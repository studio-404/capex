<?php 
class Service extends Controller
{
	public function __construct()
	{

	}

	public function index($type = '', $howmany = 10)
	{
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);	

		$personal_number = (string)functions\request::index("GET","pid");
		$pn = (int)functions\request::index("GET","pn");

		switch($type)
		{
			case "users":
				$Database = new Database("statements", array(
					"method"=>"service", 
					"itemPerPage"=>$howmany, 
					"personal_number"=>$personal_number, 
					"pn"=>(int)$pn  
				));
				$this->out = $Database->getter(); 
			break;
		}

		array_walk_recursive($this->out, function (&$val) { $val = strip_tags($val); });
		// echo "<pre>";
		echo json_encode($this->out, JSON_UNESCAPED_UNICODE);
		// echo "</pre>";
	}
}