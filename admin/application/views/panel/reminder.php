<h2>پنل مدیریت -) یادآور ها</h2>
<?php
	echo form_open('admin/add_reminder', 'method="post" class="panel_form"');

	$reminder_title_input = array(
		'name'			=>	'reminder_title',
		'place_holder'	=>	'عنوان یادآور',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$reminder_description = array(
		'name'			=>	'reminder_description',
		'maxlength'		=>	'500',
	);
	$submit_input = array(
		'name'			=>	'reminder_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان یادآور</strong></td>
		<td><?php echo form_input($reminder_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($reminder_description); ?></td>
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
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از' . $this->jdf->tr_num(20) . 'رکورد داشته باشید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست یادآور ها:</strong></p>

<?php
	if($reminder_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام یادآور</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($reminder_item as $my_reminder): ?>
				<tr>
					<td style="width:25%;"><?php echo $my_reminder['title']; ?></td>
					<td style="width:65%;"><?php echo $my_reminder['description']; ?></td>
					<td style="width:10%;">
					<a class="retrive_data_table_edit" href="<?php echo base_url() . 'panel/update_reminder/' . $my_reminder['id'] . '#content_view'; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'admin/delete_reminder/' . $my_reminder['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
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
				<td style="width:28%;">نام یادآور</td>
				<td style="width:65%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">هیچ یادآوری برای شما موجود نیست.</td>
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
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> یادآور را دارید.</p>
<p>در این بخش با وارد کردن یادآورهای خود می توانید در استفاده های بعدی از سامانه مواردی را به یاد بیاورید و آنها را انجام دهید.</p>
<?php
	echo form_close();
?>