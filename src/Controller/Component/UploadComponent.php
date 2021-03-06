<?php
namespace App\Controller\Component;



use Cake\Controller\Component;


class UploadComponent extends Component {
	public $max_files=3;
	
	public function upload($data = null,$id=null)
	{
		if(!empty($data))
		{
			$index = 0;
			
			foreach ($data['uploadfile'] as $file) {
			
				$filename= $file['name'];
				$file_tmp_name= $file['tmp_name'];
				$dir=WWW_ROOT.'uploads'.'/'.$id."/";
					

					if (!file_exists($dir)) {
					mkdir(WWW_ROOT.'uploads'.'/'. $id, 0777);
					echo "The directory $dir was successfully created.";
					
					} else {
					echo "The directory $dir exists.";
					}
					

				
				move_uploaded_file($file_tmp_name, $dir.$filename);
				$index++;
			}
		}
		return $dir.'-'.$filename;
	}
	
}
