<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_maps', 'map');
	}

	public function show_map_details()
	{
		
	}

	public function update_location()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$response = $this->map->update_map($credentials);
		echo json_encode($credentials);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */	