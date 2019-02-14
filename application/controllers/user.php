<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 *
 * Name : User Controller
 * Date : 1395/08/13
 * Auther : A.shokri
 * Description : The Controller From Handle User Panel Data.
 *
*/

class user extends IREX_Controller
{
	public function index()
	{
		redirect('panel/index');
	}

	public function add_image()
	{
		$user_id 						= $this->session->userdata('user_id');
		$config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 5500;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

       	$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
        	$error = array('error' => $this->upload->display_errors());
			redirect(base_url() . 'panel/image/1');
        }
        else
        {
        	$data = array('upload_data' => $this->upload->data());

        	$this->load->model('image_model');
        	$image = $this->image_model->insert_image($user_id, $this->upload->data('file_name'));

			redirect(base_url() . 'panel/image/2');
        }
	}

	public function edit_person()
	{
		$rules = array(
			array(
				'field'		=>	'person_first_name',
				'label'		=>	'نام',
				'rules'		=>	'required|min_length[2]|max_length[50]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_last_name',
				'label'		=>	'نام خانوادگی',
				'rules'		=>	'required|min_length[2]|max_length[50]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_day',
				'label'		=>	'روز تولد',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_month',
				'label'		=>	'ماه تولد',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_birth_year',
				'label'		=>	'سال تولد',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_gender',
				'label'		=>	'جنسیت',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_marriage',
				'label'		=>	'وضعیت تاهل',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'person_about',
				'label'		=>	'درباره من',
				'rules'		=>	'max_length[255]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/person/1');
		}
		else
		{
			$user_id 	= 	$this->session->userdata('user_id');
			$first_name = 	$this->input->post('person_first_name', true);
			$last_name 	= 	$this->input->post('person_last_name', true);
			$birthday 	= 	$this->input->post('person_birth_year', true) . '/' . $this->input->post('person_birth_month', true) . '/' . $this->input->post('person_birth_day', true);
			$gender 	= 	$this->input->post('person_gender', true);
			$marriage 	= 	$this->input->post('person_marriage', true);
			$about 		=	$this->input->post('person_about', true);

			$this->load->model('person_model');
			$this->person_model->update_person($user_id, $first_name, $last_name, $birthday, $gender, $marriage, $about);

			redirect(base_url() . 'panel/person/2');
		}
	}

	public function add_lesson()
	{
		$rules = array(
			array(
				'field'		=>	'lesson_title',
				'label'		=>	'عنوان دوره',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'lesson_start_month',
				'label'		=>	'ماه شرعو دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'lesson_start_year',
				'label'		=>	'سال شرعو دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'lesson_end_month',
				'label'		=>	'ماه پایان دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'lesson_end_year',
				'label'		=>	'سال پایان دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'lesson_description',
				'label'		=>	'توضیحات دوره',
				'rules'		=>	'max_length[255]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/lesson/1');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$lesson_title 	= $this->input->post('lesson_title', true);
			$start_date 	= $this->input->post('lesson_start_year', true) . '/' . $this->input->post('lesson_start_month', true);
			$end_date 		= $this->input->post('lesson_end_year', true) . '/' . $this->input->post('lesson_end_month', true);
			$description 	= $this->input->post('lesson_description', true);

			$this->load->model('lesson_model');
			$lesson = $this->lesson_model->insert_lesson($user_id, $lesson_title, $start_date, $end_date, $description);

			if($lesson==1)
			{
				redirect(base_url() . 'panel/lesson/2');
			}
			else
			{
				redirect(base_url() . 'panel/lesson/3');
			}
		}
	}

	public function delete_lesson($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('lesson_model');
			$lesson = $this->lesson_model->delete_lesson($id, $user_id);
			if($lesson == 1)
			{
				redirect(base_url() . 'panel/lesson/5');
			}
			else
			{
				redirect(base_url() . 'panel/lesson/4');
			}
		}
		else
		{
			redirect(base_url() . 'panel/lesson/4');
		}
	}

	public function add_job()
	{
		$rules = array(
			array(
				'field'		=>	'job_title',
				'label'		=>	'عنوان شغل',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_start_month',
				'label'		=>	'ماه شرعو شغل',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_start_year',
				'label'		=>	'سال شرعو شغل',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_end_month',
				'label'		=>	'ماه پایان شغل',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_end_year',
				'label'		=>	'سال پایان شغل',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_description',
				'label'		=>	'توضیحات شغل',
				'rules'		=>	'max_length[255]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/job/1');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$job_title 		= $this->input->post('job_title', true);
			$start_date 	= $this->input->post('job_start_year', true) . '/' . $this->input->post('job_start_month', true);
			$end_date 		= $this->input->post('job_end_year', true) . '/' . $this->input->post('job_end_month', true);
			$description 	= $this->input->post('job_description', true);

			$this->load->model('job_model');
			$job = $this->job_model->insert_job($user_id, $job_title, $start_date, $end_date, $description);

			if($job == 1)
			{
				redirect(base_url() . 'panel/job/2');
			}
			else
			{
				redirect(base_url() . 'panel/job/3');
			}
		}
	}

	public function delete_job($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('job_model');
			$lesson = $this->job_model->delete_job($id, $user_id);
			if($lesson == 1)
			{
				redirect(base_url() . 'panel/job/5');
			}
			else
			{
				redirect(base_url() . 'panel/job/4');
			}
		}
		else
		{
			redirect(base_url() . 'panel/job/4');
		}
	}

	public function add_favorite()
	{
		$rules = array(
			array(
				'field'		=>	'favorite_title',
				'label'		=>	'عنوان علاقه مندی',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'favorite_description',
				'label'		=>	'توضیحات علاقه مندی',
				'rules'		=>	'max_length[255]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/favorite/1');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$favorite_title = $this->input->post('favorite_title', true);
			$description 	= $this->input->post('favorite_description', true);

			$this->load->model('favorite_model');
			$favorite = $this->favorite_model->insert_favorite($user_id, $favorite_title, $description);

			if($favorite == 1)
			{
				redirect(base_url() . 'panel/favorite/2');
			}
			else
			{
				redirect(base_url() . 'panel/favorite/3');
			}
		}
	}

	public function delete_favorite($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('favorite_model');
			$favorite = $this->favorite_model->delete_favorite($id, $user_id);
			if($favorite == 1)
			{
				redirect(base_url() . 'panel/favorite/5');
			}
			else
			{
				redirect(base_url() . 'panel/favorite/4');
			}
		}
		else
		{
			redirect(base_url() . 'panel/favorite/4');
		}
	}

	public function add_ability()
	{
		$rules = array(
			array(
				'field'		=>	'ability_title',
				'label'		=>	'عنوان توانایی',
				'rules'		=>	'required|min_length[3]|max_length[75]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'ability_description',
				'label'		=>	'توضیحات توانایی',
				'rules'		=>	'max_length[255]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/ability/1');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$ability_title = $this->input->post('ability_title', true);
			$description 	= $this->input->post('ability_description', true);

			$this->load->model('ability_model');
			$ability = $this->ability_model->insert_ability($user_id, $ability_title, $description);

			if($ability == 1)
			{
				redirect(base_url() . 'panel/ability/2');
			}
			else
			{
				redirect(base_url() . 'panel/ability/3');
			}
		}
	}

	public function delete_ability($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('ability_model');
			$ability = $this->ability_model->delete_ability($id, $user_id);
			if($ability == 1)
			{
				redirect(base_url() . 'panel/ability/5');
			}
			else
			{
				redirect(base_url() . 'panel/ability/4');
			}
		}
		else
		{
			redirect(base_url() . 'panel/ability/4');
		}
	}

	public function add_social()
	{
		$rules = array(
			array(
				'field'		=>	'social_url',
				'label'		=>	'آدرس شبکه اجتماعی',
				'rules'		=>	'required|valid_url|min_length[5]|max_length[255]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'valid_url'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'social_type',
				'label'		=>	'نوع شبکه اجتماعی',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/social/1');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$social_url		= $this->input->post('social_url', true);
			$social_type 	= $this->input->post('social_type', true);

			$this->load->model('social_model');
			$social = $this->social_model->insert_social($user_id, $social_url, $social_type);

			if($social == 1)
			{
				redirect(base_url() . 'panel/social/2');
			}
			else
			{
				redirect(base_url() . 'panel/social/3');
			}
		}
	}

	public function delete_social($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('social_model');
			$social = $this->social_model->delete_social($id, $user_id);
			if($social == 1)
			{
				redirect(base_url() . 'panel/social/5');
			}
			else
			{
				redirect(base_url() . 'panel/social/4');
			}
		}
		else
		{
			redirect(base_url() . 'panel/social/4');
		}
	}
}

?>
