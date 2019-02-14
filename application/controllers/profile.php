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
			$description 	= $this->agent->agent_string() . '// IP:' . $this->input->ip_address();

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

		switch($person['activity'])
		{
			case 0   : {$activity = 'نامشخص';} break;
			case 1   : {$activity = 'آرایشی و بهداشتی';} break;
			case 2   : {$activity = 'آموزش الکترونیک';} break;
			case 3   : {$activity = 'آموزش پزشکی';} break;
			case 4   : {$activity = 'آموزش عالی';} break;
			case 5   : {$activity = 'آموزش فنی حرفه ای و مربیگری';} break;
			case 6   : {$activity = 'آموزش مدیریت';} break;
			case 7   : {$activity = 'آموزش و پرورش';} break;
			case 8   : {$activity = 'اتوماسیون صنعتی';} break;
			case 9   : {$activity = 'اثاثیه منزل';} break;
			case 10  : {$activity = 'ادبیات';} break;
			case 11  : {$activity = 'اقتصاد';} break;
			case 12  : {$activity = 'الهیات و معارف اسلامی';} break;
			case 13  : {$activity = 'املاک و مستغلات';} break;
			case 14  : {$activity = 'امنیت کامپیوتر و شبکه';} break;
			case 15  : {$activity = 'امنیت و تحقیقات';} break;
			case 16  : {$activity = 'امور بین الملل';} break;
			case 17  : {$activity = 'انبارداری';} break;
			case 18  : {$activity = 'انتشارات';} break;
			case 19  : {$activity = 'انرژی تجدید پذیر و محیط زیست';} break;
			case 20  : {$activity = 'انیمیشن';} break;
			case 21  : {$activity = 'اوقات فراغت';} break;
			case 22  : {$activity = 'ایمنی عمومی';} break;
			case 23  : {$activity = 'اینترنت';} break;
			case 24  : {$activity = 'برنامه نویسی';} break;
			case 25  : {$activity = 'بازاریابی و تبلیغات';} break;
			case 26  : {$activity = 'بازی های رایانه ای';} break;
			case 27  : {$activity = 'باستان شناسی';} break;
			case 28  : {$activity = 'بانکداری';} break;
			case 29  : {$activity = 'برون سپاری';} break;
			case 30  : {$activity = 'بسته بندی';} break;
			case 31  : {$activity = 'بسیج';} break;
			case 32  : {$activity = 'بشر دوستی';} break;
			case 33  : {$activity = 'بهداشت، سلامتی و تناسب اندام';} break;
			case 34  : {$activity = 'بیمارستان و خدمات درمانی';} break;
			case 35  : {$activity = 'بیمه';} break;
			case 36  : {$activity = 'بیوتکنولوژی';} break;
			case 37  : {$activity = 'پارچه';} break;
			case 38  : {$activity = 'پلاستیک';} break;
			case 39  : {$activity = 'پوشاک و مد';} break;
			case 40  : {$activity = 'تجارت بین الملل';} break;
			case 41  : {$activity = 'تجهیزات پزشکی';} break;
			case 42  : {$activity = 'تحقیقات';} break;
			case 43  : {$activity = 'ترجمه';} break;
			case 44  : {$activity = 'تصاویر متحرک و فیلم';} break;
			case 45  : {$activity = 'تنباکو';} break;
			case 46  : {$activity = 'تولید مواد غذایی';} break;
			case 47  : {$activity = 'ثبت اختراعات و امور مالکیت فکری';} break;
			case 48  : {$activity = 'چاپ';} break;
			case 49  : {$activity = 'حسابداری';} break;
			case 50  : {$activity = 'حل اختلاف';} break;
			case 51  : {$activity = 'حمل و نقل /  راه آهن';} break;
			case 52  : {$activity = 'حمل و نقل و تحویل';} break;
			case 53  : {$activity = 'خدمات اطلاع رسانی';} break;
			case 54  : {$activity = 'خدمات بهداشت روان';} break;
			case 55  : {$activity = 'خدمات حقوقی';} break;
			case 56  : {$activity = 'خدمات رفاهی و تفریح';} break;
			case 57  : {$activity = 'خدمات شهری';} break;
			case 58  : {$activity = 'خدمات فردی و خانواده';} break;
			case 59  : {$activity = 'خدمات فناوری اطلاعات';} break;
			case 60  : {$activity = 'خدمات مالی';} break;
			case 61  : {$activity = 'خدمات محیط زیست';} break;
			case 62  : {$activity = 'خدمات مصرف کننده';} break;
			case 63  : {$activity = 'خرده فروشی';} break;
			case 64  : {$activity = 'خوار و بار';} break;
			case 65  : {$activity = 'خودرو';} break;
			case 66  : {$activity = 'خیریه ها';} break;
			case 67  : {$activity = 'داروسازی';} break;
			case 68  : {$activity = 'دام داری';} break;
			case 69  : {$activity = 'دامپزشکی';} break;
			case 70  : {$activity = 'دریایی';} break;
			case 71  : {$activity = 'دستگاه های صنعتی';} break;
			case 72  : {$activity = 'دفاع و فضا';} break;
			case 73  : {$activity = 'راه آهن';} break;
			case 74  : {$activity = 'رسانه های آنلاین';} break;
			case 75  : {$activity = 'رسانه و صدا و سیما';} break;
			case 76  : {$activity = 'رستوران ها';} break;
			case 77  : {$activity = 'روابط عمومی و ارتباطات';} break;
			case 78  : {$activity = 'روان شناسی و روان پزشکی';} break;
			case 79  : {$activity = 'روحانی دینی و مذهبی';} break;
			case 80  : {$activity = 'زبان شناسی';} break;
			case 81  : {$activity = 'زمین شناسی';} break;
			case 82  : {$activity = 'ساخت و ساز';} break;
			case 83  : {$activity = 'سازمان غیر انتفاعی';} break;
			case 84  : {$activity = 'سازمان مدنی و اجتماعی';} break;
			case 85  : {$activity = 'سازمان های سیاسی';} break;
			case 86  : {$activity = 'سپاه و ارتش';} break;
			case 87  : {$activity = 'سخت افزار کامپیوتر';} break;
			case 88  : {$activity = 'سرگرمی';} break;
			case 89  : {$activity = 'سرمایه گذاری بانکی';} break;
			case 90  : {$activity = 'سرمایه و سهام خصوصی';} break;
			case 91  : {$activity = 'سفر و گردشگری';} break;
			case 92  : {$activity = 'سوپر مارکت';} break;
			case 93  : {$activity = 'شبکه های کامپیوتری';} break;
			case 94  : {$activity = 'شرکت های خدماتی';} break;
			case 95  : {$activity = 'شیشه، سرامیک و بتن';} break;
			case 96  : {$activity = 'شیلات';} break;
			case 97  : {$activity = 'صنایع شیمیایی';} break;
			case 98  : {$activity = 'صنعت برق / الکترونیک';} break;
			case 99  : {$activity = 'طب سنتی و گیاهی';} break;
			case 100 : {$activity = 'طراحی صنعتی';} break;
			case 101 : {$activity = 'طراحی گرافیکی';} break;
			case 102 : {$activity = 'طراح وب';} break;
			case 103 : {$activity = 'عکاسی';} break;
			case 104 : {$activity = 'عمده فروشی';} break;
			case 105 : {$activity = 'غذا و نوشیدنی';} break;
			case 106 : {$activity = 'فروش تجهیزات الکترونیک';} break;
			case 107 : {$activity = 'فناوری نانو';} break;
			case 108 : {$activity = 'قضایی';} break;
			case 109 : {$activity = 'کاریابی';} break;
			case 110 : {$activity = 'کاغذ و محصولات جنگل';} break;
			case 111 : {$activity = 'کالاهای لوکس و جواهر';} break;
			case 112 : {$activity = 'کالاهای مصرفی';} break;
			case 113 : {$activity = 'کتابخانه';} break;
			case 114 : {$activity = 'کشاورزی';} break;
			case 115 : {$activity = 'کشتی سازی';} break;
			case 116 : {$activity = 'لجستیک و زنجیره تامین';} break;
			case 117 : {$activity = 'لوازم خانگی';} break;
			case 118 : {$activity = 'لوازم و تجهیزات کسب و کار';} break;
			case 119 : {$activity = 'لوازم ورزشی';} break;
			case 120 : {$activity = 'مجلس شورای اسلامی';} break;
			case 121 : {$activity = 'مخابرات';} break;
			case 122 : {$activity = 'مدیریت';} break;
			case 123 : {$activity = 'مدیریت دولتی';} break;
			case 124 : {$activity = 'مدیریت سرمایه گذاری';} break;
			case 125 : {$activity = 'مشاوره حقوقی';} break;
			case 126 : {$activity = 'مشاوره مدیریت';} break;
			case 127 : {$activity = 'مصالح ساختمانی';} break;
			case 128 : {$activity = 'مطبوعات';} break;
			case 129 : {$activity = 'معدن و فلزات';} break;
			case 130 : {$activity = 'معماری و نقشه کشی';} break;
			case 131 : {$activity = 'مکانیک و یا مهندسی صنایع';} break;
			case 132 : {$activity = 'منابع انسانی';} break;
			case 133 : {$activity = 'مهندسی عمران';} break;
			case 134 : {$activity = 'موزه';} break;
			case 135 : {$activity = 'موسیقی';} break;
			case 136 : {$activity = 'نرم افزار کامپیوتر';} break;
			case 137 : {$activity = 'نفت و انرژی';} break;
			case 138 : {$activity = 'نمایشگاه و سمینار';} break;
			case 139 : {$activity = 'نهادهای مذهبی';} break;
			case 140 : {$activity = 'نویسندگی و ویراستاری';} break;
			case 141 : {$activity = 'نیروی انتظامی';} break;
			case 142 : {$activity = 'نیمه هادی ها';} break;
			case 143 : {$activity = 'هتل و مهمانداری';} break;
			case 144 : {$activity = 'هنر های زیبا';} break;
			case 145 : {$activity = 'هنر و صنایع دستی';} break;
			case 156 : {$activity = 'هنرهای نمایشی';} break;
			case 147 : {$activity = 'هواپیمایی / خطوط هوایی';} break;
			case 148 : {$activity = 'هوانوردی و هوافضا';} break;
			case 149 : {$activity = 'واردات و صادرات';} break;
			case 150 : {$activity = 'وایرلس';} break;
			case 151 : {$activity = 'ورزش';} break;
			default  : {$activity 	= "نامشخص";}
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
			'activity'		=>	$activity,
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