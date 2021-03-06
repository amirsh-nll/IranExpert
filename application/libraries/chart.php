<?php
defined('BASEPATH') or exit('No direct script access allowed');

class chart {
	public function statistics_chart($today=0, $yesterday=0, $total=0)
	{
		$max 				= max($today, $yesterday, $total);
		$min 				= min($today, $yesterday, $total);

		$number 	 		= 0;
		$today_capacity 	= 0;
		$yesterday_capacity = 0;
		$total_capacity 	= 0;

		$number_up			= $max/5;
		$row				= array('', '', '', '', '', '', '', '', '');
		$chart_number		= array(0, 0, 0, 0, 0, 0, 0, 0, 0);

		for($i=0;$i<=7;$i++)
		{
			if($today >= $number)
			{
				$today_capacity = $today_capacity + 1;
			}
			if($yesterday >= $number)
			{
				$yesterday_capacity = $yesterday_capacity + 1;
			}
			if($total >= $number)
			{
				$total_capacity = $total_capacity + 1;
			}

			if($max < $number)
			{
				if($chart_number[$i-1] != $max)
				{
					$chart_number[$i] = $max;
					$chart_number[$i+1] = $max + $number_up;
				}
				else
				{
					$chart_number[$i] = $max + $number_up;
				}
				break;
			}
			else
			{
				$chart_number[$i]	= $number;
			}

			$number = $number + $number_up;
		}

		$table = '<table class="chart" width="100%" cellspacing="0" cellpadding="0">';

		for($i=0;$i<=7;$i++)
		{
			$row[$i] = $row[$i] . '<tr>';
			if($today_capacity != 0)
			{
				if($today_capacity!=1)
				{
					$row[$i] = $row[$i] . '<td><p class="bar1">&nbsp;</p></td>';
				}
				else
				{
					$row[$i] = $row[$i] . '<td><p class="bar1">' . $this->tr_num($today) . '</p></td>';
				}
				$today_capacity = $today_capacity - 1;
			}
			else
			{
				$row[$i] = $row[$i] . '<td></td>';
			}

			if($yesterday_capacity != 0)
			{
				if($yesterday_capacity!=1)
				{
					$row[$i] = $row[$i] . '<td><p class="bar2">&nbsp;</p></td>';
				}
				else
				{
					$row[$i] = $row[$i] . '<td><p class="bar2">' . $this->tr_num($yesterday) . '</p></td>';
				}
				$yesterday_capacity = $yesterday_capacity - 1;
			}
			else
			{
				$row[$i] = $row[$i] . '<td></td>';
			}

			if($total_capacity != 0)
			{
				if($total_capacity!=1)
				{
					$row[$i] = $row[$i] . '<td><p class="bar3">&nbsp;</p></td>';
				}
				else
				{
					$row[$i] = $row[$i] . '<td><p class="bar3">' . $this->tr_num($total) . '</p></td>';
				}
				$total_capacity = $total_capacity - 1;
			}
			else
			{
				$row[$i] = $row[$i] . '<td></td>';
			}

			$row[$i] = $row[$i] . '<td>' . $this->tr_num(round($chart_number[$i])) . '</td></tr>';
		}

		for($i=6;$i>=0;$i--)
		{
			$table = $table . $row[$i];
		}

		$table = $table . '<tr><td>بازدید امروز</td><td>بازدید دیروز</td><td>بازدید کل</td><td>آمار</td></tr></table>';
		
		return $table;
	}

	public function tr_num($str,$mod='fa',$mf='٫')
	{
		$num_a=array('0','1','2','3','4','5','6','7','8','9','.');
		$key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
		return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
	}
}