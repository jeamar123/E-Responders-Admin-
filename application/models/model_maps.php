<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Maps extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function map_info()
	{
		
	}

	public function update_map($data)
	{
		if ($this->db->insert('map_location',$data)) {
			return true;
		}
	}
}