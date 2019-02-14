<?php

/*
 *
 * Name 		: Favorite Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_favorite Table.
 *
*/

class favorite_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_favorite($user_id, $favorite_title, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('favorite');

		if($result->num_rows()<5)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$favorite_title,
				'description'	=>	$description
			);

			$this->db->insert('favorite', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function load_favorite($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('favorite', 5);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function delete_favorite($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('favorite');

		return $result;
	}
}

?>