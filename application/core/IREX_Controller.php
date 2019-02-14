<?php

/*
 *
 * Name : IREX_Controller Core
 * Date : 2016/11/02
 * Auther : A.shokri
 * Description : The Core For Base Class For Inheritance Users Panel.
 *
*/

class IREX_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$login = $this->session->userdata('login');
		
		if(!empty($login))
		{
			if($login!=true)
			{
				redirect(base_url() . 'web/login/3');
			}
		}
		else
		{
			redirect(base_url() . 'web/login/3');
		}
	}
}

?>