<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Web Controller
 * Date : 2016/10/23
 * Auther : A.shokri
 * Description : The Controller From Load Main Website Page.
 *
*/

class Web extends CI_Controller
{
	public function index()
	{
		$data = array(
			'url'=>base_url()
			);
		$this->load->view('site/header',$data);
		$this->load->view('site/home',$data);
		$this->load->view('site/footer',$data);
	}

	public function register()
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

	public function login()
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

	public function forget()
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

	public function rules()
	{
		$data = array(
			'url'=>base_url()
			);
		$this->load->view('site/header',$data);
		$this->load->view('site/rules',$data);
		$this->load->view('site/footer',$data);
	}

	public function about()
	{
		$data = array(
			'url'=>base_url()
			);
		$this->load->view('site/header',$data);
		$this->load->view('site/about',$data);
		$this->load->view('site/footer',$data);
	}
}

?>