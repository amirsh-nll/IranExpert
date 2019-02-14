<?php

/*
 *
 * Name 		: Broadcast Model
 * Date 		: 1395/09/14
 * Auther 		: A.shokri
 * Description 	: The Model From irex_broadcast Table.
 *
*/

class broadcast_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_broadcast($user_send_count, $type, $title, $message)
	{
		$data = array
		(
			'user_send_count'	=>	$user_send_count,
			'time'				=>	now(),
			'type'				=>	$type,
			'title'				=>	$title,
			'message'			=>	$message
		);

		$this->db->insert('broadcast', $data);
	}

	public function read_broadcast()
	{
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('broadcast');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function read_single_broadcast($broadcast_id)
	{
		$this->db->where('id', $broadcast_id);
		$result = $this->db->get('broadcast', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}
}
?>