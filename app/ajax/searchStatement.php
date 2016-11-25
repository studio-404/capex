<?php 
class searchStatement
{
	public $out; 

	public function __construct()
	{
		require_once 'app/core/Config.php';
		if(!isset($_SESSION[Config::SESSION_PREFIX."username"]))
		{
			exit();
		}
	}
	
	public function index(){
		require_once 'app/core/Config.php';
		require_once 'app/functions/request.php';

		$this->out = array(
			"Error" => array(
				"Code"=>1, 
				"Text"=>"მოხდა შეცდომა !",
				"Details"=>"!"
			)
		);

		$pid = functions\request::index("POST","pid");

		$statements = new Database('statements', array(
			'method'=>'selectByPersonalNumber', 
			'pid'=>$pid
		));
		$getter = $statements->getter();

		$table = '<table class="striped"><tbody>';
		if(count($getter)) {
			foreach ($getter as $val) {
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'ს.კ.: ',
					$val['id']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'დამატების თარიღი: ',
					date("d/m/Y H:i:s", $val['date'])
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'IP მისამართი: ',
					$val['ip']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'პირადი ნომერი: ',
					$val['personal_number']
				);

				$editable_ = sprintf(
					"<div class=\"editable_name\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"name",
					$val['name'],  
					$pid,
					$val['name']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'სახელი: ',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_surname\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"surname",
					$val['surname'],  
					$pid,
					$val['surname']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'გვარი: ',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_dob\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"dob",
					$val['dob'],  
					$pid,
					$val['dob']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'დაბადების თარიღი: ',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_faddress\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"faddress",
					$val['faddress'],  
					$pid,
					$val['faddress']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'ფაქტობრივი მისამართი: ',
					$editable_
				);


				$cities = new Database('cities', array(
					'method'=>'selectById', 
					'id'=>$val['city']
				));
				$city_name = $cities->getter();

				$editable_ = sprintf(
					"<div class=\"editable_city\" onclick=\"updateColSelect('%s','%s','%s','%s')\">%s</div>",
					"city",
					$city_name,  
					$pid,
					$val['city'], 
					$city_name
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'ქალაქი:',
					$editable_
				);


				$editable_ = sprintf(
					"<div class=\"editable_mobile\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"mobile",
					$val['mobile'],  
					$pid,
					$val['mobile']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'მობილურის ნომერი:',
					$editable_
				);


				$editable_ = sprintf(
					"<div class=\"editable_email\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"email",
					$val['email'],  
					$pid,
					$val['email']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'ელ-ფოსტა:',
					$editable_
				);


				$editable_ = sprintf(
					"<div class=\"editable_jobTitle\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"jobTitle",
					$val['jobTitle'],  
					$pid,
					$val['jobTitle']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'სამსახურის დასახელება:',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_monthly_income\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"monthly_income",
					$val['monthly_income'],  
					$pid,
					$val['monthly_income']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'ყოველთვიური შემოსავალი:',
					$editable_
				);
				

				$editable_ = sprintf(
					"<div class=\"editable_position\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"position",
					$val['position'],  
					$pid,
					$val['position']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'საქმიანობა პოზიცია:',
					$editable_
				);


				$editable_ = sprintf(
					"<div class=\"editable_jobphone\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"jobphone",
					$val['jobphone'],  
					$pid,
					$val['jobphone']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'სამსახურის ტელეფონის ნომერი:',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_contactPerson\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"contactPerson",
					$val['contactPerson'],  
					$pid,
					$val['contactPerson']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'საკონტაქტო პირი:',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_contactPersonNumber\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"contactPersonNumber",
					$val['contactPersonNumber'],  
					$pid,
					$val['contactPersonNumber']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'საკონტაქტო პირის ტელეფონი:',
					$editable_
				);
				
				$editable_ = sprintf(
					"<div class=\"editable_demended_loan\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"demended_loan",
					$val['demended_loan'],  
					$pid,
					$val['demended_loan']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'მოთხოვნილი სესხი:',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_demended_month\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"demended_month",
					$val['demended_month'],  
					$pid,
					$val['demended_month']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'მოთხოვნილი თვე:',
					$editable_
				);

				$editable_ = sprintf(
					"<div class=\"editable_password\" onclick=\"updateCol('%s','%s','%s')\">%s</div>",
					"password",
					$val['password'],  
					$pid,
					$val['password']
				);
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'პაროლი:',
					$editable_
				);

				$status = ($val["loan_status"]==2) ? "checked='checked'" : "";
				
				$aprooved = "
				<div class=\"switch\">
				<label>
				მიმ. განხილვა
				<input type=\"hidden\" id=\"loan-spid\" name=\"loan-spid\" value=\"".$pid."\" />
				<input type=\"checkbox\" id=\"loan-status\" name=\"loan-status\" value=\"on\" ".$status." />
				<span class=\"lever\"></span>
				დამტკიცება
				</label>
				</div>";

				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'სესხის დამტკიცება:',
					$aprooved
				);

				$status2 = ($val["loan_finished"]==2) ? "checked='checked'" : "";
				$aprooved2 = "
				<div class=\"switch\">
				<label>
				მიმდინარე
				<input type=\"hidden\" id=\"loan-spid2\" name=\"loan-spid2\" value=\"".$pid."\" />
				<input type=\"checkbox\" id=\"loan-status2\" name=\"loan-status2\" value=\"on\" ".$status2." />
				<span class=\"lever\"></span>
				დასრულდა
				</label>
				</div>";
				$table .= sprintf("
					<tr>
					<td><strong>%s</strong></td>
					<td>%s</td>
					</tr>",
					'სესხის სტატუსი:',
					$aprooved2
				);

				

				//
				
			}
		}else{
			$table .= sprintf("
					<tr>
					<td colspan=\"2\">%s</td>
					</tr>",
					'მონაცემი ვერ მოიძებნა !'
			);
		}
		$table .= '</table></tbody>';

		$this->out = array(
			"Error" => array(
				"Code"=>0, 
				"Text"=>"ოპერაცია შესრულდა წარმატებით !",
				"Details"=>""
			),
			"table" => $table
		);	

		return $this->out;
	}
}