<?php 
class modules
{
	private $conn;

	public function index($conn, $args)
	{
		$out = 0;
		$this->conn = $conn;
		if(method_exists("modules", $args['method']))
		{
			$out = $this->$args['method']($args);
		}
		return $out;
	}

	private function select($args)
	{
		$fetch = array();
		$itemPerPage = $args['itemPerPage'];
		$from = (isset($_GET['pn']) && $_GET['pn']>0) ? (($_GET['pn']-1)*$itemPerPage) : 0;
		$parsed_url = $args['parsed_url'];
		if(isset($parsed_url[2])){
			$select = "SELECT (SELECT COUNT(`id`) FROM `usefull` WHERE `type`=:type AND `lang`=:lang AND `status`!=:one) as counted, `idx`, `title`, `visibility` FROM `usefull` WHERE `type`=:type AND `lang`=:lang AND `status`!=:one LIMIT ".$from.",".$itemPerPage;
			$prepare = $this->conn->prepare($select); 
			$prepare->execute(array(
				":type"=>$parsed_url[2], 
				":lang"=>$args['lang'],
				":one"=>1
			));
			if($prepare->rowCount()){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		return $fetch;
	}

	private function updateVisibility($args)
	{
		$visibility = ($args['visibility']==0) ? 1 : 0;
		$idx = (int)$args['idx'];

		$update = "UPDATE `usefull` SET `visibility`=:visibility WHERE `idx`=:idx";
		$prepare = $this->conn->prepare($update);
		$prepare->execute(array(
			":visibility"=>$visibility, 
			":idx"=>$idx
		));
		if($prepare->rowCount())
		{
			return 1;
		}
		return 0;
	}

	private function add($args)
	{
		$date = strtotime($args['date']);
		$type = $args['moduleSlug'];
		$title = $args['title'];
		$pageText = $args['pageText'];
		$link = $args['link'];

		$select = "SELECT `title` FROM `languages`";
		$prepare = $this->conn->prepare($select);
		$prepare->execute();
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

		$max = "SELECT MAX(`idx`) as maxidx FROM `usefull` WHERE `status`!=:one";
		$prepare2 = $this->conn->prepare($max);
		$prepare2->execute(array(":one"=>1));
		$fetch2 = $prepare2->fetch(PDO::FETCH_ASSOC);
		$maxId = ($fetch2["maxidx"]) ? $fetch2["maxidx"] + 1 : 1;

		foreach ($fetch as $val) {
			$insert = "INSERT INTO `usefull` SET `idx`=:idx, `date`=:datex, `type`=:type, `title`=:title, `description`=:description, `url`=:url, `lang`=:lang";
			$prepare3 = $this->conn->prepare($insert);
			$prepare3->execute(array(
				":idx"=>$maxId, 
				":datex"=>$date, 
				":type"=>$type, 
				":title"=>$title, 
				":description"=>$pageText, 
				":url"=>$link,
				":lang"=>$val['title']
			)); 
		}
		return 1;
	}

	private function removeModule($args)
	{
		$idx = $args['idx'];

		$update = "UPDATE `usefull` SET `status`=:one WHERE `idx`=:idx";
		$prepare = $this->conn->prepare($update); 
		$prepare->execute(array(
			":one"=>1,
			":idx"=>$idx
		));
		if($prepare->rowCount()){
			return 1;
		}

		return 0;
	}
}