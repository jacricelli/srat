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
App::uses('Controller', 'Controller');

/**
 * Usuarios
 */
class UsuariosController extends Controller {

/**
 * Componentes
 *
 * @var array
 */
	public $components = array(
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'legajo'),
					'passwordHasher' => 'Blowfish',
					'recursive' => -1,
					'scope' => array('estado' => 1),
					'userFields' => array('id', 'legajo', 'apellido', 'nombre'),
					'userModel' => 'Usuario'
				),
				'Api.Token'
			)
		)
	);

/**
 * Vista
 *
 * @var string
 */
	public $viewClass = 'Json';

/**
 * Constructor
 *
 * @param CakeRequest $request Petición
 * @param CakeResponse $response Respuesta
 *
 * @return void
 */
	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);

		Configure::write('Exception.renderer', 'Api.ApiExceptionRenderer');
	}

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->response->disableCache();
		$this->response->type('json');

		$this->Auth->allow('token');
	}

/**
 * Genera un token para un usuario
 *
 * @return void
 *
 * @throws NotFoundException Cuando no es posible identificar el usuario o no existe
 *
 */
	public function token() {
		$this->request->allowMethod('post');

		$this->request->data = array(
			'Usuario' => $this->request->data
		);

		$user = $this->Auth->identify($this->request, $this->response);
		if (!$user) {
			throw new NotFoundException('No fue posible identificar el usuario especificado o no existe.');
		}

		$payload = array(
			'iat' => time(),
			'nbf' => time(),
			'exp' => time() + 1800,
			'data' => $user
		);
		$token = \Firebase\JWT\JWT::encode($payload, Configure::read('Security.salt'), 'HS256');

		$this->_serialize(compact('user', 'token'));
	}

/**
 * Método auxiliar para establecer variables para la vista y serializarlas
 *
 * @param array $vars Variables
 *
 * @return void
 */
	protected function _serialize(array $vars) {
		$_serialize = array_keys($vars);
		$this->set($vars + compact('_serialize'));
	}
}
