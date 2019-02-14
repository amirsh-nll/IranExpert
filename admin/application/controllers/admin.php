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
				'field'		=>	'person_activity',
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
				'field'		=>	'person_about',
				'label'		=>	'درباره من',
				'rules'		=>	'max_length[1000]',
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
			$first_name 		= 	$this->input->post('person_first_name', true);
			$last_name 			= 	$this->input->post('person_last_name', true);
			$birthday 			= 	$this->input->post('person_birth_year', true) . '/' . $this->input->post('person_birth_month', true) . '/' . $this->input->post('person_birth_day', true);
			$activity 			= 	$this->input->post('person_activity', true);
			$gender 			= 	$this->input->post('person_gender', true);
			$marriage 			= 	$this->input->post('person_marriage', true);
			$about 				=	$this->input->post('person_about', true);
			$mobile_number 		= 	$this->input->post('contact_mobile_number', true);
			$phone_number 		= 	$this->input->post('contact_phone_number', true);
			$postal_code 		= 	$this->input->post('contact_postal_code', true);
			$province_id		= 	$this->input->post('contact_province_id', true);
			$city_name 			= 	$this->input->post('contact_city_name', true);
			$address 			= 	$this->input->post('contact_address', true);

			$this->load->model('person_model');
			$this->person_model->update_person($user_id, $first_name, $last_name, $birthday, $activity, $gender, $marriage, $about);

			$this->load->model('contact_model');
			$this->contact_model->update_contact($user_id, $mobile_number, $phone_number, $postal_code, $province_id, $city_name, $address);

			$this->user_model->change_middle_name($user_id, $new_middle_name);

			redirect(base_url() . 'panel/user_edit/' . $new_middle_name . '/2#notice_view');
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
				'rules'		=>	'required|min_length[5]|max_length[500]',
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
}
?>