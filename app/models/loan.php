<?php 
class loan
{
	public $cities;
	public function __construct()
	{

	}

	public function index()
	{
		$out = "<div id=\"ApplicationModal\" class=\"modal ApplicationModal\">";
		$out .= "<form id=\"loanForm\" name=\"loanForm\">";
		$out .= "<input type=\"hidden\" name=\"loanMoney\" id=\"loanMoney2\" value=\"0\" />";
		$out .= "<input type=\"hidden\" name=\"loanMonth\" id=\"loanMonth2\" value=\"0\" />";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"form-group col-sm-12 padding_0\">";
		$out .= "<div class=\"col-sm-4\">";
		$out .= "<label class=\"TitleLabel\">სამომხმარებლო სესხის განაცხადი</label>";
		$out .= "</div>";
		$out .= "<div class=\"col-sm-4\">";
		$out .= "<label class=\"LoansCountDiv\"><span id=\"loanMoney\">0</span><strong>l</strong> <span>/ <span id=\"loanMonth\">0</span> <b>თვით</b></span></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"col-sm-12\">";
		$out .= "<div class=\"modal-message-box\"></div>";
		$out .= "</div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-name\" name=\"loan-name\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-name\">სახელი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-surname\" name=\"loan-surname\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-surname\">გვარი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-pid\" name=\"loan-pid\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-pid\">პირადი ნომერი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-dob\" name=\"loan-dob\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-dob\">დაბადების თარიღი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-gender\" name=\"loan-gender\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-gender\">სქესი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-email\" name=\"loan-email\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-email\">ელ-ფოსტა</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-phone\" name=\"loan-phone\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-phone\">ტელეფონი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<select id=\"loan-city\" name=\"loan-city\">";
		
		foreach ($this->cities as $val) {
			$out .= "<option value=\"".$val['id']."\">".$val['names']."</option>";
		}	

		$out .= "</select>";

		$out .= "<label>აირჩიეთ ქალაქი</label>";
		$out .= " </div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-street\" name=\"loan-street\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-street\">ქუჩა</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-home\" name=\"loan-home\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-home\">სახლი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-flat\" name=\"loan-flat\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-flat\">ბინა</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-postal\" name=\"loan-postal\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-postal\">საფოსტო კოდი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-income\" name=\"loan-income\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-income\">ყოველთვიური შემოსავალი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-otherloan\" name=\"loan-otherloan\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-otherloan\">მიმდინარე სესხი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\" style=\"opacity:0\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"\" type=\"text\" class=\"\">";
		$out .= "<label for=\"\">emptyxxx</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-password\" name=\"loan-password\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-password\">პაროლი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-4\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"loan-repassword\" name=\"loan-repassword\" type=\"text\" class=\"\">";
		$out .= "<label for=\"loan-repassword\">გაიმეორე პაროლი</label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-9\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ApplicationFooterText\">";
		$out .= "<input type=\"checkbox\" class=\"filled-in\" id=\"checkbox1\" name=\"checkbox1\" />";
      	$out .= "<label for=\"checkbox1\">გავეცანი და ვეთანხმები <a href=\"#\">ხელშეკრულების</a> პირობებს</label> ";
		$out .= "<input type=\"checkbox\" class=\"filled-in\" id=\"checkbox2\" name=\"checkbox2\" />";
      	$out .= "<label for=\"checkbox2\">საკრედიტო ისტორიის გადამოწმება სს კრედიტინფო საქართველოს მონაცემთა ბაზაში</label>";
		$out .= "</div></div></div>";

		$out .= "<div class=\"input-field col-sm-3\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" onclick=\"makeStatement()\">განაცხადის გაგზავნა</div>";
		$out .= "</div></div>";

		$out .= "</div></div></div></form></div>";
		return $out;
	}
}