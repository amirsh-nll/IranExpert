<h2>پنل کاربری -) اطلاعات شغلی -) ویرایش</h2>
<?php
	echo form_open('user/update_job', 'method="post" class="panel_form"');

	$job_item 		= $job_item[0];
	$start 			= explode('/', $job_item['start']);
	$end 			= explode('/', $job_item['end']);

	$job_title_input = array(
		'name'			=>	'job_title',
		'place_holder'	=>	'عنوان شغل',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$job_item['title']
	);
	for($i=1;$i<=12;$i++)
	{
		$job_start_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$job_start_year_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$job_end_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$job_end_year_item[$i]=$this->jdf->tr_num($i);
	}
	$job_description = array(
		'name'			=>	'job_description',
		'maxlength'		=>	'500',
		'value'			=>	$job_item['description']
	);
	$submit_input = array(
		'name'			=>	'job_submit',
		'value'			=>	'بروزرسانی'
	);
?>

<table>
	<tr>
		<td><strong>عنوان شغل</strong></td>
		<td><?php echo form_input($job_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع دوره</strong></td>
		<td><?php echo form_dropdown('job_start_month', $job_start_month_item, $start[1], 'class="job_item"'); echo form_dropdown('job_start_year', $job_start_year_item, $start[0], 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان دوره</strong></td>
		<td><?php echo form_dropdown('job_end_month', $job_end_month_item, $end[1], 'class="job_item"'); echo form_dropdown('job_end_year', $job_end_year_item, $end[0], 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($job_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/job#table_view'; ?>" title="بازگشت">بازگشت</a>
		</td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت بروزرسانی شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>قبل از ویرایش لطفا اطلاعات قبلی خود را مشاهده کنید ممکن است به صورت اشتباهی وارد این بخش شده باشید و اطلاعات صحیح خود را از بین ببرید.</p>
<?php
	echo form_close();
?>