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

		if($result->num_rows()<20)
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

	public function read_job($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('job', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_job($user_id, $job_id, $job_title, $start_date, $end_date, $description)
	{
		$data = array(
			'title'			=>	$job_title,
			'start'			=>	$start_date,
			'end'			=>	$end_date,
			'description'	=>	$description
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $job_id);
		$this->db->update('job');
	}

	public function delete_job($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('job');

		return $result;
	}

	public function fetch_record_with_id($user_id, $job_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $job_id);
		$result = $this->db->get('job', 1);

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