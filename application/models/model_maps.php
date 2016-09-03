<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Maps extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	/*********FOR UPDATE!************/
	public function get_all_department_location()
	{	
		$dept_cat = $this->db->where('dept_id',$this->session->userdata('dept_id'))
					->get('department')
					->row()
					->category;			
	
		$query = $this->db->select('*')
				 ->from('map_location t1')
				 ->join('department t2','t1.dept_id=t2.dept_id','inner')
				 ->where('t2.category',$dept_cat)
				 ->get()
				 ->result();				
	

		return $query;
	}
	public function get_all_department($category="")
	{
		if ($category) {
			$query = $this->db->select('*')
					 ->from('map_location t1')
					 ->join('department t2','t1.dept_id=t2.dept_id','inner')
					 ->where('t2.category',$category)
					 ->get()
					 ->result();
		}else{
			$query = $this->db->select('*')
					 ->from('map_location t1')
					 ->join('department t2','t1.dept_id=t2.dept_id','inner')
					 ->get()
					 ->result();			
		}
		return $query;
	}
	/********************************/
	public function get_all_markers( $dept_id )
	{
		// Department Branches
		$query = $this->db->select('*')
				 ->from('map_location t1')
				 ->join('department_branches t2','t1.dept_id=t2.branch_id','inner')
				 ->where('t1.main_dept_id',$dept_id)
				 ->get()
				 ->result();
		return $query;
	}

	public function focused_map_info( $dept_id )
	{
		$location_data = array();
		$query = $this->db->select('*')
				->from('department t1')
				->join('map_location t2','t1.dept_id=t2.dept_id','inner')
				->where('t1.dept_id',$dept_id)
				->where('t2.status','focus')
				->get();
		$query2 = $this->db->select('*')
				->from('department_branches t1')
				->join('map_location t2','t1.branch_id=t2.dept_id','inner')
				->where('t1.dept_id',$dept_id)
				->where('t2.status','focus')
				->get();
		if ($query->result() != null) {
			foreach ($query->result() as $key => $value) {
				if ($query->result()) {
					$location_data = array(
						'location_id' =>$value->location_id,
						'dept_id' =>$value->dept_id,
						'map_name' => $value->map_name,
						'map_type' => $value->map_type,
						'map_description' => $value->map_description,
						'lat' => $value->lat,
						'lng' => $value->lng,
						'zoom' => $value->zoom,
						'status' => $value->status,
						'dept_name' => $value->dept_name,
						'dept_desc' => $value->dept_desc,
						'hotline_no' => $value->hotline_no,
						'mobile_no' => $value->mobile_no,
						'address' => $value->address,
						'email' => $value->email,
						'website' => $value->website
					);
					$this->session->set_userdata('current_dept_id',$location_data['location_id']);
					return $location_data;	
				}else{
					return "nothing";
				}
			}				
		}else{
			foreach ($query2->result() as $key => $value) {
				if ($query2->result()) {
					$location_data = array(
						'location_id' =>$value->location_id,
						'dept_id' =>$value->branch_id,
						'map_name' => $value->map_name,
						'map_type' => $value->map_type,
						'map_description' => $value->map_description,
						'lat' => $value->lat,
						'lng' => $value->lng,
						'zoom' => $value->zoom,
						'status' => $value->status,
						'dept_name' => $value->branch_name,
						'dept_desc' => $value->description,
						'hotline_no' => $value->hotline_no,
						'mobile_no' => $value->mobile_no,
						'address' => $value->address,
						'email' => $value->email,
						'website' => 'none'
					);
					$this->session->set_userdata('current_dept_id',$location_data['location_id']);
					return $location_data;	
				}else{
					return "nothing";
				}
			}				
		}
	}

	public function show_focused_map_id()
	{	
		$dept_location_data = array();
		$branch_location_data = array();
		$dept_id = ""; // Either branch or department
		$get_dept_id = $this->db->where('main_dept_id',$this->session->userdata('dept_id'))
				 ->where('status','focus')
				 ->get('map_location')
				 ->result();
		foreach ($get_dept_id as $key => $value) {
			$dept_id = $value->dept_id;
		}
		// Query for department
		$dept_info = $this->db->select('*')
					->from('department t1')
					->join('map_location t2','t1.dept_id = t2.dept_id','inner')
					->where('t1.dept_id' , $dept_id)
					->get()
					->result();

		foreach ($dept_info as $key => $value) {
			$dept_location_data = array(
				'dept_id' => $value->dept_id,
				'dept_name' => $value->dept_name,
				'dept_desc' => $value->dept_desc,
				'category' =>  $value->category,
				'hotline_no' => $value->hotline_no,
				'mobile_no' => $value->mobile_no,
				'address' => $value->address,
				'email' => $value->email,
				'lat' => $value->lat,
				'lng' => $value->lng,
				'website' => $value->website,
				'dept_image' => $value->dept_image,
				'location_id' => $value->location_id,
				'main_dept_id' => $value->main_dept_id,
				'map_name' => $value->map_name,
				'map_type' => $value->map_type,
				'map_description' => $value->map_description,
				'status' => $value->status,
				'zoom' => $value->zoom
			);
		}
		// Query for branch department
		$branch_info = $this->db->select('*')
					->from('department_branches t1')
					->join('map_location t2','t1.branch_id = t2.dept_id','inner')
					->where('t1.branch_id' , $dept_id)
					->get()
					->result();

		foreach ($branch_info as $key => $value) {
			$branch_location_data = array(
				'dept_id' => $value->branch_id,
				'dept_name' => $value->branch_name,
				'dept_desc' => $value->description,
				'marker_status' =>  $value->marker_status,
				'hotline_no' => $value->hotline_no,
				'mobile_no' => $value->mobile_no,
				'address' => $value->address,
				'email' => $value->email,
				'dept_image' => $value->branch_img,
				'location_id' => $value->location_id,
				'lat' => $value->lat,
				'lng' => $value->lng,
				'main_dept_id' => $value->main_dept_id,
				'map_type' => $value->map_type,
				'map_description' => $value->map_description,
				'status' => $value->status,
				'zoom' => $value->zoom
			);
		}

		if ($dept_info) {
			return $dept_location_data;
		}else{
			return $branch_location_data;
		}

	}

	public function update_map( $data )
	{
		$location_data = array();
		$query = $this->db->where( 'main_dept_id' , $this->session->userdata('dept_id') )
				->where( 'status' , 'focus' )
				->get( 'map_location' );
		foreach ($query->result() as $key => $value) {
			$location_data = array(
				'location_id' =>$value->location_id,
				'map_name' => $value->map_name,
				'map_type' => $value->map_type,
				'map_description' => $value->map_description,
				'lat' => $value->lat,
				'lng' => $value->lng
			);
		}
		if ( $query->result() == null ) {
			// if wala pay marker nga na set ani nga department,magcreate daun xa based on data nga gipasa
			$data->status = "focus";
			$data->main_dept_id =  $this->session->userdata('dept_id');
			$data->dept_id =  $this->session->userdata('dept_id');

			if ($this->db->insert('map_location',$data)) {
				return array( 'status' => 'created' , 'message' => 'Map successfully added' );
			}
		}else {
			// if nanay map location nga na save para ani nga department, mag update ra xa
			$this->db->where('location_id', $data->location_id)
					->set('map_name',$data->map_name)
					->set('map_type',$data->map_type)
					->set('lat',$data->lat)
					->set('lng',$data->lng)
					->set('map_description',$data->map_description)	
					->set('zoom',$data->zoom)
					->update('map_location');
			return array( 'status' => 'updated' , 'message' => 'Location successfully updated' );
		}
	}

	public function getAllMarkerList( $dept_id )
	{
		$query = $this->db->select('*')
					->from('map_location t1')
					->join('department_branches t2','t1.dept_id = t2.branch_id','inner')
					->where('t1.main_dept_id',$dept_id)
					->get()
					->result();	
		return $query;

	}

	public function set_branch_marker( $data )
	{
		if ($this->db->insert( 'map_location' , $data ) ) {
			$this->db->where( 'branch_id', $data->dept_id )
					 ->set( 'marker_status' , 'MARKER_SET' )
					 ->update( 'department_branches' );
			return array( 'status' => 'success' , 'msg' => 'Marker successfully created' );
		}else{
			return array( 'status' => 'error' , 'msg' => 'You have an error on adding marker' );
		}
	}

	public function set_main_map_view( $data )
	{
		if ($data) {
			// Para ni sa naka focus nga map ug iyang i not_focused ang status
			$this->db->where( 'main_dept_id' , $this->session->userdata('dept_id') )
					 ->where('status','focus')
					 ->set('status','not_focused')
					 ->update('map_location');	
 			//  Para ni sa map na set as focus/ new focused map
			$this->db->where('dept_id', $data)
					 ->set('status','focus')
					 ->update('map_location');
			return array('status' => 'success' , 'msg' => "Main map set");		
		}
	}

	// gets the data to be edited 
	public function get_marker_data( $data )
	{
		$query = $this->db->where('dept_id' , $data)
				 ->get('map_location');
		foreach ($query->result() as $key => $value) {
			return array(
				'location_id' => $value->location_id,
				'lat' => $value->lat,
				'lng' => $value->lng,
				'dept_id' => $value->dept_id,
				'main_dept_id' => $value->main_dept_id,
				'map_name' => $value->map_name,
				'map_type' => $value->map_type,
				'map_description' => $value->map_description,
				'status' => $value->status,
				'zoom' => $value->zoom
			);
		}
	}

	public function delete_map_info( $data ) {

		$query = $this->db->where('branch_id', $data->dept_id)
						  ->set('marker_status','NO_MARKER');
		if ($query->update('department_branches')) {
			$this->db->where('location_id' , $data->location_id )->delete('map_location');
			return array( 'status' => 'success' , 'msg' => 'Map info removed' );
		}else{
			return array( 'status' => 'success' , 'msg' => 'Main map removed' );
		}

	}

	public function edit_map_info ($data) {
		if ($data) {
			$this->db->where('dept_id',$data->dept_id)->update('map_location',$data);
			return array( 'status' => 'success' , 'msg' => 'Map info successfully updated' );
		}else{
			return array( 'status' => 'error' , 'msg' => 'Error on updating' );
		}
	}
	// Mobile Alert
	public function add_alert_request($data) {
		if ($this->db->insert('alert_info',$data)){
			return array('status' => 'success');
		}else 
			return array('status' => 'error');
	}
	// Multiple Mobile Alert
	public function add_alert_request_to_all($data) {
		$x = [];
		for ($i=0; $i < count($data['data_objects']); $i++) { 
			$x[] = $data['data_objects'][$i];			
		}
		if ($this->db->insert_batch('alert_info', $x)) {
			return $x; 
		}else{
			false;
		}
	}
	// Display lists of alerts
	public function list_of_alert_request() {
		$query = $this->db->select('*')
						->from('alert_info t1')
						->join('department t2','t1.dept_id=t2.dept_id','inner')
						->where('t1.dept_id',$this->session->userdata('dept_id'))
						->order_by('t1.date','desc')
						->get()
						->result();					
		if ($query) {
			return $query;
		}else{
			return array('status' => 'error','msg' => 'Error on data insertion' );
		}
	}
	// Display lists of alerts
	public function get_request_by_category($category="") {

		if ($category) {
			$query = $this->db->select('*')
							->from('alert_info t1')
							->join('department t2','t1.dept_id=t2.dept_id','inner')	
							->order_by('t1.date','desc')
							->where('t2.category',$category)
							->get()
							->result();			
		}else{
			$query = $this->db->select('*')
							->from('alert_info t1')
							->join('department t2','t1.dept_id=t2.dept_id','inner')
							->order_by('t1.date','desc')
							->get()
							->result();			
		}
		return $query;
	}

	// Display lists of alerts by department for mobile responders
	public function get_request_alert($dept_id) {
		if ($dept_id) {
			return $this->db->where('dept_id',$dept_id)
				->get('alert_info')
				->result();			
		}
	}
 	
 	public function count_alert_requests(){
 		$user_type = $this->db->where('user_id',$this->session->userdata('user_id'))->get('users')->row()->user_type;
 		if ($user_type == 'Superadmin') {
			$responded = $this->db->where('status','responded')->count_all_results('alert_info');
			$denied = $this->db->where('status','denied')->count_all_results('alert_info');
			$waiting = $this->db->where('status','request_for_respond')->count_all_results('alert_info');
 		}else{
			$responded = $this->db->where('dept_id',$this->session->userdata('dept_id'))
				->where('status','responded')
				->count_all_results('alert_info');
			$denied = $this->db->where('dept_id',$this->session->userdata('dept_id'))
				->where('status','denied')
				->count_all_results('alert_info');
			$waiting = $this->db->where('dept_id',$this->session->userdata('dept_id'))
				->where('status','request_for_respond')
				->count_all_results('alert_info');
 		}
		return array('responded' => $responded, 'denied' => $denied, 'request_for_respond' => $waiting );
 		
 	}
	// Update sa alert actions
	public function update_status_alert_request($data){

	    date_default_timezone_set('Asia/Manila');
	    $date_alerted = date('Y-m-d G:i:s', time()); 
	    
		switch ($data->action) {
			case 'respond':
				$new_data = array('status' => 'responded', 'date_responded' =>  $date_alerted );
				break;
			case 'deny':
				$new_data = array('status' => 'denied', 'date_responded' =>  $date_alerted );
				break;	
			case 'delete':
				$this->db->where('alert_id',$data->alert_id)->delete('alert_info');
				return array(
						'status' => 'success', 
						'action' => 'delete',
						'msg' => 'Request was deleted',
						'alert_id' => $data->alert_id
						);
				break;		
		}
		// Get responder's department name
		$dept_name = $this->db->where('dept_id',$this->session->userdata('dept_id'))->get('department')->row()->dept_name;
		
		if ($this->db->where('alert_id',$data->alert_id)->update('alert_info',$new_data)) {
			return array(
					'status' => 'success', 
					'alert_status' => $new_data['status'],
					'msg' => 'Your request was '.$new_data['status'].' by '.$dept_name
					);
		}

	}


}