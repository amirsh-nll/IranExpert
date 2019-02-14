<h2>پنل مدیریت -) یادآور ها -) ویرایش</h2>
<?php
	echo form_open($url . 'admin/update_reminder', 'method="post" class="panel_form"');

	$reminder_item 	= $reminder_item[0];

	$reminder_title_input = array(
		'name'			=>	'reminder_title',
		'place_holder'	=>	'عنوان یادآور',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$reminder_item['title']
	);
	$reminder_description = array(
		'name'			=>	'reminder_description',
		'maxlength'		=>	'500',
		'value'			=>	$reminder_item['description']
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
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/reminder#table_view'; ?>" title="بازگشت">بازگشت</a>
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
<p>در این بخش با وارد کردن یادآورهای خود می توانید در استفاده های بعدی از سامانه مواردی را به یاد بیاورید و آنها را انجام دهید.</p>
<?php
	echo form_close();
?>