<?php

/*
 *
 * Name 		: Violation Model
 * Date 		: 1395/08/17
 * Auther 		: A.shokri
 * Description 	: The Model From irex_violation Table.
 *
*/

class violation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function violation_user($user_id, $violation_type, $violation_reason, $violation_description)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'type'			=>	$violation_type,
			'reason'		=>	$violation_reason,
			'description'	=>	$violation_description
		);
		$this->db->insert('violation', $data);

		return 1;
	}
}