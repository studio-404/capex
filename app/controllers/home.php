<?php
class Home extends Controller{
	
	public function index($name = '')
	{
		/* Database Connection */
		$Database = new Database('test');
		$output = $Database->getter();
		
		/* model */
		$TestModel = $this->model('TestModel');
		$TestModel->output = $output;

		/* view */
		$this->view('home/index', [
			"name" => $TestModel->index()
		]);
	}

}