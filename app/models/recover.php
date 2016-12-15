<?php 
class recover
{

	public function __construct()
	{
		
	}

	public function index()
	{
		require_once 'app/functions/string.php';
		$string = new functions\string();
		$secure = $string::random(8);
		$_SESSION["capex_secure"] = $secure;
		
		$out = "<div id=\"recover\" class=\"modal modal-trigger recover\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div>";
		$out .= "<h4>პაროლის აღდგენა</h4>";
		$out .= "<div class=\"modal-message-box-recover\"></div>";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		
		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<input id=\"secure\" name=\"secure\" type=\"hidden\" value=\"".$secure."\" />";
		$out .= "<input id=\"recover-email\" name=\"recover-email\" type=\"text\" class=\"\">";
		$out .= "<label for=\"recover-email\">ელ-ფოსტა <font color=\"red\">*</font></label>";
		$out .= "</div></div>";


		$out .= "<div class=\"input-field col-sm-12\">";
		$out .= "<div class=\"form-group\">";
		$out .= "<div class=\"ButtonOrange waves-effect waves-light\" id=\"reButton\" onclick=\"reButton()\">გაგზავნა</div>";

		$out .= "</div></div></div></div></div></div>";
		return $out;
	}
}