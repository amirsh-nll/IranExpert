<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Panel Controller
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

		$this->load->model('page_model');
		$user_panel_content = $this->page_model->read_page(3);

		$data = array
		(
			'url'				=>base_url(),
			'title'				=>'پنل کاربری - پیشخوان',
			'message_unread'	=>	$this->message_unread_count(),
			'reminder_count'	=>	$this->reminder_count(),
			'user_panel_content'=>	$user_panel_content['content']
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
			'message_unread'	=>	$this->message_unread_count(),
			'active_image'		=>	$image['file_name'],
			'key'				=>	do_hash($user_id, 'md5'),
			'reminder_count'	=>	$this->reminder_count()
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

		$this->load->model('activity_model');
		$activity = $this->activity_model->read_all_activity();
		
		$birthday = explode('/', $person['birthday']);
		
		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - اطلاعات فردی',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'first_name_value'	=>	$person['first_name'],
			'last_name_value'	=>	$person['last_name'],
			'birth_day_value'	=>	$birthday[2],
			'birth_month_value'	=>	$birthday[1],
			'birth_year_value'	=>	$birthday[0],
			'activity_id_value'	=>	$person['activity_id'],
			'gender_value'		=>	$person['gender'],
			'marriage_value'	=>	$person['marriage'],
			'webpage_url_value'	=>	$person['webpage_url'],
			'about_value'		=>	$person['about'],
			'activity'			=>	$activity,
			'reminder_count'	=>	$this->reminder_count()
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

		$this->load->model('province_model');
		$province = $this->province_model->read_all_province();
		
		$data = array
		(
			'url'					=>	base_url(),
			'title'					=>	'پنل کاربری - اطلاعات تماس',
			'notice'				=>	$notice,
			'message_unread'		=>	$this->message_unread_count(),
			'email_value'			=>	$contact['email'],
			'mobile_number_value'	=>	$contact['mobile_number'],
			'phone_number_value'	=>	$contact['phone_number'],
			'postal_code_value'		=>	$contact['postal_code'],
			'province_id_value'		=>	$contact['province_id'],
			'city_name_value'		=>	$contact['city_name'],
			'address_value'			=>	$contact['address'],
			'province'				=>	$province,
			'reminder_count'	=>	$this->reminder_count()
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
			'message_unread'	=>	$this->message_unread_count(),
			'lesson_item'		=>	$lesson,
			'reminder_count'	=>	$this->reminder_count()
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
			'message_unread'	=>	$this->message_unread_count(),
			'lesson_item'		=>	$lesson,
			'reminder_count'	=>	$this->reminder_count()
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - اطلاعات شغلی',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'job_item'			=>	$job,
			'reminder_count'	=>	$this->reminder_count()
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
			'message_unread'	=>	$this->message_unread_count(),
			'job_item'			=>	$job,
			'reminder_count'	=>	$this->reminder_count()
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - توانایی ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'ability_item'		=>	$ability,
			'reminder_count'	=>	$this->reminder_count()
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
			'message_unread'	=>	$this->message_unread_count(),
			'ability_item'		=>	$ability,
			'reminder_count'	=>	$this->reminder_count()
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - پروژه ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'project_item'		=>	$project,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/project', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_project($project_id = 0, $notice = 0)
	{
		$project_id = xss_clean($project_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($project_id) || $project_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/project');
		}

		$this->load->model('project_model');
		$project = $this->project_model->fetch_record_with_id($user_id, $project_id);

		if($project==0)
		{
			redirect(base_url() . 'panel/project');
		}

		$this->session->set_userdata('project_id_for_update', $project_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش پروژه ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'project_item'		=>	$project,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_project', $data);
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - مقالات',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'article_item'		=>	$article,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/article', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_article($article_id = 0, $notice = 0)
	{
		$article_id = xss_clean($article_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($article_id) || $article_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/article');
		}

		$this->load->model('article_model');
		$article = $this->article_model->fetch_record_with_id($user_id, $article_id);

		if($article==0)
		{
			redirect(base_url() . 'panel/article');
		}

		$this->session->set_userdata('article_id_for_update', $article_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش مقالات',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'article_item'		=>	$article,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_article', $data);
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
			'message_unread'	=>	$this->message_unread_count(),
			'achievement_item'	=>	$achievement,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/achievement', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_achievement($achievement_id = 0, $notice = 0)
	{
		$achievement_id = xss_clean($achievement_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($achievement_id) || $achievement_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/achievement');
		}

		$this->load->model('achievement_model');
		$achievement = $this->achievement_model->fetch_record_with_id($user_id, $achievement_id);

		if($achievement==0)
		{
			redirect(base_url() . 'panel/achievement');
		}

		$this->session->set_userdata('achievement_id_for_update', $achievement_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش افتخارات',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'achievement_item'	=>	$achievement,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_achievement', $data);
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - علاقه مندی',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'favorite_item'		=>	$favorite,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/favorite', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_favorite($favorite_id = 0, $notice = 0)
	{
		$favorite_id = xss_clean($favorite_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($favorite_id) || $favorite_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/favorite');
		}

		$this->load->model('favorite_model');
		$favorite = $this->favorite_model->fetch_record_with_id($user_id, $favorite_id);

		if($favorite==0)
		{
			redirect(base_url() . 'panel/favorite');
		}

		$this->session->set_userdata('favorite_id_for_update', $favorite_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش علاقه مندی ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'favorite_item'		=>	$favorite,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_favorite', $data);
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
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - شبکه های اجتماعی',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'social_item'		=>	$social,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/social', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_social($social_id = 0, $notice = 0)
	{
		$social_id = xss_clean($social_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($social_id) || $social_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/social');
		}

		$this->load->model('social_model');
		$social = $this->social_model->fetch_record_with_id($user_id, $social_id);

		if($social==0)
		{
			redirect(base_url() . 'panel/social');
		}

		$this->session->set_userdata('social_id_for_update', $social_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش شبکه های اجتماعی',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'social_item'		=>	$social,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_social', $data);
		$this->load->view('panel/footer', $data);
	}

	public function statistics()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('statistics_model');
		$statistics = $this->statistics_model->read_statistics($user_id);

		$this->load->library('chart');
		$chart = $this->chart->statistics_chart($statistics['today'], $statistics['yesterday'], $statistics['total']);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - آمار',
			'chart'				=>	$chart,
			'message_unread'	=>	$this->message_unread_count(),
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/statistics', $data);
		$this->load->view('panel/footer', $data);
	}

	public function setting($notice=0)
	{
		$notice = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - تنظیمات',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'middle_name_value'	=>	$middle_name,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/setting', $data);
		$this->load->view('panel/footer', $data);
	}

	public function suspend_accont($notice=0)
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
		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - انسداد حساب کاربری',
			'notice'			=>	$notice,
			'captcha'			=>	$cap,
			'message_unread'	=>	$this->message_unread_count(),
			'reminder_count'	=>	$this->reminder_count()
		);

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/suspend_accont', $data);
		$this->load->view('panel/footer', $data);
	}

	public function message($notice=0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/message');
		}

		$this->load->model('message_model');
		$message = $this->message_model->read_message($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - پیام ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'message_item'		=>	$message,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/message', $data);
		$this->load->view('panel/footer', $data);
	}

	public function read_message($message_id=0, $notice=0)
	{

		$message_id = xss_clean($message_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($message_id) || $message_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/message');
		}

		$this->load->model('message_model');
		$message = $this->message_model->fetch_record_with_id($user_id, $message_id);

		if($message==0)
		{
			redirect(base_url() . 'panel/message');
		}

		$this->message_model->mark_read($user_id, $message_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - مشاهده پیام',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'message_item'		=>	$message,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/read_message', $data);
		$this->load->view('panel/footer', $data);
	}

	public function certificate($notice=0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/certificate');
		}

		$this->load->model('certificate_model');
		$certificate = $this->certificate_model->certificate_status($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - رسمی کردن پروفایل',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'certificate_status'=>	$certificate,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/certificate', $data);
		$this->load->view('panel/footer', $data);
	}

	public function reminder($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		if(!is_numeric($notice))
		{
			redirect(base_url() . 'panel/reminder');
		}

		$this->load->model('reminder_model');
		$reminder = $this->reminder_model->read_reminder($user_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - یادآور ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'reminder_item'		=>	$reminder,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/reminder', $data);
		$this->load->view('panel/footer', $data);
	}

	public function update_reminder($reminder_id = 0, $notice = 0)
	{
		$reminder_id = xss_clean($reminder_id);
		$notice 	= xss_clean($notice);
		$user_id 	= $this->session->userdata('user_id');

		if(!is_numeric($reminder_id) || $reminder_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/reminder');
		}

		$this->load->model('reminder_model');
		$reminder = $this->reminder_model->fetch_record_with_id($user_id, $reminder_id);

		if($reminder==0)
		{
			redirect(base_url() . 'panel/reminder');
		}

		$this->session->set_userdata('reminder_id_for_update', $reminder_id);

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل کاربری - ویرایش یادآور ها',
			'notice'			=>	$notice,
			'message_unread'	=>	$this->message_unread_count(),
			'reminder_item'		=>	$reminder,
			'reminder_count'	=>	$this->reminder_count()
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/update_reminder', $data);
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
		redirect(base_url() . 'login');
	}

	private function message_unread_count()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('message_model');
		$message_unread = $this->message_model->message_unread($user_id);
		return $message_unread;
	}
	private function reminder_count()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('reminder_model');
		$reminder_count = $this->reminder_model->reminder_count($user_id);
		return $reminder_count;
	}
}

?>