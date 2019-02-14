<h2>پنل کاربری -) پروژه ها -) ویرایش</h2>
<?php
	echo form_open('user/update_project', 'method="post" class="panel_form"');

	$project_item 	= $project_item[0];
	$start 			= explode('/', $project_item['start']);
	$end 			= explode('/', $project_item['end']);

	$project_title_input = array(
		'name'			=>	'project_title',
		'place_holder'	=>	'عنوان پروژه',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$project_item['title']
	);
	for($i=1;$i<=12;$i++)
	{
		$project_start_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$project_start_year_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$project_end_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$project_end_year_item[$i]=$this->jdf->tr_num($i);
	}
	$project_description = array(
		'name'			=>	'project_description',
		'maxlength'		=>	'500',
		'value'			=>	$project_item['description']
	);
	$submit_input = array(
		'name'			=>	'project_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان پروژه</strong></td>
		<td><?php echo form_input($project_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع پروژه</strong></td>
		<td><?php echo form_dropdown('project_start_month', $project_start_month_item, $start[1], 'class="project_item"'); echo form_dropdown('project_start_year', $project_start_year_item, $start[0], 'class="project_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان پروژه</strong></td>
		<td><?php echo form_dropdown('project_end_month', $project_end_month_item, $end[1], 'class="project_item"'); echo form_dropdown('project_end_year', $project_end_year_item, $end[0], 'class="project_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($project_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/project#table_view'; ?>" title="بازگشت">بازگشت</a>
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
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن پروژه های انجام شده توسط شما می توانید بازدیدکنندگان را مجذوب خود کنید.</p>
<?php
	echo form_close();
?>