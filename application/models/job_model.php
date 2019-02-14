<?php

/*
 *
 * Name 		: Job Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_job Table.
 *
*/

class job_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_job($user_id, $job_title, $start_date, $end_date, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('job');

		if($result->num_rows()<5)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$job_title,
				'start'			=>	$start_date,
				'end'			=>	$end_date,
				'description'	=>	$description
			);

			$this->db->insert('job', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function load_job($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('job', 5);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function delete_job($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('job');

		return $result;
	}
}

?>