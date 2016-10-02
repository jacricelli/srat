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
App::uses('ExceptionRenderer', 'Error');

/**
 * Renderizador de excepciones
 */
class ApiExceptionRenderer extends ExceptionRenderer {

/**
 * Excepción
 *
 * @var Exception
 */
	public $error;

/**
 * Constructor
 *
 * @param Exception $exception Excepción
 *
 * @return void
 */
	public function __construct($exception) {
		$this->error = $exception;
	}

/**
 * Genera la respuesta con los datos de la excepción
 *
 * @return void
 */
	public function render() {
		$response = new CakeResponse();

		$error = new stdClass;
		$error->code = $this->error->getCode();
		$error->message = $this->error->getMessage();

		try {
			$response->statusCode($error->code);
		} catch (Exception $e) {
			$error->code = 500;
			$response->statusCode($error->code);
		}
		$response->body(json_encode(compact('error')));
		$response->send();
	}
}
