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
			'email'				=>	'',
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

	public function update_contact($user_id, $email, $mobile_number, $phone_number, $postal_code, $province_id, $city_name, $address)
	{
		$data = array(
			'email'				=>	$email,
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

	public function province_id_free($province_id)
	{
		$this->db->where('province_id', $province_id);
		$result = $this->db->get('contact');

		if($result->num_rows()>0)
		{
			$result = $result->result_array();
			foreach ($result as $my_result) {
				$data = array(
					'id'			=>	$my_result['id'],
					'user_id'		=>	$my_result['user_id'],
					'mobile_number'	=>	$my_result['mobile_number'],
					'phone_number'	=>	$my_result['phone_number'],
					'postal_code'	=>	$my_result['postal_code'],
					'province_id'	=>	1,
					'city_name'		=>	$my_result['city_name'],
					'address'		=>	$my_result['address']
				);
				$this->db->set($data);
				$this->db->where('id', $my_result['id']);
				$this->db->update('contact');
			}
		}
		else
		{
			return 0;
		}
	}

	public function contact_special_province($province_id)
	{
		$this->db->where('province_id', $province_id);
		$result = $this->db->get('contact');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}
}

?>