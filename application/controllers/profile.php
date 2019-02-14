<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : Profile
 * Date : 1395/08/14
 * Auther : A.shokri
 * Description : The Controller From Load User Profile Page.
 *
*/

class profile extends CI_Controller
{
	public function index($middle_name = 0)
	{
		$middle_name = strtolower(xss_clean($middle_name));
		if($middle_name===0)
		{
			redirect(base_url() . 'web/index');
		}
		else
		{
			$this->load->model('user_model');
			$user_id = $this->user_model->fetch_user_id_with_middle_name($middle_name);
			if($user_id == 0)
			{
				redirect(base_url() . 'web/index');
			}
			$data = array(
				'url'		=>	base_url(),
				'data'		=>	$this->load_data($user_id)
			);

			$this->load->view('profile/header', $data);
			$this->load->view('profile/main', $data);
			$this->load->view('profile/footer', $data);
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
			'copyright'		=>	$copyright
		);

	}
}

?>