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

		if($result->num_rows()<20)
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

	public function read_favorite($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('favorite', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_favorite($user_id, $favorite_id, $favorite_title, $description)
	{
		$data = array(
			'title'			=>	$favorite_title,
			'description'	=>	$description
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $favorite_id);
		$this->db->update('favorite');
	}

	public function delete_favorite($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('favorite');

		return $result;
	}

	public function fetch_record_with_id($user_id, $favorite_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $favorite_id);
		$result = $this->db->get('favorite', 1);

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