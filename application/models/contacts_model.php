<?php

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Model From irex_contacts Table.
 *
*/

class contacts_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_contacts($user_id)
	{
		$data = array
		(
			'user_id'=>$user_id,
			'province_id'=>0
		);

		$this->db->insert('contacts', $data);
	}
}

?>