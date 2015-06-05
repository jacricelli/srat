/*!
 * Tabla
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

$(function() {
	$('table').each(function() {
		$('th a.asc, th a.desc', this)
		.parent()
		.append('<i>&nbsp;</i>');
	});
});
