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
App::uses('Controller', 'Controller');

/**
 * Controlador de la aplicación
 *
 * @author Jorge Alberto Cricelli <jacricelli@gmail.com>
 */
class AppController extends Controller {

/**
 * Componentes
 *
 * @var array
 */
	public $components = array(
		'AbsenceUpdater',
		'Security' => array('blackHoleCallback' => 'blackHole'),
		'Session',
		'Flash',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'legajo'),
					'passwordHasher' => 'Blowfish',
					'recursive' => -1,
					'scope' => array('estado' => 1),
					'userModel' => 'Usuario'
				)
			),
			'authError' => 'La operación solicitada ha sido rechazada debido a que no cuenta con suficientes privilegios.',
			'authorize' => 'Controller',
			'flash' => array(
				'element' => 'notify',
				'key' => 'auth',
				'params' => array('level' => 'error')
			),
			'loginAction' => array('controller' => 'usuarios', 'action' => 'login', 'admin' => false, 'plugin' => false),
			'loginRedirect' => array('controller' => 'usuarios', 'action' => 'dashboard', 'admin' => false, 'plugin' => false),
			'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login', 'admin' => false, 'plugin' => false),
			'unauthorizedRedirect' => array('controller' => 'usuarios', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)
		)
	);

/**
 * Ayudantes
 *
 * @var array
 */
	public $helpers = array(
		'Flash',
		'Form' => array('className' => 'MyForm'),
		'Html' => array('className' => 'MyHtml'),
		'Session'
	);

/**
 * Configuración de notificaciones
 *
 * @var array
 */
	protected $_notify = array(
		'blackHole' => array(
			'level' => 'error',
			'message' => 'Se ha rechazado la solicitud debido a que los datos recibidos no son válidos.',
			'redirect' => true
		),
		'record_created' => array(
			'level' => 'success',
			'message' => 'La operación solicitada se ha completado exitosamente.',
			'redirect' => true
		),
		'record_modified' => array(
			'level' => 'success',
			'message' => 'La operación solicitada se ha completado exitosamente.',
			'redirect' => array('action' => 'index')
		),
		'record_not_saved' => array(
			'level' => 'warning',
			'message' => 'La operación solicitada no se ha completado debido a un error inesperado.',
			'redirect' => false
		),
		'record_deleted' => array(
			'level' => 'success',
			'message' => 'La operación solicitada se ha completado exitosamente.',
			'redirect' => array('action' => 'index')
		),
		'record_not_deleted' => array(
			'level' => 'warning',
			'message' => 'La operación solicitada no se ha completado debido a un error inesperado.',
			'redirect' => array('action' => 'index')
		),
		'record_delete_associated' => array(
			'level' => 'warning',
			'message' => 'La operación solicitada no se ha completado debido a que el registro se encuentra asociado.',
			'redirect' => array('action' => 'index')
		)
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->response->disableCache();

		if ($this->Auth->user()) {
			if ($this->Auth->user('reset') && $this->request->controller !== 'usuarios') {
				$this->redirect(array(
					'controller' => 'usuarios', 'action' => 'restablecer', 'admin' => false, 'plugin' => false
				));
			}
		}

		if ($this->Auth->user('admin')) {
			$this->set('totalAbsences', ClassRegistry::init('Inasistencia')->getYesterdaysTotal());
		}
	}

/**
 * Comprueba si un usuario tiene acceso a las acciones de un controlador
 *
 * @param array $user Datos del usuario
 *
 * @return bool `true` en caso exitoso o `false` en caso contrario
 */
	public function isAuthorized($user = null) {
		if ($this->request->prefix === 'admin') {
			return (bool)$user['admin'];
		}
		return true;
	}

/**
 * Responde a solicitudes invalidadas por el componente Security
 *
 * @param null|string $type Tipo de error
 *
 * @return void
 */
	public function blackHole($type = null) {
		$this->_notify(__FUNCTION__);
	}

/**
 * Genera una notificación
 *
 * Las configuraciones se definen en la propiedad `AppController::$_notify` o bien,
 * puede especificarse en el segundo parámetro de este método.
 *
 * ### Opciones
 *
 * (string) `level`
 * Nivel de notificación, `error`, `info`, `success` o `warning`.
 *
 * (string) `message`
 * Mensaje de la notificación.
 *
 * (boolean|array|string) `redirect`
 * El valor `true` realiza una redirección a la URL actual (actualizar URL). Una matriz o cadena
 * especifica la dirección URL a redireccionar.
 *
 * @param string|Exception $name Nombre de la configuración o instancia de una excepción
 * @param array $config Opciones de configuración en caso de no tener una configuración
 * definida o para modificar una existente
 *
 * @return void
 */
	protected function _notify($name = null, $config = array()) {
		$default = array(
			'level' => 'error',
			'message' => 'No hay descripción del error.',
			'redirect' => false
		);

		if ($name instanceof Exception) {
			$default['message'] = $name->getMessage();
			$name = Inflector::underscore(str_replace('Exception', '', get_class($name)));
		}

		$options = array();
		if (isset($this->_notify[$name])) {
			$options = array_merge($this->_notify[$name], $config);
		} else {
			$options = array_merge($default, $config);
		}

		foreach (array_keys($default) as $key) {
			if (!isset($options[$key])) {
				$options[$key] = $default[$key];
			}
		}

		$this->Flash->set(
			$options['message'],
			array('element' => 'notify', 'params' => array('level' => $options['level']))
		);

		if ($options['redirect']) {
			if ($options['redirect'] === true) {
				$options['redirect'] = '';
			}
			$this->redirect($options['redirect']);
		}
	}
}
