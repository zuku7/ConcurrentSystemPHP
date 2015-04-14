<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects']
        ];
        $this->set('tasks', $this->paginate($this->Tasks));
        $this->set('_serialize', ['tasks']);
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Users', 'Projects', 'Tasks']
        ]);
        $this->set('task', $task);
        $this->set('_serialize', ['task']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $tasks = $this->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('task', 'users', 'projects'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $tasks = $this->Tasks->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('task', 'users', 'projects', 'tasks'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success('The task has been deleted.');
        } else {
            $this->Flash->error('The task could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
