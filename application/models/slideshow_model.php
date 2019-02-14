<?php

/*
 *
 * Name 		: SlideShow Model
 * Date 		: 1395/09/05
 * Auther 		: A.shokri
 * Description 	: The Model From irex_slideshow Table.
 *
*/

class slideshow_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function read_slideshow()
	{
		$result = $this->db->get('slideshow');

		if($result->num_rows() < 1)
		{
			return 0;
		}
		else
		{
			$reulst = $result->result_array();
			return $reulst;
		}
	}
}
?>