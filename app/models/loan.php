<?php 
class loan
{
	public $cities;
	public $agreement;
	public function __construct()
	{
		$contactData = new Database('modules', array(
			"method"=>"selectContactData",
			"lang"=>"ge"
		));
		$contactData = $contactData->getter();
		$this->agreement = strip_tags($contactData['agreement'],'<a>');

		try{
			$dom = new DOMDocument();
			@$dom->loadHTML(mb_convert_encoding($this->agreement, 'HTML-ENTITIES', 'UTF-8'));
			$x = new DOMXPath($dom);

			foreach($x->query("//a") as $node)
			{   
				$node->setAttribute("target","_blank");
			}
			$this->agreement = $dom->saveHtml();
		}catch(Exception $e){}
	}

	public function index()
	{
		$out = "<div id=\"ApplicationModal\" class=\"modal ApplicationModal\">";
		$out .= "<form id=\"loanForm\" name=\"loanForm\">";
		$out .= "<input type=\"hidden\" name=\"loanMoney\" id=\"loanMoney2\" value=\"300\" />";
		$out .= "<input type=\"hidden\" name=\"loanMonth\" id=\"loanMonth2\" value=\"3\" />";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"form-group col-sm-12 padding_0\">";
		$out .= "<div class=\"col-sm-4\">";
		$out .= "<label class=\"TitleLabel\">სამომხმარებლო სესხის განაცხადი</label>";
		$out .= "</div>";
		$out .= "<div class=\"col-sm-4\">";
		$out .= "<label class=\"LoansCountDiv\"><span id=\"loanMoney\">300</span><strong>l</strong> <span>/ <span id=\"loanMonth\">3</span> <b>თვით</b></span></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"col-sm-12\">";
		$out .= "<div class=\"modal-message-box\"></div>";
		$out .= "</div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-name\" name=\"loan-name\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-name\">სახელი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-surname\" name=\"loan-surname\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-surname\">გვარი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-pid\" name=\"loan-pid\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-pid\">პირადი ნომერი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-dob\" name=\"loan-dob\" type=\"text\" value=\"".date("d/m/Y")."\">";
		$out .= "<label for=\"loan-dob\">დაბადების თარიღი ( დღე/თვე/წელი ) <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-faddress\" name=\"loan-faddress\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-faddress\">ფაქტობრივი მისამართი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<select id=\"loan-city\" name=\"loan-city\">";
		
		foreach ($this->cities as $val) {
			$default = ($val['id']==1) ? "selected='selected'" : "";
			$out .= "<option value=\"".$val['id']."\" ".$default.">".$val['names']."</option>";
		}	

		$out .= "</select>";

		$out .= "<label>აირჩიეთ ქალაქი <font color=\"red\">*</font></label>";
		$out .= " </div></div>";

		$out .= "<div style=\"opacity:0; clear: both\"></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-mobile\" name=\"loan-mobile\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-mobile\">მობილურის ნომერი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-email\" name=\"loan-email\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-email\">ელ-ფოსტა <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-jobTitle\" name=\"loan-jobTitle\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-jobTitle\">სამსახურის დასახელება <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-income\" name=\"loan-income\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-income\">ყოველთვიური შემოსავალი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-position\" name=\"loan-position\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-position\">საქმიანობა პოზიცია</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-jobphone\" name=\"loan-jobphone\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-jobphone\">სამსახურის ტელეფონის ნომერი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-contactPerson\" name=\"loan-contactPerson\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-contactPerson\">საკონტაქტო პირი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-contactPersonNumber\" name=\"loan-contactPersonNumber\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-contactPersonNumber\">საკონტაქტო პირის ტელეფონი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		// $out .= "<div class=\"input-field col-sm-4\"><div class=\"form-group\">";
		// $out .= "<select name=\"loan-gender\" id=\"loan-gender\">";
		// $out .= "<option value=\"მამრობითი\">მამრობითი</option>";	
		// $out .= "<option value=\"მდედრობითი\">მდედრობითი</option>";	
		// $out .= "</select>";
		// $out .= "<label>აირჩიეთ სქესი</label></div></div>";

		

		

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-password\" name=\"loan-password\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-password\">პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-repassword\" name=\"loan-repassword\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-repassword\">გაიმეორე პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-9\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ApplicationFooterText\">";
		$out .= "<input type=\"checkbox\" class=\"filled-in\" id=\"checkbox1\" name=\"checkbox1\" />";
      	$out .= "<label for=\"checkbox1\" style=\"display:inline-block\">გავეცანი და ვეთანხმები ".$this->agreement." და პერსონალური მონაცემთა დამუშავების პირობებს</label> ";
		
		// $out .= "<input type=\"checkbox\" class=\"filled-in\" id=\"checkbox2\" name=\"checkbox2\" />";
      	// $out .= "<label for=\"checkbox2\" style=\"display:inline-block\">საკრედიტო ისტორიის გადამოწმება სს კრედიტინფო საქართველოს მონაცემთა ბაზაში</label>";
		$out .= "</div></div></div>";

		$out .= "<div class=\"input-field col-sm-3\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" onclick=\"makeStatement()\">განაცხადის გაგზავნა</div>";
		$out .= "</div></div>";

		$out .= "</div></div></div></form></div>";
		return $out;
	}
}