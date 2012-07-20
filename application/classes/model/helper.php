<?php
Class Model_helper extends Model
{
	public function instrIncr($string){ //890-8371-9999x-001
		$str = substr($string,0,13); //890-8371-9999
		$int = str_replace('-', '', $str); //89083719999
		$int++; //89083720000
		$str = substr($int,0,3).'-'.substr($int,3,4).'-'.substr($int,7,4); //890-8372-0000
		return $str.substr($string,13); //890-8372-0000x-001
	}

	public static function validateNosnas($value){
		$query = DB::select()->from('orders')->where('nosnas','=',$value);
		$result = $query->execute()->as_array();
		if(!empty($result)) return FALSE;
		else return TRUE;
	}
}
