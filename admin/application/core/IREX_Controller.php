<?php

/*
 *
 * Name : IREX_Controller Core
 * Date : 1395/08/27
 * Auther : A.shokri
 * Description : The Core For Base Class For Inheritance Users Panel.
 *
*/

class IREX_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$admin_login = $this->session->userdata('admin_login');
		$user_id 	 = $this->session->userdata('user_id');
		
		if(!empty($admin_login))
		{
			if($admin_login!=true)
			{
				redirect(base_url() . 'login/3');
			}
		}
		else
		{
			redirect(base_url() . 'login/3');
		}
	}
}

?>