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

	public function read_main_website_statistics()
	{
		$this->db->where('user_id', 1);
		$result = $this->db->get('statistics', 1);
		$result = $result->result_array();
		$result = $result[0];
		
		return $result;
	}

	public function read_all_user_statistics()
	{
		$result = $this->db->get('statistics');
		$result = $result->result_array();

		$statistics = array(
			'today'		=>	0,
			'yesterday'	=>	0,
			'total'		=>	0
		);
		
		foreach ($result as $my_result) {
			$statistics['today']	+= $my_result['today'];
			$statistics['yesterday']+= $my_result['yesterday']; 
			$statistics['total']	+= $my_result['total']; 
		}
		
		return $statistics;
	}

	public function top_visit_today_statistics()
	{
		$this->db->order_by('today', 'DESC');
		$result = $this->db->get('statistics', 10);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			return $result;
		}
		else
		{
			return 0;
		}
	}

	public function top_visit_yesterday_statistics()
	{
		$this->db->order_by('yesterday', 'DESC');
		$result = $this->db->get('statistics', 10);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			return $result;
		}
		else
		{
			return 0;
		}
	}

	public function top_visit_total_statistics()
	{
		$this->db->order_by('total', 'DESC');
		$result = $this->db->get('statistics', 10);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			return $result;
		}
		else
		{
			return 0;
		}
	}
}
?>