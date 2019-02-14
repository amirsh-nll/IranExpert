<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Controller From Load User Panel.
 *
*/

class panel extends cI_Controller
{
	public function index($page = 0)
	{
		/*
		ability
		contacts
		favorite
		image
		job
		lesson
		login
		messages
		person
		social
		state
		*/
		$data = array
		(
			'url'=>base_url()
		);
		$this->load->view('panel/header', $data);
	}

	
}

?>