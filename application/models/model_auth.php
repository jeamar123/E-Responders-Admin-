<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Auth extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function check_account($data)
	{

		$query = $this->db->where('username', $data['username'])
						  ->where('password', $data['password'])
						  ->get('users')
						  ->num_rows();
		if ($query == 1) {
			return 1; // if account really exists
		}else{
			return 0; // if account does not exist
		}
	}
	public function getUserInfo()
	{
		$query = $this->db->select('*')
				->from('user_info t1')
				->join('users t2','t1.user_id = t2.user_id','inner')
				->where('t2.username',$this->session->userdata('username'))
				->where('t2.password',$this->session->userdata('password'))
				->get()->result_object();

		foreach ($query as $key => $value) {
			$this->session->set_userdata('user_id',$value->user_id);
			$this->session->set_userdata('dept_id',$value->dept_id);
		}
		return $query;
	}

}