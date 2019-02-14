<?php

/*
 *
 * Name 		: Activity Model
 * Date 		: 1395/09/01
 * Auther 		: A.shokri
 * Description 	: The Model From irex_activity Table.
 *
*/

class activity_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function read_all_activity()
	{
		$result = $this->db->get('activity');
		$reulst = $result->result_array();

		$activity_list = '';
		foreach ($reulst as $my_result) {
			$activity_list[$my_result['id']] = $my_result['name'];
		}

		return $activity_list;
	}

	public function fetch_activity_name($activity_id)
	{
		$this->db->where('id' ,$activity_id);
		$result = $this->db->get('activity', 1);

		if($result->num_rows() < 1)
		{
			return 'نامشخص';
		}
		else
		{
			$result = $result->result_array();
			$result = $result[0];
			return $result['name'];
		}
	}
}
?>