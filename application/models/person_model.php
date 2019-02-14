<?php

/*
 *
 * Name 		: Person Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_person Table.
 *
*/

class person_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_person($user_id)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'first_name'	=>	'',
			'last_name' 	=>	'',
			'birthday'		=>	'1395/01/01',
			'activity_id'	=>	1,
			'gender'		=>	0,
			'marriage'		=>	0,
			'about'			=>	''
		);

		$this->db->insert('person', $data);
	}

	public function read_person($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('person', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_person($user_id, $first_name, $lastname, $birthday, $activity_id, $gender, $marriage, $about)
	{
		$data = array(
			'first_name'	=>	$first_name,
			'last_name'		=>	$lastname,
			'birthday'		=>	$birthday,
			'activity_id'	=>	$activity_id,
			'gender'		=>	$gender,
			'marriage'		=>	$marriage,
			'about'			=>	$about
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('person');
	}

	public function fetch_full_name($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('person', 1);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			$result = $result[0]['first_name'] . " " . $result[0]['last_name'];
			return $result;
		}
		else
		{
			return 0;
		}
	}
}

?>