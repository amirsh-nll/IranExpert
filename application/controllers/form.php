<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Form Controller
 * Date : 1395/08/03
 * Auther : A.shokri
 * Description : The Controller From Load Form Page.
 *
*/

class form extends CI_Controller
{
	public function register()
	{
		$rules = array(
				array(
					'field'		=>	'email',
					'label'		=>	'آدرس ایمیل',
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
					),
				array(
					'field'		=>	'rules_check',
					'label'		=>	'پذیرش قوانین',
					'rules'		=>	'numeric',
					'errors'	=>	array(
						'numeric'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'captcha',
					'label'		=>	'کد امنیتی',
					'rules'		=>	'required',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'web/register/1');
		}
		else
		{
			$email 			= $this->input->post('email',true);
			$password 		= $this->input->post('password',true);
			$rules_check 	= $this->input->post('rules_check',true);
			$code 			= $this->input->post('captcha',true);

			if($rules_check!=1)
			{
				redirect(base_url() . 'web/register/3');
			}

			if($this->captcha_model->check($code))
			{
				$middle_name = explode('@', $email);
				$this->load->model('user_model');
				$user_id = $this->user_model->new_user($email, $password, $middle_name[0]);

				$this->load->model('person_model');
				$this->person_model->blank_person($user_id);
				
				$this->load->model('contact_model');
				$this->contact_model->blank_contacts($user_id);

				$this->load->model('state_model');
				$this->state_model->blank_state($user_id);

				$this->load->model('image_model');
				$this->image_model->default_image($user_id);

				redirect(base_url() . 'web/login/4');

			}
			else
			{
				redirect(base_url() . 'web/register/2');
			}
		}
	}

	public function login()
	{
		$rules = array(
				array(
					'field'		=>	'email',
					'label'		=>	'آدرس ایمیل',
					'rules'		=>	'required|valid_email',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'password',
					'label'		=>	'رمز عبور',
					'rules'		=>	'required|min_length[5]|max_length[40]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'min_lenth'		=>	'فیلد %s معتبر نمی باشد.',
						'max_lenth'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'captcha',
					'label'		=>	'کد امنیتی',
					'rules'		=>	'required',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'web/login/1');
		}
		else
		{
			$email 		= $this->input->post('email',true);
			$password 	= $this->input->post('password',true);
			$code 		= $this->input->post('captcha',true);

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$login = $this->user_model->check_user_for_login($email, $password);
				if($login!=0)
				{
					$session = array(
						'user_id'	=>	$login,
						'login'		=>	true
					);
					$this->session->set_userdata($session);
					redirect(base_url() . 'panel/index');
				}
				else
				{
					redirect(base_url() . 'web/login/1');
				}

			}
			else
			{
				redirect(base_url() . 'web/login/2');
			}
		}
	}

	public function forget()
	{
		$rules = array(
				array(
					'field'		=>	'email',
					'label'		=>	'آدرس ایمیل',
					'rules'		=>	'required|valid_email',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'captcha',
					'label'		=>	'کد امنیتی',
					'rules'		=>	'required',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'web/forget/1');
		}
		else
		{
			
		}
	}
}