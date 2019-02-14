<h2>پنل کاربری -) تنظیمات</h2>
<?php
	echo form_open($url . 'admin/change_password', 'method="post" class="panel_form"');

	$old_password_input = array(
		'name'			=>	'old_password',
		'placeholder'	=>	'رمز عبور فعلی',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$new_password_input = array(
		'name'			=>	'new_password',
		'placeholder'	=>	'رمز عبور جدید',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$new_repassword_input = array(
		'name'			=>	'new_repassword',
		'placeholder'	=>	'تکرار رمز عبور جدید',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$submit_input = array(
		'name'			=>	'setting_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>رمز عبور فعلی</strong></td>
		<td><?php echo form_password($old_password_input); ?></td>
	</tr>
	<tr>
		<td><strong>رمز عبور جدید</strong></td>
		<td><?php echo form_password($new_password_input); ?></td>
	</tr>
	<tr>
		<td><strong>تکرار رمز عبور</strong></td>
		<td><?php echo form_password($new_repassword_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">لطفا رمز عبور فعلی خود را درست وارد کنید.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">رمز عبور حساب شما با موفقیت تغییر یافت.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای امنیت بیشتر بهتر است در بازه های زمانی معینی رمز عبور خود را تغییر دهید.</p>
<p>رمز عبور قوی و غیر قابل پیش بینی رمز عبوری است که شامل حروف، اعداد، کاراکترهای ویژه می باشد.</p>
<p>رمز عبور هر شخص مانند کلید گاوصندوق هر فرد است، پس کلید گاوصندوق اطلاعات خود را در اختیار دیگران قرار ندهید.</p>
<?php
	echo form_close();
?>