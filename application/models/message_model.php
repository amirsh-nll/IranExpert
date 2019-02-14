<?php

/*
 *
 * Name 		: Message Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_messages Table.
 *
*/

class message_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_message($user_id, $title, $email, $message, $description)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'status'		=>	1,
			'title'			=>	$title,
			'email'			=>	$email,
			'message'		=>	$message,
			'description'	=>	$description
		);

		$this->db->insert('message', $data);
		return 1;
	}

	public function message_unread($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('status', 1);
		$result = $this->db->get('message');

		return $result->num_rows();
	}
}
?>