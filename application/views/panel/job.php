<h2>اطلاعات شغلی</h2>
<?php
	echo form_open('data/job','method="post" class="panel_form"');

	$job_title_input = array(
		'name'=>'job_title',
		'place_holder'=>'عنوان شغل',
		'maxlength'=>'100',
		'required'=>'required'
	);
	for($i=1;$i<=12;$i++)
	{
		$job_start_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$job_start_year_item[$i]=$i;
	}
	for($i=1;$i<=12;$i++)
	{
		$job_end_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$job_end_year_item[$i]=$i;
	}
	$job_description = array(
		'name'=>'job_description',
		'maxlength'=>'255',
	);
	$submit_input = array(
		'name'=>'job_submit',
		'value'=>'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان شغل</td>
		<td><?php echo form_input($job_title_input); ?></td>
	</tr>
	<tr>
		<td>شروع دوره شغلی</td>
		<td><?php echo form_dropdown('job_start_month', $job_start_month_item, '', 'class="job_item"'); echo form_dropdown('job_start_year', $job_start_year_item, '', 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td>پایان دوره شغلی</td>
		<td><?php echo form_dropdown('job_end_month', $job_end_month_item, '', 'class="job_item"'); echo form_dropdown('job_end_year', $job_end_year_item, '', 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
		<td><?php echo form_textarea($job_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<p>&nbsp;</p>
<p>لیست دوره های شغلی :</p>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن سوابق شغلی خود در شرکت ها، تیم ها و ... می توانید یک روزمه ی شغلی غنی برای خود ایجاد کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 دوره ی شغلی را دارید و با این محدودیت شما می توانید پست های شغلی برجسته تر خود را به ثبت برسانید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>