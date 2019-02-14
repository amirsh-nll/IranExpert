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

	public function insert_slideshow($file_name, $title, $description)
	{
		$result = $this->db->get('slideshow');
		if($result->num_rows() <= 10)
		{
			$data = array
			(
				'file_name'		=>	$file_name,
				'title'			=>	$title,
				'description'	=>	$description
			);
			$this->db->insert('slideshow', $data);
			return 1;
		}
		else
		{
			return 0;
		}
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

	public function delete_slideshow($slideshow_id)
	{
		$this->db->where('id', $slideshow_id);
		$result = $this->db->delete('slideshow');
		return $result;
	}

	
}
?>