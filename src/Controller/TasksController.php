<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;

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

		public function myprofile()
		{
		//debug($this->Auth->user());
		$name = $this->Auth->user('login');
		$this->set('id',$this->Auth->user('id'));
		$this->set('role', $this->Auth->user('group_id') );
		$this->set('name' , $name );

			$this->paginate = [
			'contain' => ['Users', 'Projects' ]
			];
			$id=$this->Auth->user('id');

			if($this->Auth->user('group_id')== 1)
			{
			$this->set(
			'tasks', $this->paginate($this->Tasks));
			}
			else {

			$query = $this->Tasks->find('all')->where(['user_id' => $id]);

			$this->set('tasks', $this->paginate($query));

			}

			$this->set(
		'_serialize', ['tasks']);
		$this->set('role', $this->Auth->user('group_id') );
		
		}
	
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Projects' ]
			];
			$id=$this->Auth->user('id');
			
			$query = $this->Tasks->find('all')->where(['user_id' => $id]);
			//debug($this->paginate($query));
			$this->set('tasks', $this->paginate($query));

			// $this->set(
		// 'tasks', $this->paginate($this->Tasks));
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
			
			$files=null;
			
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

	$queryUser = TableRegistry::get('Users')->find()->where(['id' => $this->request->data['user_id' ]]);

	foreach ($queryUser as $user) {
	$userMail=$user->email;
	$userLogin=$user->login;
	}
	$queryProject = TableRegistry::get('Projects')->find()->where(['id' => $this->request->data['project_id']]);

	foreach ($queryProject as $project) {
	$projectName=$project->name;

	}

	$email = new Email();
	$email->transport('default');

	try {
	$res = $email->from([ $this->Auth->user(
	'email') => $this->Auth->user('login')])
	->to([$userMail => $userLogin])
	->subject('ConcurrentSystem - Added to Task')
	->send('Hi '.$userLogin.','."\n".'You have been added to task:  '.$this->request->data['name'].' in project: '.$projectName."\n".'Kinds regards'.','."\n".$this->Auth->user('login'));

	} catch (Exception $e) {

	echo 'Exception : ',  $e->getMessage(), "\n";

	}

	$this->Flash->success('The task has been saved.');
	//$this->Flash->success($query);
	return $this->redirect(['action' => 'myprofile']);
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
debug($query);
		$task = $this->Tasks->get($id, [
		'contain' => []
		]);

		if(!empty($this->request->data))
		{
		$path=$this->Upload->upload($this->request->data,$id);
		$task->file= $path;
		if ($this->Tasks->save($task)) {
		$this->Flash->success('The task has been saved.And file has been added');
		return $this->redirect(['action' => 'myprofile']);
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
                return $this->redirect(['action' => 'myprofile']);
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
        return $this->redirect(['action' => 'myprofile']);
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
