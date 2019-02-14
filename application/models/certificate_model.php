<?php

/*
 *
 * Name 		: Certificate Model
 * Date 		: 1395/09/06
 * Auther 		: A.shokri
 * Description 	: The Model From irex_certificate Table.
 *
*/

class certificate_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function new_certificate($user_id, $identity_1, $identity_2, $start_date, $end_date, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('certificate');

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			foreach ($result as $my_result) {
				if($my_result['status']==1 && $my_result['end_date'] > now())
				{
					return 0;
				}
			}
		}
			
		$data = array
		(
			'user_id'		=>	$user_id,
			'status'		=>	0,
			'identity_1'	=>	$identity_1,
			'identity_2'	=>	$identity_2,
			'start_date'	=>	$start_date,
			'end_date'		=>	$end_date,
			'description'	=>	$description
		);
		$this->db->insert('certificate', $data);
		return 1;
	}

	public function certificate_status($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('certificate');

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			foreach ($result as $my_result) {
				if($my_result['status']==1 && $my_result['end_date'] > now())
				{
					return $my_result['end_date'];
				}
				else
				{
					return 0;
				}
			}
		}
	}
}

?>