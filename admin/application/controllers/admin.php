<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Admin Controller
 * Date : 1395/08/27
 * Auther : A.shokri
 * Description : The Controller From Load Admin Section.
 *
*/

class admin extends CI_Controller
{
	public function index()
	{
		redirect(base_url() . 'panel/index');
	}

	public function new_user()
	{
		$rules = array(
			array(
				'field'		=>	'email',
				'label'		=>	'ایمیل',
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
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/new_user/1');
		}
		else
		{
			$email 			= $this->input->post('email', true);
			$password 		= $this->input->post('password', true);
			$middle_name 	= explode('@', $email);

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

			redirect(base_url() . 'panel/new_user/2');
		}
	}

	public function user_edit()
	{
		$rules = array(
			array(
				'field'		=>	'middle_name_user',
				'label'		=>	'نام کاربری',
				'rules'		=>	'required|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'email_user',
				'label'		=>	'ایمیل',
				'rules'		=>	'required|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_first_name',
				'label'		=>	'نام',
				'rules'		=>	'min_length[2]|max_length[50]',
				'errors'	=>	array(
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_last_name',
				'label'		=>	'نام خانوادگی',
				'rules'		=>	'min_length[2]|max_length[50]',
				'errors'	=>	array(
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_day',
				'label'		=>	'روز تولد',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_month',
				'label'		=>	'ماه تولد',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_year',
				'label'		=>	'سال تولد',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_activity_id',
				'label'		=>	'زمینه فعالیت',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_gender',
				'label'		=>	'جنسیت',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_marriage',
				'label'		=>	'وضعیت تاهل',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'webpage_url',
				'label'		=>	'وبلاگ/وبسایت',
				'rules'		=>	'prep_url|min_length[5]|max_length[500]',
				'errors'	=>	array(
					'prep_url'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_about',
				'label'		=>	'درباره من',
				'rules'		=>	'max_length[1000]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_general_email',
				'label'		=>	'ایمیل عمومی',
				'rules'		=>	'max_length[70]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_mobile_number',
				'label'		=>	'همراه',
				'rules'		=>	'numeric|min_length[10]|max_length[20]',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_phone_number',
				'label'		=>	'تلفن تماس',
				'rules'		=>	'numeric|min_length[6]|max_length[20]',
					'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_postal_code',
				'label'		=>	'کد پستی',
				'rules'		=>	'numeric|min_length[9]|max_length[20]',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_province_id',
				'label'		=>	'استان',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_city_name',
				'label'		=>	'نام شهر',
				'rules'		=>	'min_length[2]|max_length[50]',
				'errors'	=>	array(
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_address',
				'label'		=>	'آدرس',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'new_password',
				'label'		=>	'رمز عبور',
				'rules'		=>	'min_length[5]|max_length[40]',
				'errors'	=>	array(
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);
		$user_id = $this->session->userdata('user_for_edit');
		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name_with_user_id($user_id);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/user_edit/' . $middle_name . '/1#notice_view');
		}
		else
		{
			$new_middle_name	=   $this->input->post('middle_name_user', true);
			$new_email			=   $this->input->post('email_user', true);
			$first_name 		= 	$this->input->post('person_first_name', true);
			$last_name 			= 	$this->input->post('person_last_name', true);
			$birthday 			= 	$this->input->post('person_birth_year', true) . '/' . $this->input->post('person_birth_month', true) . '/' . $this->input->post('person_birth_day', true);
			$activity_id		= 	$this->input->post('person_activity_id', true);
			$gender 			= 	$this->input->post('person_gender', true);
			$marriage 			= 	$this->input->post('person_marriage', true);
			$webpage_url 		=	$this->input->post('webpage_url', true);
			$about 				=	$this->input->post('person_about', true);
			$general_email		= 	$this->input->post('contact_general_email', true);
			$mobile_number 		= 	$this->input->post('contact_mobile_number', true);
			$phone_number 		= 	$this->input->post('contact_phone_number', true);
			$postal_code 		= 	$this->input->post('contact_postal_code', true);
			$province_id		= 	$this->input->post('contact_province_id', true);
			$city_name 			= 	$this->input->post('contact_city_name', true);
			$address 			= 	$this->input->post('contact_address', true);
			$new_password 		=	ltrim(rtrim($this->input->post('new_password', true)));

			$this->load->model('person_model');
			$this->person_model->update_person($user_id, $first_name, $last_name, $birthday, $activity_id, $gender, $marriage, $webpage_url, $about);

			$this->load->model('contact_model');
			$this->contact_model->update_contact($user_id, $general_email, $mobile_number, $phone_number, $postal_code, $province_id, $city_name, $address);

			$new_middle_name_change = $this->user_model->change_middle_name($user_id, $new_middle_name);
			$this->user_model->change_email($user_id, $new_email);

			if($new_password!='')
			{
				$this->user_model->change_user_password($user_id, $new_password);
			}

			redirect(base_url() . 'panel/user_edit/' . $new_middle_name_change . '/2#notice_view');
		}
	}

	public function user_ban()
	{
		$rules = array(
			array(
				'field'		=>	'user_status',
				'label'		=>	'وضعیت',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);
		$user_id = $this->session->userdata('user_for_edit');
		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name_with_user_id($user_id);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/user_ban/' . $middle_name . '/1');
		}
		else
		{
			$status = $this->input->post('user_status', true);
			if($status==1)
			{
				$this->user_model->unsuspend_user($user_id);
			}
			else
			{
				$this->user_model->suspend_user($user_id);
			}
			redirect(base_url() . 'panel/user_ban/' . $middle_name . '/2');
		}
	}

	public function user_message()
	{
		$rules = array(
			array(
				'field'		=>	'title',
				'label'		=>	'موضوع پیام',
				'rules'		=>	'required|min_length[3]|max_length[100]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
				),
			array(
				'field'		=>	'message',
				'label'		=>	'پیام شما',
				'rules'		=>	'required|min_length[5]|max_length[2000]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
				)
		);

		$this->form_validation->set_rules($rules);
		$user_id = $this->session->userdata('user_for_edit');
		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name_with_user_id($user_id);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/user_message/' . $middle_name . '/1');
		}
		else
		{
			$title 	= $this->input->post('title',true);
			$message= $this->input->post('message',true);
			$this->load->model('message_model');
			$message = $this->message_model->insert_message($user_id, $title, $message);
			if($message==1)
			{
				redirect(base_url() . 'panel/user_message/' . $middle_name . '/2');
			}
			else
			{
				redirect(base_url() . 'panel/user_message/' . $middle_name . '/1');
			}
		}
	}

	public function insert_activity()
	{
		$rules = array(
			array(
				'field'		=>	'activity',
				'label'		=>	'زمینه فعالیت',
				'rules'		=>	'required|min_length[2]|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/activity/1/1');
		}
		else
		{
			$activity = $this->input->post('activity', true);

			$this->load->model('activity_model');
			$this->activity_model->insert_activity($activity);

			redirect(base_url() . 'panel/activity/1/2');
		}
	}

	public function edit_activity()
	{
		$rules = array(
			array(
				'field'		=>	'activity',
				'label'		=>	'زمینه فعالیت',
				'rules'		=>	'required|min_length[2]|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/activity/1/1');
		}
		else
		{
			$activity_id	= $this->session->userdata('activity_id_for_edit');
			$activity_name 	= $this->input->post('activity', true);

			$this->load->model('activity_model');
			$this->activity_model->update_activity($activity_id, $activity_name);

			redirect(base_url() . 'panel/activity/1/2');
		}
	}

	public function insert_province()
	{
		$rules = array(
			array(
				'field'		=>	'province',
				'label'		=>	'نام استان',
				'rules'		=>	'required|min_length[2]|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/province/1/1');
		}
		else
		{
			$province = $this->input->post('province', true);

			$this->load->model('province_model');
			$this->province_model->insert_province($province);

			redirect(base_url() . 'panel/province/1/2');
		}
	}

	public function edit_province()
	{
		$rules = array(
			array(
				'field'		=>	'province',
				'label'		=>	'نام استان',
				'rules'		=>	'required|min_length[2]|max_length[70]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/province/1/1');
		}
		else
		{
			$province_id	= $this->session->userdata('province_id_for_edit');
			$province_name 	= $this->input->post('province', true);

			$this->load->model('province_model');
			$this->province_model->update_province($province_id, $province_name);

			redirect(base_url() . 'panel/province/1/2');
		}
	}

	public function new_slideshow()
	{
        $rules = array(
			array(
				'field'		=>	'title',
				'label'		=>	'عنوان اسلاید',
				'rules'		=>	'max_length[70]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/slideshow/1#content_view');
		}
		else
		{
			$config['upload_path']          = '../upload/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 7500;
	        $config['max_width']            = 950;
	        $config['max_height']           = 450;
			$this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('userfile'))
	        {
	        	$error = array('error' => $this->upload->display_errors());
				redirect(base_url() . 'panel/slideshow/1#content_view');
	        }
	        else
	        {
	        	$data 			= array('upload_data' => $this->upload->data());
	        	$title			= $this->input->post('title', true);
	        	$description 	= $this->agent->agent_string() . '// IP:' . $this->input->ip_address();
	        	$this->load->model('slideshow_model');
	        	$slideshow = $this->slideshow_model->insert_slideshow($this->upload->data('file_name'), $title, $description);

	        	if($slideshow==0)
	        	{
	        		redirect(base_url() . 'panel/slideshow/3#content_view');
	        	}
	        	else
	        	{
	        		redirect(base_url() . 'panel/slideshow/2#content_view');
	        	}
	        }
		}
	}

	public function certificate_manage()
	{
		$rules = array(
			array(
				'field'		=>	'certificate_status',
				'label'		=>	'وضعیت',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);
		$certificate_id = $this->session->userdata('certificate_id');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/certificate_manage/' . $certificate_id . '/1');
		}
		else
		{
			$status = $this->input->post('certificate_status', true);
			if($status==1 || $status==0)
			{
				$this->load->model('certificate_model');
				$this->certificate_model->certificate_status_change($certificate_id, $status);
				redirect(base_url() . 'panel/certificate_manage/' . $certificate_id . '/2');
			}
			else
			{
				redirect(base_url() . 'panel/certificate_manage/' . $certificate_id . '/1');
			}
		}
	}

	public function search_user()
	{
		$rules = array(
			array(
				'field'		=>	'search',
				'label'		=>	'جستجو کاربر',
				'rules'		=>	'max_length[70]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/list_user');
		}
		else
		{
			$search = $this->input->post('search', true);
			$this->load->model('user_model');
			$user = $this->user_model->search_user($search);
			
			$this->load->model('message_model');
			$user_id 		= $this->session->userdata('user_id');
			$message_unread = $this->message_model->message_unread($user_id);

			$this->load->model('reminder_model');
			$reminder_count = $this->reminder_model->reminder_count($user_id);

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

			$users = $this->sort->array_sort($users, 'last_login', SORT_DESC);

			$data = array(
				'title'				=>	'پنل مدیریت - جستجو کاربران',
				'url'				=>	base_url(),
				'message_unread'	=>	$message_unread,
				'user'				=>	$users,
				'reminder_count'	=>	$reminder_count
			);
			$this->load->view('panel/header', $data);
			$this->load->view('panel/search_user', $data);
			$this->load->view('panel/footer', $data);
		}
	}

	public function broadcast_message()
	{
		$rules = array(
			array(
				'field'		=>	'type',
				'label'		=>	'گروه دریافت کننده',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'	=>	'فیلد %s معتبر نمی باشد.',
					'numeric'	=>	'فیلد %s معتبر نمی باشد.'
					)
				),
			array(
				'field'		=>	'province_id',
				'label'		=>	'استان',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'activity_id',
				'label'		=>	'زمینه فعالیت',
				'rules'		=>	'numeric',
				'errors'	=>	array(
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'title',
				'label'		=>	'موضوع پیام',
				'rules'		=>	'required|min_length[3]|max_length[100]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
				),
			array(
				'field'		=>	'message',
				'label'		=>	'پیام شما',
				'rules'		=>	'required|min_length[5]|max_length[2000]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
					)
				)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/broadcast_message/1');
		}
		else
		{
			$type 		= $this->input->post('type',true);
			$activity_id= $this->input->post('activity_id',true);
			$province_id= $this->input->post('province_id',true);
			$title 		= $this->input->post('title',true);
			$message 	= $this->input->post('message',true);
			$this->load->model('message_model');

			switch ($type) {
				case 1:
					{
						$this->load->model('user_model');
						$user = $this->user_model->read_all_user();
						if($user!==0)
						{
							$count=0;
							foreach ($user as $my_user) {
								$message = $this->message_model->insert_message($my_user['id'], $title, $message, 'BroadCast Message By Admin');
								$count+=1;
							}
							$this->load->model('broadcast_model');
								$this->broadcast_model->insert_broadcast($count, $type . '/0', $title, $message);

							redirect(base_url() . 'panel/broadcast_message/2');
						}
						else
						{
							redirect(base_url() . 'panel/broadcast_message/3');
						}
					}
					break;
				case 2:
					{
						if($activity_id!=0)
						{
							$this->load->model('person_model');
							$person = $this->person_model->person_special_activity($activity_id);
							if($person!==0)
							{
								$count=0;
								foreach ($person as $my_person) {
									$message = $this->message_model->insert_message($my_person['user_id'], $title, $message, 'BroadCast Message By Admin');
									$count+=1;
								}
								$this->load->model('broadcast_model');
								$this->broadcast_model->insert_broadcast($count, $type . '/' . $activity_id, $title, $message);

								redirect(base_url() . 'panel/broadcast_message/2');
							}
							else
							{
								redirect(base_url() . 'panel/broadcast_message/3');
							}
						}
					}
					break;
				case 3:
					{
						if($province_id!=0)
						{
							$this->load->model('contact_model');
							$contact = $this->contact_model->contact_special_province($province_id);
							if($contact!==0)
							{
								$count=0;
								foreach ($contact as $my_contact) {
									$message = $this->message_model->insert_message($my_contact['user_id'], $title, $message, 'BroadCast Message By Admin');
									$count+=1;
								}
								$this->load->model('broadcast_model');
								$this->broadcast_model->insert_broadcast($count, $type . '/' . $province_id, $title, $message);

								redirect(base_url() . 'panel/broadcast_message/2');
							}
							else
							{
								redirect(base_url() . 'panel/broadcast_message/3');
							}
						}
					}
					break;
				
				default:
					die(0);
					redirect(base_url() . 'panel/broadcast_message/1');
					break;
			}

			redirect(base_url() . 'panel/broadcast_message/1');
		}
	}

	public function change_password()
	{
		$rules = array(
			array(
				'field'		=>	'old_password',
				'label'		=>	'رمز عبور فعلی',
				'rules'		=>	'required|min_length[5]|max_length[40]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'new_password',
				'label'		=>	'رمز عبور جدید',
				'rules'		=>	'required|min_length[5]|max_length[40]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'new_repassword',
				'label'		=>	'تکرار رمز عبور',
				'rules'		=>	'required|matches[new_password]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'matches'		=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/setting/3');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$old_password 	= $this->input->post('old_password', true);
			$new_password 	= $this->input->post('new_password', true);
			$new_repassword = $this->input->post('new_repassword', true);

			$this->load->model('user_model');
			$setting = $this->user_model->change_password($user_id, $old_password, $new_password, $new_repassword);

			if($setting!=1)
			{
				redirect(base_url() . 'panel/setting/1');
			}
			else
			{
				redirect(base_url() . 'panel/setting/2');
			}
		}
	}

	public function site_content()
	{
		$rules = array(
			array(
				'field'		=>	'rules_page',
				'label'		=>	'صفحه قوانین سایت',
				'rules'		=>	'max_length[5000]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'about_page',
				'label'		=>	'صفحه درباره ما',
				'rules'		=>	'max_length[5000]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'user_panel',
				'label'		=>	'صفحه پیشخوان کاربران',
				'rules'		=>	'max_length[5000]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);
		$user_id = $this->session->userdata('user_for_edit');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/site_content/1#notice_view');
		}
		else
		{
			$rules_page	= $this->input->post('rules_page', true);
			$about_page	= $this->input->post('about_page', true);
			$user_panel	= $this->input->post('user_panel', true);

			$this->load->model('page_model');
			$this->page_model->update_page($about_page, $rules_page, $user_panel);

			redirect(base_url() . 'panel/site_content/2#notice_view');
		}
	}

	public function add_reminder()
	{
		$rules = array(
			array(
				'field'		=>	'reminder_title',
				'label'		=>	'عنوان یادآور',
				'rules'		=>	'required|min_length[3]|max_length[75]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'reminder_description',
				'label'		=>	'توضیحات',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/reminder/1#content_view');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$reminder_title = $this->input->post('reminder_title', true);
			$description 	= $this->input->post('reminder_description', true);

			$this->load->model('reminder_model');
			$reminder = $this->reminder_model->insert_reminder($user_id, $reminder_title, $description);

			if($reminder == 1)
			{
				redirect(base_url() . 'panel/reminder/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/reminder/3#content_view');
			}
		}
	}

	public function update_reminder()
	{
		$reminder_id = $this->session->userdata('reminder_id_for_update');
		
		if(empty($reminder_id))
		{
			redirect(base_url() . 'panel/reminder#content_view');
		}

		$rules = array(
			array(
				'field'		=>	'reminder_title',
				'label'		=>	'عنوان یادآور',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'reminder_description',
				'label'		=>	'توضیحات',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			$reminder_id 	= $this->session->userdata('reminder_id_for_update');
			redirect(base_url() . 'panel/update_reminder/' . $reminder_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$reminder_id 	= $this->session->userdata('reminder_id_for_update');
			$reminder_title 	= $this->input->post('reminder_title', true);
			$description 	= $this->input->post('reminder_description', true);

			$this->load->model('reminder_model');
			$reminder = $this->reminder_model->update_reminder($user_id, $reminder_id, $reminder_title, $description);

			redirect(base_url() . 'panel/update_reminder/' . $reminder_id . '/2#content_view');
		}
	}

	public function delete_reminder($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('reminder_model');
			$reminder = $this->reminder_model->delete_reminder($id, $user_id);
			if($reminder == 1)
			{
				redirect(base_url() . 'panel/reminder/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/reminder/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/reminder/4');
		}
	}

	public function search_image()
	{
		$rules = array(
			array(
				'field'		=>	'search',
				'label'		=>	'جستجو کاربر',
				'rules'		=>	'max_length[70]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/list_image');
		}
		else
		{
			$search = $this->input->post('search', true);
			$this->load->model('image_model');
			$image = $this->image_model->search_image($search);
			
			$this->load->model('message_model');
			$user_id 		= $this->session->userdata('user_id');
			$message_unread = $this->message_model->message_unread($user_id);

			$this->load->model('reminder_model');
			$reminder_count = $this->reminder_model->reminder_count($user_id);

			$i=0;
			$images = '';

			$images = $this->sort->array_sort($image, 'last_login', SORT_DESC);

			$data = array(
				'title'				=>	'پنل مدیریت - جستجو تصاویر',
				'url'				=>	base_url(),
				'message_unread'	=>	$message_unread,
				'images'			=>	$images,
				'reminder_count'	=>	$reminder_count
			);
			$this->load->view('panel/header', $data);
			$this->load->view('panel/search_image', $data);
			$this->load->view('panel/footer', $data);
		}
	}
}
?>