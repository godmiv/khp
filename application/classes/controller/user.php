<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Template {

	public $template = 'tpl/default';

	public function action_index()
	{
		$data['text'] = 'text';
		$this->template->content = View::factory('user/login',$data);
	}
	
	public function action_login() {
		$this->auto_render = false;
		$login = Arr::get($_POST, 'login');
		$pass = Arr::get($_POST, 'pass');
		$url = Arr::get($_POST,'url');
		$query = DB::select()->from('users')->where('login','=',$login);
		if(!$query->execute()->get('pass')) $data = 'Неверный логин';
		else {
			$query = DB::select()->from('users')->where('login','=',$login)
				->where('pass', '=', $pass);
			$result = $query->execute()->as_array();
			if(!$result) $data = 'Неверный пароль';
			else {
				$data = 'Авторизация пройдена';
				$user = $result[0];
				Session::instance()->set('user', $result[0]);
			}
			$this->request->redirect($url);
			//print_r(Session::instance()->as_array());
		}
		//$this->response->body($data);
	}
	
	public function action_logout() {
		$this->auto_render = false;
		Session::instance()->delete('user');
		$this->request->redirect();
		//$this->response->body('ok');
	}
	
	public function action_changepass() {
		
	}
}