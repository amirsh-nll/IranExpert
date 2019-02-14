<?php

/*
 *
 * Name 		: Page Model
 * Date 		: 1395/09/15
 * Auther 		: A.shokri
 * Description 	: The Model From irex_page Table.
 *
*/

class page_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function read_page($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('page');
		$result = $result->result_array();
		$result = $result[0];
		return $result;
	}
}

?>