<h2>پنل کاربری -) لیست کاربران -) ارسال پیام</h2>
<?php
	echo form_open('admin/user_message', 'method="post" class="panel_form"');
	$title_input = array(
		'name'			=>	'title',
		'placeholder'	=>	'عنوان (اختیاری)',
		'maxlength'		=> 	100
	);
	$message_input = array(
		'name'			=>	'message',
		'maxlength'		=> 	500
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=> 	'ارسال پیام'
	);
?>

<table>
	<tr>
		<td>نام کاربری:</td>
		<td><?=$middle_name; ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_input($title_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_textarea($message_input); ?></td>
	</tr>
	<tr>
		<td style="border:none;"></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/list_user" class="return_key" title="بازگشت">بازگشت</a>
		</td>
	</tr>
</table>
<?php echo form_close(); ?>
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
<p>در این بخش می توانید به کاربران خود پیام دهید و آنها از صندوق پیام های خود پیام شما را بخوانند.</p>
<p>طریقه ی صحبت کردن و جمله بندی شما ممکن است در رفتار کاربر و استفاده از سامانه تغییر یابد پس مانند مدیران به آنها پیام دهید.</p>