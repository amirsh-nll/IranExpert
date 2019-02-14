<?php

/*
 *
 * Name 		: Message Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_messages Table.
 *
*/

class message_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_message($user_id, $full_name, $title, $email, $message, $description)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'time'			=>	now(),
			'status'		=>	1,
			'report'		=>	0,
			'full_name'		=>	$full_name,
			'title'			=>	$title,
			'email'			=>	$email,
			'message'		=>	$message,
			'description'	=>	$description
		);

		$this->db->insert('message', $data);
		return 1;
	}

	public function read_message($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('message', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function message_unread($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
		$result = $this->db->get('message');

		return $result->num_rows();
	}

	public function mark_read($user_id, $message_id)
	{
		$data = array(
			'status'		=>	0
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $message_id);
		$this->db->update('message');
	}

	public function fetch_record_with_id($user_id, $message_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $message_id);
		$result = $this->db->get('message', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function ownership_message($user_id, $message_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $message_id);
		$result = $this->db->get('message');

		if($result->num_rows()!=0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function report_message($user_id, $message_id)
	{
		$data = array(
			'report'	=>	1
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $message_id);
		$this->db->update('message');
	}
}
?>