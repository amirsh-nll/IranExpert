<?php

/*
 *
 * Name 		: Achievement Model
 * Date 		: 1395/08/17
 * Auther 		: A.shokri
 * Description 	: The Model From irex_achievement Table.
 *
*/

class achievement_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_achievement($user_id, $achievement_title, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('achievement');

		if($result->num_rows()<5)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$achievement_title,
				'description'	=>	$description
			);

			$this->db->insert('achievement', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function read_achievement($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('achievement', 5);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function delete_achievement($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('achievement');

		return $result;
	}
}

?>