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