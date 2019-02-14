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
        $config['max_size']             = 7500;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

       	$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
        	$error = array('error' => $this->upload->display_errors());
			redirect(base_url() . 'panel/image/1#content_view');
        }
        else
        {
        	$data = array('upload_data' => $this->upload->data());

        	$this->load->model('image_model');
        	$image = $this->image_model->update_image($user_id, $this->upload->data('file_name'));

			redirect(base_url() . 'panel/image/2#content_view');
        }
	}

	public function delete_image()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('image_model');
        $image = $this->image_model->delete_image($user_id);

        if($image==1)
        {
        	redirect(base_url() . 'panel/image/4#content_view');
        }
        else
        {
			redirect(base_url() . 'panel/image/3#content_view');
		}
	}

	public function update_person()
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
				'rules'		=>	'max_length[1000]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			)
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/person/1#content_view');
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

			redirect(base_url() . 'panel/person/2#content_view');
		}
	}

	public function update_contact()
	{
		$rules = array(
			array(
				'field'		=>	'contact_mobile_number',
				'label'		=>	'همراه',
				'rules'		=>	'required|numeric|min_length[10]|max_length[20]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_phone_number',
				'label'		=>	'تلفن تماس',
				'rules'		=>	'required|numeric|min_length[6]|max_length[20]',
					'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_postal_code',
				'label'		=>	'کد پستی',
				'rules'		=>	'required|numeric|min_length[9]|max_length[20]',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'contact_province',
				'label'		=>	'استان',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
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

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/contact/1#content_view');
		}
		else
		{
			$user_id 			= 	$this->session->userdata('user_id');
			$mobile_number 		= 	$this->input->post('contact_mobile_number', true);
			$phone_number 		= 	$this->input->post('contact_phone_number', true);
			$postal_code 		= 	$this->input->post('contact_postal_code', true);
			$province 			= 	$this->input->post('contact_province', true);
			$address 			= 	$this->input->post('contact_address', true);

			$this->load->model('contact_model');
			$this->contact_model->update_contact($user_id, $mobile_number, $phone_number, $postal_code, $province, $address);

			redirect(base_url() . 'panel/contact/2#content_view');
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
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/lesson/1#content_view');
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
				redirect(base_url() . 'panel/lesson/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/lesson/3#content_view');
			}
		}
	}

	public function update_lesson()
	{
		$lesson_id = $this->session->userdata('lesson_id_for_update');
		
		if(empty($lesson_id))
		{
			redirect(base_url() . 'panel/lesson#content_view');
		}

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
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			$lesson_id 	= $this->session->userdata('lesson_id_for_update');
			redirect(base_url() . 'panel/update_lesson/' . $lesson_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$lesson_id 		= $this->session->userdata('lesson_id_for_update');

			$lesson_title 	= $this->input->post('lesson_title', true);
			$start_date 	= $this->input->post('lesson_start_year', true) . '/' . $this->input->post('lesson_start_month', true);
			$end_date 		= $this->input->post('lesson_end_year', true) . '/' . $this->input->post('lesson_end_month', true);
			$description 	= $this->input->post('lesson_description', true);

			$this->load->model('lesson_model');
			$lesson = $this->lesson_model->update_lesson($user_id, $lesson_id, $lesson_title, $start_date, $end_date, $description);

			redirect(base_url() . 'panel/update_lesson/' . $lesson_id . '/2#content_view');
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
				redirect(base_url() . 'panel/lesson/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/lesson/4#table_view');
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
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/job/1#content_view');
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
				redirect(base_url() . 'panel/job/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/job/3#content_view');
			}
		}
	}

	public function update_job()
	{
		$job_id = $this->session->userdata('job_id_for_update');
		
		if(empty($job_id))
		{
			redirect(base_url() . 'panel/job#content_view');
		}

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
				'label'		=>	'ماه شرعو دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_start_year',
				'label'		=>	'سال شرعو دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_end_month',
				'label'		=>	'ماه پایان دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_end_year',
				'label'		=>	'سال پایان دوره',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_description',
				'label'		=>	'توضیحات دوره',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			$job_id 	= $this->session->userdata('job_id_for_update');
			redirect(base_url() . 'panel/update_job/' . $job_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$job_id 		= $this->session->userdata('job_id_for_update');

			$job_title 	= $this->input->post('job_title', true);
			$start_date 	= $this->input->post('job_start_year', true) . '/' . $this->input->post('job_start_month', true);
			$end_date 		= $this->input->post('job_end_year', true) . '/' . $this->input->post('job_end_month', true);
			$description 	= $this->input->post('job_description', true);

			$this->load->model('job_model');
			$job = $this->job_model->update_job($user_id, $job_id, $job_title, $start_date, $end_date, $description);

			redirect(base_url() . 'panel/update_job/' . $job_id . '/2#content_view');
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
				redirect(base_url() . 'panel/job/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/job/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/job/4');
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
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/ability/1#content_view');
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
				redirect(base_url() . 'panel/ability/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/ability/3#content_view');
			}
		}
	}

	public function update_ability()
	{
		$ability_id = $this->session->userdata('ability_id_for_update');
		
		if(empty($ability_id))
		{
			redirect(base_url() . 'panel/ability#content_view');
		}

		$rules = array(
			array(
				'field'		=>	'ability_title',
				'label'		=>	'عنوان توانایی',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'ability_description',
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
			$ability_id 	= $this->session->userdata('ability_id_for_update');
			redirect(base_url() . 'panel/update_ability/' . $ability_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$ability_id 	= $this->session->userdata('ability_id_for_update');
			$ability_title 	= $this->input->post('ability_title', true);
			$description 	= $this->input->post('ability_description', true);

			$this->load->model('ability_model');
			$ability = $this->ability_model->update_ability($user_id, $ability_id, $ability_title, $description);

			redirect(base_url() . 'panel/update_ability/' . $ability_id . '/2#content_view');
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
				redirect(base_url() . 'panel/ability/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/ability/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/ability/4');
		}
	}

	public function add_project()
	{
		$rules = array(
			array(
				'field'		=>	'project_title',
				'label'		=>	'عنوان پروژه',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_start_month',
				'label'		=>	'ماه شرعو پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_start_year',
				'label'		=>	'سال شرعو پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_end_month',
				'label'		=>	'ماه پایان پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_end_year',
				'label'		=>	'سال پایان پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'job_description',
				'label'		=>	'توضیحات پروژه',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/project/1#content_view');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$project_title 	= $this->input->post('project_title', true);
			$start_date 	= $this->input->post('project_start_year', true) . '/' . $this->input->post('project_start_month', true);
			$end_date 		= $this->input->post('project_end_year', true) . '/' . $this->input->post('project_end_month', true);
			$description 	= $this->input->post('project_description', true);

			$this->load->model('project_model');
			$project = $this->project_model->insert_project($user_id, $project_title, $start_date, $end_date, $description);

			if($project == 1)
			{
				redirect(base_url() . 'panel/project/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/project/3#content_view');
			}
		}
	}

	public function update_project()
	{
		$project_id = $this->session->userdata('project_id_for_update');
		
		if(empty($project_id))
		{
			redirect(base_url() . 'panel/project#content_view');
		}

		$rules = array(
			array(
				'field'		=>	'project_title',
				'label'		=>	'عنوان پروژه',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_start_month',
				'label'		=>	'ماه شرعو پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_start_year',
				'label'		=>	'سال شرعو پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_end_month',
				'label'		=>	'ماه پایان پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_end_year',
				'label'		=>	'سال پایان پروژه',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'project_description',
				'label'		=>	'توضیحات پروژه',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			$project_id 	= $this->session->userdata('project_id_for_update');
			redirect(base_url() . 'panel/update_project/' . $project_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$project_id 	= $this->session->userdata('project_id_for_update');

			$project_title 	= $this->input->post('project_title', true);
			$start_date 	= $this->input->post('project_start_year', true) . '/' . $this->input->post('project_start_month', true);
			$end_date 		= $this->input->post('project_end_year', true) . '/' . $this->input->post('project_end_month', true);
			$description 	= $this->input->post('project_description', true);

			$this->load->model('project_model');
			$project = $this->project_model->update_project($user_id, $project_id, $project_title, $start_date, $end_date, $description);

			redirect(base_url() . 'panel/update_project/' . $project_id . '/2#content_view');
		}
	}

	public function delete_project($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('project_model');
			$project = $this->project_model->delete_project($id, $user_id);
			if($project == 1)
			{
				redirect(base_url() . 'panel/project/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/project/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/project/4');
		}
	}

	public function add_article()
	{
		$rules = array(
			array(
				'field'		=>	'article_title',
				'label'		=>	'عنوان مقاله',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_start_month',
				'label'		=>	'ماه شرعو مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_start_year',
				'label'		=>	'سال شرعو مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_end_month',
				'label'		=>	'ماه پایان مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_end_year',
				'label'		=>	'سال پایان مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_description',
				'label'		=>	'توضیحات مقاله',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/article/1#content_view');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$article_title 	= $this->input->post('article_title', true);
			$start_date 	= $this->input->post('article_start_year', true) . '/' . $this->input->post('article_start_month', true);
			$end_date 		= $this->input->post('article_end_year', true) . '/' . $this->input->post('article_end_month', true);
			$description 	= $this->input->post('article_description', true);

			$this->load->model('article_model');
			$article = $this->article_model->insert_article($user_id, $article_title, $start_date, $end_date, $description);

			if($article == 1)
			{
				redirect(base_url() . 'panel/article/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/article/3#content_view');
			}
		}
	}

	public function update_article()
	{
		$article_id = $this->session->userdata('article_id_for_update');
		
		if(empty($article_id))
		{
			redirect(base_url() . 'panel/article#content_view');
		}

		$rules = array(
			array(
				'field'		=>	'article_title',
				'label'		=>	'عنوان مقاله',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_start_month',
				'label'		=>	'ماه شرعو مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_start_year',
				'label'		=>	'سال شرعو مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_end_month',
				'label'		=>	'ماه پایان مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_end_year',
				'label'		=>	'سال پایان مقاله',
				'rules'		=>	'required|numeric',
				'errors'	=>	array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'numeric'		=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'article_description',
				'label'		=>	'توضیحات مقاله',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			$article_id 	= $this->session->userdata('article_id_for_update');
			redirect(base_url() . 'panel/update_article/' . $article_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$article_id 	= $this->session->userdata('article_id_for_update');

			$article_title 	= $this->input->post('article_title', true);
			$start_date 	= $this->input->post('article_start_year', true) . '/' . $this->input->post('article_start_month', true);
			$end_date 		= $this->input->post('article_end_year', true) . '/' . $this->input->post('article_end_month', true);
			$description 	= $this->input->post('article_description', true);

			$this->load->model('article_model');
			$article = $this->article_model->update_article($user_id, $article_id, $article_title, $start_date, $end_date, $description);

			redirect(base_url() . 'panel/update_article/' . $article_id . '/2#content_view');
		}
	}

	public function delete_article($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('article_model');
			$article = $this->article_model->delete_article($id, $user_id);
			if($article == 1)
			{
				redirect(base_url() . 'panel/article/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/article/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/article/4');
		}
	}

	public function add_achievement()
	{
		$rules = array(
			array(
				'field'		=>	'achievement_title',
				'label'		=>	'عنوان افتخار',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'achievement_description',
				'label'		=>	'توضیحات افتخار',
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/achievement/1#content_view');
		}
		else
		{
			$user_id = $this->session->userdata('user_id');

			$achievement_title = $this->input->post('achievement_title', true);
			$description 	= $this->input->post('achievement_description', true);

			$this->load->model('achievement_model');
			$achievement = $this->achievement_model->insert_achievement($user_id, $achievement_title, $description);

			if($achievement == 1)
			{
				redirect(base_url() . 'panel/achievement/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/achievement/3#content_view');
			}
		}
	}

	public function update_achievement()
	{
		$achievement_id = $this->session->userdata('achievement_id_for_update');
		
		if(empty($achievement_id))
		{
			redirect(base_url() . 'panel/achievement#content_view');
		}

		$rules = array(
			array(
				'field'		=>	'achievement_title',
				'label'		=>	'عنوان افتخار',
				'rules'		=>	'required|min_length[3]|max_length[70]',
				'errors'	=>array(
					'required'		=>	'فیلد %s معتبر نمی باشد.',
					'min_length'	=>	'فیلد %s معتبر نمی باشد.',
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
			array(
				'field'		=>	'achievement_description',
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
			$achievement_id 	= $this->session->userdata('achievement_id_for_update');
			redirect(base_url() . 'panel/update_achievement/' . $achievement_id . '/1#content_view');
		}
		else
		{
			$user_id 			= $this->session->userdata('user_id');
			$achievement_id 	= $this->session->userdata('achievement_id_for_update');
			$achievement_title 	= $this->input->post('achievement_title', true);
			$description 		= $this->input->post('achievement_description', true);

			$this->load->model('achievement_model');
			$achievement = $this->achievement_model->update_achievement($user_id, $achievement_id, $achievement_title, $description);

			redirect(base_url() . 'panel/update_achievement/' . $achievement_id . '/2#content_view');
		}
	}

	public function delete_achievement($id)
	{
		$id = xss_clean($id);
		if(is_numeric($id))
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('achievement_model');
			$achievement = $this->achievement_model->delete_achievement($id, $user_id);
			if($achievement == 1)
			{
				redirect(base_url() . 'panel/achievement/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/achievement/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/achievement/4');
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
				'rules'		=>	'max_length[500]',
				'errors'	=>	array(
					'max_length'	=>	'فیلد %s معتبر نمی باشد.'
				)
			),
		);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run()==false)
		{
			redirect(base_url() . 'panel/favorite/1#content_view');
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
				redirect(base_url() . 'panel/favorite/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/favorite/3#content_view');
			}
		}
	}

	public function update_favorite()
	{
		$favorite_id = $this->session->userdata('favorite_id_for_update');
		
		if(empty($favorite_id))
		{
			redirect(base_url() . 'panel/favorite#content_view');
		}

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
			$favorite_id 	= $this->session->userdata('favorite_id_for_update');
			redirect(base_url() . 'panel/update_favorite/' . $favorite_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$favorite_id 	= $this->session->userdata('favorite_id_for_update');
			$favorite_title = $this->input->post('favorite_title', true);
			$description 	= $this->input->post('favorite_description', true);

			$this->load->model('favorite_model');
			$favorite = $this->favorite_model->update_favorite($user_id, $favorite_id, $favorite_title, $description);

			redirect(base_url() . 'panel/update_favorite/' . $favorite_id . '/2#content_view');
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
				redirect(base_url() . 'panel/favorite/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/favorite/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/favorite/4');
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
			redirect(base_url() . 'panel/social/1#content_view');
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
				redirect(base_url() . 'panel/social/2#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/social/3#content_view');
			}
		}
	}

	public function update_social()
	{
		$social_id = $this->session->userdata('social_id_for_update');
		
		if(empty($social_id))
		{
			redirect(base_url() . 'panel/social#content_view');
		}

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
			$social_id 	= $this->session->userdata('social_id_for_update');
			redirect(base_url() . 'panel/update_social/' . $social_id . '/1#content_view');
		}
		else
		{
			$user_id 		= $this->session->userdata('user_id');
			$social_id 		= $this->session->userdata('social_id_for_update');
			$social_url 	= $this->input->post('social_url', true);
			$social_type 	= $this->input->post('social_type', true);

			$this->load->model('social_model');
			$social = $this->social_model->update_social($user_id, $social_id, $social_url, $social_type);

			redirect(base_url() . 'panel/update_social/' . $social_id . '/2#content_view');
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
				redirect(base_url() . 'panel/social/5#table_view');
			}
			else
			{
				redirect(base_url() . 'panel/social/4#table_view');
			}
		}
		else
		{
			redirect(base_url() . 'panel/social/4');
		}
	}
}

?>