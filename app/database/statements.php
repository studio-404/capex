<?php 
class statements
{
	private $conn;

	public function index($conn, $args)
	{
		$out = 0;
		$this->conn = $conn;
		if(method_exists("statements", $args['method']))
		{
			$out = $this->$args['method']($args);
		}
		return $out;
	}

	private function checkUser($args)
	{
		$fetch = array();
		$select = "SELECT * FROM `statements` WHERE `personal_number`=:personal_number AND `password`=:password AND `status`!=:one";
		$prepare = $this->conn->prepare($select); 
		$prepare->execute(array(
			":personal_number"=>$args['user'],
			":password"=>$args['pass'],
			":one"=>1 
		));
		if($prepare->rowCount()){
			return true;
		}
		return false;
	}

	private function removeStatement($args)
	{
		$update = "UPDATE `statements` SET `status`=:one WHERE `id`=:id";
		$prepare = $this->conn->prepare($update);
		$prepare->execute(array(
			":id"=>$args['id'],
			":one"=>1
		)); 
		if($prepare->rowCount())
		{
			return 1;
		}
		return 0;
	}

	private function selectByPersonalNumber($args)
	{
		$fetch = array();
		$select = "SELECT * FROM `statements` WHERE `personal_number`=:personal_number AND `status`!=:one";
		$prepare = $this->conn->prepare($select); 
		$prepare->execute(array(
			":personal_number"=>$args['pid'],
			":one"=>1 
		));
		if($prepare->rowCount()){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			if($fetch[0]["read"]==0 && !isset($args['noUpdateRead'])){
				$this->updateRead($fetch[0]["id"]);
			}
		}
		return $fetch;
	}

	private function updateRead($id)
	{
		$update = "UPDATE `statements` SET `read`=:one WHERE `id`=:id";
		$prepare = $this->conn->prepare($update);
		$prepare->execute(array(
			":id"=>$id, 
			":one"=>1
		)); 
		if($prepare->rowCount())
		{
			return 1;
		}
		return 0;
	}

	private function select($args)
	{
		$fetch = array();
		$itemPerPage = $args['itemPerPage'];
		$from = (isset($_GET['pn']) && $_GET['pn']>0) ? (($_GET['pn']-1)*$itemPerPage) : 0;
		
		$select = "SELECT (SELECT COUNT(`id`) FROM `statements` WHERE `status`!=:one) as counted, `id`, `date`, `name`, `surname`, `personal_number`, `read` FROM `statements` WHERE `status`!=:one ORDER BY `date` DESC LIMIT ".$from.",".$itemPerPage;
		$prepare = $this->conn->prepare($select); 
		$prepare->execute(array(
			":one"=>1
		));
		if($prepare->rowCount()){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		}
		return $fetch;
	}

	private function insert($args)
	{
		require_once 'app/functions/server.php';
		$server = new functions\server();
		$ip = $server->ip();
		$out = 0;
		
		try{
			$insert = "INSERT INTO `statements` SET 
			`date`=:datex, 
			`ip`=:ip, 
			`name`=:name, 
			`surname`=:surname, 
			`personal_number`=:personal_number, 
			`dob`=:dob, 
			`faddress`=:faddress, 
			`city`=:city, 
			`mobile`=:mobile, 
			`email`=:email, 
			`jobTitle`=:jobTitle, 
			`monthly_income`=:income, 
			`position`=:position, 
			`jobphone`=:jobphone, 
			`contactPerson`=:contactPerson, 
			`contactPersonNumber`=:contactPersonNumber, 
			`demended_loan`=:demended_loan, 
			`demended_month`=:demended_month, 
			`password`=:password, 
			`agree`=:one, 
			`read`=:zero, 
			`status`=:zero 
			";
			$prepare = $this->conn->prepare($insert);
			$prepare->execute(array(
				":datex"=>time(),
				":ip"=>$ip,
				":name"=>$args['name'],
				":surname"=>$args['surname'],
				":personal_number"=>$args['pid'],
				":dob"=>$args['dob'],
				":faddress"=>$args['faddress'],
				":city"=>$args['city'],
				":mobile"=>$args['mobile'],
				":email"=>$args['email'],
				":jobTitle"=>$args['jobTitle'],
				":income"=>$args['income'],
				":position"=>$args['position'],
				":jobphone"=>$args['jobphone'],
				":contactPerson"=>$args['contactPerson'],
				":contactPersonNumber"=>$args['contactPersonNumber'],
				":demended_loan"=>$args['loanMoney'],
				":demended_month"=>$args['loanMonth'],
				":password"=>$args['password'],
				":one"=>1,
				":zero"=>0
			));	
			if($prepare->rowCount()){
				$out = 1;	
			}			
		}catch(Exception $e){ $out = 0;	}
		return $out;
	}

	private function edit($args)
	{
		$out = 0;		
		try{
			$update = "UPDATE `statements` SET 
			`update_date`=:update_date, 
			`name`=:name, 
			`surname`=:surname, 
			`dob`=:dob, 
			`faddress`=:faddress, 
			`city`=:city, 
			`mobile`=:mobile, 
			`email`=:email, 
			`jobTitle`=:jobTitle, 
			`monthly_income`=:income, 
			`position`=:position, 
			`jobphone`=:jobphone, 
			`contactPerson`=:contactPerson, 
			`contactPersonNumber`=:contactPersonNumber 
			WHERE 
			`personal_number`=:personal_number AND
			`status`!=:one 
			";
			$prepare = $this->conn->prepare($update);
			$prepare->execute(array(
				":update_date"=>time(),
				":name"=>$args['name'],
				":surname"=>$args['surname'],
				":personal_number"=>$args['pid'],
				":dob"=>$args['dob'],
				":faddress"=>$args['faddress'],
				":city"=>$args['city'],
				":mobile"=>$args['mobile'],
				":email"=>$args['email'],
				":jobTitle"=>$args['jobTitle'],
				":income"=>$args['income'],
				":position"=>$args['position'],
				":jobphone"=>$args['jobphone'],
				":contactPerson"=>$args['contactPerson'],
				":contactPersonNumber"=>$args['contactPersonNumber'],
				":one"=>1
			));	
			if($prepare->rowCount()){
				$out = 1;	
			}			
		}catch(Exception $e){ $out = 0;	}
		return $out;
	}

	private function checkOldPassword($args)
	{
		$select = "SELECT `id` FROM `statements` WHERE `personal_number`=:personal_number AND `password`=:password AND `status`!=:one";
		$prepare = $this->conn->prepare($select); 
		$prepare->execute(array(
			":personal_number"=>$args['user'],
			":password"=>$args['old'],
			":one"=>1 
		));
		if($prepare->rowCount()){
			return true;
		}
		return false;
	}

	private function updateUserPassword($args)
	{
		$out = 0;		
		try{
			$update = "UPDATE `statements` SET 
			`update_date`=:update_date, 
			`password`=:password			
			WHERE 
			`personal_number`=:personal_number AND
			`status`!=:one 
			";
			$prepare = $this->conn->prepare($update);
			$prepare->execute(array(
				":update_date"=>time(),
				":password"=>$args["newpassword"],
				":personal_number"=>$args["user"],
				":one"=>1
			));	
			if($prepare->rowCount()){
				$out = 1;	
			}			
		}catch(Exception $e){ $out = 0;	}
		return $out;
	}
}