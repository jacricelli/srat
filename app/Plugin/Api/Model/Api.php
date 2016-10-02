<?php
/**
 * Sistema de Registro de Asistencia y Temas
 *
 * (c) Universidad Tecnológica Nacional - Facultad Regional Delta
 *
 * Este archivo está sujeto a los términos y condiciones descritos
 * en el archivo LICENCIA.txt que acompaña a este software.
 */

/**
 * Dependencias
 */
App::uses('Model', 'Model');

/**
 * Api
 */
class Api extends Model {

/**
 * Modelo sin tabla
 *
 * @var bool
 */
	public $useTable = false;

/**
 * Devuelve todos los cargos asociados a un usuario en el día de la fecha
 *
 * @param int $id Identificador del usuario
 *
 * @return array
 */
	public function getCargos($id) {
		$cargos = array();

		$rows = ClassRegistry::init('Usuario')->getCargos($id);
		if (!empty($rows['Registro'])) {
			foreach ($rows['Registro'] as $rid => $row) {
				$token = array(
					'id' => $row['id'],
					'tipo' => $row['tipo'],
					'asignatura_id' => $row['asignatura_id'],
					'usuario_id' => $row['usuario_id'],
					'fecha' => $row['fecha']
				);

				$cargos[$rid] = array(
					'id' => \Firebase\JWT\JWT::encode($token, Configure::read('Security.salt'), 'HS256'),
					'asignatura' => $rows['Cargo'][$rid]['asignatura'],
					'entrada' => $row['entrada'],
					'salida' => $row['salida'],
					'obs' => $row['obs']
				);
			}
		}

		return compact('cargos');
	}

/**
 * Prepara los cargos enviados por el usuario para ser guardados
 *
 * @param array $data Cargos
 *
 * @return array
 */
	public function parseCargos($data) {
		$out = array();

		if (!empty($data['cargos'])) {
			foreach ($data['cargos'] as $rid => $row) {
				if (empty($row['id'])) {
					continue;
				}
				try {
					$out[$rid] = (array)\Firebase\JWT\JWT::decode($row['id'], Configure::read('Security.salt'), array('HS256'));
				} catch (Exception $e) {
					continue;
				}

				$missing = false;
				foreach (array('entrada', 'salida', 'obs') as $field) {
					if (!isset($row[$field])) {
						$missing = true;
						break;
					}
					$out[$rid][$field] = $row[$field];
				}
				if ($missing) {
					$out[$rid] = array();
					continue;
				}

				if (date('Y-m-d') !== date('Y-m-d', strtotime($out[$rid]['fecha']))) {
					$out[$rid] = array();
					continue;
				}

				if (empty($out[$rid]['id'])) {
					$conditions = array(
						'tipo' => $out[$rid]['tipo'],
						'asignatura_id' => $out[$rid]['asignatura_id'],
						'usuario_id' => $out[$rid]['usuario_id'],
						'DATE(fecha)' => date('Y-m-d', strtotime($out[$rid]['fecha']))
					);
					if (ClassRegistry::init('Registro')->hasAny($conditions)) {
						$out[$rid] = array();
						continue;
					}
				}
			}
		}

		return array_filter($out);
	}
}
