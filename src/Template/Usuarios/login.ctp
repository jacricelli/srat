<?php
echo $this->Form->create();
echo $this->Form->input('legajo');
echo $this->Form->input('password', ['label' => 'Contraseña']);
echo $this->Form->button('Iniciar sesión');
echo $this->Form->end();
