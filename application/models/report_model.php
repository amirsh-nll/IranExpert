<?php

/*
 *
 * Name 		: Report Model
 * Date 		: 1395/08/17
 * Auther 		: A.shokri
 * Description 	: The Model From irex_report Table.
 *
*/

class report_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function report_user($user_id, $report_type, $report_reason, $report_description)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'type'			=>	$report_type,
			'reason'		=>	$report_reason,
			'description'	=>	$report_description
		);
		$this->db->insert('report', $data);

		return 1;
	}
}