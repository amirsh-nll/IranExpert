<h2>پنل کاربری -) افزودن کاربر جدید</h2>
<?php 
	echo form_open('admin/new_user', 'method="post" class="panel_form"');
	$email_input = array(
		'name'			=>	'email',
		'placeholder'	=>	'ایمیل',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$password_input = array(
		'name'			=>	'password',
		'placeholder'	=>	'رمز عبور',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$repassword_input = array(
		'name'			=>	'repassword',
		'placeholder'	=>	'تکرار رمز عبور',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت نام'
	);
?>
<table>
	<tr>
		<td>آدرس ایمیل</td>
		<td><?php echo form_input($email_input); ?></td>
	</tr>
	<tr>
		<td>رمز عبور</td>
		<td><?php echo form_password($password_input); ?></td>
	</tr>
	<tr>
		<td>تکرار رمز عبور</td>
		<td><?php echo form_password($repassword_input); ?></td>
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
?>

<?php echo form_close(); ?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>با کمک فرم بالا می توانید کاربر جدیدی به سیستم اضافه کنید.</p>
<p>کاربر جدیدی که به سیستم اضافه می کنید به صورت دستی است و تنها یک عضو ساده خواهد شد.</p>
<p>کاربر ساخته شده می به صورت اتوماتیک فعال خواهد بود و می تواند از خدمات وبسایت به راحتی استفاده کند.</p>
<p></p>