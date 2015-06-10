<?php
/**
 * Configuración de CakePHP
 *
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
 * Nivel de depuración
 */
Configure::write('debug', 0);

/**
 * Configuración del manejador de errores
 */
Configure::write('Error', array(
	'handler' => 'ErrorHandler::handleError',
	'level' => E_ALL & ~E_DEPRECATED,
	'trace' => true
));

/**
 * Configuración del manejador de excepciones
 */
Configure::write('Exception', array(
	'handler' => 'ErrorHandler::handleException',
	'log' => true,
	'renderer' => 'AppExceptionRenderer'
));

/**
 * Descomentar la siguiente línea cuando no se utilice mod_rewrite
 */
#Configure::write('App.baseUrl', env('SCRIPT_NAME'));

/**
 * Codificación de caracteres
 */
Configure::write('App.encoding', 'UTF-8');

/**
 * Idioma
 */
Configure::write('Config.language', 'spa');

/**
 * Zona horaria
 */
Configure::write('Config.timezone', 'America/Argentina/Buenos_Aires');

/**
 * Prefijos de las rutas
 */
Configure::write('Routing.prefixes', array('admin'));

/**
 * Deshabilitar cache
 */
Configure::write('Cache.disable', false);

/**
 * Habilitar comprobación del cache
 */
Configure::write('Cache.check', true);

/**
 * Configuración de la sesión
 */
Configure::write('Session', array(
	'cookie' => 'utn_srat',
	'cookieTimeout' => 0,
	'defaults' => 'cache'
));

/**
 * Cadena al azar usada por los métodos de seguridad
 */
Configure::write('Security.salt', '');

/**
 * Cadena numérica al azar usada por los métodos de seguridad
 */
Configure::write('Security.cipherSeed', '');

/**
 * Configuración del cache
 */
Configure::write('App.Cache', array(
	'duration' => (Configure::read('debug') == 0 ? '+1 year' : '+10 seconds'),
	'engine' => (PHP_SAPI !== 'cli' ? 'Apc' : 'File')
));

/**
 * Cache del core del framework
 */
Cache::config('_cake_core_', array_merge(
	Configure::read('App.Cache'),
	array(
		'path' => CACHE . 'persistent' . DS,
		'prefix' => basename(ROOT) . '_cake_core_'
	)
));

/**
 * Cache de modelos y orígenes de datos
 */
Cache::config('_cake_model_', array_merge(
	Configure::read('App.Cache'),
	array(
		'path' => CACHE . 'models' . DS,
		'prefix' => basename(ROOT) . '_cake_model_'
	)
));
