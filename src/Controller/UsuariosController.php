<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * Usuarios
 */
class UsuariosController extends AppController
{
    /**
     * beforeFilter
     *
     * @param \Cake\Event\Event $event Evento
     *
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if (!$this->Auth->user()) {
            if (in_array($this->request->action, ['dashboard', 'logout'])) {
                $this->Auth->setConfig('authError', false);
            }
        } else {
            $this->Auth->allow(['dashboard', 'logout']);
        }
    }

    /**
     * Inicio de sesión
     *
     * @return \Cake\Http\Response
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Los datos ingresados no son correctos'));
            }
        }

        return null;
    }

    /**
     * Cierre de sesión
     *
     * @return \Cake\Http\Response
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Dashboard
     *
     * @return void
     */
    public function dashboard()
    {
    }
}
