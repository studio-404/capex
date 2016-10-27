<?php 
class websiteNavigation
{
	public $navigation;

	public function index(){
		require_once 'app/core/Config.php';
		$nav = "";
		if(count($this->navigation)){
			foreach ($this->navigation as $val) {
				$slug = Config::WEBSITE.Config::PAGE_PREFIX."/".$val['lang']."/".$val['idx']."/".$val['slug']; 
				$visibility = ($val['visibility']==1) ? "visibility_off" : "visibility";
				$nav .= sprintf(
					"
					<tr>
					<td>%d</td>
					<td><a href=\"%s\" target=\"_blank\">%s</a></td>
					<td class=\"roboto-font\">%s</td>
					<td>
					<a href=\"%s\">
						<i class=\"material-icons tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"ხილვადობის შეცვლა\">%s</i>
					</a>
					<a href=\"%s\">
						<i class=\"material-icons tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"რედაქტირება\">mode_edit</i>
					</a>
					<a href=\"%s\">
						<i class=\"material-icons tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"წაშლა\">delete</i>
					</a>
					</td>
					</tr>
					",
					$val['idx'],
					$slug,				
					$val['title'],
					$val['type'],
					"?visibility",
					$visibility,
					"?edit",
					"?delete"
				);
			}
		}
		return $nav;
	}
}