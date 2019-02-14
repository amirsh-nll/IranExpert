<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Profile
 * Date : 1395/08/14
 * Auther : A.shokri
 * Description : The Controller From Load User Profile Page.
 *
*/

class profile extends CI_Controller
{
	public function index($middle_name = 0)
	{
		$middle_name = xss_clean($middle_name);
		if($middle_name===0)
		{
			redirect(base_url() . 'web/index');
		}
		else
		{
			$data = array(
				'url'		=>	base_url()
			);
			$this->load->view('profile/header', $data);
			$this->load->view('profile/profile', $data);
			$this->load->view('profile/footer', $data);
		}
	}

	private function load_data()
	{
		$this->load->model('user_model');
		$this->load->model('image_model');
		$this->load->model('person_model');
		$this->load->model('contact_model');
		$this->load->model('lesson_model');
		$this->load->model('job_model');
		$this->load->model('favorite_model');
		$this->load->model('ability_model');
		$this->load->model('social_model');
	}
}

?>