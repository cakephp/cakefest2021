<?php
declare(strict_types=1);

namespace App\Controller;

class LoginController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login']);
        $this->viewBuilder()->setLayout('login');
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/home';

            return $this->redirect($target);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function logout()
    {
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Login', 'action' => 'login']);
    }
}
