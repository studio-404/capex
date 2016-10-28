<?php 
class dashboard extends Controller
{
	public $managerNavigation; 
	public $websiteNavigation; 
	public $websiteNavigation2; 

	public function __construct()
	{
		if(!isset($_SESSION[Config::SESSION_PREFIX."username"]))
		{
			require_once 'app/functions/redirect.php';
			functions\redirect::url("/manager/index");
		}

		$page = new Database('page', array(
			"method"=>"select",
			"cid"=>0,
			"nav_type"=>0, 
			"lang"=>"ge",
			"status"=>0
		));

		$page2 = new Database('page', array(
			"method"=>"select",
			"cid"=>0,
			"nav_type"=>1, 
			"lang"=>"ge",
			"status"=>0
		));

		$this->websiteNavigation = $this->model('websiteNavigation');
		$this->websiteNavigation->navigation = $page->getter();

		$this->websiteNavigation2 = $this->model('websiteAdditionalNavigation');
		$this->websiteNavigation2->navigation = $page2->getter();

		$this->managerNavigation = $this->model('managerNavigation');
		$this->managerNavigation->navigation = array(
			"dashboard/index"=>"გვერდები",
			"dashboard/modules"=>"მოდულები",
			"dashboard/statements"=>"განაცხადები",
			"manager/index"=>"გასვლა"
		);
	}

	public function index()
	{
		/* view */
		$this->view('dashboard/index', [
			"header" => array(
				"website" => Config::WEBSITE,
				"public" => Config::PUBLIC_FOLDER
			),
			"nav" => $this->managerNavigation->index(),
			"additionalNavigation"=>$this->websiteNavigation2->index(), 
			"mainNavigation" => $this->websiteNavigation->index(),
			"footerNav" => $this->managerNavigation->footer()
		]);
	}

	public function modules()
	{
		$this->view('dashboard/modules', [
			"header" => array(
				"website" => Config::WEBSITE,
				"public" => Config::PUBLIC_FOLDER
			),
			"nav" => $this->managerNavigation->index(),
			"footerNav" => $this->managerNavigation->footer()
		]);
	}

	public function statements()
	{
		$this->view('dashboard/statements', [
			"header" => array(
				"website" => Config::WEBSITE,
				"public" => Config::PUBLIC_FOLDER
			),
			"nav" => $this->managerNavigation->index(),
			"footerNav" => $this->managerNavigation->footer()
		]);
	}

}