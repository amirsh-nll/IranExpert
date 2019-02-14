<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 2016/10/24
 * Auther : A.shokri
 * Description : The Controller From Load Main Website Page.
 *
*/

class User extends CI_Controller
{
	public function register()
	{
		$rules = array(
				array(
					'field'=>'email',
					'label'=>'آدرس ایمیل',
					'rules'=>'required|valid_email|is_unique[user.email]',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'valid_email'=>'فیلد %s معتبر نمی باشد.',
						'is_unique'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'password',
					'label'=>'رمز عبور',
					'rules'=>'required|min_length[5]|max_length[40]',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'min_length'=>'فیلد %s معتبر نمی باشد.',
						'max_length'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'repassword',
					'label'=>'تکرار رمز عبور',
					'rules'=>'required|matches[password]',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'matches'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'captcha',
					'label'=>'کد امنیتی',
					'rules'=>'required',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect('web/register/1');
		}
		else
		{
			$email = xss_clean($_POST['email']);
			$password = xss_clean($_POST['password']);
			$code = xss_clean($_POST['captcha']);

			if($this->captcha_model->check($code))
			{
				$this->load->model('user_model');
				$user_id = $this->user_model->new_user($email, $password);

				$this->load->model('person_model');
				$this->person_model->blank_person($user_id);
				
				$this->load->model('contacts_model');
				$this->contacts_model->blank_contacts($user_id);

				$this->load->model('state_model');
				$this->state_model->blank_state($user_id);

				redirect('web/login/3');

			}
			else
			{
				redirect('web/register/2');
			}
		}
	}

	public function login()
	{
		$rules = array(
				array(
					'field'=>'email',
					'label'=>'آدرس ایمیل',
					'rules'=>'required|valid_email',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'valid_email'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'password',
					'label'=>'رمز عبور',
					'rules'=>'required|min_length[5]|max_lenth[40]',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'min_lenth'=>'فیلد %s معتبر نمی باشد.',
						'max_lenth'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'captcha',
					'label'=>'کد امنیتی',
					'rules'=>'required',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect('web/login/1');
		}
		else
		{

		}
	}

	public function forget()
	{
		$rules = array(
				array(
					'field'=>'email',
					'label'=>'آدرس ایمیل',
					'rules'=>'required|valid_email',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.',
						'valid_email'=>'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'=>'captcha',
					'label'=>'کد امنیتی',
					'rules'=>'required',
					'errors'=>array(
						'required'=>'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect('web/forget/1');
		}
		else
		{

		}
	}
}