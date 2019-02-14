<?php

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Model From irex_user Table.
 *
*/

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
			'password'=>do_hash($password, 'md5'),
			'status'=>1,
			'time'=>now()
		);

		$this->db->insert('user', $data);

		$this->db->where('email', $email);
		$result = $this->db->get('user');

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

	public function check_user_for_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', do_hash($password, 'md5'));
		$result = $this->db->get('user');

		if($result->num_rows()>0)
		{
			foreach($result->result() as $row)
			{
				$user_id = $row->id;
				$user_status = $row->status;
			}
			if($user_status==1)
			{
				return $user_id;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
}

?>