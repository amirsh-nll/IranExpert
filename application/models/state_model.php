<?php

/*
 *
 * Name 		: State Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_state Table.
 *
*/

class state_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_state($user_id)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'view_count'	=> 	0
		);

		$this->db->insert('state', $data);
	}
}

?>