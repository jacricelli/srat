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
 * Autocargador de clases de Composer
 */
require_once ROOT . '/vendor/autoload.php';

/**
 * Quitar y volver a agregar el autocargador de clases de CakePHP para que el de Composer tenga precedencia
 * http://goo.gl/kKVJO7
 */
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);
