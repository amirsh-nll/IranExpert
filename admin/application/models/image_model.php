<?php

/*
 *
 * Name 		: Image Model
 * Date 		: 1395/08/27
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
	}

	public function delete_image($user_id)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'file_name'		=>	'default.png',
			'description'	=>	'Admin Changed This Image'
		);

		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('image');
	}

	public function read_all_image($page=1)
	{
		if($page!=1)
		{
			$page = $page * 9 - 8;
		}
		$this->db->limit(9, $page);
		$result = $this->db->get('image');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function image_count()
	{
		$result = $this->db->get('image');
		return $result->num_rows();
	}

	public function image_default_count()
	{
		$this->db->where('file_name', 'default.png');
		$result = $this->db->get('image');
		return $result->num_rows();
	}

	public function image_undefault_count()
	{
		return $this->image_count() - $this->image_default_count();
	}
}

?>