<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 2016/10/24
 * Auther : A.shokri
 * Description : The Controller From Load Main Website Page.
 *
*/

class User extends CI_Controller
{
	function auth()
	{
		$email = xss_clean($_POST['email']);
		$password = xss_clean($POST['password']);

		
	}
}