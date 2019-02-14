<?php

/*
 *
 * Name 		: Reminder Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_reminder Table.
 *
*/

class reminder_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_reminder($user_id, $reminder_title, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('reminder');

		if($result->num_rows()<20)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$reminder_title,
				'description'	=>	$description
			);

			$this->db->insert('reminder', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function read_reminder($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('reminder', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_reminder($user_id, $reminder_id, $reminder_title, $description)
	{
		$data = array(
			'title'			=>	$reminder_title,
			'description'	=>	$description
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $reminder_id);
		$this->db->update('reminder');
	}

	public function delete_reminder($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('reminder');

		return $result;
	}

	public function fetch_record_with_id($user_id, $reminder_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $reminder_id);
		$result = $this->db->get('reminder', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function reminder_count($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('reminder');

		return $result->num_rows();
	}
}

?>