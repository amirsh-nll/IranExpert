<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Admin Controller
 * Date : 1395/08/27
 * Auther : A.shokri
 * Description : The Controller From Load Admin Section.
 *
*/

class admin extends CI_Controller
{
	public function index()
	{
		redirect(base_url() . 'panel/index');
	}

	public function new_user()
	{
		$rules = array(
			array(
				'field'		=>	'email',
				'label'		=>	'ایمیل',
				'rules'		=>	'required|valid_email|is_unique[user.email]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
					'is_unique'		=>	'فیلد %s معتبر نمی باشد.'
					)
				),
			array(
				'field'		=>	'password',
				'label'		=>	'رمز عبور',
				'rules'		=>	'required|min_length[5]|max_length[40]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'repassword',
				'label'		=>	'تکرار رمز عبور',
				'rules'		=>	'required|matches[password]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'matches'		=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/new_user/1');
		}
		else
		{
			$email 			= $this->input->post('email', true);
			$password 		= $this->input->post('password', true);
			$middle_name 	= explode('@', $email);

			$this->load->model('user_model');
			$user_id = $this->user_model->new_user($email, $password, $middle_name[0]);

			$this->load->model('person_model');
			$this->person_model->blank_person($user_id);
			
			$this->load->model('contact_model');
			$this->contact_model->blank_contact($user_id);

			$this->load->model('statistics_model');
			$this->statistics_model->blank_statistics($user_id);

			$this->load->model('image_model');
			$this->image_model->default_image($user_id);

			redirect(base_url() . 'panel/new_user/2');
		}
	}
}
?>