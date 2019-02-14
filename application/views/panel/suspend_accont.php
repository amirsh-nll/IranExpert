<h2>پنل کاربری -) انسداد حساب کاربری</h2>
<p>با انسداد حساب کاربری خود، به صورت بلند مدت امکان دسترسی به پنل کاربری و روزمه آنلاین شما غیر ممکن خواهد شد. در صورت پشیمانی مجبور به عضویت دوباره خواهید شد.</p>
<p>&nbsp;</p>
<p><strong>موارد زیر حذف خواهند شد و قابل بازیابی نیستند:</strong></p>
<p>تصویر کاربری</p>
<p>اطلاعات فردی</p>
<p>اطلاعات تماس</p>
<p>اطلاعات تحصیلی</p>
<p>اطلاعات شغلی</p>
<p>توانایی ها</p>
<p>پروژه ها</p>
<p>مقالات</p>
<p>افتخارات</p>
<p>علاقه مندی ها</p>
<p>شبکه های اجتماعی</p>
<p>پیام ها</p>
<div id="suspend_view">&nbsp;</div>
<p><strong>انسداد حساب کاربری:</strong></p>
<?php
	echo form_open('user/suspend_accont', 'method="post" class="panel_form"');
	$password_input = array(
		'name'			=>	'password',
		'place_holder'	=>	'رمز عبور',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$reason_input = array(
		'name'			=>	'reason',
		'maxlength'		=>	'1000'
	);
	$captcha_input = array(
		'name'			=>	'captcha',
		'placeholder'	=>	'گد امنیتی',
		'required'		=>	'required',
		'maxlength'		=> 	'5'
	);
	$submit_input = array(
		'name'			=>	'suspend_submit',
		'value'			=>	'ثبت',
		'class'			=>	'suspend_accont',
		'style'			=>	'border:none !important;'
	);
?>
<table>
	<tr>
		<td><strong>رمز عبور</strong></td>
		<td><?php echo form_password($password_input); ?></td>
	</tr>
	<tr>
		<td><strong>دلیل شما(اختیاری)</strong></td>
		<td><?php echo form_textarea($reason_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><div class="captcha_suspend_accont"><?php echo $captcha['image']; ?></div></td>
	</tr>
	<tr>
		<td><strong>کد امنیتی</strong></td>
		<td><?php echo form_input($captcha_input); ?></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo form_submit($submit_input); ?>
		</td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">لطفا رمز عبور خود را صحیح وارد کنید.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشد.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">لطفا کد امنیتی را صحیح وارد کنید.</p>';
	}
?>

<?php
	echo form_close();
?>