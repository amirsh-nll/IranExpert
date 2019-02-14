<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 1395/08/27
 * Auther : A.shokri
 * Description : The Controller From Load Admin Section.
 *
*/

class web extends CI_Controller
{
	public function index()
	{
		$this->login();
	}

	public function login($notice=0)
	{
		$notice = xss_clean($notice);
		$admin_login = $this->session->userdata('admin_login');
		
		if(!empty($admin_login))
		{
			if($admin_login==true)
			{
				$this->session->set_userdata('admin_login');
				$this->session->set_userdata('user_id');
				redirect(base_url() . 'login/4');
			}
		}

		$captcha = array(
	        'img_path'      => '../captcha/',
	        'img_url'       => 'http://localhost/captcha/',
	        'word_length'   => 5,
	        'font_path'		=> './assets/font/stencilstd.otf',
	        'colors'        => array(
	                'background' 	=> array(255, 255, 255),
                	'border' 		=> array(255, 255, 255),
                	'text' 			=> array(0, 0, 0),
                	'grid' 			=> array(255, 40, 40)
	        )
		);
		$cap = create_captcha($captcha);

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);


		$data = array(
			'url'		=>	base_url(),
			'captcha'	=>	$cap,
			'notice'	=> $notice
		);
		$this->load->view('web/login', $data);
	}

	public function auth()
	{
		$rules = array(
			array(
				'field'	=>'email',
				'label'	=>'ایمیل',
				'rules'	=>'required|min_length[5]|max_length[70]',
				'errors'=> array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'	=>'password',
				'label'	=>'رمز عبور',
				'rules'	=>'required|min_length[5]|max_length[40]',
				'errors'=> array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'	=>'captcha',
				'label'	=>'کد امنیتی',
				'rules'	=>'required',
				'errors'=> array(
					'required'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'login/1');
		}
		else
		{
			$email 		= $this->input->post('email'	, true);
			$password 	= $this->input->post('password', true);
			$code 		= $this->input->post('captcha', true);
			$this->load->model('captcha_model');

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$user_id = $this->user_model->check_user_for_login($email, $password);
				if($user_id!=0)
				{
					$description = $this->agent->agent_string() . '// IP:' . $this->input->ip_address();
					$this->load->model('login_model');
					$this->login_model->login($user_id, $description);

					$this->session->set_userdata('admin_login', true);
					$this->session->set_userdata('user_id', $user_id);
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
}
?>