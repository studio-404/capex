<?php
class TestModel
{
	public $output;

	public function index(){
		echo $this->output[0]["name"];
	}
}