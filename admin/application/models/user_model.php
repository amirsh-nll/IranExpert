<?php

/*
 *
 * Name 		: User Model
 * Date 		: 1395/08/27
 * Auther 		: A.shokri
 * Description 	: The Model From irex_user Table.
 *
*/

class user_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_user_for_login($email, $password)
	{
		$this->db->where('type', 1);
		$this->db->where('email', $email);
		$this->db->where('password', do_hash($password, 'md5'));
		$result = $this->db->get('user', 1);

		if($result->num_rows()>0)
		{
			foreach($result->result() as $row)
			{
				$user_id = $row->id;
			}
			
			return $user_id;
		}
		else
		{
			return 0;
		}
	}

	public function new_user($email, $password, $middle_name)
	{
		$data = array
		(
			'type'			=>	0,
			'email'			=>	$email,
			'password'		=>	do_hash($password, 'md5'),
			'middle_name'	=>	$middle_name,
			'status'		=>	1,
			'time'			=>	now(),
			'description'	=>	''
		);

		$this->db->insert('user', $data);

		$this->db->where('email', $email);
		$result = $this->db->get('user', 1);

		if($result->num_rows()>0)
		{
			foreach($result->result() as $row)
			{
				$user_id = $row->id;
			}
			return $user_id;
		}
		else
		{
			return 0;
		}
	}

	public function read_user_list()
	{
		$result = $this->db->get('user');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function change_password($user_id, $old, $new)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);
		$result = $result->result_array();
		$result = $result[0];

		if($result['password'] == do_hash($old, 'md5'))
		{
			$data = array(
				'password'	=>	do_hash($new, 'md5')
			);
			$this->db->set($data);
			$this->db->where('id', $user_id);
			$this->db->update('user');
			
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

?>