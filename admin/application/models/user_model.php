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

	public function read_user($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function read_user_list($page=1)
	{
		if($page!=1)
		{
			$page = $page * 10 - 9;
		}
		$this->db->limit(10, $page);
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

	public function user_count()
	{
		$result = $this->db->get('user');
		return $result->num_rows();
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

	public function fetch_middle_name_with_user_id($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('user', 1);

		if($result->num_rows()!=1)
		{
			return 0;
		}
		else
		{
			foreach($result->result() as $row)
			{
				$middle_name = $row->middle_name;
			}
			return $middle_name;
		}
	}

	public function change_middle_name($user_id, $middle_name)
	{
		$data = array(
			'middle_name'	=>	$middle_name
		);
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$this->db->update('user');
	}

	public function suspend_user($user_id)
	{
		$data = array(
			'status'		=>	0,
			'description'	=>	'Suspend Reason : Admin is Suspend'
		);
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$this->db->update('user');
	}

	public function unsuspend_user($user_id)
	{
		$data = array(
			'status'		=>	1,
			'description'	=>	''
		);
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$this->db->update('user');
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