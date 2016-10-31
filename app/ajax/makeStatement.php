<?php 
class makeStatement
{
	public $out; 
	
	public function index(){
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);
		$data = functions\request::index("POST","formData");
		$unserialized = unserialize($data);

		$this->out = array(
			"Error" => array(
				"Code"=>0, 
				"Text"=>"მოხდა შეცდომა !",
				"json"=>""
			)
		);
		// if($visibility != "" && $idx != ""){

		// 	$page = new Database('page', array(
		// 		"method"=>"updateVisibility",
		// 		"visibility"=>$visibility,
		// 		"idx"=>$idx 
		// 	));
		// 	$result = $page->getter();
		// 	if($result==1){
		// 		$this->out = array(
		// 			"Error" => array(
		// 				"Code"=>0, 
		// 				"Text"=>"",
		// 				"Details"=>""
		// 			),
		// 			"Success" => array(
		// 				"Code"=>1,
		// 				"Text"=>"ოპერაცია შესრულდა წარმატებით !",
		// 				"Details"=>""
		// 			)
		// 		);	
		// 	}
		// }

		return $this->out;
	}
}