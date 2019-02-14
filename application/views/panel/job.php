<h2>پنل کاربری -) اطلاعات شغلی</h2>
<?php
	echo form_open('user/add_job', 'method="post" class="panel_form"');

	$job_title_input = array(
		'name'			=>	'job_title',
		'place_holder'	=>	'عنوان شغل',
		'maxlength'		=>	'70',
		'required'		=>	'required'
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
		'name'			=>	'job_description',
		'maxlength'		=>	'500',
	);
	$submit_input = array(
		'name'			=>	'job_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان شغل</strong></td>
		<td><?php echo form_input($job_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع دوره شغلی</strong></td>
		<td><?php echo form_dropdown('job_start_month', $job_start_month_item, '', 'class="job_item"'); echo form_dropdown('job_start_year', $job_start_year_item, '', 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان دوره شغلی</strong></td>
		<td><?php echo form_dropdown('job_end_month', $job_end_month_item, '', 'class="job_item"'); echo form_dropdown('job_end_year', $job_end_year_item, '', 'class="job_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($job_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
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
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از 5 رکورد داشته باشید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست دوره های شغلی:</strong></p>
<?php
	if($job_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>عنوان شغلی</td>
				<td>شروع دوره</td>
				<td>پایان دوره</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($job_item as $my_job): ?>
				<tr>
					<td style="width:18%;"><?php echo $my_job['title']; ?></td>
					<td style="width:15%; text-align:center;"><?php echo $my_job['start']; ?></td>
					<td style="width:15%; text-align:center;"><?php echo $my_job['end']; ?></td>
					<td style="width:45%;"><?php echo $my_job['description']; ?></td>

					<td style="width:7%;">
						<a class="retrive_data_table_edit" href="<?php echo base_url() . 'panel/update_job/' . $my_job['id'] . '#content_view'; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_job/' . $my_job['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td style="width:18%;">عنوان شغل</td>
				<td style="width:15%;">شروع دوره</td>
				<td style="width:15%;">پایان دوره</td>
				<td style="width:45%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">شغلی برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>

<?php
	if($notice == 4)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 5)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در حال حاظر شما اجازه ثبت 20 دوره ی شغلی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن سوابق شغلی خود در شرکت ها، تیم ها و ... می توانید یک روزمه ی شغلی غنی برای خود ایجاد کنید.</p>
<?php
	echo form_close();
?>