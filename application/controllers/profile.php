<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Profile Controller
 * Date : 1395/08/14
 * Auther : A.shokri
 * Description : The Controller From Load User Profile Page.
 *
*/

class profile extends CI_Controller
{
	public function index($middle_name = 0, $notice=0)
	{
		$middle_name = strtolower(xss_clean($middle_name));
		if($middle_name===0)
		{
			redirect(base_url() . 'index');
		}
		else
		{
			$this->load->model('user_model');
			$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);
			if($user_id == 0)
			{
				redirect(base_url() . 'index');
			}
			else
			{
				$user = $this->user_model->check_suspend($user_id);
				if($user!=1)
				{
					redirect(base_url() . 'index');
				}
				else
				{
					$data = array(
						'url'		=>	base_url(),
						'notice'	=>	$notice,
						'data'		=>	$this->load_data($user_id)
					);

					$this->load->model('statistics_model');
					$this->statistics_model->statistics_calculator($user_id);

					$this->load->view('profile/header', $data);
					$this->load->view('profile/main', $data);
					$this->load->view('profile/footer', $data);
				}
			}
		}
	}

	public function send_message($middle_name=0)
	{
		$middle_name = xss_clean($middle_name);
		if($middle_name===0)
		{
			redirect(base_url() . 'index');
		}

		$rules = array(
				array(
					'field'		=>	'name',
					'label'		=>	'نام شما',
					'rules'		=>	'required|min_length[3]|max_length[100]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
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
					'field'		=>	'email',
					'label'		=>	'ایمیل',
					'rules'		=>	'required|valid_email|min_length[5]|max_length[70]',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.',
						'valid_email'	=>	'فیلد %s معتبر نمی باشد.',
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'message',
					'label'		=>	'پیام شما',
					'rules'		=>	'min_length[5]|max_length[500]',
					'errors'	=>	array(
						'min_length'	=>	'فیلد %s معتبر نمی باشد.',
						'max_length'	=>	'فیلد %s معتبر نمی باشد.'
						)
					),
				array(
					'field'		=>	'captcha',
					'label'		=>	'کد امنیتی',
					'rules'		=>	'required',
					'errors'	=>	array(
						'required'		=>	'فیلد %s معتبر نمی باشد.'
						)
					),
			);

		$this->form_validation->set_rules($rules);

		$this->load->model('captcha_model');

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'profile/' . $middle_name . '/1#message_form');
		}
		else
		{
			$this->load->model('user_model');

			$user_id 		= $this->user_model->fetch_user_id_with_middle_name($middle_name);
			$full_name		= $this->input->post('name',true);
			$title 			= $this->input->post('title',true);
			$email 			= $this->input->post('email',true);
			$message 		= $this->input->post('message',true);
			$captcha 		= $this->input->post('captcha',true);
			$description 	= $this->agent->agent_string();

			if($this->captcha_model->check($code))
			{
				$this->load->model('message_model');
				$message = $this->message_model->insert_message($user_id, $full_name, $title, $email, $message, $description);
				if($message==1)
				{
					redirect(base_url() . 'profile/' . $middle_name . '/2#message_form');
				}
				else
				{
					redirect(base_url() . 'profile/' . $middle_name . '/1#message_form');
				}
			}
			else
			{
				redirect(base_url() . 'profile/' . $middle_name . '/3#message_form');
			}
		}
	}

	private function load_data($user_id)
	{
		$user_id = xss_clean($user_id);

		/* User Profile Email */
		$this->load->model('user_model');
		$middle_name = $this->user_model->fetch_middle_name($user_id);
		$email 		 = $this->user_model->fetch_email($user_id);

		/* User Profile Image */
		$this->load->model('image_model');
		$image = $this->image_model->read_image($user_id);
		$image = $image[0]['file_name'];

		/* User Profile PersonData */
		$this->load->model('person_model');
		$person = $this->person_model->read_person($user_id);
		$person = $person[0];

		if(empty($person['first_name']) && empty($person['last_name']))
		{
			$full_name = "&nbsp;";
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
		if(empty($person['about']))
		{
			$about = "این صفحه رزومه آنلاین بنده می باشد.";
		}
		else
		{
			$about = $person['about'];
		}

		/* User Profile ContactData */
		$this->load->model('contact_model');
		$contact = $this->contact_model->read_contact($user_id);
		$contact = $contact[0];

		if(empty($contact['mobile_number']))
		{
			$mobile = "&nbsp;";
		}
		else
		{
			$mobile = $contact['mobile_number'];
		}

		if(empty($contact['phone_number']))
		{
			$phone = "&nbsp;";
		}
		else
		{
			$phone = $contact['phone_number'];
		}

		switch($contact['province'])
		{
			case 0  : { $province = '&nbsp;';					} break;
			case 1  : { $province = 'استان اردبیل';				} break;
			case 2  : { $province = 'استان اصفهان';				} break;
			case 3  : { $province = 'استان البرز';				} break;
			case 4  : { $province = 'استان ایلام';				} break;
			case 5  : { $province = 'استان آذربایجان شرقی';		} break;
			case 6  : { $province = 'استان آذربایجان غربی';		} break;
			case 7  : { $province = 'استان بوشهر';				} break;
			case 8  : { $province = 'استان تهران';				} break;
			case 9  : { $province = 'استان چهارمحال و بختیاری';	} break;
			case 10 : { $province = 'استان خراسان جنوبی';			} break;
			case 11 : { $province = 'استان خراسان رضوی';			} break;
			case 12 : { $province = 'استان خراسان شمالی';			} break;
			case 13 : { $province = 'استان خوزستان';				} break;
			case 14 : { $province = 'استان زنجان';				} break;
			case 15 : { $province = 'استان سمنان';				} break;
			case 16 : { $province = 'استان سیستان و بلوچستان';	} break;
			case 17 : { $province = 'استان فارس';				} break;
			case 18 : { $province = 'استان قزوین';				} break;
			case 19 : { $province = 'استان قم';					} break;
			case 20 : { $province = 'استان کردستان';				} break;
			case 21 : { $province = 'استان کرمان';				} break;
			case 22 : { $province = 'استان کرمانشاه';				} break;
			case 23 : { $province = 'استان کهگیلویه و بویراحمد';	} break;
			case 24 : { $province = 'استان گلستان';				} break;
			case 25 : { $province = 'استان گیلان';				} break;
			case 26 : { $province = 'استان لرستان';				} break;
			case 27 : { $province = 'استان مازندران';				} break;
			case 28 : { $province = 'استان مرکزی';				} break;
			case 29 : { $province = 'استان هرمزگان';				} break;
			case 30 : { $province = 'استان همدان';				} break;
			case 31 : { $province = 'استان یزد';					} break;
			default : { $province = '&nbsp;';					} break;
		};

		if(empty($contact['address']))
		{
			$address = $province;
		}
		else
		{
			$address = $province . " / " . $contact['address'];
		}

		/* User Profile LessonData */
		$this->load->model('lesson_model');
		$lesson = $this->lesson_model->read_lesson($user_id);
		
		/* User Profile JobData */
		$this->load->model('job_model');
		$job = $this->job_model->read_job($user_id);

		/* User Profile ProjectData */
		$this->load->model('project_model');
		$project = $this->project_model->read_project($user_id);

		/* User Profile ArticleData */
		$this->load->model('article_model');
		$article = $this->article_model->read_article($user_id);

		/* User Profile AchievementData */
		$this->load->model('achievement_model');
		$achievement = $this->achievement_model->read_achievement($user_id);
		
		/* User Profile FavoriteData */
		$this->load->model('favorite_model');
		$favorite = $this->favorite_model->read_favorite($user_id);
		
		/* User Profile AbilityData */
		$this->load->model('ability_model');
		$ability = $this->ability_model->read_ability($user_id);
		
		/* User Profile SocialData */
		$this->load->model('social_model');
		$social = $this->social_model->read_social($user_id);

		/* Captcha For Send Message */
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

		$capcha_data = array(
		        'captcha_time'  => $cap['time'],
		        'ip_address'    => $this->input->ip_address(),
		        'word'          => $cap['word']
		);
		$this->load->model('captcha_model');
		$this->captcha_model->insert($capcha_data);

		/* Data */
		return array(
			'title'			=>	$title,
			'image'			=>	$image,
			'middle_name'	=>	$middle_name,
			'full_name'		=> 	$full_name,
			'birthday'		=>	$birthday,
			'marriage'		=>	$marriage,
			'gender'		=>	$gender,
			'about'			=>	$about,
			'email'			=>	$email,
			'mobile'		=>	$mobile,
			'phone'			=>	$phone,
			'address'		=>	$address,
			'lesson'		=>	$lesson,
			'job'			=>	$job,
			'ability'		=>	$ability,
			'project'		=>	$project,
			'article'		=>	$article,
			'achievement'	=>	$achievement,
			'favorite'		=>	$favorite,
			'social'		=>	$social,
			'copyright'		=>	$copyright,
			'captcha'		=>	$cap
		);
	}
}

?>