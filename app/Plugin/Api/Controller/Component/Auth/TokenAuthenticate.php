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
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

/**
 * Adaptador de autenticación para AuthComponent que permite autenticar usuarios por medio de un token
 */
class TokenAuthenticate extends BaseAuthenticate {

/**
 * Excepción
 *
 * @var Exception
 */
	protected $_error;

/**
 * Opciones de configuración
 *
 * @var array
 */
	public $settings = array(
		'header' => 'Authorization'
	);

/**
 * Autentica a un usuario en base a la información de la petición
 *
 * @param CakeRequest $request Petición
 * @param CakeResponse $response Respuesta
 *
 * @return array|bool Array con los datos del usuario o false en caso contrario
 */
	public function authenticate(CakeRequest $request, CakeResponse $response) {
		return $this->getUser($request);
	}

/**
 * Comprueba si el token está presente en la petición e intenta obtener los datos del usuario
 *
 * @param CakeRequest $request Petición
 *
 * @return array|bool Array con los datos del usuario o false en caso contrario
 */
	public function getUser(CakeRequest $request) {
		$token = $request->header($this->settings['header']);
		if ($token) {
			return $this->_getUser($token);
		}
		return false;
	}

/**
 * Obtiene los datos del usuario usando el token especificado
 *
 * @param string $token Token
 *
 * @return array|bool Array con los datos del usuario o false en caso contrario
 */
	protected function _getUser($token) {
		try {
			$payload = Firebase\JWT\JWT::decode($token, Configure::read('Security.salt'), array('HS256'));
			return (array)$payload->data;
		} catch (Exception $e) {
			$this->_error = $e;
		}
		return false;
	}

/**
 * Lanza una excepción en caso de acceso sin estar autenticado
 *
 * @param CakeRequest $request Petición
 * @param CakeResponse $response Respuesta
 *
 * @return void
 *
 * @throws UnauthorizedException
 */
	public function unauthenticated(CakeRequest $request, CakeResponse $response) {
		$message = $this->_Collection->Auth->authError;
		if ($this->_error) {
			$message = $this->_error->getMessage();
		}
		throw new UnauthorizedException($message);
	}
}
