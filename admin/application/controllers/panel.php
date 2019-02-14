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
			'about'				=>	$about,
			'email'				=>	$email,
			'mobile'			=>	$mobile,
			'phone'				=>	$phone,
			'postal_code'		=>	$postal_code,
			'address'			=>	$address
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
			'activity_value'		=>	$person['activity'],
			'marriage_value'		=>	$person['marriage'],
			'gender_value'			=>	$person['gender'],
			'about_value'			=>	$person['about'],
			'mobile_number_value'	=>	$contact['mobile_number'],
			'phone_number_value'	=>	$contact['phone_number'],
			'postal_code_value'		=>	$contact['postal_code'],
			'province_value'		=>	$contact['province'],
			'address_value'			=>	$contact['address'],
			'notice'				=>	$notice
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
			'title'				=>	'پنل مدیریت - مسدود سازی',
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
		$page 		 = $image_count / 10;
		if($page * 10 - 9 < $image_count)
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

	public function delete_image($middle_name='', $page=1)
	{
		$middle_name = xss_clean($middle_name);
		$page 		 = xss_clean($page);
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

	public function report()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('message_model');
		$message_unread = $this->message_model->message_unread($user_id);

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
			'message_unread'	=>	$message_unread
		);
		$this->load->view('panel/header', $data);
		$this->load->view('panel/report', $data);
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