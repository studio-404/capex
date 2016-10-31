<?php 
class question
{
	public $questionsArray;
	public function __construct()
	{

	}

	public function index()
	{
		$out = "<div id=\"QuestionModal\" class=\"modal QuestionModal\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div> ";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"form-group col-sm-12 padding_0\">";
		$out .= "<div class=\"col-sm-12\">";
		$out .= "<label class=\"TitleLabel\">ხშირად დასმული კითხვები</label>";
		$out .= "</div></div>";
		$x = 1;
		if(count($this->questionsArray)):
			foreach ($this->questionsArray as $val) {
				$out .= "<div class=\"col-sm-12 QuestionItem\">";
				$out .= "<strong>".$x.". ".$val['title']."</strong>";
				$out .= "<span>".$val['description']."</span>";
				$out .= "</div>";
				$x++;
			}
		endif;

		$out .= "</div></div></div></div>";
		return $out;
	}
}