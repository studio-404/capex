<?php 
class homepage
{
	public function __construct()
	{

	}

	public function index()
	{
		$out = "<section id=\"HomePage\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"col-sm-6 padding_0 animated fadeInLeft\">";
		$out .= "<div class=\"HomeLeftDiv height100\">";
		$out .= "<span>არ ვარ დარეგისტრირებული</span>";
		$out .= "<div class=\"HomeBigFont\">გჭირდება სწრაფი <br/>სესხი</div>";
		$out .= "<span>მიიღე სესხი სახლიდან <br/> გაუსვლელად</span>";
		$out .= "<div class=\"clear\"></div>";
		$out .= "<a class=\"ScrollAnimate HomeButton waves-effect waves-orange animated-button victoria-one\" href=\"#ScrollingPage\">ფულის მიღება</a>";
		$out .= "</div></div>";
		$out .= "<div class=\"col-sm-6 padding_0 animated fadeInRight\">";
		$out .= "<div class=\"HomeRightDiv height100\">";
		$out .= "<span>არ ვარ დარეგისტრირებული</span>";
		$out .= "<div class=\"HomeBigFont\">გჭირდება სწრაფი <br/>სესხი</div>";
		$out .= "<span>მიიღე სესხი სახლიდან <br/>გაუსვლელად</span>";
		$out .= "<div class=\"clear\"></div>";
		$out .= "<a class=\"HomeButton waves-effect waves-teal OpenModalClick animated-button victoria-two\" href=\"#AuthorizationPopup\">ავტორიზაცია</a>";
		$out .= "</div></div></div>";
		$out .= "</section>";

		return $out;
	}
}