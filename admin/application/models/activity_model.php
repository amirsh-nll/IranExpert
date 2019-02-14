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

	public function insert_activity($activity_name)
	{
		$data = array
		(
			'name'	=>	$activity_name
		);

		$this->db->insert('activity', $data);
	}

	public function read_activity_list($page=1)
	{
		if($page!=1)
		{
			$page = $page * 10 - 9;
		}
		$this->db->limit(10, $page);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('activity');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function activity_count()
	{
		$result = $this->db->get('activity');
		return $result->num_rows();
	}

	public function read_all_activity()
	{
		$result = $this->db->get('activity');

		if($result->num_rows() < 1)
		{
			return 0;
		}
		else
		{
			$reulst = $result->result_array();
			$activity_list = '';
			foreach ($reulst as $my_result) {
				$activity_list[$my_result['id']] = $my_result['name'];
			}

			return $activity_list;
		}
	}

	public function read_once_activity($activity_id)
	{
		$this->db->where('id', $activity_id);
		$result = $this->db->get('activity', 1);

		if($result->num_rows() < 1)
		{
			return 0;
		}
		else
		{
			$reulst = $result->result_array();
			$reulst = $reulst[0];
			return $reulst;
		}
	}

	public function update_activity($activity_id, $activity_name)
	{
		$data = array(
			'name'	=>	$activity_name
		);
		$this->db->set($data);
		$this->db->where('id', $activity_id);
		$this->db->update('activity');
	}

	public function delete_activity($activity_id)
	{
		$this->db->where('id', $activity_id);
		$result = $this->db->delete('activity');

		return $result;
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