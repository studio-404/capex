<?php 
class reget
{
	public $out; 
	
	public function index(){
		require_once 'app/core/Config.php';
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			), 
			"Success" => array(
				"Code"=>0,
				"Text"=>"",
				"Details"=>""
			)
		);

		$money = functions\request::index("POST","money");
		$month = functions\request::index("POST","month");

		/**
		**	DO JOB
		*/


		
		return $this->out;
	}
}