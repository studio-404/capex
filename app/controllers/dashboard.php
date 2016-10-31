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
			"dashboard/modules/faq"=>"მოდულები",
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
		require_once 'app/functions/url.php';
		require_once 'app/functions/string.php';
		require_once 'app/functions/pagination.php';

		$string = new functions\string(); 
		$url = new functions\url();
		$pagination = new functions\pagination();

		// database
		$getUrl = explode("/", $url->getUrl());
		$itemPerPage = 20;
		$modules = new Database('modules', array(
			"method"=>"select",
			"parsed_url"=>$getUrl,
			"lang"=>"ge",
			"itemPerPage"=>$itemPerPage
		));
		$getter = $modules->getter();

		$usefull_modules = new Database('modules', array(
			"method"=>"selectParentUsefull",
			"lang"=>"ge"
		));
		$use_mod = $usefull_modules->getter();

		// models
		$modelesView = $this->model('modelesView');
		$modelesView->data = $getter;
		$modelesView->string = $string;

		$parentModel = $this->model('parentModel');
		$parentModel->use_mod = $use_mod;

		$this->view('dashboard/modules', [
			"header" => array(
				"website" => Config::WEBSITE,
				"public" => Config::PUBLIC_FOLDER
			),
			"nav" => $this->managerNavigation->index(),
			"parsed_url"=>$getUrl,
			"string"=>$string, 
			"modules"=>$getter,
			"itemPerPage"=>$itemPerPage,
			"pagination"=>$pagination,
			"parentModel"=>$parentModel->index(),
			"theModels"=>$modelesView->index(), 
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