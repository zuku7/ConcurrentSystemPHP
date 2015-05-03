<?php
namespace App\Controller;

use App\Controller\AppController;

class ArqivosController extends AppController {
	public $uses=array();
	public $components=array('Upload');
	
	public function upload()
	{
		debug($this->request->data);
		if(!empty($this->request->data))
		{
			$this->Upload->upload($this->request->data);
		}
	}
	
}
