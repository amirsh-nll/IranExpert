<?php

class person_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function new_person($user_id)
	{
		$data = array
		(
			'user_id'=>$user_id
		);

		$this->db->insert('person', $data);
	}
}

?>