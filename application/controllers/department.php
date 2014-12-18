<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_dept_info()
	{
		$data = $this->model_dept->get_dept_info();
		echo json_encode($data);
	}

	public function create_dept(){
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_dept->create_dept($credentials);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */	