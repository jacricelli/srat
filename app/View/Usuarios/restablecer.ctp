<?php
/**
 * Restablecer contraseña
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
 * Breadcrumbs
 */
$this->Html->addCrumb('Restablecer contraseña');
?>
<?php echo $this->Form->create('Usuario', array('class' => 'form-vertical')) ?>
<ul>
	<li>Los campos indicados con <span class="required">*</span>son obligatorios.</li>
</ul>
<fieldset>
	<?php
	echo $this->Form->hidden('id');
	echo $this->Form->hidden('reset');

	echo $this->Form->input('new_password', array(
		'after' => 'Debe estar compuesta por letras, números y un mínimo de 6 caracteres',
		'autofocus',
		'class' => 'span3',
		'label' => 'Nueva contraseña',
		'type' => 'password'
	));
	?>
</fieldset>
<?php
echo $this->Form->buttons(array(
	'Guardar' => array('type' => 'submit')
));
