<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ajax extends Controller {

	public function action_nextnumber()
	{
		$this->auto_render = FALSE;

		if($this->request->param('id') == '') $result = FALSE;
		else {
			$id = $this->request->param('id');

			$q = 'SELECT * FROM codifier_instr WHERE id = '.$id;
			$r = DB::query(Database::SELECT,$q)->execute()->as_array();
			$query = 'SELECT left( kodinstr, 13) as kodinstr FROM `orders` where MID(kodinstr,5,4) BETWEEN "'.$r[0]['numstart'].'" and "'.$r[0]['numend'].'" ORDER by left( kodinstr, 13) DESC LIMIT 1';
			$result = DB::query(Database::SELECT,$query)->execute()->as_array();
		}
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';
		$this->response->headers['Cache-Control'] = 'no-cache, must-revalidate';
		$this->response->headers['Pragma'] = 'no-cache';
		$this->response->headers['Expires'] = '-1';

		//$this->response->body(json_encode($result));
		$int = str_replace('-','',$result[0]['kodinstr']);
		$int++;
		//(string)$int;

		$res = substr($int,0,3).'-'.substr($int,3,4).'-'.substr($int,7,4).'|'.$r[0]['name'];
		$this->response->body($res);
		//echo $res;
	}
}