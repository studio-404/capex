<?php
class addPageForm 
{
	public $out; 
	
	public function index(){
		require_once 'app/core/Config.php';
		require_once 'app/functions/makeForm.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);

		$call = self::request("POST", "call");

		$form = functions\makeForm::open(array(
			"action"=>"?",
			"method"=>"post",
			"id"=>"",
			"id"=>"",
		));

		$form .= functions\makeForm::select(array(
			"id"=>"choosePageType",
			"choose"=>"აირჩიეთ გვერდის ტიპი",
			"options"=>array(
				"text"=>"ტექსტური",
				"plugin"=>"პლაგინი"
			)
		));

		$form .= functions\makeForm::inputText(array(
			"placeholder"=>"დასახელება", 
			"id"=>"title", 
			"name"=>"title" 
		));

		$form .= functions\makeForm::inputText(array(
			"placeholder"=>"ბმული", 
			"id"=>"slug", 
			"name"=>"slug" 
		));

		$form .= functions\makeForm::textarea(array(
			"id"=>"pageDescription",
			"name"=>"pageDescription",
			"value"=>"მოკლე აღწერა"
		));

		$form .= functions\makeForm::textarea(array(
			"id"=>"pageText",
			"name"=>"pageText",
			"value"=>"ვრცელი აღწერა"
		));

		$form .= functions\makeForm::close();

		if($call == "true"){
			$this->out = array(
				"Error" => array(
					"Code"=>0, 
					"Text"=>"ოპერაცია შესრულდა წარმატებით !",
					"Details"=>""
				),
				"form" => $form,
				"attr" => "formPageAdd()"
			);	
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