<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 2016/10/30
 * Auther : A.shokri
 * Description : The Controller From Load User Panel.
 *
*/

class panel extends IREX_Controller
{
	public function index($page = 0)
	{
		$this->home();
	}

	public function home()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - پیشخوان'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home', $data);
		$this->load->view('panel/footer', $data);
	}

	public function person()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - اطلاعات فردی'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/person', $data);
		$this->load->view('panel/footer', $data);
	}
	
	public function lesson()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - اطلاعات تحصیلی'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/lesson', $data);
		$this->load->view('panel/footer', $data);
	}

	public function job()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - اطلاعات شغلی'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/job', $data);
		$this->load->view('panel/footer', $data);
	}

	public function favorite()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - علاقه مندی ها'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/favorite', $data);
		$this->load->view('panel/footer', $data);
	}

	public function ability()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - توانایی ها'
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/ability', $data);
		$this->load->view('panel/footer', $data);
	}

	public function social()
	{
		$data = array
		(
			'url'=>base_url(),
			'title'=>'پنل کاربری - شبکه های اجتماعی'
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
		
	}

	public function out()
	{
		$this->session->set_userdata('user_id');
		$this->session->set_userdata('login');
		redirect(base_url() . 'web/login');
	}
}

?>