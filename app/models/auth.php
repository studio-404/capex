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
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"PersonalNumber\" type=\"text\" class=\"\">";
		$out .= "<label for=\"PersonalNumber\">პირადი ნომერი</label>";
		$out .= "</div></div>";
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"PersonalPass\" type=\"password\" class=\"\">";
		$out .= "<label for=\"PersonalPass\">პაროლი</label>";
		$out .= "</div></div>";
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\">შესვლა</div>";
		$out .= "</div></div></div></div></div></div>";
		return $out;
	}
}