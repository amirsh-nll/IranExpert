<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 1395/08/10
 * Auther : A.shokri
 * Description : The Controller From Load User Panel.
 *
*/

class panel extends IREX_Controller
{
	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('person_model');
		$person = $this->person_model->fetch_full_name($user_id);
		
		if($person==0)
		{
			$person = "کاربر";
		}

		$data = array
		(
			'url'		=>base_url(),
			'title'		=>'پنل کاربری - پیشخوان',
			'full_name'	=>	$person
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home', $data);
		$this->load->view('panel/footer', $data);
	}

	public function image($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/image');
		}

		$this->load->model('image_model');
		$image = $this->image_model->read_image($user_id);
		$image = $image[0];

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - تصویر کاربری',
			'notice'			=>	$notice,
			'active_image'		=>	$image['file_name']
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/image', $data);
		$this->load->view('panel/footer', $data);

	}

	public function person($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/person');
		}

		$this->load->model('person_model');
		$person = $this->person_model->read_person($user_id);
		$person = $person[0];
		
		$birthday = explode('/', $person['birthday']);
		
		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - اطلاعات فردی',
			'notice'			=>	$notice,
			'first_name_value'	=>	$person['first_name'],
			'last_name_value'	=>	$person['last_name'],
			'birth_day_value'	=>	$birthday[2],
			'birth_month_value'	=>	$birthday[1],
			'birth_year_value'	=>	$birthday[0],
			'gender_value'		=>	$person['gender'],
			'marriage_value'	=>	$person['marriage'],
			'about_value'		=>	$person['about']
		);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/person', $data);
		$this->load->view('panel/footer', $data);
	}

	public function contact($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/contact');
		}

		$this->load->model('contact_model');
		$contact = $this->contact_model->read_contact($user_id);
		$contact = $contact[0];
		
		$data = array
		(
			'url'					=>	base_url(),
			'title'					=>	'پنل کاربری - اطلاعات تماس',
			'notice'				=>	$notice,
			'mobile_number_value'	=>	$contact['mobile_number'],
			'phone_number_value'	=>	$contact['phone_number'],
			'postal_code_value'		=>	$contact['postal_code'],
			'province_value'		=>	$contact['province'],
			'address_value'			=>	$contact['address'],
		);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/contact', $data);
		$this->load->view('panel/footer', $data);
	}
	
	public function lesson($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/lesson');
		}

		if($this->session->has_userdata('lesson_id_for_update'))
		{
			$this->session->unset_userdata('lesson_id_for_update');
		}

		$this->load->model('lesson_model');
		$lesson = $this->lesson_model->read_lesson($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - اطلاعات تحصیلی',
			'notice'			=>	$notice,
			'lesson_item'		=>	$lesson
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/lesson', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_lesson($lesson_id = 0, $notice = 0)
	{
		$lesson_id 	= xss_clean($lesson_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($lesson_id) || $lesson_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/lesson');
		}

		$this->load->model('lesson_model');
		$lesson = $this->lesson_model->fetch_record_with_id($user_id, $lesson_id);

		if($lesson==0)
		{
			redirect(base_url() . 'panel/lesson');
		}

		$this->session->set_userdata('lesson_id_for_update', $lesson_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش اطلاعات تحصیلی',
			'notice'			=>	$notice,
			'lesson_item'		=>	$lesson
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_lesson', $data);
		$this->load->view('panel/footer', $data);
	}

	public function job($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/job');
		}

		$this->load->model('job_model');
		$job = $this->job_model->read_job($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - اطلاعات شغلی',
			'notice'		=>	$notice,
			'job_item'		=>	$job
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/job', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_job($job_id = 0, $notice = 0)
	{
		$job_id 	= xss_clean($job_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($job_id) || $job_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/job');
		}

		$this->load->model('job_model');
		$job = $this->job_model->fetch_record_with_id($user_id, $job_id);

		if($job==0)
		{
			redirect(base_url() . 'panel/job');
		}

		$this->session->set_userdata('job_id_for_update', $job_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش اطلاعات شغلی',
			'notice'			=>	$notice,
			'job_item'			=>	$job
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_job', $data);
		$this->load->view('panel/footer', $data);
	}

	public function ability($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/ability');
		}

		$this->load->model('ability_model');
		$ability = $this->ability_model->read_ability($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - علاقه مندی',
			'notice'		=>	$notice,
			'ability_item'	=>	$ability
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/ability', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_ability($ability_id = 0, $notice = 0)
	{
		$ability_id = xss_clean($ability_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($ability_id) || $ability_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/ability');
		}

		$this->load->model('ability_model');
		$ability = $this->ability_model->fetch_record_with_id($user_id, $ability_id);

		if($ability==0)
		{
			redirect(base_url() . 'panel/ability');
		}

		$this->session->set_userdata('ability_id_for_update', $ability_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش توانایی ها',
			'notice'			=>	$notice,
			'ability_item'		=>	$ability
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_ability', $data);
		$this->load->view('panel/footer', $data);
	}

	public function project($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/project');
		}

		$this->load->model('project_model');
		$project = $this->project_model->read_project($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - پروژه ها',
			'notice'		=>	$notice,
			'project_item'	=>	$project
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/project', $data);
		$this->load->view('panel/footer', $data);
	}

	public function article($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/article');
		}

		$this->load->model('article_model');
		$article = $this->article_model->read_article($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - مقالات',
			'notice'		=>	$notice,
			'article_item'	=>	$article
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/article', $data);
		$this->load->view('panel/footer', $data);
	}

	public function achievement($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/achievement');
		}

		$this->load->model('achievement_model');
		$achievement = $this->achievement_model->read_achievement($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - افتخارات',
			'notice'			=>	$notice,
			'achievement_item'	=>	$achievement
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/achievement', $data);
		$this->load->view('panel/footer', $data);
	}

	public function favorite($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/favorite');
		}

		$this->load->model('favorite_model');
		$favorite = $this->favorite_model->read_favorite($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - علاقه مندی',
			'notice'		=>	$notice,
			'favorite_item'	=>	$favorite
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/favorite', $data);
		$this->load->view('panel/footer', $data);
	}

	public function social($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/social');
		}

		$this->load->model('social_model');
		$social = $this->social_model->read_social($user_id);

		$data = array
		(
			'url'			=>	base_url(),
			'title'			=>	'پنل کاربری - شبکه های اجتماعی',
			'notice'		=>	$notice,
			'social_item'	=>	$social
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/social', $data);
		$this->load->view('panel/footer', $data);
	}

	public function state()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - آمار'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/state', $data);
		$this->load->view('panel/footer', $data);
	}

	public function setting()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - تنظیمات'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/setting', $data);
		$this->load->view('panel/footer', $data);
	}

	public function message()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - پیام ها'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/message', $data);
		$this->load->view('panel/footer', $data);
	}

	public function profile()
	{
		$user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$user = $this->user_model->fetch_middle_name($user_id);

		redirect(base_url() . 'profile/' . $user);
	}

	public function out()
	{
		$this->session->set_userdata('user_id');
		$this->session->set_userdata('login');
		redirect(base_url() . 'web/login');
	}
}

?>