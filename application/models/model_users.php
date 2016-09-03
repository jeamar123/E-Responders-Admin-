<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Users extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create_user($data)
	{	
			$id = "";$user_type="";$dept_id = "";
			// Check username if exists
			$check_username = $this->db->where('username',$data->username)
									  ->get('users')->num_rows();			
			if ($check_username > 0 ) {
				return array('status' => 'error', 'msg' => 'Username already exists');
			}
			// Get the max user_id
			$max_user_id = $this->db->select_max('user_id')->get('user_info')->result_object();
			foreach ($max_user_id as $key => $value) {
				$id = $value->user_id + 1;
			}
			// Get the max dept_id
			$max_dept_id = $this->db->select_max('dept_id')->get('department')->result_object();
			foreach ($max_dept_id as $key => $value) {
				$dept_id = $value->dept_id + 1;
			}			

			// Data inserted in table user
			$user_account = array(
				'user_type'=> 'Administrator',
				'user_id'  => $id,
				'username' => $data->username,
				'password' => md5($data->password) 
			);
			// Data inserted in table user_info
			$user_info_dafault = array(
				'user_id' => $id,
				'fname'	  => 'Admin',
				'dept_id' => $dept_id
			);
			// Data inserted in table department
			$department = array(
				'dept_id' => $dept_id,
				'category'=> $data->category
			);
			// Data inserted in table department_branches
			$department_branches = array(
				'dept_id' 	=> $dept_id,
				'branch_id' => $dept_id,
				'category'=> $data->category
			);

			if ($this->db->insert('users',$user_account)) {
				$this->db->insert('user_info', $user_info_dafault);
				$this->db->insert('department', $department);
				$this->db->insert('department_branches', $department_branches);
				return array('status' => 'success', 'msg' => 'New user successfully added');
			}else{
				return array('status' => 'error', 'msg' => 'Error on insert');
			}

	}

	public function update_account_settings($data)
	{	
		if ($data) {
			$arr = array('password' => md5($data->new_pass));
			$this->db->where('user_id',$this->session->userdata('user_id'))->update('users',$arr);
			return array('status' => 'success', 'msg' => 'Successfully updated' );
		}else{
			return 'empty';
		}
	}

	public function get_all_users()
	{
		return $this->db->select('*')
						->from('user_info t1')
						->join('users t2','t1.user_id=t2.user_id','inner')
						->join('department t3','t1.dept_id=t3.dept_id','inner')
						->where('t2.user_type','Administrator')
						->get()
						->result_object();
	}

	public function edit_user_info($data)
	{
		if ($this->db->where('user_id',$data['user_id'])->update('user_info',$data)) 
			return array('status' => 'success', 'msg' => 'Profile info successfully updated');
		else 
			return array('status' => 'error', 'msg' => 'Error on update');
	}

	public function delete_user($data)
	{
		// delete tbl users,user_info, department, department_branches, map_location
		$dept_id = $this->db->where('user_id',$data)->get('user_info')->row()->dept_id;
		
		if ($this->db->where('user_id',$data)->delete('users')) {
			if ($this->db->where('user_id',$data)->delete('user_info')) {}
			if ($this->db->where('dept_id',$dept_id)->delete('department')) {}
			if ($this->db->where('dept_id',$dept_id)->delete('department_branches')) {}
			if ($this->db->where('dept_id',$dept_id)->delete('map_location')) {}
			$response =  array('status' => 'success' , 'msg' => 'Successfully removed' );
		}
		else
			 $response = array('status' => 'error' , 'msg' => 'error on delete' );

		return $response;		
	}

	public function update_profile_img($data)
	{
		if ($data) {
			$this->db->where('user_id',$this->session->userdata('user_id'))->update('user_info',array('profile_pic' => $data));
			return array('status'=>'success', 'msg'=>'Successfully updated');			
		}else{
			return array('status'=>'error', 'msg'=>'error daw');
		}
		
	}



}