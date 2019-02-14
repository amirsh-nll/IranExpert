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
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - پیشخوان',
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home', $data);
		$this->load->view('panel/footer', $data);
	}

	public function image($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

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

	public function contact()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - اطلاعات تماس'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/contact', $data);
		$this->load->view('panel/footer', $data);
	}
	
	public function lesson($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		$this->load->model('lesson_model');
		$lesson = $this->lesson_model->load_lesson($user_id);

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

	public function job($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		$this->load->model('job_model');
		$job = $this->job_model->load_job($user_id);

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

	public function favorite($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		$this->load->model('favorite_model');
		$favorite = $this->favorite_model->load_favorite($user_id);

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

	public function ability($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		$this->load->model('ability_model');
		$ability = $this->ability_model->load_ability($user_id);

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

	public function social($notice = 0)
	{
		$notice  = xss_clean($notice);
		$user_id = $this->session->userdata('user_id');

		$this->load->model('social_model');
		$social = $this->social_model->load_social($user_id);

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
		$user = $this->user_model->user_middle_name($user_id);

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