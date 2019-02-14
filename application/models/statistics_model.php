<?php

/*
 *
 * Name 		: Statistics Model
 * Date 		: 1395/08/09
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

	public function statistics_calculator($user_id)
	{	
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('statistics', 1);
		$result = $result->result_array();
		$result = $result[0];

		$now = date('y') . date('n') . date('j');
		if($result['last_visit']==$now)
		{
			$data = array
			(
				'today'		=> 	$result['today']+1,
				'total'		=> 	$result['total']+1
			);
		}
		else
		{
			$data = array
			(
				'today'		=> 	1,
				'yesterday'	=> 	$result['today'],
				'total'		=> 	$result['total']+1,
				'last_visit'=> 	date('y') . date('n') . date('j')
			);
		}

		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('statistics');
	}

	public function read_statistics($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('statistics', 1);
		$result = $result->result_array();
		$result = $result[0];
		
		return $result;
	}
}

?>