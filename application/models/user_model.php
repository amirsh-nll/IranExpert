<?php

/*
 *
 * Name 		: User Model
 * Date 		: 1395/08/09
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

	public function check_user_for_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', do_hash($password, 'md5'));
		$result = $this->db->get('user', 1);

		if($result->num_rows()>0)
		{
			foreach($result->result() as $row)
			{
				$user_id 		= $row->id;
				$user_status 	= $row->status;
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

	public function fetch_middle_name($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);

		foreach($result->result() as $row)
		{
			$middle_name = $row->middle_name;
		}
		return $middle_name;
	}

	public function fetch_user_id_with_middle_name($middle_name)
	{
		$this->db->where('middle_name', $middle_name);
		$result = $this->db->get('user', 1);

		if($result->num_rows()!=1)
		{
			return 0;
		}
		else
		{
			foreach($result->result() as $row)
			{
				$id = $row->id;
			}
			return $id;
		}
	}

	public function fetch_email($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);

		foreach($result->result() as $row)
		{
			$email = $row->email;
		}
		return $email;
	}

	public function fetch_user_id_with_email($email)
	{
		$this->db->where('email', $email);
		$result = $this->db->get('user', 1);
		
		if($result->num_rows() < 1)
		{
			return 0;
		}
		
		foreach($result->result() as $row)
		{
			$id = $row->id;
		}
		return $id;
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

	public function check_suspend($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);

		foreach($result->result() as $row)
		{
			$status = $row->status;
		}
		return $status;
	}

	public function suspend_accont($user_id, $password, $reason)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);
		$result = $result->result_array();
		$result = $result[0];

		if($result['password'] == do_hash($password, 'md5'))
		{
			$data = array(
				'status'		=>	0,
				'description'	=>	'Suspend Reason : ' . $reason
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

	public function forget_password($user_id)
	{
		$data = array(
			'password'	=>	do_hash('123456789', 'md5')
		);
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$this->db->update('user');
	}
}

?>