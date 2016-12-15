<?php 
class homepage
{
	public function __construct()
	{

	}

	public function index()
	{
		$out = "<div id=\"HomePage\" class=\"height100\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"col-sm-6 padding_0 animated fadeInLeft\">";
		$out .= "<div class=\"HomeLeftDiv height100\"><br /><br />";
		// $out .= "<span>არ ვარ დარეგისტრირებული</span>";
		$out .= "<div class=\"HomeBigFont\">ახალი<br />მომხმარებელი<br /></div>";
		$out .= "<span>მიიღე <strong style=\"font-family:roboto\">2000</strong> ლარამდე სესხი სწრაფად</span>";
		$out .= "<div class=\"clear\"></div><br />";
		$out .= "<a class=\"ScrollAnimate HomeButton waves-effect waves-orange animated-button victoria-one\" href=\"#Scrolling\">სესხის აღება</a>";
		$out .= "</div></div>";
		$out .= "<div class=\"col-sm-6 padding_0 animated fadeInRight\">";
		$out .= "<div class=\"HomeRightDiv height100\"><br /><br />";
		// $out .= "<span>არ ვარ დარეგისტრირებული</span>";
		$out .= "<div class=\"HomeBigFont\">არსებული<br />მომხმარებელი<br /></div>";
		$out .= "<span>მიიღე <strong style=\"font-family:roboto\">2000</strong> ლარამდე სესხი განმეორებით</span>";
		$out .= "<div class=\"clear\"></div><br />";
		$out .= "<a class=\"HomeButton waves-effect waves-teal OpenModalClick animated-button victoria-two\" href=\"#AuthorizationPopup\">ავტორიზაცია</a>";
		$out .= "</div></div></div>";
		$out .= "</div>";

		return $out;
	}
}