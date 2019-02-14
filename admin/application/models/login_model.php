<?php

/*
 *
 * Name 		: Login Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_login Table.
 *
*/

class login_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login($user_id, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('login');
		$data = array
		(
			'user_id'		=>	$user_id,
			'time'			=>	now(),
			'description'	=>	$description
		);
		$this->db->insert('login', $data);
		return 1;
	}

	public function last_login($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('login',1);
		if($result->num_rows()==0)
		{
			$this->load->model('user_model');
			$last_time = $this->user_model->fetch_register_time($user_id);
			return $last_time;
		}
		else
		{
			$result = $result->result_array();
			$result = $result[0];
			$last_time = $result['time'];
			return $last_time;
		}
	}

	public function login_today()
	{
		$result = $this->db->get('login');
		$result = $result->result_array();

		$i=0;
		foreach ($result as $my_result) {
			if($my_result['time'] >= now() - 86400)
			{
				$i+=1;
			}
		}
		return $i;
	}

	public function login_month()
	{
		$result = $this->db->get('login');
		$result = $result->result_array();

		$i=0;
		foreach ($result as $my_result) {
			if($my_result['time'] >= now() - 2592000)
			{
				$i+=1;
			}
		}
		return $i;
	}

	public function login_year()
	{
		$result = $this->db->get('login');
		$result = $result->result_array();

		$i=0;
		foreach ($result as $my_result) {
			if($my_result['time'] >= now() - 31536000)
			{
				$i+=1;
			}
		}
		return $i;
	}
}

?>