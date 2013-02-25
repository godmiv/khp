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
			//die('Пользователь не залогинен, нужно отсекать это раньше, а не во время записи файла.');
			Session::instance()->set('msg', 'Неавторизованный пользователь. Загрузка файлов разрешена только авторизованным пользователям.');
			$this->request->redirect(Arr::get($_POST,'returnurl'));
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
				$query = DB::insert('files', array('detal_id','owner','desc','filename','date_upload','originalfilename'))
						->values(array(
							$id,
							$sess['user']['login'],
							Arr::get($_POST,'description'),
							$uploadfile,
							DB::expr('now()'),
							$_FILES['userfile']['name']
							));
				$query->execute();
				$query = DB::update('orders')->set(array('files'=>'1'))->where('id','=',$id);
				$query->execute();
				//echo "Файл корректен и был успешно загружен.\n";
				Session::instance()->set('msg', 'Файл был успешно загружен.');
				$this->request->redirect(Arr::get($_POST,'returnurl'));
			} else {
				//echo "Файл не сохранен, чтото пошло не так... \n";
				Session::instance()->set('msg', 'Файл не сохранен, чтото пошло не так...');
				$this->request->redirect(Arr::get($_POST,'returnurl'));
			}
		}
	}
	public function action_showall()
	{
		$data['id'] = $this->request->param('id');
		$query = DB::select()->from('files')->where('detal_id', '=', $data['id']);
		$result = $query->execute()->as_array();
//print_r($result);
		if(!empty ($result)){
			$data['result'] = $result;
		}
		if ($this->request->is_ajax()){
			$this->response->body(View::factory('file/showall', $data));
		}
		else $this->template->content = View::factory('file/showall',$data);
	}
	public function action_del()
	{
		$id = $this->request->param('id');
		$query = DB::select()->from('files')->where('id', '=', $id);
		$file = $query->execute()->as_array();
		ob_start(); print_r($file); $test = ob_get_contents(); ob_end_clean();
		$this->template->content = 'Удаление файла'.$test;
	}
}