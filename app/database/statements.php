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
		}else{
			$select2 = "SELECT * FROM `statements` WHERE `personal_number`=:personal_number AND `recover`=:recover AND `status`!=:one";
			$prepare2 = $this->conn->prepare($select2); 
			$prepare2->execute(array(
				":personal_number"=>$args['user'],
				":recover"=>$args['pass'],
				":one"=>1 
			));
			if($prepare2->rowCount()){
				$update = "UPDATE `statements` SET `recover`=:empty, `password`=:newpassword WHERE `personal_number`=:personal_number AND `status`!=:one";
				$prepare3 = $this->conn->prepare($update); 
				$prepare3->execute(array(
					":empty"=>"", 
					":newpassword"=>$args['pass'], 
					":personal_number"=>$args['user'], 
					":one"=>1  
				));
				return true;
			}
		}
		return false;
	}

	private function checkAfterRegister($args)
	{
		$select = "SELECT `id` FROM `statements` WHERE (`personal_number`=:personal_number OR `email`=:email) AND `status`!=:one";
		$prepare = $this->conn->prepare($select); 
		$prepare->execute(array(
		":personal_number"=>$args['pid'],
		":email"=>$args['email'],
		":one"=>1 
		));
		if($prepare->rowCount())
		{
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

	private function updatecolumne($args)
	{
		try{
			$update = "UPDATE `statements` SET `".$args['col']."`=:updateColumeName WHERE `personal_number`=:personal_number";
			$prepare = $this->conn->prepare($update);
			$prepare->execute(array(
				":updateColumeName"=>$args['value'],
				":personal_number"=>$args['personal_number']
			)); 
			
			if($prepare->rowCount())
			{
				return 1;
			}
		}catch(Exception $e){
			echo $e;
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

	private function regetMoney($args)
	{
		$out = 0;
		$update = "UPDATE `statements` SET `date`=:timex, `update_date`=:timex, `demended_loan`=:moneyx, `demended_month`=:monthx, `read`=:zero, `loan_status`=:zero, `loan_finished`=:zero WHERE `personal_number`=:personal_number"; 
		try{
			$prepare = $this->conn->prepare($update); 
			$prepare->execute(array(
				":timex"=>time(), 
				":moneyx"=>$args['money'],
				":monthx"=>$args['month'],
				":zero"=>0,
				":personal_number"=>$args['personal_number']
			));
			if($prepare->rowCount()){
				$out = 1;
			}
		}catch(Exception $e){
			echo $e;
		}
		return $out;
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

	private function service($args)
	{
		$fetch = array();
		$itemPerPage = $args['itemPerPage'];
		$from = (isset($_GET['pn']) && $_GET['pn']>0) ? (($_GET['pn']-1)*$itemPerPage) : 0;
		
		$select = "SELECT (SELECT COUNT(`id`) FROM `statements` WHERE `status`!=:one) as counted, `id`, `date` as insert_date,`personal_number`, `name`, `surname`, `dob` as date_of_birth, `faddress` as address, (SELECT `cities`.`names` FROM `cities` WHERE `cities`.`id`=`statements`.`city`) as city, `mobile`, `email`, `jobTitle` as job, `position` as job_position, `jobphone` as job_phone, `monthly_income` as salary, `contactPerson` as contact_person, `contactPersonNumber` as contact_person_number, `demended_loan`, `demended_month` FROM `statements` WHERE `status`!=:one ORDER BY `date` DESC LIMIT ".$from.",".$itemPerPage;
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

	private function history($args)
	{
		$out = 0;
		$copy = "INSERT INTO history (`date`, `update_date`, `ip`, `name`, `surname`, `personal_number`, `dob`, `faddress`, `city`, `mobile`, `email`, `jobTitle`, `monthly_income`, `position`, `jobphone`, `contactPerson`, `contactPersonNumber`, `demended_loan`, `demended_month`, `password`, `recover`, `agree`, `read`, `loan_status`, `loan_finished`, `status`)
			SELECT `date`, `update_date`, `ip`, `name`, `surname`, `personal_number`, `dob`, `faddress`, `city`, `mobile`, `email`, `jobTitle`, `monthly_income`, `position`, `jobphone`, `contactPerson`, `contactPersonNumber`, `demended_loan`, `demended_month`, `password`, `recover`, `agree`, `read`, `loan_status`, `loan_finished`, `status` FROM statements WHERE `personal_number`=:personal_number;";
		try{
			$prepare = $this->conn->prepare($copy);
			$prepare->execute(array(
				":personal_number"=>$args["personal_number"]
			));	
			if($prepare->rowCount()){
				$out = 1;	
			}
		}catch(Exception $e){ $out = 0;	}
		return $out;
	}

	private function chnageRecover($args)
	{
		$out = 0;		
		try{
			$update = "UPDATE `statements` SET 
			`recover`=:recover			
			WHERE 
			`email`=:email AND
			`status`!=:one 
			";
			$prepare = $this->conn->prepare($update);
			$prepare->execute(array(
				":recover"=>$args["recover"],
				":email"=>$args["email"],
				":one"=>1
			));	
			if($prepare->rowCount()){
				$out = 1;	
			}			
		}catch(Exception $e){ $out = 0;	}
		return $out;
	}

	private function updateLoanStatus($args)
	{ 
		$out = 0;
		if(!empty($args["status"]) && !empty($args["pid"]))
		{		
			try{
				$status = ($args["status"]=="on") ? 2 : 1;

				$update = "UPDATE `statements` SET 
				`loan_status`=:loan_status			
				WHERE 
				`personal_number`=:personal_number AND
				`status`!=:one 
				";
				$prepare = $this->conn->prepare($update);
				$prepare->execute(array(
					":loan_status"=>$status,
					":personal_number"=>$args["pid"],
					":one"=>1
				));	
				if($prepare->rowCount()){
					$out = 1;	
				}			
			}catch(Exception $e){ $out = 0;	}
		}

		if(!empty($args["status2"]) && !empty($args["pid2"]))
		{		
			try{
				$status = ($args["status2"]=="on") ? 2 : 1;

				$update = "UPDATE `statements` SET 
				`loan_finished`=:loan_finished			
				WHERE 
				`personal_number`=:personal_number AND
				`status`!=:one 
				";
				$prepare = $this->conn->prepare($update);
				$prepare->execute(array(
					":loan_finished"=>$status,
					":personal_number"=>$args["pid2"],
					":one"=>1
				));	
				if($prepare->rowCount()){
					$out = 1;	
				}			
			}catch(Exception $e){ $out = 0;	}
		}
		return $out;
	}
}