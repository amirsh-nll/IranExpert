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

	public function read_page()
	{
		$result = $this->db->get('page');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_page($about_content, $rules_content, $user_panel_content)
	{
		$data = array(
			'content'	=>	$about_content
		);
		$this->db->set($data);
		$this->db->where('id', 1);
		$this->db->update('page');

		$data = array(
			'content'	=>	$rules_content
		);
		$this->db->set($data);
		$this->db->where('id', 2);
		$this->db->update('page');

		$data = array(
			'content'	=>	$user_panel_content
		);
		$this->db->set($data);
		$this->db->where('id', 3);
		$this->db->update('page');
	}
}

?>