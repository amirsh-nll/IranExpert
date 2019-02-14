<?php

/*
 *
 * Name 		: Article Model
 * Date 		: 1395/08/17
 * Auther 		: A.shokri
 * Description 	: The Model From irex_article Table.
 *
*/

class article_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_article($user_id, $article_title, $start_date, $end_date, $description)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('article');

		if($result->num_rows()<20)
		{
			$data = array
			(
				'user_id'		=>	$user_id,
				'title'			=>	$article_title,
				'start'			=>	$start_date,
				'end'			=>	$end_date,
				'description'	=>	$description
			);

			$this->db->insert('article', $data);
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function read_article($user_id)
	{
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('article', 20);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function update_article($user_id, $article_id, $article_title, $start_date, $end_date, $description)
	{
		$data = array(
			'title'			=>	$article_title,
			'start'			=>	$start_date,
			'end'			=>	$end_date,
			'description'	=>	$description
		);
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $article_id);
		$this->db->update('article');
	}

	public function delete_article($id, $user_id)
	{
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$result = $this->db->delete('article');

		return $result;
	}

	public function fetch_record_with_id($user_id, $article_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $article_id);
		$result = $this->db->get('article', 1);

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