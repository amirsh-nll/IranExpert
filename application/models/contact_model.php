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
			'phone_number'		=>	'',
			'postal_code'		=>	'',
			'province'			=>	0,
			'address'			=>	''
		);

		$this->db->insert('contact', $data);
	}

	public function read_contact($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('contact', 1);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_contact($user_id, $mobile_number, $phone_number, $postal_code, $province, $address)
	{
		$data = array(
			'mobile_number'		=>	$mobile_number,
			'phone_number'		=>	$phone_number,
			'postal_code'		=>	$postal_code,
			'province'			=>	$province,
			'address'			=>	$address
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('contact');
	}
}

?>