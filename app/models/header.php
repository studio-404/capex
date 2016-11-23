<?php 
class header
{
	public $publicFolder;
	public $email;
	public $contactNumber;
	public $map;
	public $agreement;

	public function __construct()
	{

	}

	public function index()
	{
		$out = "<header id=\"Header\">";
		
		$out .= "<div class=\"col-sm-2\">";
		$out .= "<div class=\"logo\"><a class=\"ScrollAnimate\" href=\"#Home\"><img src=\"".$this->publicFolder."img/logo.png\"/></a></div>";
		$out .= "</div>";

		$out .= "<div class=\"col-sm-10 text-right\">";
		$out .= "<div class=\"HeaderDiv\">";
		$out .= "<div class=\"HeaderMenu\">";
		
		$out .= "<div class=\"navigation\">";
		
		$out .= "<div class=\"nav_bar\">";
		$out .= "<div class=\"CloseMenu\"></div>";
		$out .= "</div>";
		
		$out .= "<li><a class=\"MenuCloseClick2\" href=\"#Home\">მთავარი</a></li>";
		$out .= "<li><a class=\"MenuCloseClick2 OpenModalClick\" href=\"#QuestionModal\">კითხვა პასუხი</a></li>";
		$out .= "<li><a class=\"MenuCloseClick2 OpenModalClick\" href=\"#AboutUsPopup\">ჩვენს შესახებ</a></li>";
		$out .= "<li id=\"contactLink\"><a class=\"MenuCloseClick ScrollAnimate\" href=\"#Contact\">კონტაქტი</a></li>";

		$out .= "<li><a class=\"MenuCloseClick2 workingHour tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"სამუშაო საათები\" href=\"javascript:void(0)\">ორშ-პარ <strong>10:00 - 18:00</strong></a></li>";

		if(!isset($_SESSION['capex_user'])){
			$out .= "<a class=\"AuthorizationButton OpenModalClick waves-effect waves-orange\" href=\"#AuthorizationPopup\">ავტორიზაცია</a>";
		}else{
			$out .= "<a class=\"AuthorizationButton waves-effect waves-orange\" href=\"/\">გასვლა</a>";
		}
		
		$out .= "</div>";
		

		$out .= "<div class=\"nav_bg\">";
		$out .= "<div class=\"nav_bar\"> <span></span> <span></span> <span></span> </div>";
		$out .= "</div></div>";
		$out .= "<div class=\"HeaderTel\">".$this->contactNumber."<span class=\"fb-icon\" onclick=\"gotox('https://facebook.com')\"></span></div>";
		$out .= "</div></div>";
		$out .= "</header>";

		return $out;
	}
}