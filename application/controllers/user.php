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
	public function auth()
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
			$captcha = array(
		        'img_path'      => './captcha/',
		        'img_url'       => 'http://localhost/captcha/',
		        'font_path'     => './assets/font/comic.ttf',
		        'img_width'     => '150',
		        'img_height'    => 40,
		        'expiration'    => 7200,
		        'word_length'   => 5,
		        'font_size'     => 14,
		        'colors'        => array(
		                'background' => array(255, 255, 255),
	                	'border' => array(255, 255, 255),
	                	'text' => array(0, 0, 0),
	                	'grid' => array(255, 40, 40)
		        )
			);
			$image = create_captcha($captcha);
			$data = array(
				'title'=>'ورود',
				'url'=>base_url(),
				'captcha'=>$image
				);
			$this->load->view('site/form_header',$data);
			$this->load->view('site/login',$data);
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
			$captcha = array(
		        'img_path'      => './captcha/',
		        'img_url'       => 'http://localhost/captcha/',
		        'font_path'     => './assets/font/comic.ttf',
		        'img_width'     => '150',
		        'img_height'    => 40,
		        'expiration'    => 7200,
		        'word_length'   => 5,
		        'font_size'     => 14,
		        'colors'        => array(
		                'background' => array(255, 255, 255),
	                	'border' => array(255, 255, 255),
	                	'text' => array(0, 0, 0),
	                	'grid' => array(255, 40, 40)
		        )
			);
			$image = create_captcha($captcha);
			$data = array(
				'title'=>'فراموشی رمز عبور',
				'url'=>base_url(),
				'captcha'=>$image
				);
			$this->load->view('site/form_header',$data);
			$this->load->view('site/forget',$data);
		}
		else
		{

		}
	}

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
		if($this->form_validation->run()==false)
		{
			$captcha = array(
		        'img_path'      => './captcha/',
		        'img_url'       => 'http://localhost/captcha/',
		        'font_path'     => './assets/font/comic.ttf',
		        'img_width'     => '150',
		        'img_height'    => 40,
		        'expiration'    => 7200,
		        'word_length'   => 5,
		        'font_size'     => 14,
		        'colors'        => array(
		                'background' => array(255, 255, 255),
	                	'border' => array(255, 255, 255),
	                	'text' => array(0, 0, 0),
	                	'grid' => array(255, 40, 40)
	        )
			);
			$image = create_captcha($captcha);
			$data = array(
				'title'=>'ثبت نام',
				'url'=>base_url(),
				'captcha'=>$image
				);
			$this->load->view('site/form_header',$data);
			$this->load->view('site/register',$data);
		}
		else
		{
			/*
			$_POST['email']
			$_POST['password']
			$_POST['repassword']
			$_POST['captcha']
			*/
		}


	}
}