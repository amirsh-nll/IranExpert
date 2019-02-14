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
			'activity'		=>	0,
			'gender'		=>	0,
			'marriage'		=>	0,
			'about'			=>	''
		);

		$this->db->insert('person', $data);
	}
}
?>