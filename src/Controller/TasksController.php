<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

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
     */ public function beforeFilter(\Cake\Event\Event $event)
	{
	parent::beforeFilter($event);
	$this->Auth->allow('add');
	}

	public $components=array(
'Upload');
	
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects']
        ];
        $this->set('tasks', $this->paginate($this->Tasks));
        $this->set('_serialize', ['tasks']);
		$this->set('role', $this->Auth->user('group_id') );
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
            'contain' => ['Users', 'Projects' ]
			]);
			
			$dir=WWW_ROOT.'uploads'.'/'.$id."/";
			if (!file_exists($dir)) {
			mkdir(WWW_ROOT.'uploads'.'/'. $id, 0777);
			$files='no file.';
			
			} else {
				$dir = new Folder(WWW_ROOT . 'uploads/'. $id.'/');
				$files = $dir->find();
				//debug($files);
			//$file='exists.';
			}

			$this->set(
		'task', $task);
					$this->set(
		'files', $files);
        $this->set('_serialize', ['task']);
		$this->set('role', $this->Auth->user('group_id') );
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */ public function add()
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
	$users = $this->Tasks->Users->find('list', [
	'keyField' => 'id', 'valueField' => 'login'
	]);
	$projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
	$tasks = $this->Tasks->find('list', ['limit' => 200]);
	$this->set(compact('task', 'users', 'projects', 'tasks'));
	$this->set('_serialize', ['task' ]);
		}

		public function upload($id = null)
		{
		//debug($this->request->data);

		$task = $this->Tasks->get($id, [
		'contain' => []
		]);

		if(!empty($this->request->data))
		{
		$path=$this->Upload->upload($this->request->data,$id);
		$task->file= $path;
		if ($this->Tasks->save($task)) {
		$this->Flash->success('The task has been saved.And file has been added');
		return $this->redirect(['action' => 'index']);
		} else {
		$this->Flash->error('The task could not be saved. Please, try again.');
		}

		}
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
	
	public function chart()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects']
        ];
        $this->set('tasks', $this->paginate($this->Tasks));
        $this->set('_serialize', ['tasks']);
    }
}
