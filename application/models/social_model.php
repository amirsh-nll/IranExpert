<?php

/*
 *
 * Name 		: Social Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_social Table.
 *
*/

class social_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function load_social($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('social', 5);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function insert_social($user_id, $url, $type)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('social');

		if($result->num_rows()<5)
		{
			$data = array(
				'user_id'		=>	$user_id,
				'url'			=>	$url,
				'type'			=>	$type
			);

			$this->db->insert('social', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function delete_social($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('social');

		return $result;
	}
}

?>