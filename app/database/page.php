<?php 
class page
{
	private $conn;

	public function index($conn, $args)
	{
		$out = 0;
		$this->conn = $conn;
		if(method_exists("page", $args['method']))
		{
			$out = $this->$args['method']($args);
		}
		return $out;
	}

	private function select($args)
	{
		$fetch = array();
		$select = "SELECT * FROM `navigation` WHERE `cid`=:cid AND `lang`=:lang AND `status`=:status";
		$prepare = $this->conn->prepare($select);
		$prepare->execute(array(
			":cid"=>$args['cid'], 
			":lang"=>$args['lang'], 
			":status"=>$args['status'], 
		));
		if($prepare->rowCount()){
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
		}
		return $fetch;
	}

	private function add($args)
	{
		$type = $args["choosePageType"];
		$title = $args["title"];
		$slug = $args["slug"];
		$description = $args["pageDescription"];
		$textx = $args["pageText"];

		$select = "SELECT `title` FROM `languages`";
		$prepare = $this->conn->prepare($select);
		$prepare->execute();
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);

		$max = "SELECT MAX(`idx`) as maxidx FROM `navigation` WHERE `status`!=:one";
		$prepare2 = $this->conn->prepare($max);
		$prepare2->execute(array(":one"=>1));
		$fetch2 = $prepare2->fetch(PDO::FETCH_ASSOC);
		$maxId = ($fetch2["maxidx"]) ? $fetch2["maxidx"] + 1 : 1;

		$cid = 0;
		$datex = time();
		$visibility = 0;
		$status = 0;

		foreach ($fetch as $val) {
			$insert = "INSERT INTO `navigation` SET 
			`idx`=:idx, 
			`cid`=:cid, 
			`date`=:datex, 
			`type`=:type, 
			`title`=:title, 
			`description`=:description, 
			`text`=:textx, 
			`slug`=:slug, 
			`lang`=:lang, 
			`visibility`=:visibility, 
			`status`=:status";
			$prepare2 = $this->conn->prepare($insert);
			$prepare2->execute(array(
				":idx"=>$maxId,
				":cid"=>$cid,
				":datex"=>$datex,
				":type"=>$type,
				":title"=>$title,
				":description"=>$description,
				":textx"=>$textx,
				":slug"=>$slug,
				":lang"=>$val['title'],
				":visibility"=>$visibility,
				":status"=>$status
			));	
		}

		return 1;
	}
}