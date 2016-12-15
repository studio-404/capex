<?php 
class auth
{

	public function __construct()
	{
		// require_once 'app/functions/url.php';
	}

	public function index()
	{
		$out = "<div id=\"AuthorizationPopup\" class=\"modal modal-trigger AuthorizationPopup\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<h4>ავტორიზაცია</h4>";
		$out .= "<div class=\"modal-message-box-auth\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"PersonalNumber\" name=\"PersonalNumber\" type=\"text\" class=\"\">";
		$out .= "<label for=\"PersonalNumber\">პირადი ნომერი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"PersonalPass\" name=\"PersonalPass\" type=\"password\" class=\"\">";
		$out .= "<label for=\"PersonalPass\">პაროლი <font color=\"red\">*</font></label>";
		$out .= "</div></div>";

		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" id=\"siButton\" onclick=\"signintry($('#PersonalNumber').val(), $('#PersonalPass').val())\">შესვლა</div>";

		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div style=\"margin:0 -10px\">";
		$out .= "<a href=\"#recover\" class=\"OpenModalClick\" onclick=\"recoverPassword()\" style=\"color:#133056\">პაროლის აღდგენა</a>";
		$out .= "</div>";
		$out .= "</div>";

		$out .= "</div></div></div></div></div></div>";
		return $out;
	}
}