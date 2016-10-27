<?php
class signing 
{
	public $out; 
	
	public function index(){
		require_once 'app/core/Config.php';

		$username = self::request("POST", "username");
		$password = self::request("POST", "password");

		if($username == "" || $password == ""){
			$this->out = array(
				"Error" => array(
					"Code"=>1, 
					"Text"=>"ყველა ველი სავალდებულოა !",
					"Details"=>"მომხმარებლის სახელის ან პაროლის ველი ცარიელია !"
				)
			);
		}else{
			/* Database Connection */
			$Database = new Database(
				'user', 
				array(
					'method'=>'check', 
					'user'=>$username, 
					'pass'=>$password
				)
			);
			$output = $Database->getter();
			
			if($output){
				$_SESSION[Config::SESSION_PREFIX."username"] = $username;
				$this->out = array(
					"Error" => array(
						"Code"=>0, 
						"Text"=>"ოპერაცია შესრულდა წარმატებით !",
						"Details"=>$output
					),
					"redirect" => Config::ADMIN_DASHBOARD
				);
			}else{
				$this->out = array(
					"Error" => array(
						"Code"=>1, 
						"Text"=>"მომხმარებლის სახელი ან პაროლი არასწორია !",
						"Details"=>"მომხმარებლის სახელი ან პაროლი არასწორია, გთხოვთ სცადოთ მოგვიანებით !"
					)
				);
			}
		}

		return $this->out;
	}

	public static function request($type, $item){
		if($type=="POST" && isset($_POST[$item])){
			return filter_input(INPUT_POST, $item);
		}else if($type=="GET" && isset($_GET[$item])){
			return filter_input(INPUT_GET, $item);
		}else{
			return '';
		}
	}

}
?>