<?php

/*
 *
 * Name 		: Job Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_lesson Table.
 *
*/

class lesson_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_lesson($user_id, $lesson_title, $start_date, $end_date, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('lesson');

		if($result->num_rows()<5)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$lesson_title,
				'start'			=>	$start_date,
				'end'			=>	$end_date,
				'description'	=>	$description
			);

			$this->db->insert('lesson', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function load_lesson($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('lesson', 5);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function delete_lesson($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('lesson');

		return $result;
	}
	
}

?>