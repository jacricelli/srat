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
App::uses('AppController', 'Controller');

/**
 * Registros
 *
 * @author Jorge Alberto Cricelli <jacricelli@gmail.com>
 */
class RegistrosController extends AppController {

/**
 * Componentes
 *
 * @var array
 */
	public $components = array(
		'Paginator'
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('Reporte');
	}

/**
 * Responde a solicitudes invalidadas por el componente Security
 *
 * @param null|string $type Tipo de error
 *
 * @return void
 */
	public function blackHole($type = null) {
		$this->Session->delete($this->_getSessionKey());

		parent::blackHole($type);
	}

/**
 * Índice
 *
 * @return void
 */
	public function admin_index() {
		$this->redirect(array('action' => 'generar_reporte'));
	}

/**
 * Genera reportes
 *
 * @return void
 */
	public function admin_generar_reporte() {
		if (!empty($this->request->named['reset'])) {
			$this->Session->delete($this->_getSessionKey());
			$this->redirect(array('action' => 'generar_reporte'));
		}

		$options = $this->Session->read($this->_getSessionKey('Options'));
		if (!$options) {
			$options = array(
				'data' => array(),
				'paging' => array()
			);
		}

		if ($this->request->is('post')) {
			$this->Reporte->create($this->request->data);
			$fieldList = array('asignatura_id', 'usuario_id', 'desde', 'hasta', 'tipo');
			if ($this->Reporte->validates(compact('fieldList'))) {
				$options['data'] = $this->Reporte->data['Reporte'];
			} else {
				$options['data'] = array();
			}
		}

		if (!$this->request->data) {
			if ($options['data']) {
				$this->request->data['Reporte'] = $options['data'];
			} else {
				$this->request->data = array(
					'Reporte' => array(
						'asignatura_id' => null,
						'usuario_id' => null,
						'desde' => null,
						'hasta' => null,
						'tipo' => 1
					)
				);
			}
		}

		$findOptions = array(
			'fields' => array(
				'asignatura', 'Usuario.legajo', 'usuario', 'tipo', 'fecha', 'entrada', 'salida', 'obs'
			),
			'order' => array('Registro.fecha' => 'desc'),
			'recursive' => 0
		);
		if (!empty($options['data']['asignatura_id'])) {
			$findOptions['conditions']['Registro.asignatura_id'] = $options['data']['asignatura_id'];
		}
		if (!empty($options['data']['usuario_id'])) {
			$findOptions['conditions']['Registro.usuario_id'] = $options['data']['usuario_id'];
		}
		if (!empty($options['data']['desde'])) {
			$findOptions['conditions']['CAST(Registro.fecha as DATE) >='] = $options['data']['desde'];
		}
		if (!empty($options['data']['hasta'])) {
			$findOptions['conditions']['CAST(Registro.fecha as DATE) <='] = $options['data']['hasta'];
		}
		if (isset($options['data']['tipo'])) {
			if ($options['data']['tipo'] === '0') {
				$findOptions['conditions']['Registro.tipo'] = 0;
			} elseif ($options['data']['tipo'] === '1') {
				$findOptions['conditions']['Registro.tipo'] = 1;
			} else {
				$findOptions['conditions']['Registro.tipo'] = array(0, 1);
			}
		}
		if (!empty($options['paging']['order'])) {
			$findOptions['order'] = $options['paging']['order'];
		}

		$this->Paginator->settings = array_merge(
			$this->Paginator->settings,
			$findOptions,
			array('limit' => 10, 'maxLimit' => 10)
		);

		$findCondition = array();
		if (!empty($this->request->data['Reporte']['asignatura_id'])) {
			$findCondition = array('asignatura_id' => $this->request->data['Reporte']['asignatura_id']);
		}
		$this->set(array(
			'asignaturas' => $this->Registro->getAsignaturasList(),
			'usuarios' => $this->Registro->getUsuariosList($findCondition),
			'rows' => $this->Paginator->paginate(),
			'title_for_layout' => 'Generar reporte - Reportes',
			'title_for_view' => 'Generar reporte'
		));

		if (isset($this->params['paging']['Registro']['order'])) {
			$options['paging']['order'] = $this->params['paging']['Registro']['order'];
		}

		$this->Session->write($this->_getSessionKey('Options'), $options);
	}

/**
 * Genera una clave de sesión incluyendo el nombre de la acción actual como prefijo
 *
 * @param string $key Clave
 *
 * @return string Clave
 */
	protected function _getSessionKey($key = '') {
		return sprintf('Reporte.%s%s',
			Inflector::camelize($this->request->action),
			(!empty($key) ? ".$key" : "")
		);
	}
}
