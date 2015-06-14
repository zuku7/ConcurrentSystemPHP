<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */ public function beforeFilter(\Cake\Event\Event $event)
		{
		parent::beforeFilter($event);
		$this->Auth->allow([ 'logout' ]);
		}

		public function myprofile()
		{
		//debug($this->Auth->user());
		$name = $this->Auth->user('login');
		$this->set('id',$this->Auth->user('id'));
		$this->set('role', $this->Auth->user('group_id') );
		$this->set('name', $name );

		}

		public function index()
		{

		$this->paginate = [
		'contain' => [ 'Groups']
		];
		$role=$this->Auth->user('group_id');
		//debug($this->Auth->user('group_id'));
		$name = $this->Auth->user('login');
		$this->set('role', $role );
		$this->set('name', $name );
		$this->set('users' , $this->paginate($this->Users));

		}
	public function sample()
		{

		$name = $this->Auth->user('login');
		$this->set('name', $name );
		}

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
    }
	


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'myprofile']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
        $this->set('_serialize', ['user']);
		$this->set('role', $this->Auth->user('group_id') );
				$name = $this->Auth->user('login');
		$this->set('id',$this->Auth->user('id'));
		
		$this->set('name' , $name );
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
	
	public function login()
	{
		if ($this->request->is('post')) {
		//	debug($this->request->data);
			
			$user = $this->Auth->identify();

			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Incorrect password or email.'));
		}
	}

	public function logout()
	{
		$this->Flash->success('You logged out successfully.');
		return $this->redirect($this->Auth->logout());
	}
}
