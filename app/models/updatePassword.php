<?php 
class updatePassword
{
	public function __construct()
	{
		// require_once 'app/functions/url.php';
	}

	public function index()
	{
		$out = "<div id=\"updatePasswordBox\" class=\"modal modal-trigger updatePasswordBox\">";
		$out .= "<form action=\"\" method=\"post\" id=\"password-update\" name=\"password-update\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<h4>პაროლის განახლება</h4>";
		$out .= "<div class=\"modal-message-box-auth\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";

		$out .= "<div class=\"col-sm-12\">";
		$out .= "<div class=\"modal-message-box-password\"></div>";
		$out .= "</div>";
		
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"oldPassword\" name=\"oldPassword\" type=\"password\" value=\"\">";
		$out .= "<label for=\"oldPassword\">ძველი პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";
		
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"newPassword\" name=\"newPassword\" type=\"password\" value=\"\">";
		$out .= "<label for=\"newPassword\">ახალი პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"repeatPassword\" name=\"repeatPassword\" type=\"password\" value=\"\">";
		$out .= "<label for=\"repeatPassword\">გაიმეორეთ პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" id=\"upButton\" onclick=\"upPassword()\">განახლება</div>";

		$out .= "</div></div></div></div></div></form></div>";
		return $out;
	}
}