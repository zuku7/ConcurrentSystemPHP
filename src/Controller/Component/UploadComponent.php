<?php
namespace App\Controller\Component;



use Cake\Controller\Component;


class UploadComponent extends Component {
	public $max_files=3;
	
	public function upload($data = null,$id=null)
	{
		if(!empty($data))
		{
			
			foreach ($data as $file) {
				
				$filename= $file['name'];
				$file_tmp_name= $file['tmp_name'];
				$dir=WWW_ROOT.'uploads'.DS.$id;
				$allowed= array('jpg','png' );
				move_uploaded_file($file_tmp_name, $dir.'-'.$filename);
				
			}
		}
		return $dir.'-'.$filename;
	}
	
}
