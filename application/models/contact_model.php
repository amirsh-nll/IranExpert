<?php

/*
 *
 * Name 		: Contacts Model
 * Date 		: 1395/08/09
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
			'mobile_number_code'=>	'',
			'phone_number'		=>	'',
			'phone_number_code' =>	'',
			'postal_code'		=>	'',
			'province'		=>	'نامشخص',
			'address'			=>	''
		);

		$this->db->insert('contact', $data);
	}
}

?>