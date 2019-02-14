<?php

/*
 *
 * Name 		: Image Model
 * Date 		: 1395/08/27
 * Auther 		: A.shokri
 * Description 	: The Model From irex_image Table.
 *
*/

class image_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default_image($user_id)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'file_name'		=>	'default.png',
			'description'	=>	''
		);
		$this->db->insert('image', $data);
	}

	public function delete_image($user_id)
	{
		$data = array
		(
			'user_id'		=>	$user_id,
			'file_name'		=>	'default.png',
			'description'	=>	'Admin Changed This Image'
		);

		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('image');
	}

	public function read_all_image($page=1)
	{
		if($page!=1)
		{
			$page = $page * 9 - 8;
		}
		$this->db->limit(9, $page);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('image');

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function image_count()
	{
		$result = $this->db->get('image');
		return $result->num_rows();
	}

	public function image_default_count()
	{
		$this->db->where('file_name', 'default.png');
		$result = $this->db->get('image');
		return $result->num_rows();
	}

	public function image_undefault_count()
	{
		return $this->image_count() - $this->image_default_count();
	}

	public function search_image($middle_name)
	{
		$this->load->model('user_model');
		$user = $this->user_model->search_image_user($middle_name);

		if($user===0 || $user->num_rows()<1)
		{
			return 0;
		}
		else
		{
			$user = $user->result_array();
		}

		$image 	= $this->db->get('image');
		$image 	= $image->result_array();
		$images = '';

		foreach ($image as $my_image) {
			$images[$my_image['user_id']] = $my_image['file_name'];
		}

		$i=0;
		$result='';
		$this->load->model('login_model');
		foreach ($user as $my_user) {
			if(isset($images[$my_user['id']]))
			{
				$result[$i] = array
				(
					'middle_name'	=>	$my_user['middle_name'],
					'file_name'		=>	$images[$my_user['id']],
					'last_login'	=>	$this->login_model->last_login($my_user['id'])
				);
				$i+=1;
			}
		}

		return $result;
	}

	public function top_user_default_image()
	{
		$this->db->where('file_name', 'default.png');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('image',10);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function top_user_undefault_image()
	{
		$this->db->where('file_name<>', 'default.png');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('image',10);

		if($result->num_rows()>0)
		{
			return $result->result_array();
		}
		else
		{
			return 0;
		}
	}
}

?>