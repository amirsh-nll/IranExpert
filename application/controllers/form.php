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
					'rules'		=>	'required|valid_email|is_unique[user.email]|min_length[5]|max_length[70]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
						'is_unique'		=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
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

				$this->load->model('message_model');
				$this->message_model->insert_message($user_id, 'مدیر', 'به سامانه پروفایل آنلاین ایرانیان خوش آمدید.', 'no-reply@localhost.com', 'دوست عزیز به سامانه پروفایل آنلاین ایرانیان خوش آمدید. <br/> سامانه آنلاین پروفایل ایرانیان یک سامانه پارسی بوده که در تاریخ پاییز و زمستان سال ۱۳۹۵ خورشیدی بر پایه سیستم شخصی اختصاصی کدنویسی شده و توسط آقای امیر شکری راه اندازی شد این وبسایت در حال حاظر قصد دارد تا با ارائه ی خدمات تحت وب ارائه ی صفحات شخصی بتواند به شما کمک کند؛ سامانه پروفایل آنلاین ایرنیان یک سرویس کاربر محور می باشد که در کشور ایران راه اندازی شده است . <br/> تارنما چیست ؟ ویکی : وب‌گاه،تارگاه،تارنما، سایت یا وب‌سایت مجموعه‌ای از صفحات وب است که دارای یک دامنه اینترنتی یا زیردامنه اینترنتی مشترک‌اند و به صورت مجموعه‌ای از صفحات مرتبط که داده‌هایی نظیر متن، صدا، تصویر و فیلم، روی آن‌ها ارائه می‌شود، روی شبکه ی اینترنت قرار می‌گیرد.صفحه ی وب سندی است که معمولاً به صورت اچ‌تی‌ام‌ال نوشته می‌شود و همواره با استفاده از پروتکل اچ‌تی‌تی‌پی می‌توان به آن دسترسی پیدا کرد. پروتکل اچ‌تی‌تی‌پی اطلاعات را از کارساز وب‌گاه به مرورگر وب کاربر منتقل می‌کند تا این اطلاعات برای کاربر نمایش داده شوند. همه ی وب‌گاهها در کنار هم یک تار جهان‌گستر بزرگ از اطلاعات را درست می‌کنند. دسترسی به صفحات وب‌گاه از طریق یک ریشه ی مشترک یوآرال با نام صفحه اصلی امکان‌پذیر است که این صفحه ی اصلی از لحاظ فیزیکی روی همان کارساز قرار می‌گیرد. یوآرال‌های صفحات آن‌ها را به صورت هرمی سازمان‌دهی می‌کنند اگرچه ابرپیوندهای موجود میانشان تعیین می‌کنند که چگونه کاربر اطلاعات را ببینند و چگونه ترافیک وب، بین بخش‌های مختلف وب‌گاه پخش شود. برای دسترسی به اطلاعات برخی از سایت‌های وب می‌بایست حق اشتراک داشته باشید.', 'Send By Admin');

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
					'rules'		=>	'required|valid_email|min_length[5]|max_length[70]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
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
				if($login!=0 && $login!=-1)
				{
					$description = $this->agent->agent_string() . '// IP:' . $this->input->ip_address();
					$this->load->model('login_model');
					$this->login_model->login($login, $description);
					$session = array(
						'user_id'	=>	$login,
						'login'		=>	true
					);
					$this->session->set_userdata($session);

					$this->load->model('person_model');
					$person = $this->person_model->check_say_birthday($login);
					if($person==1)
					{
						$this->load->model('message_model');
						$message = $this->message_model->check_birthday_message($login);
						if($message==1)
						{
							$this->message_model->insert_message($login, 'مدیر', 'زادروزتان مبارک.', 'no-reply@localhost.com', 'زادروزتان مبارک. از صمیم قلب برایتان شادی، سلامتی و سربلندی را آزرو داریم. مایه خوشبختی و سعادت ماست که میزبان شما در این سامانه هستیم؛ ارادتمند: مدیریت سامانه', 'Send By System For BirthDay');
						}
					}

					redirect(base_url() . 'panel/index');
				}
				elseif($login==-1)
				{
					redirect(base_url() . 'login/7');
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

	public function violation()
	{
		$rules = array(
				array(
					'field'		=>	'violation_type',
					'label'		=>	'نوع تخلف',
					'rules'		=>	'required|numeric',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'numeric'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'violation_reason',
					'label'		=>	'شرح تخلف',
					'rules'		=>	'max_length[1000]',
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
		
		$middle_name = $this->session->userdata('violation_middle_name');
		if(empty($middle_name))
		{
			redirect(base_url() . 'index');
		}

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'violation/' . $middle_name . '/1');
		}
		else
		{
			$violation_type 	= $this->input->post('violation_type', true);
			$violation_reason 	= $this->input->post('violation_reason', true);
			$code 				= $this->input->post('captcha', true);
			$description 		= $this->agent->agent_string() . '// IP:' . $this->input->ip_address();

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);

				$this->load->model('violation_model');
				$this->violation_model->violation_user($user_id, $violation_type, $violation_reason, $description);

				redirect(base_url() . 'violation/' . $middle_name . '/3');
			}
			else
			{
				redirect(base_url() . 'violation/' . $middle_name . '/2');
			}
		}
	}

	public function forget()
	{
		$rules = array(
				array(
					'field'		=>	'email',
					'label'		=>	'آدرس ایمیل',
					'rules'		=>	'required|valid_email|min_length[5]|max_length[70]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
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

	public function search($key='')
	{
		$key = ltrim(rtrim($this->input->get('key', true)));
		
		$this->load->model('user_model');
		$user = $this->user_model->search_user($key);

		$data = array(
			'title'				=>	'پروفایل آنلاین ایرانیان - جستجو کاربر',
			'url'				=>	base_url(),
			'page'				=>	'search',
			'user'				=>	$this->sort->array_sort($user, 'last_login', SORT_DESC)
		);
		$this->load->view('site/header',$data);
		$this->load->view('site/search',$data);
		$this->load->view('site/footer',$data);
	}
}