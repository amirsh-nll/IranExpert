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

	public function insert_social($user_id, $url, $type)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('social');

		if($result->num_rows()<6)
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
	
	public function read_social($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('social', 6);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_social($user_id, $social_id, $url, $type)
	{
		$data = array(
			'url'			=>	$url,
			'type'			=>	$type
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $social_id);
		$this->db->update('social');
	}

	public function delete_social($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('social');

		return $result;
	}

	public function fetch_record_with_id($user_id, $social_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $social_id);
		$result = $this->db->get('social', 1);

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