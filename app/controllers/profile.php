<?php 
class Profile extends Controller
{
	public function __construct()
	{
		if(!isset($_SESSION["capex_user"]))
		{
			require_once 'app/functions/redirect.php';
			functions\redirect::url("/");
		}
	}

	public function index($name = '')
	{
		/* database */
		$modules = new Database('modules', array(
			"method"=>"selectAllFaq"
		));
		$contactData = new Database('modules', array(
			"method"=>"selectContactData",
			"lang"=>"ge"
		));
		$contactData = $contactData->getter();
		$page = new Database('page', array(
			"method"=>"selectAboutContent",
			"idx"=>2,
			"lang"=>"ge"
		)); 
		$cities = new Database("cities", array(
			"method"=>"select"
		));
		$statements = new Database('statements', array(
			'method'=>'selectByPersonalNumber',
			'pid'=>$_SESSION['capex_user'], 
			'noUpdateRead'=>"true"
		));
		$getStatements = $statements->getter();

		/* models */
		

		$loane = $this->model('loane');
		$loane->cities = $cities->getter(); 
		$loane->data = $getStatements;
		
		$question = $this->model('question');
		$question->questionsArray = $modules->getter();

		$about = $this->model('about');
		$about->content = $page->getter();

		$updatePassword = $this->model('updatePassword');		

		$header = $this->model('header');
		$homepage = $this->model('homepage');
		$header->publicFolder = Config::PUBLIC_FOLDER;

		$header->contactNumber = strip_tags($contactData['phone']);
		$header->email = strip_tags($contactData['email']);
		$header->map = (isset($contactData['map'])) ? strip_tags($contactData['map']) : "";

		/* view */
		$this->view('profile/index', [
			"header"=>array(
				"website"=>Config::WEBSITE,
				"public"=>Config::PUBLIC_FOLDER
			),
			"loaneModel"=>$loane->index(), 
			"questionModel"=>$question->index(), 
			"aboutModel"=>$about->index(), 
			"headerModel"=>$header->index(), 
			"homepageModel"=>$homepage->index(),
			"contactNumber"=>$header->contactNumber, 
			"email"=>$header->email, 
			"getStatements"=>$getStatements,
			"updatePassword"=>$updatePassword->index(),
			"map"=>$header->map
		]);
	}
}