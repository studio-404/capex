<?php 
class editModules
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
		require_once 'app/functions/makeForm.php';
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);

		$idx = functions\request::index("POST","idx");
		$lang = functions\request::index("POST","lang");

		if($idx == "" || $lang=="")
		{
			$this->out = array(
				"Error" => array(
					"Code"=>1, 
					"Text"=>"მოხდა შეცდომა !",
					"Details"=>"!"
				)
			);
		}else{
			$Database = new Database('modules', array(
					'method'=>'selectById', 
					'idx'=>$idx, 
					'lang'=>$lang
			));
			$output = $Database->getter();

			$photos = new Database('photos', array(
				'method'=>'selectByParent', 
				'idx'=>$idx, 
				'lang'=>$lang, 
				'type'=>$output['type'] 
			));
			$pictures = $photos->getter();


			$form = functions\makeForm::open(array(
				"action"=>"?",
				"method"=>"post",
				"id"=>"",
				"id"=>"",
			));

			$form .= functions\makeForm::label(array(
				"id"=>"dateLabel", 
				"for"=>"date", 
				"name"=>"თარიღი: ( დღე-თვე-წელი )",
				"require"=>""
			));

			$form .= functions\makeForm::inputText(array(
				"placeholder"=>"დღე/თვე/წელი", 
				"id"=>"date", 
				"name"=>"date",
				"value"=>date("d-m-Y", $output['date'])
			));

		
			$form .= functions\makeForm::inputText(array(
				"placeholder"=>"დასახელება", 
				"id"=>"title", 
				"name"=>"title",
				"value"=>$output['title']
			));


			$form .= functions\makeForm::label(array(
				"id"=>"longDescription", 
				"for"=>"pageText", 
				"name"=>"აღწერა",
				"require"=>""
			));

			$form .= functions\makeForm::textarea(array(
				"id"=>"pageText",
				"name"=>"pageText",
				"placeholder"=>"აღწერა",
				"value"=>$output['description']
			));

			$form .= functions\makeForm::inputText(array(
				"placeholder"=>"ბმული", 
				"id"=>"link", 
				"name"=>"link",
				"value"=>$output['url']
			));



			$form .= "<div class=\"row\" id=\"photoUploaderBox\" style=\"margin:0 -10px\">";

			if(count($pictures)){
				$i = 2;
				
				foreach($pictures as $picture) {
					$form .= "<div class=\"col s4 imageItem\" id=\"img".$i."\">
						<div class=\"card\">
				    		<div class=\"card-image waves-effect waves-block waves-light\">
				    			<input type=\"hidden\" name=\"managerFiles[]\" class=\"managerFiles\" value=\"".$picture['path']."\" />
				      			<img class=\"activator\" src=\"".Config::WEBSITE."image/loadimage?f=".Config::WEBSITE_.$picture["path"]."&w=215&h=173\" />
				    		</div>

				    		<div class=\"card-content\">
			                	<p>
			                		<a href=\"javascript:void(0)\" onclick=\"openFileManager('photoUploaderBox', 'img".$i."')\" class=\"large material-icons\">mode_edit</a>
			                		<a href=\"javascript:void(0)\" onclick=\"removePhotoItem('img".$i."')\" class=\"large material-icons\">delete</a>
			                	</p>
			              	</div>

			    		</div>
			  		</div>";
			  		$i++;
				}
			}

			$form .= "<div class=\"col s4 imageItem\" id=\"img1\">
				<div class=\"card\">
		    		<div class=\"card-image waves-effect waves-block waves-light\">
		    			<input type=\"hidden\" name=\"managerFiles[]\" class=\"managerFiles\" value=\"\" />
		      			<img class=\"activator\" src=\"/public/img/noimage.png\" />
		    		</div>

		    		<div class=\"card-content\">
	                	<p>
	                		<a href=\"javascript:void(0)\" onclick=\"openFileManager('photoUploaderBox', 'img1')\" class=\"large material-icons\">mode_edit</a>
	                		<a href=\"javascript:void(0)\" onclick=\"removePhotoItem('img1')\" class=\"large material-icons\">delete</a>
	                	</p>
	              	</div>

	    		</div>
	  		</div>";

	  		$form .= "</div>";


			$form .= functions\makeForm::close();

			
			$this->out = array(
				"Error" => array(
					"Code"=>0, 
					"Text"=>"ოპერაცია შესრულდა წარმატებით !",
					"Details"=>""
				),
				"form" => $form,
				"attr" => "formModuleEdit('".$idx."','".$lang."')"
			);	
		}

		

		return $this->out;
	}
}