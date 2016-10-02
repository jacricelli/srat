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
 * Token
 */
Router::connect('/api/token', array(
	'controller' => 'usuarios',
	'action' => 'token',
	'plugin' => 'api'
));
