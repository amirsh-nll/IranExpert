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

	public function read_certificate_list($page=0)
	{
		if($page!=0)
		{
			$page = $page * 10 - 10;
		}
		$this->db->limit(10, $page);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('certificate');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function certificate_count()
	{
		$result = $this->db->get('certificate');
		return $result->num_rows();
	}

	public function read_certificate_status($certificate_id)
	{
		$this->db->where('id', $certificate_id);
		$result = $this->db->get('certificate',1);

		if($result->num_rows()>0)
		{
			$result 	= $result->result_array();
			$result 	= $result[0];
			$data 		= array(
				'id'		=>	$result['id'],
				'user_id'	=>	$result['user_id'],
				'status'	=>	$result['status'],
				'start_date'=>	$result['start_date'],
				'end_date'	=>	$result['end_date']
			);
			return $data;
		}
		else
		{
			return 0;
		}
	}

	public function certificate_status_change($certificate_id, $status)
	{
		$data = array(
			'status'	=>	$status
		);
		$this->db->set($data);
		$this->db->where('id', $certificate_id);
		$this->db->update('certificate');
	}
}

?>