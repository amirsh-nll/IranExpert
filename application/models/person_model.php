<?php

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Model From irex_person Table.
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
			'user_id'=>$user_id,
			'gender'=>0,
			'marriage'=>0
		);

		$this->db->insert('person', $data);
	}
}

?>