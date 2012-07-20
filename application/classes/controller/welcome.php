<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Template {

	public $template = 'tpl/default';

	public function action_index()
	{
		//$query = 'SHOW TABLES';
		//$query = 'SELECT products.*, products_types.name as type FROM products LEFT JOIN products_types ON products.type_id=products_types.id where products.parrent_id=0';
		//$data['test'] = DB::query(Database::SELECT,$query)->execute()->as_array();
		$data['test'] = 'test jqgrid';
		$this->template->content = View::factory('welcome',$data);
	}
	public function action_gantt()
	{
		$data['test'] = 'test gantt';
		$this->template->content = View::factory('gantt',$data);
	}

} // End Welcome