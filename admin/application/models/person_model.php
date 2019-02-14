<?php

/*
 *
 * Name 		: Person Model
 * Date 		: 1395/08/27
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

	public function birthday_today()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_day = $this->jdf->tr_numes($this->jdf->jdate('j', now()));
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month && $birthday[2] == $this_day)
			{
				$i+=1;
			}
		}
		return $i;
	}

	public function birthday_yesterday()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_day = $this->jdf->tr_numes($this->jdf->jdate('j', now()));
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month && $birthday[2] == $this_day-1)
			{
				$i+=1;
			}
		}
		return $i;
	}

	public function birthday_month()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month)
			{
				$i+=1;
			}
		}
		return $i;
	}

	public function activity_id_free($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$result = $this->db->get('person');

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			foreach ($result as $my_result) {
				$data = array(
					'id'			=>	$my_result['id'],
					'user_id'		=>	$my_result['user_id'],
					'first_name'	=>	$my_result['first_name'],
					'last_name'		=>	$my_result['last_name'],
					'birthday'		=>	$my_result['birthday'],
					'activity_id'	=>	1,
					'gender'		=>	$my_result['gender'],
					'marriage'		=>	$my_result['marriage'],
					'webpage_url'	=>	$my_result['webpage_url'],
					'about'			=>	$my_result['about']
				);
				$this->db->set($data);
				$this->db->where('id', $my_result['id']);
				$this->db->update('person');
			}
		}
		else
		{
			return 0;
		}
	}

	public function person_special_activity($activity_id)
	{
		$this->db->where('activity_id', $activity_id);
		$result = $this->db->get('person');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function user_birthday_today()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_day = $this->jdf->tr_numes($this->jdf->jdate('j', now()));
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		$data='';
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month && $birthday[2] == $this_day)
			{
				$data[$i] = $my_result;
				$i+=1;
			}
		}
		if($i==0)
		{
			return 0;
		}
		else
		{
			return $data;
		}
	}

	public function user_birthday_yesterday()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_day = $this->jdf->tr_numes($this->jdf->jdate('j', now()));
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		$data='';
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month && $birthday[2] == $this_day-1)
			{
				$data[$i] = $my_result;
				$i+=1;
			}
		}
		if($i==0)
		{
			return 0;
		}
		else
		{
			return $data;
		}
	}

	public function user_birthday_month()
	{
		$result = $this->db->get('person');
		$result = $result->result_array();
		$this_month = $this->jdf->tr_numes($this->jdf->jdate('n', now()));

		$i=0;
		$data='';
		foreach ($result as $my_result) {
			$birthday = explode('/', $my_result['birthday']);
			if($birthday[1] == $this_month)
			{
				$data[$i] = $my_result;
				$i+=1;
			}
		}
		if($i==0)
		{
			return 0;
		}
		else
		{
			return $data;
		}
	}
}
?>