<?php

class contacts_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct()
	}

	public function new_contacts($user_id)
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