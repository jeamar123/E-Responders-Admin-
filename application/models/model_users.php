<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Users extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create_user($data)
	{	
			$id = "";
			$user_id = $this->db->select('*')
							->from('user_info t1')
							->join('users t2','t1.user_id=t2.user_id','inner')
							->limit(1)
							->order_by('t1.user_id', 'desc')
							->get();
			$check_account = $this->db->where('username',$data->username)
									  ->get('users')
									  ->num_rows();
			foreach ($user_id->result() as $key => $value) {
				 $id = $value->user_id + 1;
			}
			$user_info = array(
				'user_id' => $id,
				'fname'	  => $data->fname,
				'mname'   => $data->mname,
				'lname'   => $data->lname,	
				'dept_id' => $data->dept_id,
				'gender'  => $data->gender
			);
			
			$user_account = array(
				'user_id'	=> $id,
				'username'  => $data->username,
				'password'  => md5($data->password),
				'user_type' => $data->user_type
			);
			if ($check_account < 1) {
				if($this->db->insert('user_info',$user_info)){
					$this->db->insert('users',$user_account);
					return 1;
				}				
			}else{
				return 0; // Account already exist
			}
	}

}