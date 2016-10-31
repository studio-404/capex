<?php 
class about
{
	public $content;
	public function __construct()
	{

	}

	public function index()
	{
		$out = "<div id=\"AboutUsPopup\" class=\"modal QuestionModal\">";
		$out .= "<div class=\"modal-content\">";
		$out .= "<div class=\"modal-action modal-close\"></div> ";
		$out .= "<div class=\"AutorizationForm\">";
		$out .= "<div class=\"row\">";
		$out .= "<div class=\"form-group col-sm-12 padding_0\">";
		$out .= "<div class=\"col-sm-12\">";
		$out .= "<label class=\"TitleLabel\">".$this->content['title']."</label>";
		$out .= "</div></div>";
		$out .= "<div class=\"col-sm-12 QuestionItem\">";
		$out .= $this->content['text'];
		$out .= "</div>";
		$out .= "</div></div></div></div>";
		return $out;
	}
}