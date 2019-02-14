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
}

?>