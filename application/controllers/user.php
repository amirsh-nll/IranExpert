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
				'rules'		=>	'required|min_length[3]|max_length[100]',
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
			echo $lesson;
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
				'rules'		=>	'required|min_length[3]|max_length[100]',
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

			$job_title 	= $this->input->post('job_title', true);
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
			echo $lesson;
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
}

?>
