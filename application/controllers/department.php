<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		if (isset($_SERVER['HTTP_ORIGIN'])) {
	        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	        header('Access-Control-Allow-Credentials: true');
	        header('Access-Control-Max-Age: 86400');    // cache for 1 day
	    }

	    // Access-Control headers are received during OPTIONS requests
	    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	        exit(0);
	    }
	}
	// list with same category
	public function get_dept_list()
	{
		$data = $this->model_dept->get_dept_list();
		echo json_encode($data);
	}
	// Redirect Request
	public function redirect_request()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_dept->redirect_mobile_request($credentials);
		echo json_encode($data);		
	}
	// Get Department Latitude and Longitude
	public function getLatLng()
	{
		$data = $this->model_dept->getLatLng();
		echo json_encode($data);			
	}
	// Get notification
	public function getNotification()
	{
		$data = $this->model_dept->getNotification();
		echo json_encode($data);			
	}
	public function get_dept_info()
	{
		$data = $this->model_dept->get_dept_info();
		echo json_encode($data);
	}
	public function create_dept()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_dept->create_dept($credentials);
		echo json_encode($data);
	}

	public function get_branch_info($branch_id)
	{
		$data = $this->model_dept->get_branch_info($branch_id);
		echo json_encode($data);
	}

	public function create_branch()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_dept->create_new_branch($credentials);
		echo json_encode($data);
	}

	public function edit_branch()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_dept->update_branch($credentials);
		echo json_encode($data);		
	}

	public function delete_branch($branch_id)
	{	
		$data = $this->model_dept->delete_branch($branch_id);
		echo json_encode($data);
	}

	public function branch_list()
	{
		$data = $this->model_dept->show_branches();
		echo json_encode($data);
	}

	public function no_marker_added_branches () 
	{
		$data = $this->model_dept->no_marker_added_branches();
		echo json_encode($data);
	}
	public function do_upload()
	{
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5012';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			echo json_encode('error daw');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			foreach ($data as $key => $value) {
				$filename = $value['file_name'];
			}
			$arr = array(
					'dept_id' => $this->session->userdata('dept_id'),
					'filename' => $filename
			);
			$response = $this->model_dept->update_dept_img($arr);
			echo json_encode($response);
		}

	}
// Mobile user request
	public function display_all_department()
	{
		// $this->benchmark->mark('code_start');
		$data = $this->model_dept->display_all_department_info();
		echo json_encode($data);
		// $this->benchmark->mark('code_end');
		// echo json_encode($this->benchmark->elapsed_time('code_start', 'code_end'));
	}
	public function display_request_department($data)
	{			
		$data = $this->model_dept->request_department_location($data);
		echo json_encode($data);
	}
}

/* End of file department.php */
/* Location: ./application/controllers/department.php */	