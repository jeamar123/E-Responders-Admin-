<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Dept extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_dept_info()
	{
		return $this->db->select('*')
			 ->from('department t1')
			 ->join('user_info t2','t1.dept_id = t2.dept_id','left')
			 ->join('users t3','t2.user_id = t3.user_id', 'left')
			 ->where('t2.user_id',$this->session->userdata('user_id'))
			 ->get()
			 ->result();
	}

	public function create_dept($data)
	{
		$dept_id="";$new_dept_id;
		$query = $this->db->select('t2.dept_id')
				 ->from('department t1')
				 ->join('user_info t2','t1.dept_id = t2.dept_id','left')
				 ->join('users t3','t2.user_id = t3.user_id', 'left')
				 ->where('t2.user_id',$this->session->userdata('user_id'))
				 ->get();
		foreach ($query->result() as $key => $value) {
			$dept_id = $value->dept_id;
		}

		$count = $this->db->select('dept_id')
				 ->from('department')
				 ->limit(1)
				 ->order_by('dept_id','desc')
				 ->get();
		foreach ($count->result() as $key => $value) {
			$new_dept_id = $value->dept_id+1;
		}

		if ($dept_id == null) {
			$data->dept_id = $new_dept_id;
			// Mag create xa if wala pay department info
			if ($this->db->insert('department',$data)) {
				$this->db->where('user_id',$this->session->userdata('user_id'))
					 ->set('dept_id',$new_dept_id)
					 ->update('user_info');
				return array( "result" => true, "action" => "create", "prompt" => "Successfully saved" , "status" => "create" );
			}
			// Update daun niya ang dept_id sa user_info

		}elseif($dept_id >= 1){
			// Mag update xa if naa nay information 
			$this->db->where('dept_id', $data->dept_id )->update('department',$data);
			return array( "result" => true, "action" => "update", "prompt" => "Successfully updated" , "status" => "update" );	
		}
	}
}