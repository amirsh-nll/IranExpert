<?php

/*
 *
 * Name 		: Ability Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_ability Table.
 *
*/

class ability_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_ability($user_id, $ability_title, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('ability');

		if($result->num_rows()<20)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$ability_title,
				'description'	=>	$description
			);

			$this->db->insert('ability', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function read_ability($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('ability', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_ability($user_id, $ability_id, $ability_title, $description)
	{
		$data = array(
			'title'			=>	$ability_title,
			'description'	=>	$description
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $ability_id);
		$this->db->update('ability');
	}

	public function delete_ability($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('ability');

		return $result;
	}

	public function fetch_record_with_id($user_id, $ability_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $ability_id);
		$result = $this->db->get('ability', 1);

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