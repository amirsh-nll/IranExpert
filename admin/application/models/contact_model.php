<?php

/*
 *
 * Name 		: Contacts Model
 * Date 		: 1395/08/27
 * Auther 		: A.shokri
 * Description 	: The Model From irex_contacts Table.
 *
*/

class contact_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_contact($user_id)
	{
		$data = array
		(
			'user_id'			=>	$user_id,
			'mobile_number'		=>	'',
			'phone_number'		=>	'',
			'postal_code'		=>	'',
			'province'			=>	0,
			'address'			=>	''
		);

		$this->db->insert('contact', $data);
	}
}

?>