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

 	public function display_all_users()
 	{
 		$response = $this->model_users->get_all_users(); 
 		echo json_encode($response);
 	}

 	public function update_user_account()
 	{
 		$credentials = json_decode(file_get_contents('php://input'));
 		$response = $this->model_users->update_account_settings($credentials); 
 		echo json_encode($response);		
 	}

 	public function edit_info()
 	{
 		$credentials = json_decode(file_get_contents('php://input'));
 		$user_info = array(
 			'user_id' => $credentials[0]->user_id,
 			'fname' => $credentials[0]->fname,
 			'mname' => $credentials[0]->mname,
 			'lname' => $credentials[0]->lname,
 			'bday' => $credentials[0]->bday,
 			// 'age' => date_diff(date_create($credentials[0]->bday), date_create('today'))->y,
 			'gender' => $credentials[0]->gender,
 			'barangay' => $credentials[0]->barangay,
 			'city' => $credentials[0]->city,
 			'province' => $credentials[0]->province,
 			'postal_code' => $credentials[0]->postal_code,
 			'contact_no' => $credentials[0]->contact_no,
 			'position' => $credentials[0]->position
 		);
 		$response = $this->model_users->edit_user_info($user_info); 
 		echo json_encode($response); 		
 	}

 	public function delete_user()
 	{
 		$credentials = json_decode(file_get_contents('php://input'));
 		$response = $this->model_users->delete_user($credentials); 
 		echo json_encode($response);
 	}

	public function do_upload()
	{
		$config['upload_path'] = 'assets/img/profile_pics/';
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
			$response = $this->model_users->update_profile_img($filename);
			echo json_encode($response);
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
