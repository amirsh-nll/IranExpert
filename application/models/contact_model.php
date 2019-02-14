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
			'province_id'		=>	1,
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

	public function check_fill($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('contact', 1);

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			$result = $result[0];
			if(
				empty($result['mobile_number'])	||
				empty($result['phone_number']) 	||
				empty($result['postal_code']) 	||
				empty($result['province_id']) 	||
				empty($result['city_name']) 	||
				empty($result['address'])
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
}

?>