<?php

/*
 *
 * Name 		: Image Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_image Table.
 *
*/

class image_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default_image($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('image', 1);

		if($result->num_rows()>0)
		{
			$data = array
			(
				'file_name'		=>	'default.png',
				'description'	=>	'IP:' . $this->input->ip_address()
			);
			$this->db->set($data);
			$this->db->where('user_id', $user_id);
			$this->db->update('image');
			return 1;
		}
		else
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'file_name'		=>	'default.png',
				'description'	=>	''
			);
			$this->db->insert('image', $data);
			return 1;
		}
	}
	
	public function update_image($user_id, $new_file_name)
	{
		$data = array
		(
			'file_name'		=>	$new_file_name,
			'description'	=>	'IP:' . $this->input->ip_address()
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('image');
		return 1;
	}

	public function read_image($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('image', 1);

		return $result->result_array();
	}

	public function delete_image($user_id)
	{
		$this->default_image($user_id);
		return 1;
	}
}

?>