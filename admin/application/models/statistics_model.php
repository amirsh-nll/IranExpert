<?php

/*
 *
 * Name 		: Statistics Model
 * Date 		: 1395/08/27
 * Auther 		: A.shokri
 * Description 	: The Model From irex_statistics Table.
 *
*/

class statistics_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_statistics($user_id)
	{
		$data = array
		(
			'user_id'	=>	$user_id,
			'today'		=> 	0,
			'yesterday'	=> 	0,
			'total'		=> 	0,
			'last_visit'=> 	now()
		);

		$this->db->insert('statistics', $data);
	}
}
?>