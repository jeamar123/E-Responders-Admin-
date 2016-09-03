<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_maps', 'map');
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

	/*********FOR UPDATE!************/
	public function all_department_location()
	{
		$data = $this->map->get_all_department_location();
		echo json_encode($data);		
	}
	public function get_all_department($category="")
	{
		$val = "";
		switch ($category) {
			case 1:
				$val = "Hospital";
				break;
			case 2:
				$val = "Police";
				break;
			case 3:
				$val = "Fire Station";
				break;
			default:
				$val = "";
				break;
		}
		$data = $this->map->get_all_department($val);
		echo json_encode($data);		
	}
	/********************************/

	public function get_all_markers($dept_id)
	{
		$data = $this->map->get_all_markers($dept_id);
		echo json_encode($data);	
	}

	public function show_focused_map_details($dept_id = "")
	{	
		$data = $this->map->focused_map_info($dept_id);
		echo json_encode($data);	
	}

	public function show_focused_map_id()
	{	
		$data = $this->map->show_focused_map_id();
		echo json_encode($data);	
	}	

	public function update_location()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$response = $this->map->update_map($credentials);
		echo json_encode($response);
	}

	public function markerList($dept_id = "")
	{
		$data = $this->map->getAllMarkerList($dept_id);
		echo json_encode($data);
	}

	public function set_branch_marker()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$response = $this->map->set_branch_marker($credentials);
		echo json_encode($response);
	}

	public function set_main_map_view($dept_id = "")
	{
		$data = $this->map->set_main_map_view($dept_id);
		echo json_encode($data);
	}

	public function get_marker_data($marker_id = "")
	{
		$data = $this->map->get_marker_data($marker_id);
		echo json_encode($data);		
	}

	public function delete_map_info()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$response = $this->map->delete_map_info($credentials);
		echo json_encode($response);	
	}

	public function edit_map_info() {
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->map->edit_map_info($credentials);
		echo json_encode($data);
	}

	// Mobile
	public function send_alert_request()
	{
		$data = $this->map->add_alert_request($_POST);
		echo json_encode($data);
	}
	public function send_alert_request_to_all()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->map->add_alert_request_to_all($_POST);
		echo json_encode($data);
	}

	public function get_request_by_id($dept_id)
	{
		$data = $this->map->get_request_alert($dept_id);
		echo json_encode($data);
	}

	// Web
	public function get_current_request()
	{
		$data = $this->map->list_of_alert_request();
		echo json_encode($data);
	}

	public function count_requests()
	{
		$data = $this->map->count_alert_requests();
		echo json_encode($data);		
	}

	// For respond and deny actions
	public function update_alert_action()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->map->update_status_alert_request($credentials);
		echo json_encode($data);
	}
	
	// For showing alert requests by category
	public function display_request_alert_by_category($category="")
	{	
		$value = "";
		switch ($category) {
			case 1:
				$value = "Hospital";
				break;
			case 2:
				$value = "Police";
				break;
			case 3:
				$value = "Fire Station";
				break;
			default:
				$value = "";
				break;
		}
		$data = $this->map->get_request_by_category($value);
		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */	