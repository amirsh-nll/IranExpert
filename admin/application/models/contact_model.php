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
			'province_id'		=>	0,
			'city_name'			=>	'',
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

	public function update_contact($user_id, $mobile_number, $phone_number, $postal_code, $province_id, $city_name, $address)
	{
		$data = array(
			'mobile_number'		=>	$mobile_number,
			'phone_number'		=>	$phone_number,
			'postal_code'		=>	$postal_code,
			'province_id'		=>	$province_id,
			'city_name'			=>	$city_name,
			'address'			=>	$address
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('contact');
	}
}

?>