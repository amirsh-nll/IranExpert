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
			'webpage_url'	=>	'',
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

	public function update_person($user_id, $first_name, $lastname, $birthday, $activity_id, $gender, $marriage, $webpage_url, $about)
	{
		$data = array(
			'first_name'	=>	$first_name,
			'last_name'		=>	$lastname,
			'birthday'		=>	$birthday,
			'activity_id'	=>	$activity_id,
			'gender'		=>	$gender,
			'marriage'		=>	$marriage,
			'webpage_url'	=>	$webpage_url,
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

	public function check_fill($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('person', 1);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			$result = $result[0];
			if(
				empty($result['first_name'])	||
				empty($result['last_name']) 	||
				empty($result['birthday']) 		||
				empty($result['activity_id']) 	||
				empty($result['gender']) 		||
				empty($result['marriage']) 		||
				empty($result['webpage_url'])	||
				empty($result['about'])
			)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
	}

	public function check_say_birthday($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('person',1);
		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			$this_day = $this->jdf->tr_numes($this->jdf->jdate('j', now()));
			$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

			$result = $result[0];
			$birthday = explode('/', $result['birthday']);
			if($birthday[1] == $this_month && $birthday[2] == $this_day)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
}

?>