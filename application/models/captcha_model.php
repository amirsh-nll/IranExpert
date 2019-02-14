<?php

/*
 *
 * Name 		: Captcha Model
 * Date 		: 1395/08/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_captcha Table.
 *
*/

class captcha_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
	{
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
	}

	public function check($captcha)
	{
		$expiration = time() - 7200;
		$this->db->where('captcha_time < ', $expiration)
		        ->delete('captcha');

		$sql 	= 'SELECT COUNT(*) AS count FROM irex_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds 	= array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query 	= $this->db->query($sql, $binds);
		$row 	= $query->row();

		return $row->count;
	}
}

?>