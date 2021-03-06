<?php
/**
 * Sistema de Registro de Asistencia y Temas
 *
 * (c) Universidad Tecnológica Nacional - Facultad Regional Delta
 *
 * Este archivo está sujeto a los términos y condiciones descritos
 * en el archivo LICENCIA.txt que acompaña a este software.
 *
 * @author Jorge Alberto Cricelli <jacricelli@gmail.com>
 */

/**
 * Dependencias
 */
App::uses('AppModel', 'Model');

/**
 * Período
 *
 * @author Jorge Alberto Cricelli <jacricelli@gmail.com>
 */
class Periodo extends AppModel {

/**
 * Comportamientos
 *
 * @var array
 */
	public $actsAs = array(
		'Search.Searchable'
	);

/**
 * Campos de búsqueda
 *
 * @var array
 */
	public $filterArgs = array(
		'buscar' => array(
			'method' => 'orConditions',
			'type' => 'query'
		)
	);

/**
 * Reglas de validación
 *
 * @var array
 */
	public $validate = array(
		'desde' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'last' => true,
				'message' => 'Este campo no puede estar vacío'
			),
			'valid' => array(
				'rule' => array('date', 'ymd'),
				'message' => 'La fecha seleccionada no es válida'
			),
			'isUnique' => array(
				'rule' => array('validateUnique', array('hasta')),
				'message' => 'El período seleccionado ya existe'
			)
		),
		'hasta' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'last' => true,
				'message' => 'Este campo no puede estar vacío'
			),
			'valid' => array(
				'rule' => array('date', 'ymd'),
				'message' => 'La fecha seleccionada no es válida'
			),
			'validEndDate' => array(
				'rule' => 'validateEndDate',
				'message' => 'La fecha seleccionada debe ser igual o mayor que la indicada en el campo previo'
			)
		),
		'obs' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'last' => true,
				'message' => 'Este campo no puede estar vacío'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'El valor de este campo no debe superar los 255 caracteres'
			)
		)
	);

/**
 * Genera condiciones de búsqueda
 *
 * @param array $data Datos a buscar
 *
 * @return array
 */
	public function orConditions($data = array()) {
		$value = current($data);
		$condition = array(
			'OR' => array(
				'Periodo.obs LIKE' => '%' . $value . '%'
			)
		);

		if (preg_match('/^[0-9\/]+$/', $value)) {
			$date = date_create_from_format('d/m/Y', $value);
			if ($date) {
				$condition['OR']['Periodo.desde LIKE'] = '%' . $date->format('Y-m-d') . '%';
				$condition['OR']['Periodo.hasta LIKE'] = '%' . $date->format('Y-m-d') . '%';
			} else {
				$condition['OR']['Periodo.desde LIKE'] = '%' . $value . '%';
				$condition['OR']['Periodo.hasta LIKE'] = '%' . $value . '%';
			}
		}

		return $condition;
	}

/**
 * Genera un rango de fechas incluyendo todos los períodos registrados
 *
 * @return array Rango de fechas
 */
	public function getDatesRange() {
		$rows = $this->find('all', array(
			'fields' => array('desde', 'hasta'),
			'order' => array('desde' => 'ASC')
		));

		$out = array();
		foreach ($rows as $row) {
			if ($row[$this->alias]['desde'] === $row[$this->alias]['hasta']) {
				$out[] = $row[$this->alias]['desde'];
			} else {
				$end = new DateTime($row['Periodo']['hasta']);
				$end = $end->modify('+1 day');
				$period = new DatePeriod(
					new DateTime($row['Periodo']['desde']),
					DateInterval::createFromDateString('1 day'),
					$end
				);
				foreach ($period as $date) {
					$out[] = $date->format('Y-m-d');
				}
			}
		}

		if (!empty($out)) {
			$out = array_unique($out);
		}
		return $out;
	}

/**
 * Valida la subida de un archivo
 *
 * @param array $data Datos
 *
 * @return bool
 *
 * @link https://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#validating-uploads
 */
	public function isUploadedFile($data) {
		if (isset($data[$this->alias])) {
			$data = $data[$this->alias];
		}

		if (!isset($data['tmp_error'])) {
			$key = key($data);
			if (isset($data[$key]['tmp_name'])) {
				$data = $data[$key];
			}
		}

		if ((isset($data['error']) && $data['error'] == 0) ||
			(!empty($data['tmp_name']) && $data['tmp_name'] != 'none')
		) {
			return is_uploaded_file($data['tmp_name']);
		}

		return false;
	}

/**
 * Importa períodos desde un archivo en formato JSON
 *
 * @param string $file Ruta de acceso al archivo
 *
 * @return bool
 */
	public function importarArchivo($file) {
		if (empty($file) || !file_exists($file) || !is_readable($file)) {
			return false;
		}

		$rows = json_decode(file_get_contents($file));
		if (!is_array($rows)) {
			return false;
		}

		if (!empty($rows)) {
			$dboSource = $this->getDataSource();
			$dboSource->begin();

			if (!$dboSource->truncate($this->table)) {
				$dboSource->rollback();

				return false;
			}

			foreach ($rows as $row) {
				$this->create($row);
				if (!$this->save()) {
					$dboSource->rollback();

					return false;
				}
			}

			$dboSource->commit();
		}

		unlink($file);

		return true;
	}
}
