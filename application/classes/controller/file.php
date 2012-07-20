<?php defined('SYSPATH') or die('No direct script access.');

class Controller_File extends Controller_Template {

	public $template = 'tpl/default';
	
	public function action_form() {
		$this->auto_render = false;
		$data['test'] = 'Форма загрузки файлов';
		$this->response->body(View::factory('file/upload',$data));
	}

	public function action_upload()
	{
		$this->auto_render = false;
		echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		echo date('Y/m/d');
		echo '</pre>';
		$pathname = 'upload/';
		$sess = Session::instance()->as_array();
		if(!isset ($sess['user'])){
			die('Пользователь не залогинен, нужно отсекать это раньше, а не во время записи файла.');
		} else {
			$id = Arr::get($_POST, 'selectedrow');
			//$pathname .= date('Y/m/d'). '/' . $id . '/';
			$pathname .= $id . '/';
			$newFileName = md5(basename($_FILES['userfile']['name']));
			$newFileExt = strrchr($_FILES['userfile']['name'], '.');
			$uploadfile = $pathname . $newFileName . $newFileExt;
			echo $uploadfile;
			if(!is_dir($pathname)) mkdir($pathname,0,true);
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				$query = DB::insert('files', array('order_id','owner','desc','filename','date_upload'))
						->values(array(
							$id,
							$sess['user']['login'],
							Arr::get($_POST,'description'),
							$uploadfile,
							DB::expr('now()')
							));
				$query->execute();
				echo "Файл корректен и был успешно загружен.\n";
			} else {
				echo "Файл не сохранен, чтото пошло не так... \n";
			}
		}
	}
	public function action_showall()
	{
		$data['id'] = $this->request->param('id');
		$query = DB::select()->from('files')->where('order_id', '=', $data['id']);
		$result = $query->execute()->as_array();
		if(!empty ($result)){
			$data['result'] = $result;
		}
		$this->template->content = View::factory('file/showall',$data);
	}
}