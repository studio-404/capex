<?php 
class unsetSession
{
	public $out; 

	public function __construct()
	{

	}
	
	public function index(){
		if(isset($_SESSION['capex_user'])){
			unset($_SESSION['capex_user']);
		}
		$this->out = array(
			"Error" => array(
				"Code"=>0, 
				"Text"=>"",
				"Details"=>""
			),
			"Success"=>array(
				"Code"=>1, 
				"Text"=>"ოპერაცია შესრულდა წარმატებით !",
				"Details"=>""
			)
		);
		return $this->out;
	}
}