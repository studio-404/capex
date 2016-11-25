<?php 
class addModule
{
	public $out; 
	
	public function __construct()
	{
		require_once 'app/core/Config.php';
		if(!isset($_SESSION[Config::SESSION_PREFIX."username"]))
		{
			exit();
		}
	}
	
	public function index(){
		require_once 'app/core/Config.php';
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);

		$moduleSlug = functions\request::index("POST","moduleSlug");
		$date = functions\request::index("POST","date");
		$title = functions\request::index("POST","title");
		$pageText = functions\request::index("POST","pageText");
		$link = functions\request::index("POST","link");
		$serialPhotos = unserialize(functions\request::index("POST","serialPhotos"));


		if($moduleSlug=="" || $date=="" || $title=="" || $pageText=="")
		{
			$this->out = array(
				"Error" => array(
					"Code"=>1, 
					"Text"=>"ყველა ველი სავალდებულოა !",
					"Details"=>"!"
				)
			);
		}else{
			$Database = new Database('modules', array(
					'method'=>'add', 
					'moduleSlug'=>$moduleSlug, 
					'date'=>$date, 
					'title'=>$title, 
					'pageText'=>$pageText, 
					'link'=>$link, 
					'serialPhotos'=>$serialPhotos
			));
			$output = $Database->getter();
			if($output){
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
			}else{
				$this->out = array(
					"Error" => array(
						"Code"=>1, 
						"Text"=>"ოპერაციის შესრულებისას დაფიქსირდა შეცდომა !",
						"Details"=>""
					)
				);
			}
		}

		return $this->out;
	}
}