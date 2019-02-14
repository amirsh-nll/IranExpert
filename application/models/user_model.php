<?php

class user_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function new_user($email, $password)
	{
		$data = array
		(
			'email'=>$email,
			'password'=>$password,
			'status'=>1,
			'time'=>now()
		);

		$this->db->insert('user', $data);

		$reulst = $this->db->get_where('user', array('email'=>$email));
		$user_id = $query->result->id();
		
		return $user_id();
	}
}

?>