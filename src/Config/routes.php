<?php
/**
 * Configuración de las rutas
 *
 * Sistema de Registro de Asistenca y Temas
 *
 * (c) Universidad Tecnológica Nacional - Facultad Regional Delta
 *
 * Este archivo está sujeto a los términos y condiciones descritos
 * en el archivo licencia.txt que acompaña a este software.
 *
 * @author Jorge Alberto Cricelli <jalberto.cr@live.com>
 */

/**
 * Índice
 */
Router::connect('/', array(
	'controller' => 'usuarios',
	'action' => 'dashboard'
));

/**
 * Inicio de sesión
 */
Router::connect('/login', array(
	'controller' => 'usuarios',
	'action' => 'login'
));

/**
 * Rutas de los plugins
 */
CakePlugin::routes();

/**
 * Rutas predeterminadas de CakePHP
 */
require CAKE . 'Config' . DS . 'routes.php';
