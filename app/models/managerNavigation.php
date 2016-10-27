<?php
class managerNavigation
{
	public $navigation;

	public function index(){
		$nav = sprintf("<ul id=\"nav-mobile\" class=\"right hide-on-med-and-down\">");
		$getUrl = explode("/",$this->getUrl());
		$slug = $getUrl[0]."/".$getUrl[1];
		foreach ($this->navigation as $key => $value) {
			$active = ($key==$slug) ? "class='active'" : "";
			$nav .= sprintf(
				"<li %s><a href=\"/%s\">%s</a></li>",
				$active,
				$key,				
				$value
			);
		}
		$nav .= sprintf("</ul>");

		return ($nav);
	}

	public function footer()
	{
		$nav = sprintf("<ul>");
		$getUrl = explode("/",$this->getUrl());
		$slug = $getUrl[0]."/".$getUrl[1];
		foreach ($this->navigation as $key => $value) {
			$active = ($key==$slug) ? "class='active'" : "";
			$nav .= sprintf(
				"<li %s><a href=\"/%s\">%s</a></li>",
				$active,
				$key,				
				$value
			);
		}
		$nav .= sprintf("</ul>");

		return ($nav);
	}

	private function getUrl(){
		$request = parse_url($_SERVER['REQUEST_URI']);
		$path = $request["path"];
		$result = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');
		return $result;
	}
}