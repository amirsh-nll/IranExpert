<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Panel Controller
 * Date : 1395/08/27
 * Auther : A.shokri
 * Description : The Controller From Load Admin Panel Section.
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
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$data = array(
			'title'				=>	'پیشخوان - پنل مدیریت',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home', $data);
		$this->load->view('panel/footer', $data);
	}

	public function new_user($notice=0)
	{
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$data = array(
			'title'				=>	'پیشخوان - افزودن کاربر جدید',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/new_user', $data);
		$this->load->view('panel/footer', $data);
	}

	public function list_user($page=1)
	{
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('user_model');
		$user = $this->user_model->read_user_list();

		$data = array(
			'title'				=>	'پیشخوان - لیست کاربران',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'page'				=>	$page,
			'user'				=>	$user
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/list_user', $data);
		$this->load->view('panel/footer', $data);
	}
}
?>