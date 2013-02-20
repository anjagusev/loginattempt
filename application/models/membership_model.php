<?php 
class Membership_model extends CI_Model {
	
	function validate(){
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		
		if($query->num_rows == 1) {
			
			return true;
		}
	}
	
	function create_member() {
		//getting the username from the post array storing it in username and getting the data ready to insert
		$username = $this->input->post('username');
		
		$new_member_insert_data = array (
		
		'first_name' => $this->input->post('first_name'),
		'last_name' => $this->input->post('last_name'),
		'email' => $this->input->post('email'),
		'username' => $this->input->post('username'),
		//we run the md5 function so we can store 32 bit hash in our database
		'password' => md5($this->input->post('password'))
		);
		//doing our insert
		$insert = $this->db->insert('users', $new_member_insert_data);
		return $insert;
		
	}
	
	function check_if_username_exists($username) {
	$this->db->where('username', $username);
	$result = $this->db->get('users');
	
	if($result->num_rows() > 0 ){
		
		return FALSE; //username tkane
		}
		else
		{
		return TRUE; //username cna be reg'd
		
		}
		
	}
	
	function check_if_email_exists($email) {
		$this->db->where('email', $email);
		$result = $this->db->get('users');
		
		if($result->num_rows() > 0 ){
		
		return FALSE; //username tkane
		}
		else
		{
		return TRUE; //username cna be reg'd
		
		}
		
	}
}