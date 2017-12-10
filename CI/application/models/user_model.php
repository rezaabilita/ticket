<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * create_user function.
	 */
	public function create_user($first_name, $last_name, $email, $password, $role)
	{
		$data = array(
			'user_fname'    => $first_name,
			'user_lname'    => $last_name,
			'user_email'    => $email,
			'user_password' => $password,
			'user_rank'     => $role
		);
		
		return $this->db->insert('users', $data);
	}
	
	/**
	 * create_sample function.
	 */
	public function create_sample($first_name, $last_name)
	{
		$data = array(
			'name'   => $first_name,
			'family' => $last_name
		);
		
		return $this->db->insert('sample_for_git_assignment', $data);
	}

	/**
	 * get_samples function.
	 */
	public function get_samples()
	{
		$this->db->select('*')
				 ->from('sample_for_git_assignment');
		
		return $this->db->get()->result_array();
	}

	/**
	 * user_login function.
	 */
	public function user_login($email, $password)
	{
		$this->db->select('*')
				 ->from('users')
				 ->where('user_email', $email)
				 ->where('user_password', $password);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	/**
	 * get_user_id_by_email function.
	 */
	public function get_user_id_by_email($email)
	{
		$this->db->select('id')
				 ->from('users')
				 ->where('user_email', $email);
		
		return $this->db->get()->row('id');
	}
	
	/**
	 * get_user function.
	 */
	public function get_user($user_id)
	{
		$this->db->from('users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
	}
}