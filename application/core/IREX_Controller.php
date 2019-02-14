<?php

/*
 *
 * Name : IREX_Controller Core
 * Date : 1395/08/12
 * Auther : A.shokri
 * Description : The Core For Base Class For Inheritance Users Panel.
 *
*/

class IREX_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$login 		= $this->session->userdata('login');
		$user_id 	= $this->session->userdata('user_id');
		
		if(!empty($login))
		{
			if($login!=true)
			{
				redirect(base_url() . 'login/3');
			}
			else
			{
				$this->load->model('user_model');
				$user = $this->user_model->check_suspend($user_id);
				if($user!=1)
				{
					redirect(base_url() . 'login/1');
				}
			}
		}
		else
		{
			redirect(base_url() . 'login/3');
		}
	}
}

?>