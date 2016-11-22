<?php 
class loane
{
	public $cities;
	public $data;
	public function __construct()
	{
		
	}

	public function index()
	{
		$out = "<div id=\"ApplicationModal\" class=\"modal ApplicationModal\">";
		$out .= "<form id=\"editloanForm\" name=\"editloanForm\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"form-group col-sm-12 padding_0\">";
		$out .= "<div class=\"col-sm-4\">";
		$out .= "<label class=\"TitleLabel\">პროფილის რედაქტირება</label>";
		$out .= "</div>";		
		$out .= "</div>";

		$out .= "<div class=\"col-sm-12\">";
		$out .= "<div class=\"modal-message-box\"></div>";
		$out .= "</div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-name\" name=\"loan-name\" type=\"text\" value=\"".htmlentities($this->data[0]["name"])."\">";
		$out .= "<label for=\"loan-name\">სახელი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-surname\" name=\"loan-surname\" type=\"text\" value=\"".htmlentities($this->data[0]["surname"])."\">";
		$out .= "<label for=\"loan-surname\">გვარი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-pid\" name=\"loan-pid\" type=\"text\" value=\"".$_SESSION['capex_user']."\" disabled=\"disabled\">";
		$out .= "<label for=\"loan-pid\">პირადი ნომერი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-dob\" name=\"loan-dob\" type=\"text\" value=\"".htmlentities($this->data[0]["dob"])."\">";
		$out .= "<label for=\"loan-dob\">დაბადების თარიღი ( დღე/თვე/წელი ) <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-faddress\" name=\"loan-faddress\" type=\"text\" value=\"".htmlentities($this->data[0]["faddress"])."\">";
		$out .= "<label for=\"loan-faddress\">ფაქტობრივი მისამართი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<select id=\"loan-city\" name=\"loan-city\">";
		
		foreach ($this->cities as $val) {
			$active = ($val['id'] == $this->data[0]["city"]) ? " selected='selected'" : "";
			$out .= "<option value=\"".$val['id']."\"".$active.">".$val['names']."</option>";
		}	

		$out .= "</select>";

		$out .= "<label>აირჩიეთ ქალაქი <font color=\"red\">*</font></label>";
		$out .= " </div></div>";

		$out .= "<div style=\"opacity:0; clear: both\"></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-mobile\" name=\"loan-mobile\" type=\"text\" value=\"".htmlentities($this->data[0]["mobile"])."\">";
		$out .= "<label for=\"loan-mobile\">მობილურის ნომერი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-email\" name=\"loan-email\" type=\"text\" value=\"".htmlentities($this->data[0]["email"])."\">";
		$out .= "<label for=\"loan-email\">ელ-ფოსტა <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-jobTitle\" name=\"loan-jobTitle\" type=\"text\" value=\"".htmlentities($this->data[0]["jobTitle"])."\">";
		$out .= "<label for=\"loan-jobTitle\">სამსახურის დასახელება <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-income\" name=\"loan-income\" type=\"text\" value=\"".htmlentities($this->data[0]["monthly_income"])."\">";
		$out .= "<label for=\"loan-income\">ყოველთვიური შემოსავალი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-position\" name=\"loan-position\" type=\"text\" value=\"".htmlentities($this->data[0]["position"])."\">";
		$out .= "<label for=\"loan-position\">საქმიანობა პოზიცია</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-jobphone\" name=\"loan-jobphone\" type=\"text\" value=\"".htmlentities($this->data[0]["jobphone"])."\">";
		$out .= "<label for=\"loan-jobphone\">სამსახურის ტელეფონის ნომერი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-contactPerson\" name=\"loan-contactPerson\" type=\"text\" value=\"".htmlentities($this->data[0]["contactPerson"])."\">";
		$out .= "<label for=\"loan-contactPerson\">საკონტაქტო პირი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-contactPersonNumber\" name=\"loan-contactPersonNumber\" type=\"text\" value=\"".htmlentities($this->data[0]["contactPersonNumber"])."\">";
		$out .= "<label for=\"loan-contactPersonNumber\">საკონტაქტო პირის ტელეფონი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";


		$out .= "<div class=\"input-field col-sm-3\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" onclick=\"updateProfile()\">განახლება</div>";
		$out .= "</div></div>";

		$out .= "</div></div></div></form></div>";
		return $out;
	}
}