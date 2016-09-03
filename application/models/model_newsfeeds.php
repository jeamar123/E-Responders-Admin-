<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Newsfeeds extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create_post ($data)
	{
		if ($data['post_content'] != null || $data['post_file'] != null ) {
			if ($this->db->insert('post',$data)) {
				return array( 'status' => 'success' , 'msg' => "Posted successfully" );	
			}else{
				return array( 'status' => 'error' , 'msg' => "Error on posting" );	
			}
		}else {
			return array ('status' => 'empty' , 'msg' => 'Empty set' );
		}
		
	}

	public function get_posts( $category = "" ) 
	{	
		
		if ($category) {
			$query = $this->db->select('*')
					->from('post t1')
					->join('department_branches t2','t1.dept_id = t2.branch_id','inner')
					->where('t2.category',$category)
					->order_by('t1.post_date','desc')
					->get()
					->result();
		}else {
			$query = $this->db->select('*')
					->from('post t1')
					->join('department_branches t2','t1.dept_id = t2.branch_id','inner')
					->order_by('t1.post_date','desc')
					->get()
					->result();
		}
		return $query;
	}

	public function delete_post( $post_id )
	{
		if ($post_id) {
			$this->db->where('post_id',$post_id)->delete('post');
			return array('status' => 'success', 'msg' => 'Post successfully deleted' );
		}
	}
	public function edit_post( $data )
	{
		if ($data) {
			$this->db->where('post_id',$data->post_id)->update('post',$data);
			return array('status' => 'success', 'msg' => 'Post successfully updated' );
		}
	}

}