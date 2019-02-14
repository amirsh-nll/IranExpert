<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 1395/08/03
 * Auther : A.shokri
 * Description : The Controller From Load Main Website Page.
 *
*/

class web extends CI_Controller
{
	private function statistics()
	{
		$this->load->model('statistics_model');
		$this->statistics_model->statistics_calculator(1);
	}

	public function index()
	{
		$data = array(
			'url'		=>	base_url(),
			'title'		=>	'پروفایل آنلاین ایرانیان',
			'page'		=>	'index'
			);

		$this->statistics();

		$this->load->view('site/header',$data);
		$this->load->view('site/home',$data);
		$this->load->view('site/footer',$data);
	}

	public function register($notice=0)
	{
		$notice = xss_clean($notice);
		$login = $this->session->userdata('login');
		
		if(!empty($login))
		{
			if($login==true)
			{
				$this->session->set_userdata('user_id');
				$this->session->set_userdata('login');
			}
		}

		$captcha = array(
	        'img_path'      => './captcha/',
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
		$data = array(
			'title'		=>	'ثبت نام در',
			'url'		=>	base_url(),
			'captcha'	=>	$cap,
			'notice'	=>	$notice
			);
		
		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		$this->statistics();

		$this->load->view('site/form_header',$data);
		$this->load->view('site/register',$data);
	}

	public function login($notice=0)
	{
		$notice = xss_clean($notice);
		$login = $this->session->userdata('login');
		
		if(!empty($login))
		{
			if($login==true)
			{
				$this->session->set_userdata('user_id');
				$this->session->set_userdata('login');
				redirect(base_url() . 'login/5');
			}
		}

		$captcha = array(
	        'img_path'      => './captcha/',
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
		$data = array(
			'title'		=>	'ورود به',
			'url'		=>	base_url(),
			'captcha'	=>	$cap,
			'notice'	=>	$notice
			);

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		$this->statistics();

		$this->load->view('site/form_header',$data);
		$this->load->view('site/login',$data);
	}

	public function report($middle_name='', $notice=0)
	{
		$notice 		= xss_clean($notice);
		$middle_name 	= xss_clean($middle_name);
		$login 			= $this->session->userdata('login');

		if(empty($middle_name))
		{
			redirect(base_url() . 'index');
		}

		$this->session->set_userdata('report_middle_name', $middle_name);

		$captcha = array(
	        'img_path'      => './captcha/',
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
		$data = array(
			'title'			=>	'گزارش تخلف',
			'url'			=>	base_url(),
			'captcha'		=>	$cap,
			'notice'		=>	$notice,
			'middle_name'	=>	$middle_name
			);

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		$this->statistics();

		$this->load->view('site/form_header',$data);
		$this->load->view('site/report',$data);
	}

	public function forget($notice=0)
	{
		$notice = xss_clean($notice);
		$login = $this->session->userdata('login');
		
		if(!empty($login))
		{
			if($login==true)
			{
				$this->session->set_userdata('user_id');
				$this->session->set_userdata('login');
			}
		}
		
		$captcha = array(
	        'img_path'      => './captcha/',
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
		$data = array(
			'title'		=>	'فراموشی رمز عبور',
			'url'		=>	base_url(),
			'captcha'	=>	$cap,
			'notice'	=>	$notice
			);

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		$this->statistics();

		$this->load->view('site/form_header',$data);
		$this->load->view('site/forget',$data);
	}

	public function rules()
	{
		$data = array(
			'url'		=>	base_url(),
			'title'		=>	'پروفایل آنلاین ایرانیان - قوانین',
			'page'		=>	'rules'
			);

		$this->statistics();

		$this->load->view('site/header',$data);
		$this->load->view('site/rules',$data);
		$this->load->view('site/footer',$data);
	}

	public function about()
	{
		$data = array(
			'url'		=>	base_url(),
			'title'		=>	'پروفایل آنلاین ایرانیان - درباره ما',
			'page'		=>	'about'
			);
		
		$this->statistics();

		$this->load->view('site/header',$data);
		$this->load->view('site/about',$data);
		$this->load->view('site/footer',$data);
	}

	public function contact($notice=0)
	{
		$notice = xss_clean($notice);

		$captcha = array(
	        'img_path'      => './captcha/',
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
			'title'		=>	'پروفایل آنلاین ایرانیان - تماس با ما',
			'page'		=>	'contact',
			'captcha'	=>	$cap,
			'notice'	=>	$notice
			);
		
		$this->statistics();

		$this->load->view('site/header',$data);
		$this->load->view('site/contact',$data);
		$this->load->view('site/footer',$data);
	}

	public function send_message()
	{
		$rules = array(
				array(
					'field'		=>	'name',
					'label'		=>	'نام شما',
					'rules'		=>	'required|min_length[3]|max_length[100]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'title',
					'label'		=>	'موضوع پیام',
					'rules'		=>	'min_length[3]|max_length[100]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'email',
					'label'		=>	'ایمیل',
					'rules'		=>	'required|valid_email|min_length[5]|max_length[70]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'message',
					'label'		=>	'پیام شما',
					'rules'		=>	'min_length[5]|max_length[500]',
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

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'contact/1#message_form');
		}
		else
		{
			$user_id 		= 1;
			$full_name		= $this->input->post('name',true);
			$title 			= $this->input->post('title',true);
			$email 			= $this->input->post('email',true);
			$message 		= $this->input->post('message',true);
			$captcha 		= $this->input->post('captcha',true);
			$description 	= $this->agent->agent_string() . '// IP:' . $this->input->ip_address();

			if($this->captcha_model->check($code))
			{
				$this->load->model('message_model');
				$message = $this->message_model->insert_message($user_id, $full_name, $title, $email, $message, $description);
				if($message==1)
				{
					redirect(base_url() . 'contact/2#message_form');
				}
				else
				{
					redirect(base_url() . 'contact/1#message_form');
				}
			}
			else
			{
				redirect(base_url() . 'contact/3#message_form');
			}
		}
	}
}

?>