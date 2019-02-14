<?php

/*
 *
 * Name 		: Login Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_login Table.
 *
*/

class login_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($user_id, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('login');
		$data = array
		(
			'user_id'		=>	$user_id,
			'time'			=>	now(),
			'description'	=>	$description
		);
		$this->db->insert('login', $data);
		return 1;
	}
}

?>