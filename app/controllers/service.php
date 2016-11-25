<?php 
class Service extends Controller
{
	public function __construct()
	{

	}

	public function index($type = '', $howmany = 10)
	{
		$out = array(); 

		switch($type)
		{
			case "users":
				$Database = new Database("statements", array(
					"method"=>"service", 
					"itemPerPage"=>$howmany 
				));
				$out = $Database->getter(); 
			break;
		}

		array_walk_recursive($out, function (&$val) { $val = strip_tags($val); });

		echo json_encode($out, JSON_UNESCAPED_UNICODE);
	}
}