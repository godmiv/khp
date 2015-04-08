<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Order extends Controller_Template {

	public $template = 'tpl/default';
	//public $user = array('login'=>'testuser','grp'=>'testgroup');
	public $columns;

	public function before() {
		parent::before();
		$this->user = Session::instance()->get('user');
		$this->columns['detal'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','60'),
			'status'=>array('Статус','60'),
			'detalavto'=>array('Деталь автомобиля','140'),
			'nazvdet'=>array('Название детали','110'),
			'nosnas'=>array('Шифр оснастки','170'),
			'nizv'=>array('Изв. оснастки','90'),
			'kodinstr'=>array('Шифр инструмента','140'),
			'nizvins'=>array('Изв. истр.','90'),
			//'date_start'=>array('Дата выдачи заказа','100'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'comment_start'=>array('Текст заказа','120','textarea'),//'text'=>array('Коментарий технолога','250','textarea'),
			'user_start'=>array('Выдал заказ','90'),
			'files'=>array('','16'),
		);
$this->columns['orders'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','60'),
			'status'=>array('Статус','60'),
			'detalavto'=>array('Деталь автомобиля','140'),
			'nazvdet'=>array('Название детали','110'),
			'nosnas'=>array('Шифр оснастки','170'),
			'nizv'=>array('Изв. оснастки','90'),
			'kodinstr'=>array('Шифр инструмента','140'),
			'nizvins'=>array('Изв. истр.','90'),
			//'date_start'=>array('Дата выдачи заказа','100'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'comment_start'=>array('Текст заказа','120','textarea'),//'text'=>array('Коментарий технолога','250','textarea'),
			'user_start'=>array('Выдал заказ','90'),
			'comment_accept'=>array('Коментарий конструктора','120'),
			'files'=>array('','16'),
		);
		$this->columns['startedorders'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','60'),
			'status'=>array('Статус','60'),
			'detalavto'=>array('Деталь автомобиля','140'),
			'nazvdet'=>array('Название детали','110'),
			'nosnas'=>array('Шифр оснастки','170'),
			'nizv'=>array('Изв. оснастки','90'),
			'kodinstr'=>array('Шифр инструмента','140'),
			'nizvins'=>array('Изв. истр.','90'),
			'comment_start'=>array('Текст заказа','120','textarea'),
			'comment_accept'=>array('Коментарий конструктора','120'),
			'date_start'=>array('Дата выдачи заказа','85'),
			'user_start'=>array('Выдал заказ','90'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'files'=>array('','16'),
		);

		$this->columns['acceptorders'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','60'),
			'status'=>array('Статус','60'),
			'detalavto'=>array('Деталь автомобиля','140'),
			'nazvdet'=>array('Название детали','110'),
			'nosnas'=>array('Шифр оснастки','170'),
			'nizv'=>array('Изв. оснастки','90'),
			'kodinstr'=>array('Шифр инструмента','140'),
			'nizvins'=>array('Изв. истр.','90'),
			'comment_start'=>array('Коментарий технолога','120','textarea'),
			'comment_accept'=>array('Коментарий конструктора','120'),
			'date_start'=>array('Дата выдачи заказа','85'),
			'user_start'=>array('Выдал заказ','90'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'files'=>array('','16'),
		);

		$this->columns['plan'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','70'),
			'status'=>array('Статус','70'),
			'detalavto'=>array('Деталь автомобиля','150'),
			'nazvdet'=>array('Название детали','120'),
			'nosnas'=>array('Шифр оснастки','180'),
			'nizv'=>array('Изв. оснастки','100'),
			'kodinstr'=>array('Шифр инструмента','200'),
			'nizvins'=>array('Изв. истр.','100'),
			'comment_start'=>array('Коментарий технолога','120','textarea'),
			'comment_accept'=>array('Коментарий конструктора','120'),
			'date_start'=>array('Дата выдачи заказа','85'),
			'user_start'=>array('Выдал заказ','100'),
			'doer'=>array('Исполнитель','120'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'files'=>array('','16'),
		);

		$this->columns['finish'] = array(
			'id'=>array('ID','30'),
			'number'=>array('№ заказа','70'),
			'status'=>array('Статус','70'),
			'detalavto'=>array('Деталь автомобиля','150'),
			'nazvdet'=>array('Название детали','120'),
			'nosnas'=>array('Шифр оснастки','170'),
			'nizv'=>array('Изв. оснастки','100'),
			'kodinstr'=>array('Шифр инструмента','170'),
			'nizvins'=>array('Изв. истр.','100'),
			'comment_start'=>array('Коментарий технолога','120','textarea'),
			'comment_accept'=>array('Коментарий конструктора','120'),
			'date_start'=>array('Дата выдачи заказа','85'),
			'user_start'=>array('Выдал заказ','100'),
			'doer'=>array('Исполнитель','100'),
			//'date_end'=>array('Дата сдачи заказа','100'),
			'files'=>array('','16'),
		);
	}

	public function action_index() {
		$data['text'] = 'Index of order';
		$this->template->content = View::factory('order/index',$data);
	}

	/*
	 * Выдача заказа технологами
	 *
	 */
	public function action_start() {
		$data['title'] = 'Открытие заказа';

		$data['form_osn'] = array(
			'detalavto'	=>array('name'=>'detalavto','value'=>Arr::get($_POST, 'detalavto', ''),'attr'=>array('desc'=>'Деталь автомобиля', 'id'=>'detalavto')),
			'nazvdet'	=>array('name'=>'nazvdet',	'value'=>Arr::get($_POST, 'nazvdet', ''),'attr'=>array('desc'=>'Название детали', 'id'=>'nazvdet')),
			'nosnas'	=>array('name'=>'nosnas',	'value'=>Arr::get($_POST, 'nosnas', ''),'attr'=>array('desc'=>'Шифр оснастки', 'id'=>'nosnas')),
			'nizv'		=>array('name'=>'nizv',		'value'=>Arr::get($_POST, 'nizv', ''),'attr'=>array('desc'=>'Извещение оснастки', 'id'=>'nizv')),
		);

		$data['form_ins'] = array(
			'kodinstr'	=>array('name'=>'kodinstr',	'value'=>Arr::get($_POST, 'kodinstr', ''),'attr'=>array('desc'=>'Код инструмента', 'id'=>'kodinstr', 'readonly'=>'readonly')),
			'nizvins'	=>array('name'=>'nizvins',	'value'=>Arr::get($_POST, 'nizvins', ''),'attr'=>array('desc'=>'Извещение инструмента', 'id'=>'nizvins')),
		);

		$data['form_all'] = array(
			'comment_start'	=>array('name'=>'comment_start', 'value'=>Arr::get($_POST, 'comment_start', ''), 'attr'=>array('desc'=>'Текст заказа', 'id'=>'comment_start', 'cols'=>'30', 'rows'=>'5')),
		);

		$data['columns']['detal'] = $this->columns['detal'];
		$data['columns']['orders'] = $this->columns['orders'];
		$data['columns']['startedorders'] = $this->columns['startedorders'];

		foreach ($data['columns']['detal'] as $key=>$val){
			$data['colnames']['detal'][] = $val[0];
		}
		foreach ($data['columns']['orders'] as $key=>$val){
			$data['colnames']['orders'][] = $val[0];
		}
		foreach ($data['columns']['startedorders'] as $key=>$val){
			$data['colnames']['startedorders'][] = $val[0];
		}

		$query = DB::select()->from('codifier_instr');
		$data['codifier_instr'] = $result = DB::query(Database::SELECT,$query)->execute()->as_array();
		$data['codifier_instr_selected'] = Arr::get($_POST,'osin','');
		if(isset($_POST['add'])) {
			$post = Validation::factory($_POST);
			if($_POST['osin'] == 1) {
				$post->rule('nosnas', 'not_empty');
				$post->rule('nosnas', 'Model_Helper::validateNosnas');
			} else {
				$post->rule('kodinstr', 'not_empty');
			}
			$post->rule('nazvdet', 'not_empty');
			if($post->check()) {
				$query = DB::insert('orders', array(
					'detalavto',
					'nazvdet',
					'nosnas',
					'nizv',
					'kodinstr',
					'nizvins',
					'comment_start',
					'user_start',
					'group_start',
					'osin'
					))
						->values(array(
							Arr::get($_POST, 'detalavto'),
							Arr::get($_POST, 'nazvdet'),
							Arr::get($_POST, 'nosnas'),
							Arr::get($_POST, 'nizv'),
							Arr::get($_POST, 'kodinstr'),
							Arr::get($_POST, 'nizvins'),
							Arr::get($_POST, 'comment_start'),
							$this->user['fio'],//$this->user['login'],
							$this->user['grp'],
							Arr::get($_POST, 'osin')
							));
				$query->execute();
				Request::current()->redirect('order/start');
			} else {
				$data['errors']=$post->errors('');
				//$this->template->content = 'Ошибка добавления записи в базу.';
			}
		}
		//echo var_dump($data);
		$this->template->content = View::factory('order/start',$data);
	}

	/*
	 * Этот метод вызывается стандартными кнопками jqgrid
	 * При нажатии кнопки jqgrid посылает $_POST['oper'] который может содержать del, edit или add
	 */
	public function action_edit() {
		$this->auto_render = false;

		if($_POST['oper'] == 'del') {
			$query = DB::delete('orders')->where('id', '=', $_POST['id']);
			$query->execute();
			$status = "success";
			$message = "delete succeeded";
		}

		if($_POST['oper'] == 'edit') {
			print_r($_POST);
			$id = Arr::get($_POST,'id');
			$nosnas = Arr::get($_POST,'nosnas');
			$kodinstr = Arr::get($_POST, 'kodinstr');

			$query = DB::select()->from('orders')->where('id','=',$id);
			$result = $query->execute()->as_array();
			$osin = $result[0]['osin'];//если osin == 1 - это ММ, иначе - инструмент.
			
			$query = DB::select()->from('orders');
			if($osin == '1'){
				$query->where_open()
					->where('nosnas','=',$nosnas)
					->and_where('osin', '=', 1)
				->where_close();
			} else {
				$query->where_open()
					->where('kodinstr', '=', $kodinstr)
					->and_where('osin', '<>', 1)
				->where_close();
			}
			$query->and_where('id', '<>', $id)
				->and_where('status','IS', NULL);// Если деталь уже есть в невыданных заказах - не разрешаем добавление.
			$result = $query->execute()->as_array();
//echo Database::instance()->last_query."\r\n";
			if(empty ($result)){
				$query = DB::update('orders');
				if($osin == '1') $query->set(array('nosnas' => Arr::get($_POST,'nosnas') ) );
				$query->set(array('kodinstr' => Arr::get($_POST,'kodinstr'),
							'nosnas' => Arr::get($_POST,'nosnas'),
							'nazvdet' => Arr::get($_POST,'nazvdet'),
							'comment_start' => Arr::get($_POST,'comment_start'),
						));
				$query->where('id', '=', $id);
				$query->execute();
//echo Database::instance()->last_query."\r\n";
				$status = "success";
				$message = "edit succeeded";
			} else {
				$status = "fail";
				$message = "Ошибка. Такой шифр инструмента или оснастки уже есть в базе.";
			}
		}
		$s = $status.';'.$message.';'.'';
		$this->response->body($s);
	}

	/*
	 * Вывод таблицы с деталями, которым не присвоен номер заказа.
	 * Вызывается jqgrid'ом через ajax
	 */
	public function action_detal() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number', 'IS', NULL)
				->and_where_open()
				->where('status', 'IS', NULL)
				//->and_where('user_start', '=', $this->user['login'])
				->or_where('status', '=', 'Возврат')
				->and_where_close()
				;
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['detal']);
		$s = $this->xmlforjqgrid($query, $fields);
		$this->response->body($s);
	}
	/*
	 * Вывод таблицы с деталями, которым уже присвоен номер заказа.
	 * Вызывается jqgrid'ом через ajax
	 */
	public function action_orders() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number','IS NOT', NULL)
				//->and_where('user_start', '=', $this->user['login'])
				->and_where_open()
				->where('status', 'IS', NULL)
				->or_where('status', '=', 'Возврат')
				->and_where_close()
				;
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['orders']);
		$s = $this->xmlforjqgrid($query, $fields);
		$this->response->body($s);
	}
	/*
	 * вывод таблицы с уже запущенными заказами
	 * Вызывается jqgrid'ом через ajax
	 */
	public function action_started() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number','IS NOT', NULL)
				->and_where('status', '=', 'Выдан');
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['startedorders']);
		$s = $this->xmlforjqgrid($query, $fields);
		$this->response->body($s);
	}
	/*
	 * Добавление деталей в заказ
	 * Вызывается через ajax
	 */
	public function action_addtoorder() {
		$this->auto_render = false;
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			$query = DB::select(array('max("number")', 'maxnum'))->from('orders');
			$result = $query->execute()->as_array();
			$nextnum = $result[0]['maxnum'] + 1;
			if(!empty($_POST['order'])) $nextnum = Arr::get ($_POST, 'order');
			$query = DB::update('orders')->set(array('number'=>$nextnum,'status'=>NULL))->where('id', 'IN', $ids);
			$query->execute();
			echo 'ok';
		} else {
			echo 'Не выбрана ни одна деталь';
		}
 	}
	/*
	 * Удаление деталей из заказа
	 * Вызывается через ajax
	 */
	public function action_delfromorder() {
		$this->auto_render = false;
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			$query = DB::update('orders')->set(array('number' => NULL))->where('id', 'IN', $ids);
			$query->execute();
			echo 'ok';
		} else {
			echo 'Не выбрана ни одна деталь';
		}
	}
	/*
	 * Помечает заказ как запущенный, вызывается через ajax
	 */
	public function action_startorder() {
		$this->auto_render = false;
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			//Если выбрано несколько строк - отбрасываем все, т.к. там может быть несколько номеров заказов.
			$id = $ids[0];
			$query = DB::select('number')->from('orders')->where('id','=',$id);
			$number = $query->execute()->get('number');
			//print_r($res->get('number'));
			$query = DB::update('orders')
					->set(array('date_start'=>DB::expr('now()'), 'status'=>'Выдан'))
					->where('number','=',$number);
			$query->execute();
			return TRUE;
		}
		else return FALSE;
	}
	/*
	 * Добавляет условия для поиска в запрос.
	 * @param $q Запрос, в который добавляются условия
	 * @param $p Объект json_decode, содержащий параметры поиска
	 */
	public function createwhere($q,$p) {
		//print_r($p);
		$q->where_open();
		if($p->groupOp == 'AND') $w = 'and_where';
		if($p->groupOp == 'OR') $w = 'or_where';
		foreach ($p->rules as $rule) {
			//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
			switch ($rule->op) {
				case 'eq': $q->$w($rule->field, '=', $rule->data); break; // равно
				case 'ne': $q->$w($rule->field, '<>', $rule->data); break; // не равно
				case 'lt': $q->$w($rule->field, '<', $rule->data); break; // меньше
				case 'le': $q->$w($rule->field, '<=', $rule->data); break; // меньше или равно
				case 'gt': $q->$w($rule->field, '>', $rule->data); break; // больше
				case 'ge': $q->$w($rule->field, '>=', $rule->data); break; // больше или равно
				case 'bw': $q->$w($rule->field, 'LIKE', $rule->data.'%'); break; // начинается с
				case 'bn': $q->$w($rule->field, 'NOT LIKE', $rule->data.'%'); break; // не начинается с
				case 'ew': $q->$w($rule->field, 'LIKE', '%'.$rule->data); break; // заканчивается на
				case 'en': $q->$w($rule->field, 'NOT LIKE', '%'.$rule->data); break; // не заканчивается на
				case 'cn': $q->$w($rule->field, 'LIKE', '%'.$rule->data.'%'); break; // содержит
				case 'nс': $q->$w($rule->field, 'NOT LIKE', '%'.$rule->data.'%'); break; // не содержит
				case 'nu': $q->$w($rule->field, 'IS', NULL); break; // is null
				case 'nn': $q->$w($rule->field, 'IS NOT', NULL); break; // is not null
				case 'in': $q->$w($rule->field, 'IN', explode(',', $rule->data)); break; // находится в
				case 'ni': $q->$w($rule->field, 'NOT IN', explode(',', $rule->data)); break; // не находится в
				//default:
			}
		}
		$q->where_close();
	}

	public function action_accept() {

		$data['title'] = 'Приемка заказа';

		$data['columns']['startedorders'] = $this->columns['startedorders'];

		$data['columns']['acceptorders'] = $this->columns['acceptorders'];

		foreach ($data['columns']['startedorders'] as $key=>$val){
			$data['colnames']['startedorders'][] = $val[0];
		}
		foreach ($data['columns']['acceptorders'] as $key=>$val){
			$data['colnames']['acceptorders'][] = $val[0];
		}
		$this->template->content = View::factory('order/accept',$data);
	}

	/*
	 * Помечает заказ как принятый, вызывается через ajax
	 */
	public function action_acceptorder() {
		$this->auto_render = false;
		//print_r($_POST);
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			//Если выбрано несколько строк - отбрасываем все, т.к. там может быть несколько номеров заказов.
			$id = $ids[0];
			$query = DB::select('number')->from('orders')->where('id','=',$id);
			$number = $query->execute()->get('number');
			//print_r($res->get('number'));
			$query = DB::update('orders')
					->set(array('date_accept'=>DB::expr('now()'), 'status'=>'Принят'))
					->where('number','=',$number);
			$query->execute();
			// В одну из деталей заказ добавляем коментарий ко всему заказу.
			$query = DB::update('orders')
					->set(array('comment_accept'=>Arr::get($_POST,'comment')))
					->where('id','=',$id);
			$query->execute();
			return TRUE;
		}
		else return FALSE;
	}
	/*
	 * Помечает заказ как непринятый, вызывается через ajax
	 */
	public function action_notacceptorder() {
		$this->auto_render = false;
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			//Если выбрано несколько строк - отбрасываем все, т.к. там может быть несколько номеров заказов.
			$id = $ids[0];
			$query = DB::select('number')->from('orders')->where('id','=',$id);
			$number = $query->execute()->get('number');
			//print_r($res->get('number'));
			$query = DB::update('orders')
					->set(array('date_accept'=>DB::expr('now()'), 'status'=>'Возврат'))
					->where('number','=',$number);
			$query->execute();
			// В одну из деталей заказ добавляем коментарий ко всему заказу.
			$query = DB::update('orders')
					->set(array('comment_accept'=>Arr::get($_POST,'comment')))
					->where('id','=',$id);
			$query->execute();
			return TRUE;
		}
		else return FALSE;
	}
	/*
	 * вывод таблицы с принятыми
	 * Вызывается jqgrid'ом через ajax
	 */
	public function action_tableaccepted() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number', 'IS NOT', NULL)
				->and_where_open()
					->where('status', '=', 'Принят')
					->or_where('status', '=', 'Возврат')
				->where_close();
		// we should set the appropriate header information. Do not forget this.
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['startedorders']);
		$s = $this->xmlforjqgrid($query, $fields);
		$this->response->body($s);
	}
	/*
	 * Вывод таблицы планирования
	 */
	public function action_plan() {
		$data['title'] = 'Планирование заказа';
		$doers = '';
		$query = DB::select()->from('users')
				->where('grp', '=', 'kbimo');
		$result = $query->execute()->as_array();
		foreach ($result as $key=>$val){
			$doers .= $val['login'].':'.$val['fio'].';';
		}
		$doers = substr($doers,0,-1);

		$data['columns']['plan'] = $this->columns['plan'];
		$data['columns']['plan']['doer']['values'] = $doers;
		foreach ($data['columns']['plan'] as $key=>$val){
			$data['colnames']['plan'][] = $val[0];
		}
		$this->template->content = View::factory('order/plan',$data);
	}

	/*
	 * Помечает заказ как запланированный, вызывается jqgrid'ом через аякс.
	 */
	public function action_saveplan() {
		$this->auto_render = false;
		if(!empty($_POST)) {
			$id = Arr::get($_POST,'id');
			$doer_login = Arr::get($_POST,'doer');
			$query = DB::select('fio')->from('users')->where('login','=',$doer_login);
			$doer_f = $query->execute()->get('fio');

			$query = DB::select('number')->from('orders')->where('id','=',$id);
			$number = $query->execute()->get('number');

			$query = DB::update('orders')
					->set(array('date_plan'=>DB::expr('now()'), 'status'=>'План', 'doer'=>$doer_f))
					->where('number','=',$number);
			$query->execute();
			return TRUE;
		}
		else return FALSE;
	}
	/*
	 * Вызывается jqgrid'ом для отрисовки таблицы заказов для планирования.
	 */
	public function action_tableplan() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number','IS NOT', NULL)
				->and_where_open()
					->where('status', '=', 'Принят')
					->or_where('status', '=', 'План')
				->where_close();
				//->group_by('number')
		$fields = array_keys($this->columns['plan']);
		$s = $this->xmlforjqgrid($query,$fields);
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$this->response->body($s);
	}

	/*
	 * Вывод таблицы завершения заказа
	 */
	public function action_finish() {
		$data['title'] = 'Заершение заказа';

		$data['columns']['finish'] = $this->columns['finish'];
		$data['columns']['finished'] = $this->columns['finish'];
		foreach ($data['columns']['finish'] as $key=>$val){
			$data['colnames']['finish'][] = $val[0];
			$data['colnames']['finished'][] = $val[0];
		}
		$this->template->content = View::factory('order/finish',$data);
	}
	/*
	 * Помечает заказ как готовый, вызывается через ajax
	 */
	public function action_finishorder() {
		$this->auto_render = false;
		//print_r($_POST);
		if(!empty($_POST)) {
			$ids = explode(',', $_POST['ids']);
			//Если выбрано несколько строк - отбрасываем все, т.к. там может быть несколько номеров заказов.
			$id = $ids[0];
			$query = DB::select('number')->from('orders')->where('id','=',$id);
			$number = $query->execute()->get('number');
			//print_r($res->get('number'));
			$query = DB::update('orders')
					->set(array('date_finish'=>DB::expr('now()'), 'status'=>'Готов'))
					->where('number','=',$number);
			$query->execute();
			// В одну из деталей заказ добавляем коментарий ко всему заказу.
			$query = DB::update('orders')
					->set(array('comment_finish'=>Arr::get($_POST,'comment_finish')))
					->where('id','=',$id);
			$query->execute();
			return TRUE;
		}
		else return FALSE;
	}
	/*
	 * Вызывается jqgrid'ом для отрисовки таблицы заказов находящихся в работе.
	 */
	public function action_tablefinish() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number', 'IS NOT', NULL)
				->and_where_open()
					->where('status', '=', 'План')
				->where_close();

		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['finish']);
		$s = $this->xmlforjqgrid($query,$fields);
		$this->response->body($s);
	}
	/*
	 * Вызывается jqgrid'ом для отрисовки таблицы готовых заказов.
	 */
	public function action_tablefinished() {
		$this->auto_render = false;
		$query = DB::select()->from('orders')
				->where('number', 'IS NOT', NULL)
				->and_where_open()
					->where('status', '=', 'Готов')
				->where_close();
		// we should set the appropriate header information. Do not forget this.
		$this->response->headers['Content-type'] = 'text/xml;charset=utf-8';//("Content-type: text/xml;charset=utf-8");
		$fields = array_keys($this->columns['finish']);
		$s = $this->xmlforjqgrid($query,$fields);
		$this->response->body($s);
	}

	/*
	 * Готовит xml для jqgrid на основе запроса $query, списка полей $fields
	 */
	private function xmlforjqgrid($query,$fields) {
		$page = Arr::get($_POST,'page');
		$limit = Arr::get($_POST,'rows');
		$sidx = Arr::get($_POST,'sidx');
		$sord = Arr::get($_POST,'sord');

		if(!$sidx) $sidx =1;

		// calculate the number of rows for the query. We need this for paging the result
		if($_POST['_search'] == 'true') {
			$this->createwhere($query,json_decode(Arr::get($_POST,'filters')));
		}
		$count = $query->execute()->count();

		// calculate the total pages for the query
		if( $count > 0 && $limit > 0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}

		// if for some reasons the requested page is greater than the total
		// set the requested page to total page
		if ($page > $total_pages) $page=$total_pages;

		// calculate the starting position of the rows
		$start = $limit*$page - $limit;

		// if for some reasons start position is negative set it to 0
		// typical case is that the user type 0 for the requested page
		if($start <0) $start = 0;

		// дополняем запрос условия сортировки и лимитами
		$query->order_by($sidx,$sord)->limit($limit)->offset($start);

		$result = $query->execute()->as_array();

		$s = "<?xml version='1.0' encoding='utf-8'?>";
		$s .= "<rows>";
		$s .= "<page>".$page."</page>";
		$s .= "<total>".$total_pages."</total>";
		$s .= "<records>".$count."</records>";

		// be sure to put text data in CDATA
		foreach($result as $row) {
			$s .= "<row id='". $row['id']."'>";
			foreach($fields as $key=>$val) {
				$s .= "<cell><![CDATA[". $row[$val]."]]></cell>";
			}
			$s .= "</row>";
		}
		$s .= "</rows>";
		//$s .= Database::instance()->last_query;//debug
		return $s;
	}
}