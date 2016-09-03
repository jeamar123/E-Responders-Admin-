<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function do_upload()
	{
		$config = array ( 'upload_path' => base_url('uploads') ,
					'allowed_types'	=> 'gif|jpg|png' ,
					'max_width'	=>	'1024' ,
					'max_height' => '768'
		);
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			var_dump($data);
		}
	}
}