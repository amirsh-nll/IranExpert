<?php

/*
 *
 * Name 		: Violation Model
 * Date 		: 1395/09/09
 * Auther 		: A.shokri
 * Description 	: The Model From irex_violation Table.
 *
*/

class violation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function read_violation_list($page=0)
	{
		if($page!=0)
		{
			$page = $page * 10 - 10;
		}
		$this->db->limit(10, $page);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get('violation');

		if($result->num_rows()>0)
		{
			$i=0;
			$results='';
			$result = $result->result_array();

			foreach ($result as $my_result) {
				switch ($my_result['type']) {
					case 1:
					{
						$type = 'توزیع محتوای نژادی یا قومی ، دینی و ...';
					}
					break;
					case 2:
					{
						$type = 'هرزنامه';
					}
					break;
					case 3:
					{
						$type = 'تصویر غیرمجاز یا توهین آمیز';
					}
					break;
					case 4:
					{
						$type = 'توزیع اطلاعات شخصی و محرمانه شخصی سایر افراد';
					}
					break;
					case 5:
					{
						$type = 'متفرقه';
					}
					break;
					default:
					{
						$type = 'متفرقه';
					}
					break;
				}
				$results[$i] = array(
					'id'			=>	$my_result['id'],
					'user_id'		=>	$my_result['user_id'],
					'type'			=>	$type,
					'reason'		=>	$my_result['reason'],
					'description'	=>	$my_result['description']
				);
				$i+=1;
			}

			return $results;
		}
		else
		{
			return 0;
		}
	}

	public function violation_count()
	{
		$result = $this->db->get('violation');
		return $result->num_rows();
	}
}

?>