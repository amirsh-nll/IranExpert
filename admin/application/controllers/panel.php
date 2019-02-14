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
			'title'				=>	'پنل مدیریت - پیشخوان',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home', $data);
		$this->load->view('panel/footer', $data);
	}

	public function new_user($notice=0)
	{
		$notice = xss_clean($notice);
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$data = array(
			'title'				=>	'پنل مدیریت - افزودن کاربر جدید',
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
		$page = xss_clean($page);
		if(!is_numeric($page))
		{
			redirect(base_url() . 'panel/list_user/1');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('user_model');
		$user 		= $this->user_model->read_user_list($page);
		if($user==0 && $page != 1)
		{
			redirect(base_url() . 'panel/list_user/1');
		}

		$user_count = $this->user_model->user_count();
		$page 		= $user_count / 10;
		if($page * 10 - 9 < $user_count)
		{
			$page+=1;
		}

		$i=0;
		$users = '';
		$this->load->model('login_model');

		foreach ($user as $my_user) {
			$users[$i] = array(
				'id'			=>	$my_user['id'],
				'middle_name'	=>	$my_user['middle_name'],
				'email'			=>	$my_user['email'],
				'last_login'	=>	$this->login_model->last_login($my_user['id'])
			);
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - لیست کاربران',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'page'				=>	$page,
			'user'				=>	$users,
			'page_count'		=>	$page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/list_user', $data);
		$this->load->view('panel/footer', $data);
	}

	public function view_user_information($middle_name='')
	{
		$middle_name = xss_clean($middle_name);
		if(empty($middle_name))
		{
			redirect(base_url() . 'panel/list_user');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('user_model');
		$user_id_for_read = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		$user  = $this->user_model->read_user($user_id_for_read);
		$email = $user[0]['email'];
		$status= $user[0]['status'];

		if($status==1)
		{
			$status="فعال";
		}
		else
		{
			$status='غیرفعال';
		}

		$type  = $user[0]['type'];
		if($type==1)
		{
			$type='مدیر';
		}
		else
		{
			$type='کاربر عادی';
		}

		$this->load->model('person_model');
		$person = $this->person_model->read_person($user_id_for_read);
		$person = $person[0];

		if(empty($person['first_name']) && empty($person['last_name']))
		{
			$full_name = "بدون نام";
		}
		else
		{
			$full_name = $person['first_name'] . $person['last_name'];
		}

		if(empty($person['birthday']))
		{
			$birthday = "&nbsp;";
		}
		else
		{
			$birthday = $person['birthday'];
		}

		$this->load->model('activity_model');
		$activity = $this->activity_model->fetch_activity_name($person['activity_id']);

		switch($person['marriage'])
		{
			case 0:{$marriage 	= "نامشخص";} break;
			case 1:{$marriage 	= "مجرد";} break;
			case 2:{$marriage 	= "متاهل";} break;
			default:{$marriage 	= "نامشخص";}
		}

		switch($person['gender'])
		{
			case 0:{
				$gender = "نامشخص";
				$title = "رزومه " . $person['first_name'] . $person['last_name'];
				$copyright = "آقا/خانم " . $person['first_name'] . $person['last_name'];
			} break;
			case 1:{
				$gender = "آقا";
				$title = "رزومه آقای " . $person['first_name'] . $person['last_name'];
				$copyright = "جناب آقای " . $person['first_name'] . $person['last_name'];
			} break;
			case 2:{
				$gender = "خانم";
				$title = "رزومه خانم " . $person['first_name'] . $person['last_name'];
				$copyright = "سرکار خانم " . $person['first_name'] . $person['last_name'];
			} break;
			default:{
				$gender = "نامشخص";
				$title = "رزومه " . $person['first_name'] . $person['last_name'];
				$copyright = "آقا/خانم " . $person['first_name'] . $person['last_name'];
			}
		}

		$webpage_url = $person['webpage_url'];

		if(empty($person['about']))
		{
			$about = "این صفحه رزومه آنلاین بنده می باشد.";
		}
		else
		{
			$about = $person['about'];
		}

		$this->load->model('contact_model');
		$contact = $this->contact_model->read_contact($user_id_for_read);
		$contact = $contact[0];

		if(empty($contact['mobile_number']))
		{
			$mobile = "نامشخص";
		}
		else
		{
			$mobile = $contact['mobile_number'];
		}

		if(empty($contact['phone_number']))
		{
			$phone = "نامشخص";
		}
		else
		{
			$phone = $contact['phone_number'];
		}

		if(empty($contact['postal_code']))
		{
			$postal_code = "نامشخص";
		}
		else
		{
			$postal_code = $contact['postal_code'];
		}

		$this->load->model('province_model');
		$province = $this->province_model->fetch_province_name($contact['province_id']);

		if($contact['city_name']=='')
		{
			$city = 'شهر:{نامشخص}';
		}
		else
		{
			$city = 'شهر:{' . $contact['city_name'] . '}';
		}

		if(empty($contact['address']))
		{
			$address = $province . ' / ' . $city;
		}
		else
		{
			$address = $province . ' / ' . $city . " / " . $contact['address'];
		}

		$this->load->model('certificate_model');
		$certificate = $this->certificate_model->certificate_status($user_id_for_read);
		if($certificate!=0)
		{
			$certificate = 'رسمی، اعتبار تا تاریخ:' . $this->jdf->jdate(" j / F / Y " ,$certificate);
		}
		else
		{
			$certificate = 'غیر رسمی';
		}

		$data = array(
			'title'				=>	'پنل مدیریت - نمایش اطلاعات کاربر',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'status'			=>	$status,
			'type'				=>	$type,
			'middle_name'		=>	$middle_name,
			'full_name'			=> 	$full_name,
			'birthday'			=>	$birthday,
			'activity'			=>	$activity,
			'marriage'			=>	$marriage,
			'gender'			=>	$gender,
			'webpage_url'		=>	$webpage_url,
			'about'				=>	$about,
			'email'				=>	$email,
			'mobile'			=>	$mobile,
			'phone'				=>	$phone,
			'postal_code'		=>	$postal_code,
			'address'			=>	$address,
			'certificate'		=>	$certificate
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/user_information', $data);
		$this->load->view('panel/footer', $data);
	}

	public function user_edit($middle_name='', $notice=0)
	{
		$middle_name = xss_clean($middle_name);
		$notice = xss_clean($notice);
		if(empty($middle_name))
		{
			redirect(base_url() . 'panel/list_user');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('user_model');
		$user_id_for_read = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		$user  = $this->user_model->read_user($user_id_for_read);
		$this->session->set_userdata('user_for_edit', $user_id_for_read);

		$this->load->model('person_model');
		$person = $this->person_model->read_person($user_id_for_read);
		$person = $person[0];
		$birthday = explode('/', $person['birthday']);

		$this->load->model('contact_model');
		$contact = $this->contact_model->read_contact($user_id_for_read);
		$contact = $contact[0];

		$this->load->model('province_model');
		$province = $this->province_model->read_all_province();

		$this->load->model('activity_model');
		$activity = $this->activity_model->read_all_activity($person['activity_id']);

		$data = array(
			'title'					=>	'پنل مدیریت - ویرایش اطلاعات کاربر',
			'url'					=>	base_url(),
			'message_unread'		=>	$message_unread,
			'middle_name_value'		=>	$middle_name,
			'first_name_value'		=> 	$person['first_name'],
			'last_name_value'		=> 	$person['last_name'],
			'birth_day_value'		=>	$birthday[2],
			'birth_month_value'		=>	$birthday[1],
			'birth_year_value'		=>	$birthday[0],
			'activity_id_value'		=>	$person['activity_id'],
			'marriage_value'		=>	$person['marriage'],
			'gender_value'			=>	$person['gender'],
			'about_value'			=>	$person['about'],
			'webpage_url_value'		=>	$person['webpage_url'],
			'mobile_number_value'	=>	$contact['mobile_number'],
			'phone_number_value'	=>	$contact['phone_number'],
			'postal_code_value'		=>	$contact['postal_code'],
			'province_id_value'		=>	$contact['province_id'],
			'city_name_value'		=>	$contact['city_name'],
			'address_value'			=>	$contact['address'],
			'notice'				=>	$notice,
			'province'				=>	$province,
			'activity'				=>	$activity
		);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/user_edit', $data);
		$this->load->view('panel/footer', $data);
	}

	public function user_ban($middle_name='', $notice=0)
	{
		$middle_name = xss_clean($middle_name);
		$notice = xss_clean($notice);
		if(empty($middle_name))
		{
			redirect(base_url() . 'panel/list_user');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('user_model');
		$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		$user = $this->user_model->read_user($user_id);
		$user = $user[0];
		$status = $user['status'];

		$user_id_for_read = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		$user  = $this->user_model->read_user($user_id_for_read);
		$this->session->set_userdata('user_for_edit', $user_id_for_read);

		$data = array(
			'title'				=>	'پنل مدیریت - وضعیت کاربر',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'middle_name'		=>	$middle_name,
			'status_value'		=>	$status,
			'notice'			=>	$notice
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/user_ban', $data);
		$this->load->view('panel/footer', $data);
	}

	public function user_message($middle_name='', $notice=0)
	{
		$middle_name = xss_clean($middle_name);
		$notice = xss_clean($notice);
		if(empty($middle_name))
		{
			redirect(base_url() . 'panel/list_user');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('user_model');
		$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		
		$user_id_for_read = $this->user_model->fetch_user_id_with_middle_name($middle_name);
		$user  = $this->user_model->read_user($user_id_for_read);
		$this->session->set_userdata('user_for_edit', $user_id_for_read);

		$data = array(
			'title'				=>	'پنل مدیریت - ارسال پیام',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'middle_name'		=>	$middle_name,
			'notice'			=>	$notice
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/user_message', $data);
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
		$message = $this->message_model->read_admin_message($user_id);
		$message_unread = $this->message_model->message_unread($user_id);

		$data = array(
			'title'				=>	'پنل مدیریت - پیام ها',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice,
			'message_item'		=>	$message
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/message', $data);
		$this->load->view('panel/footer', $data);
	}

	public function read_message($message_id=0, $notice=0)
	{
		$notice = xss_clean($notice);

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		if(!is_numeric($message_id) || $message_id==0 || !is_numeric($notice))
		{
			redirect(base_url() . 'panel/message');
		}

		$this->load->model('message_model');
		$message = $this->message_model->fetch_record_with_id($user_id, $message_id);
		$message_unread = $this->message_model->message_unread($user_id);

		if($message==0)
		{
			redirect(base_url() . 'panel/message');
		}

		$this->message_model->mark_read($user_id, $message_id);

		$data = array
		(
			'title'				=>	'پنل مدیریت - پیام ها',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice,
			'message_item'		=>	$message
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/read_message', $data);
		$this->load->view('panel/footer', $data);
	}

	public function report_message($message_id)
	{
		$message_id = xss_clean($message_id);
		if(is_numeric($message_id))
		{
			$user_id = $this->session->userdata('user_id');

			$this->load->model('message_model');
			$message = $this->message_model->ownership_message($user_id, $message_id);
			if($message==0)
			{
				redirect(base_url() . 'panel/message');
			}
			else
			{
				$this->message_model->report_message($user_id, $message_id);
				redirect(base_url() . 'panel/read_message/' . $message_id . '/1' . '#content_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/message');
		}
	}

	public function list_image($page=1, $notice=0)
	{
		$page = xss_clean($page);
		if(!is_numeric($page))
		{
			redirect(base_url() . 'panel/list_image/1');
		}
		$current_page = $page;
		$this->session->set_userdata('page', $page);

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('image_model');
		$image = $this->image_model->read_all_image($page);
		if($image==0 && $page != 1)
		{
			redirect(base_url() . 'panel/list_image/1');
		}

		$image_count = $this->image_model->image_count();
		$page 		 = $image_count / 9;
		if($page * 9 - 8 < $image_count)
		{
			$page+=1;
		}

		$this->load->model('user_model');
		$i = 0;

		foreach ($image as $my_image) {
			$images[$i]['middle_name'] 	= $this->user_model->fetch_middle_name_with_user_id($my_image['user_id']);
			$images[$i]['file_name']	= $my_image['file_name'];
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - لیست کاربران',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'images'			=>	$images,
			'notice'			=>	$notice,
			'page_count'		=>	$page,
			'current_page'		=>	$current_page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/list_image', $data);
		$this->load->view('panel/footer', $data);
	}

	public function delete_image($middle_name='')
	{
		$middle_name = xss_clean($middle_name);
		$page 		 = $this->session->userdata('page');
		if(!is_numeric($page) || $page < 0)
		{
			$page = 1;
		}
		
		if($middle_name=='')
		{
			redirect(base_url() . 'panel/list_image/' . $page . '/1#notice_view');
		}
		else
		{
			$this->load->model('user_model');
			$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);

			$this->load->model('image_model');
			$this->image_model->delete_image($user_id);

			redirect(base_url() . 'panel/list_image/' . $page . '/2#notice_view');
		}
	}

	public function report($report_number=0)
	{
		if(!is_numeric($report_number))
		{
			$report_number=0;
		}
		elseif($report_number < 0 || $report_number > 7)
		{
			$report_number=0;
		}

		$user_id = $this->session->userdata('user_id');
		$this->load->model('message_model');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->library('chart');

		$chart_1 = '';
		$chart_2 = '';
		$chart_3 = '';
		$chart_4 = '';
		$chart_5 = '';
		$chart_6 = '';
		$chart_7 = '';

		switch($report_number)
		{
			case 0:{
				$this->load->model('statistics_model');
				$statistics_1 = $this->statistics_model->read_main_website_statistics();
				$statistics_2 = $this->statistics_model->read_all_user_statistics();
				$this->load->model('user_model');
				$user_count = $this->user_model->user_count();
				$user_active_count = $this->user_model->user_active_count();
				$user_deactive_count = $this->user_model->user_deactive_count();
				$register_today = $this->user_model->register_today();
				$register_month = $this->user_model->register_month();
				$register_year = $this->user_model->register_year();
				$this->load->model('image_model');
				$all_image = $this->image_model->image_count();
				$all_default_image = $this->image_model->image_default_count();
				$all_undefault_image = $this->image_model->image_undefault_count();
				$this->load->model('login_model');
				$login_today = $this->login_model->login_today();
				$login_month = $this->login_model->login_month();
				$login_year = $this->login_model->login_year();
				$this->load->model('person_model');
				$birthday_today		= $this->person_model->birthday_today();
				$birthday_yesterday = $this->person_model->birthday_yesterday();
				$birthday_month 	= $this->person_model->birthday_month();
				$this->load->library('chart');
				$chart_1 = $this->chart->statistics_chart($statistics_1['today'], $statistics_1['yesterday'], $statistics_1['total']);
				$chart_2 = $this->chart->statistics_chart($statistics_2['today'], $statistics_2['yesterday'], $statistics_2['total']);
				$chart_3 = $this->chart->user_count_chart($user_deactive_count, $user_active_count, $user_count);
				$chart_4 = $this->chart->image_chart($all_image, $all_undefault_image, $all_default_image);
				$chart_5 = $this->chart->login_chart($login_today, $login_month, $login_year);
				$chart_6 = $this->chart->register_chart($register_today, $register_month, $register_year);
				$chart_7 = $this->chart->birthday_chart($birthday_today, $birthday_yesterday, $birthday_month);
			} break;
			case 1:{
				$this->load->model('statistics_model');
				$statistics_1 = $this->statistics_model->read_main_website_statistics();
				$chart_1 = $this->chart->statistics_chart($statistics_1['today'], $statistics_1['yesterday'], $statistics_1['total']);
			} break;
			case 2:{
				$this->load->model('statistics_model');
				$statistics_2 = $this->statistics_model->read_all_user_statistics();
				$chart_2 = $this->chart->statistics_chart($statistics_2['today'], $statistics_2['yesterday'], $statistics_2['total']);
			} break;
			case 3:{
				$this->load->model('user_model');
				$user_count = $this->user_model->user_count();
				$user_active_count = $this->user_model->user_active_count();
				$user_deactive_count = $this->user_model->user_deactive_count();
				$chart_3 = $this->chart->user_count_chart($user_deactive_count, $user_active_count, $user_count);
			} break;
			case 4:{
				$this->load->model('image_model');
				$all_image = $this->image_model->image_count();
				$all_default_image = $this->image_model->image_default_count();
				$all_undefault_image = $this->image_model->image_undefault_count();
				$chart_4 = $this->chart->image_chart($all_image, $all_undefault_image, $all_default_image);
			} break;
			case 5:{
				$this->load->model('login_model');
				$login_today = $this->login_model->login_today();
				$login_month = $this->login_model->login_month();
				$login_year = $this->login_model->login_year();
				$chart_5 = $this->chart->login_chart($login_today, $login_month, $login_year);
			} break;
			case 6:{
				$this->load->model('user_model');
				$register_today = $this->user_model->register_today();
				$register_month = $this->user_model->register_month();
				$register_year = $this->user_model->register_year();
				$chart_6 = $this->chart->register_chart($register_today, $register_month, $register_year);
			} break;
			case 7:{
				$this->load->model('person_model');
				$birthday_today		= $this->person_model->birthday_today();
				$birthday_yesterday = $this->person_model->birthday_yesterday();
				$birthday_month 	= $this->person_model->birthday_month();
				$chart_7 = $this->chart->birthday_chart($birthday_today, $birthday_yesterday, $birthday_month);
			} break;
			default:{redirect(base_url() . 'panel/report');}
		}

		$data = array
		(
			'url'				=>	base_url(),
			'title'				=>	'پنل مدیریت - گزارش های سایت',
			'chart_1'			=>	$chart_1,
			'chart_2'			=>	$chart_2,
			'chart_3'			=>	$chart_3,
			'chart_4'			=>	$chart_4,
			'chart_5'			=>	$chart_5,
			'chart_6'			=>	$chart_6,
			'chart_7'			=>	$chart_7,
			'report_section'	=>	$report_number,
			'message_unread'	=>	$message_unread
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/report', $data);
		$this->load->view('panel/footer', $data);
	}

	public function activity($page=1, $notice=0)
	{
		$notice = xss_clean($notice);
		$page 	= xss_clean($page);
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('activity_model');
		$activity = $this->activity_model->read_activity_list($page);
		
		if($activity==0 && $page != 1)
		{
			redirect(base_url() . 'panel/activity/1');
		}

		$activity_count = $this->activity_model->activity_count();
		$page 			= $activity_count / 10;
		if($page * 10 - 9 < $activity_count)
		{
			$page+=1;
		}

		$i=0;
		$activities = '';

		foreach ($activity as $my_activity) {
			$activities[$i] = array(
				'id'		=>	$my_activity['id'],
				'name'		=>	$my_activity['name']
			);
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - زمینه فعالیت',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice,
			'activity'			=>	$activities,
			'page'				=>	$page,
			'page_count'		=>	$page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/activity', $data);
		$this->load->view('panel/footer', $data);
	}

	public function activity_edit($activity_id='', $notice=0)
	{
		$activity_id = xss_clean($activity_id);
		$notice = xss_clean($notice);
		if(empty($activity_id))
		{
			redirect(base_url() . 'panel/activity');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('activity_model');
		$activity = $this->activity_model->read_once_activity($activity_id);
		$this->session->set_userdata('activity_id_for_edit', $activity['id']);

		$data = array(
			'title'					=>	'پنل مدیریت - ویرایش زمینه فعالیت',
			'url'					=>	base_url(),
			'message_unread'		=>	$message_unread,
			'notice'				=>	$notice,
			'activity_name_value'	=>	$activity['name']
		);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/activity_edit', $data);
		$this->load->view('panel/footer', $data);
	}

	public function delete_activity($activity_id=0)
	{
		$activity_id = xss_clean($activity_id);

		if($activity_id==0 || $activity_id==1 || !is_numeric($activity_id))
		{
			redirect(base_url() . 'panel/activity');
		}

		$this->load->model('person_model');
		$person = $this->person_model->activity_id_free($activity_id);

		$this->load->model('activity_model');
		$activity = $this->activity_model->delete_activity($activity_id);

		if($activity==0)
		{
			redirect(base_url() . 'panel/activity/1/3#retrive_data_table');
		}
		else
		{
			redirect(base_url() . 'panel/activity/1/4#retrive_data_table');
		}
	}

	public function province($page=1, $notice=0)
	{
		$notice = xss_clean($notice);
		$page 	= xss_clean($page);
		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('province_model');
		$province = $this->province_model->read_province_list($page);
		
		if($province==0 && $page != 1)
		{
			redirect(base_url() . 'panel/province/1');
		}

		$province_count = $this->province_model->province_count();
		$page 			= $province_count / 10;
		if($page * 10 - 9 < $province_count)
		{
			$page+=1;
		}

		$i=0;
		$provinces = '';

		foreach ($province as $my_province) {
			$provinces[$i] = array(
				'id'		=>	$my_province['id'],
				'name'		=>	$my_province['name']
			);
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - استان ها',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice,
			'province'			=>	$provinces,
			'page'				=>	$page,
			'page_count'		=>	$page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/province', $data);
		$this->load->view('panel/footer', $data);
	}

	public function province_edit($province_id='', $notice=0)
	{
		$province_id = xss_clean($province_id);
		$notice = xss_clean($notice);
		if(empty($province_id))
		{
			redirect(base_url() . 'panel/province');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('province_model');
		$province = $this->province_model->read_once_province($province_id);
		$this->session->set_userdata('province_id_for_edit', $province['id']);

		$data = array(
			'title'					=>	'پنل مدیریت - ویرایش زمینه فعالیت',
			'url'					=>	base_url(),
			'message_unread'		=>	$message_unread,
			'notice'				=>	$notice,
			'province_name_value'	=>	$province['name']
		);

		$this->load->view('panel/header', $data);
		$this->load->view('panel/province_edit', $data);
		$this->load->view('panel/footer', $data);
	}

	public function delete_province($province_id=0)
	{
		$province_id = xss_clean($province_id);

		if($province_id==0 || $province_id==1 || !is_numeric($province_id))
		{
			redirect(base_url() . 'panel/province');
		}

		$this->load->model('contact_model');
		$contact = $this->contact_model->province_id_free($province_id);

		$this->load->model('province_model');
		$province = $this->province_model->delete_province($province_id);

		if($province==0)
		{
			redirect(base_url() . 'panel/province/1/3#retrive_data_table');
		}
		else
		{
			redirect(base_url() . 'panel/province/1/4#retrive_data_table');
		}
	}

	public function slideshow($notice=0)
	{
		$notice = xss_clean($notice);

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);

		$this->load->model('slideshow_model');
		$slideshow = $this->slideshow_model->read_slideshow();

		$data = array(
			'title'				=>	'پنل مدیریت - اسلایدشو',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'notice'			=>	$notice,
			'slideshow_item'	=>	$slideshow
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/slideshow', $data);
		$this->load->view('panel/footer', $data);
	}

	public function delete_slideshow($slideshow_id=0)
	{
		$slideshow_id = xss_clean($slideshow_id);

		if($slideshow_id==0)
		{
			redirect(base_url() . 'panel/slideshow/4#slideshow_item');
		}
		else
		{
			$this->load->model('slideshow_model');
			$this->slideshow_model->delete_slideshow($slideshow_id);

			redirect(base_url() . 'panel/slideshow/5#slideshow_item');
		}
	}

	public function certificate($page=1)
	{
		$page = xss_clean($page);
		if(!is_numeric($page))
		{
			redirect(base_url() . 'panel/certificate/1');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('certificate_model');
		$certificate = $this->certificate_model->read_certificate_list($page);
		if($certificate==0 && $page != 1)
		{
			redirect(base_url() . 'panel/certificate/1');
		}

		$certificate_count  = $this->certificate_model->certificate_count();
		$page 				= $certificate_count / 10;
		if($page * 10 - 9 < $certificate_count)
		{
			$page+=1;
		}

		$i=0;
		$certificates='';
		$this->load->model('user_model');

		foreach ($certificate as $my_certificate) {
			$certificates[$i] = array(
				'middle_name'	=>	$this->user_model->fetch_middle_name_with_user_id($my_certificate['user_id']),
				'id'			=>	$my_certificate['id'],
				'status'		=>	$my_certificate['status'],
				'identity_1'	=>	$my_certificate['identity_1'],
				'identity_2'	=>	$my_certificate['identity_2'],
				'start_date'	=>	$my_certificate['start_date'],
				'end_date'	=>	$my_certificate['end_date']
			);
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - مجوزهای رسمیت',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'page'				=>	$page,
			'certificate'		=>	$certificates,
			'page_count'		=>	$page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/certificate', $data);
		$this->load->view('panel/footer', $data);
	}

	public function certificate_manage($certificate_id='', $notice=0)
	{
		$certificate_id = xss_clean($certificate_id);
		$notice = xss_clean($notice);
		if(empty($certificate_id))
		{
			redirect(base_url() . 'panel/certificate');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('certificate_model');
		$certificate = $this->certificate_model->read_certificate_status($certificate_id);
		$this->session->set_userdata('certificate_id', $certificate['id']);

		if($certificate==0)
		{
			redirect(base_url() . 'panel/certificate');
		}

		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name_with_user_id($certificate['user_id']);

		$data = array(
			'title'				=>	'پنل مدیریت - مدیریت مجوز رسمیت',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'middle_name'		=>	$middle_name,
			'certificate'		=>	$certificate,
			'notice'			=>	$notice
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/certificate_manage', $data);
		$this->load->view('panel/footer', $data);
	}

	public function violation_accont($page=1)
	{
		$page = xss_clean($page);
		if(!is_numeric($page))
		{
			redirect(base_url() . 'panel/violation_accont/1');
		}

		$this->load->model('message_model');
		$user_id 		= $this->session->userdata('user_id');
		$message_unread = $this->message_model->message_unread($user_id);
		
		$this->load->model('violation_model');
		$violation = $this->violation_model->read_violation_list($page);
		if($violation==0 && $page != 1)
		{
			redirect(base_url() . 'panel/violation_accont/1');
		}

		$violation_count  = $this->violation_model->violation_count();
		$page 				= $violation_count / 10;
		if($page * 10 - 9 < $violation_count)
		{
			$page+=1;
		}

		$i=0;
		$violations='';
		$this->load->model('user_model');

		foreach ($violation as $my_violation) {
			$violations[$i] = array(
				'middle_name'	=>	$this->user_model->fetch_middle_name_with_user_id($my_violation['user_id']),
				'id'			=>	$my_violation['id'],
				'reason'		=>	$my_violation['reason'],
				'type'			=>	$my_violation['type']
			);
			$i+=1;
		}

		$data = array(
			'title'				=>	'پنل مدیریت - مجوزهای رسمیت',
			'url'				=>	base_url(),
			'message_unread'	=>	$message_unread,
			'page'				=>	$page,
			'violation'			=>	$violations,
			'page_count'		=>	$page
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/violation_accont', $data);
		$this->load->view('panel/footer', $data);
	}

	public function out()
	{
		$this->session->set_userdata('user_id');
		$this->session->set_userdata('admin_login');
		redirect(base_url() . 'login');
	}
}
?>