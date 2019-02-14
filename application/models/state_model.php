<?php

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Model From irex_state Table.
 *
*/

class state_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function blank_state($user_id)
	{
		$data = array
		(
			'user_id'=>$user_id
		);

		$this->db->insert('state', $data);
	}
}

?>