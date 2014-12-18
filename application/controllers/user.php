<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('model_auth', 'mod_auth');
 	}

 	public function getUserInfo()
 	{
 		$data = $this->mod_auth->getUserInfo();
 		echo json_encode($data);
 	}

 	public function addNewUser()
 	{
 		$credentials = json_decode(file_get_contents('php://input'));
 		$response = $this->model_users->create_user($credentials); 
 		echo json_encode($response);
 	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */