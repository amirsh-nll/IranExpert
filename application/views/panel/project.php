<h2>پنل کاربری -) پروژه ها</h2>
<?php
	echo form_open('user/add_project', 'method="post" class="panel_form"');

	$project_title_input = array(
		'name'			=>	'project_title',
		'place_holder'	=>	'عنوان پروژه',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	for($i=1;$i<=12;$i++)
	{
		$project_start_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$project_start_year_item[$i]=$i;
	}
	for($i=1;$i<=12;$i++)
	{
		$project_end_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$project_end_year_item[$i]=$i;
	}
	$project_description = array(
		'name'			=>	'project_description',
		'maxlength'		=>	'255',
	);
	$submit_input = array(
		'name'			=>	'project_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان پروژه</td>
		<td><?php echo form_input($project_title_input); ?></td>
	</tr>
	<tr>
		<td>شروع پروژه</td>
		<td><?php echo form_dropdown('project_start_month', $project_start_month_item, '', 'class="project_item"'); echo form_dropdown('project_start_year', $project_start_year_item, '', 'class="project_item"'); ?></td>
	</tr>
	<tr>
		<td>پایان پروژه</td>
		<td><?php echo form_dropdown('project_end_month', $project_end_month_item, '', 'class="project_item"'); echo form_dropdown('project_end_year', $project_end_year_item, '', 'class="project_item"'); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
		<td><?php echo form_textarea($project_description); ?></td>
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

<p>&nbsp;</p>
<p>لیست پروژه ها :</p>
<?php
	if($project_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>عنوان پروژه</td>
				<td>شروع پروژه</td>
				<td>پایان پروژه</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($project_item as $my_project): ?>
				<tr>
					<td style="width:20%;"><?php echo $my_project['title']; ?></td>
					<td style="width:10%; text-align:center;"><?php echo $my_project['start']; ?></td>
					<td style="width:10%; text-align:center;"><?php echo $my_project['end']; ?></td>
					<td style="width:60%;"><?php echo $my_project['description']; ?></td>
					<td><a href="<?php echo base_url() . 'user/delete_project/' . $my_project['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a></td>
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
				<td style="width:20%;">عنوان پروژه</td>
				<td style="width:15%;">شروع پروژه</td>
				<td style="width:15%;">پایان پروژه</td>
				<td style="width:50%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">پروژه ای برای نمایش موجود نیست.</td>
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
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن پروژه های انجام شده توسط شما می توانید بازدیدکنندگان را مجذوب خود کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 پروژه را دارید و با این محدودیت شما می توانید پروژه های برجسته تر خود را به ثبت برسانید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>