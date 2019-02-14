<?php

/*
 *
 * Name 		: Province Model
 * Date 		: 1395/08/30
 * Auther 		: A.shokri
 * Description 	: The Model From irex_province Table.
 *
*/

class province_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_province($province_name)
	{
		$data = array
		(
			'name'	=>	$province_name
		);

		$this->db->insert('province', $data);
	}

	public function read_province_list($page=1)
	{
		if($page!=1)
		{
			$page = $page * 10 - 9;
		}
		$this->db->limit(10, $page);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('province');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function province_count()
	{
		$result = $this->db->get('province');
		return $result->num_rows();
	}

	public function read_all_province()
	{
		$result = $this->db->get('province');
		$reulst = $result->result_array();

		$province_list = '';
		foreach ($reulst as $my_result) {
			$province_list[$my_result['id']] = $my_result['name'];
		}

		return $province_list;
	}

	public function read_once_province($province_id)
	{
		$this->db->where('id', $province_id);
		$result = $this->db->get('province', 1);

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

	public function update_province($province_id, $province_name)
	{
		$data = array(
			'name'	=>	$province_name
		);
		$this->db->set($data);
		$this->db->where('id', $province_id);
		$this->db->update('province');
	}

	public function delete_province($province_id)
	{
		$this->db->where('id', $province_id);
		$result = $this->db->delete('province');

		return $result;
	}

	public function fetch_province_name($province_id)
	{
		$this->db->where('id' ,$province_id);
		$result = $this->db->get('province', 1);

		if($result->num_rows() < 1)
		{
			return 'استان:{نامشخص}';
		}
		else
		{
			$result = $result->result_array();
			$result = $result[0];
			return 'استان:{' . $result['name'] . '}';
		}
	}
}
?>