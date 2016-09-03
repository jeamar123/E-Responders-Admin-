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

	public function get_dept_list()
	{
		$category = $this->db->where('dept_id',$this->session->userdata('dept_id'))
			 ->get('department')
			 ->row()
			 ->category;
		return $this->db->select('*')
			 ->from('department t1')
			 ->join('map_location t2','t1.dept_id=t2.dept_id','inner')
			 ->where('t1.dept_id != "'.$this->session->userdata('dept_id').'"')
			 ->where('t1.category',$category)
			 ->get()
			 ->result();
	}

	public function redirect_mobile_request($data)
	{
		$dept_datas = [];
		$mobile_id;$lat;$lng;$msg;$status;$date;$dept_name;$deptID;
		/***Get alert_info data using $data->alert_id'***/
		$alert_info = $this->db->where('alert_id',$data->alert_id)
			 ->get('alert_info')
			 ->result();
		foreach ($alert_info as $key => $value) {
			$mobile_id = $value->mobile_id;
			$lat = $value->lat;
			$lng = $value->lng;
			$msg = $value->msg;
			$status = $value->status;
			$date = $value->date;
			$deptID = $value->dept_id;
		}
		/***Get name of the department who redirected the request***/
		$dept_name = $this->db->where('dept_id',$deptID)
			 ->get('department')
			 ->row()
			 ->dept_name;		
		/***Insert redirected request to the following responder departments***/
		for ($i=0; $i < count($data->data_list); $i++) { 
			$dept_datas[]['dept_id'] = $data->data_list[$i];
			$dept_datas[$i]['mobile_id'] = $mobile_id;
			$dept_datas[$i]['lat'] = $lat;
			$dept_datas[$i]['lng'] = $lng;
			$dept_datas[$i]['msg'] = $msg;
			$dept_datas[$i]['status'] = $status;
			$dept_datas[$i]['date'] = $date;
			$dept_datas[$i]['redirected_by'] = $dept_name;
			$dept_datas[$i]['alert_type'] = 'redirected';

		}
		if ($this->db->insert_batch('alert_info', $dept_datas)) {
			$this->db->where('alert_id',$data->alert_id)
				->set('status','redirected')
				->update('alert_info');			
			return array('status'=>'success','msg'=>'Request successfully redirected.');
		}
		/********************************************************/
	}
	public function getLatLng()
	{
		return $this->db->where('dept_id',$this->session->userdata('dept_id'))
			->get('map_location')
			->result();
	}
	public function getNotification()
	{
		return $this->db->select('*')
			->from('alert_info t1')
			->join('department t2','t1.dept_id=t2.dept_id','inner')
			->where('t2.dept_id',$this->session->userdata('dept_id'))
			->where('t1.alert_type','redirected')
			->where('status','request_for_respond')
			->get()
			->result();
	}
	public function update_dept_img($data)
	{
		$this->db->where('dept_id',$data['dept_id'])
			->set('dept_image',$data['filename'])
			->update('department');
		$this->db->where('branch_id',$data['dept_id'])
			->set('branch_img',$data['filename'])
			->update('department_branches');
		return array('result' => true , 'status' => 'success', 'msg' => 'Department image updated');	
	}

	public function create_dept($data)
	{
		$branch_info = array(
			'branch_name' => $data->dept_name ,
			'description' => $data->dept_desc ,
			'email'		  => $data->email
		);
		if ($this->db->where('dept_id',$data->dept_id)->update('department',$data)) {
			$this->db->where('branch_id',$data->dept_id)->update('department_branches',$branch_info);
			return array('status' => 'success', 'msg' => 'Successfully saved');
		}
	}

	public function get_branch_info($branch_id)
	{
		return $this->db->where('branch_id',$branch_id)
					->get('department_branches')
					->result();
	}

	public function create_new_branch ($data)
	{
		$new_id = $this->db->count_all_results('department_branches');
		$new_id += 1;
		$branch_id_char = "BRC-".$new_id;
		$data->marker_status = "NO_MARKER";
		$data->branch_id = $branch_id_char;
		$query = $this->db->where('branch_id',$data->branch_id)
						->get('department_branches')
						->num_rows();
		if ($query == 1) {
			$new_id += 2;
			$branch_id_char = "BRC-".$new_id;
			$data->branch_id = $branch_id_char;
			if ($this->db->insert('department_branches',$data)) {
				return array ( 'status' => 'created' , 'msg' => 'Branch successfully created' );
			}else{
				return array ( 'status' => 'error' , 'msg' => 'Error in adding data' );
			}
		}else{
			if ($this->db->insert('department_branches',$data)) {
				return array ( 'status' => 'created' , 'msg' => 'Branch successfully created' );
			}else{
				return array ( 'status' => 'error' , 'msg' => 'Error in adding data' );
			}			
		}
		return $query;
	}

	public function update_branch($data)
	{
		if ($this->db->where('branch_id',$data->branch_id)->update('department_branches',$data)) {
			return array ( 'status' => 'updated' , 'msg' => 'Branch successfully updated' );
		}else{
			return array ( 'status' => 'error' , 'msg' => 'Error on update' );
		}
	}
	public function show_branches()
	{
		$dept_id;
		$data = $this->get_dept_info();
		foreach ($data as $key => $value) { $dept_id = $value->dept_id;	}
		return $this->db->where('dept_id', $dept_id)->order_by('dept_id','desc')->get('department_branches')->result();

	}
	public function delete_branch($data)
	{
		if ($this->db->where('branch_id',$data)->delete('department_branches')) {
			$this->db->where('dept_id',$data)->delete('map_location');
			return array ( 'status' => 'removed' , 'msg' => 'Branch successfully removed' );
		}else{
			return array ( 'status' => 'error' , 'msg' => 'Error on delete' );
		}
	}

	// SHOW BRANCHES FOR CURRENT DEPARTMENTS WITH NO LOCATION SETUP
	public function no_marker_added_branches () 
	{	
		return $this->db->where('dept_id',$this->session->userdata('dept_id'))
				->where('marker_status','NO_MARKER')
				->get('department_branches')
				->result();
	}

	// Mobile request
	public function display_all_department_info()
	{
		return $this->db->select('*')
				->from('department_branches t1')
				->join('map_location t2','t1.dept_id = t2.dept_id','inner')
				->get()
				->result();
	}
	public function request_department_location($data)
	{	
		// 1 = 'Hospital'
		// 2 = 'Police'
		// 3 = 'Fire Station'
		$category = "";
		
		switch ($data) {
			case 1:
				$category = "Hospital";
				break;
			case 2:
				$category = "Police";
				break;
			case 3:
				$category = "Fire Station";
				break;
		}
		return $this->db->select('*')
				->from('department_branches t1')
				->join('map_location t2','t1.branch_id = t2.dept_id','inner')
				->where('t1.category',$category)
				->get()
				->result();
		// return $category;
	}

}