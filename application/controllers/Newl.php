<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
class Newl extends REST_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('news_model');
	}
	
	public function index_get() {
		
		if(empty($this->get('slug'))){
			$news =  $this->news_model->get_news();
		}
		else {
			$news =  $this->news_model->get_news($this->get('slug'));
		}
		
		$this->response($news);
	}
	
	public function create_post() {
		$data =	$this->news_model->set_news();
		$this->response($data);
		
	}
}
