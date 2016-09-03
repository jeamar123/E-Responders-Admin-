<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsfeeds extends CI_Controller {

	public function do_upload()
	{
		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|zip|pdf|rar|tar.gz|doc|docx|xls|xlsx|ppt|pptx|mp3|mp4|3gp';
		$config['max_size']	= '2048';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ($_POST) {
			// echo json_encode($_POST['post_content']);

			if (  $this->upload->do_upload())
			{
				$filename = "";
				$data = array('upload_data' => $this->upload->data());
				foreach ($data as $key => $value) {
					$filename = $value['file_name'];
				}			
				$data_file = array(
					'post_content' => $_POST['post_content'],
					'post_file' => $filename,
					'dept_id' => $this->session->userdata('dept_id'),
					'user_id' => $this->session->userdata('user_id')
				);
			}else{			
				$data_file = array(
					'post_content' => $_POST['post_content'],
					'dept_id' => $this->session->userdata('dept_id'),
					'user_id' => $this->session->userdata('user_id')
				);				
			}
			$response = $this->model_newsfeeds->create_post($data_file);
			echo json_encode($response);						
		}

	}

	public function show_posts ($category = "") 
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
		}
		$data = $this->model_newsfeeds->get_posts($value);
		echo json_encode($data);
	}

	public function delete_post()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_newsfeeds->delete_post($credentials);
		echo json_encode($data);
	}

	public function edit_post()
	{
		$credentials = json_decode(file_get_contents('php://input'));
		$data = $this->model_newsfeeds->edit_post($credentials);
		echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */