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
		$data = array
		(
			'user_id'		=>	$user_id,
			'file_name'		=>	'default.png',
			'description'	=>	''
		);
		$this->db->insert('image', $data);
		return 1;
	}
	
	public function insert_image($user_id, $new_file_name)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('image');
		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			$file_name = $result[0]['file_name'];

			$this->db->where('user_id', $user_id);
			$result = $this->db->delete('image');
			delete_files(base_url() . 'upload/' . $file_name);
		}
		
		$data = array
		(
			'user_id'		=>	$user_id,
			'file_name'		=>	$new_file_name,
			'description'	=>	''
		);
		$this->db->insert('image', $data);
		return 1;
	}

	public function read_image($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('image');

		return $result->result_array();
	}
}

?>