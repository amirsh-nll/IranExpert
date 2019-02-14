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
					)
			);

		$this->form_validation->set_rules($rules);

		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'register/1');
		}
		else
		{
			$email 			= $this->input->post('email', true);
			$password 		= $this->input->post('password', true);
			$rules_check 	= $this->input->post('rules_check', true);
			$code 			= $this->input->post('captcha', true);

			if($rules_check!=1)
			{
				redirect(base_url() . 'register/3');
			}

			if($this->captcha_model->check($code))
			{
				$middle_name = explode('@', $email);
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

				redirect(base_url() . 'login/4');

			}
			else
			{
				redirect(base_url() . 'register/2');
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
			redirect(base_url() . 'login/1');
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
					$description = $this->agent->agent_string() . '// IP:' . $this->input->ip_address();
					$this->load->model('login_model');
					$this->login_model->login($login, $description);
					$session = array(
						'user_id'	=>	$login,
						'login'		=>	true
					);
					$this->session->set_userdata($session);
					redirect(base_url() . 'panel/index');
				}
				else
				{
					redirect(base_url() . 'login/1');
				}

			}
			else
			{
				redirect(base_url() . 'login/2');
			}
		}
	}

	public function report()
	{
		$rules = array(
				array(
					'field'		=>	'report_type',
					'label'		=>	'نوع تخلف',
					'rules'		=>	'required|numeric',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'numeric'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'report_reason',
					'label'		=>	'شرح تخلف',
					'rules'		=>	'min_length[3]|max_length[1000]',
					'errors'	=>	array(
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
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
		
		$middle_name = $this->session->userdata('report_middle_name');
		if(empty($middle_name))
		{
			redirect(base_url() . 'index');
		}

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'report/' . $middle_name . '/1');
		}
		else
		{
			$report_type 	= $this->input->post('report_type', true);
			$report_reason 	= $this->input->post('report_reason', true);
			$code 			= $this->input->post('captcha', true);
			$description 	= $this->agent->agent_string() . '// IP:' . $this->input->ip_address();

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);

				$this->load->model('report_model');
				$this->report_model->report_user($user_id, $report_type, $report_reason, $description);

				redirect(base_url() . 'report/' . $middle_name . '/3');
			}
			else
			{
				redirect(base_url() . 'report/' . $middle_name . '/2');
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
		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'forget/1');
		}
		else
		{
			$email 			= $this->input->post('email', true);
			$code 			= $this->input->post('captcha', true);
			$description 	= $this->agent->agent_string() . '// IP : ' . $this->input->ip_address();

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$user_id = $this->user_model->fetch_user_id_with_email($email);
				
				if($user_id!=0)
				{
					$this->user_model->forget_password($user_id);
					redirect(base_url() . 'forget/3');
				}
				else
				{
					redirect(base_url() . 'forget/1');
				}
			}
			else
			{
				redirect(base_url() . 'forget/2');
			}
		}
	}
}