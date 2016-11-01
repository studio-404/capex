<?php 
class statementsView
{
	public $data;
	public $string;

	public function index(){
		$out = '';
		if(count($this->data)) : 
			foreach ($this->data as $val) {
				$out .= sprintf("<tr>
						<td>%d</td>
						<td>%s</td>
						<td>%s %s</td>
						<td>%s</td>
						<td>
							<a href=\"javascript:void(0)\" onclick=\"searchStatement('%s')\"><i class=\"material-icons tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"სრულად ნახვა\">pageview</i></a>

							<a href=\"javascript:void(0)\" onclick=\"askRemoveStatement('%s')\"><i class=\"material-icons tooltipped\" data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"წაშლა\">delete</i></a>
						</td>
					</tr>",
					$val['id'],
					date("d/m/Y g:i:s", $val['date']), 
					$val['name'],
					$val['surname'],
					$val['personal_number'],
					$val['personal_number'], 
					$val['id']
				);
			}
		endif;
		return $out;
	}
}