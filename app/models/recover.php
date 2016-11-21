<?php 
class recover
{

	public function __construct()
	{
		// require_once 'app/functions/url.php';
	}

	public function index()
	{
		$out = "<div id=\"recover\" class=\"modal modal-trigger recover\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<h4>პაროლის აღდგენა</h4>";
		$out .= "<div class=\"modal-message-box-auth\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"recover-email\" name=\"recover-email\" type=\"text\" class=\"\">";
		$out .= "<label for=\"recover-email\">ელ-ფოსტა</label>";
		$out .= "</div></div>";


		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" id=\"reButton\">გაგზავნა</div>";

		$out .= "</div></div></div></div></div></div>";
		return $out;
	}
}