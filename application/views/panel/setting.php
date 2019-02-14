<h2>پنل کاربری -) تنظیمات</h2>
<?php
	echo form_open($url . 'user/change_setting', 'method="post" class="panel_form"');

	$middle_name_input = array(
		'name'			=>	'middle_name',
		'place_holder'	=>	'نام کاربری',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$middle_name_value
	);
	$old_password_input = array(
		'name'			=>	'old_password',
		'place_holder'	=>	'رمز عبور فعلی',
		'maxlength'		=>	'40',
		'required'		=>	'required'
	);
	$new_password_input = array(
		'name'			=>	'new_password',
		'place_holder'	=>	'رمز عبور جدید',
		'maxlength'		=>	'40'
	);
	$new_repassword_input = array(
		'name'			=>	'new_repassword',
		'place_holder'	=>	'تکرار رمز عبور جدید',
		'maxlength'		=>	'40'
	);
	$submit_input = array(
		'name'			=>	'setting_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>نام کاربری</strong></td>
		<td><?php echo form_input($middle_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>رمز عبور فعلی</strong></td>
		<td><?php echo form_password($old_password_input); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
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
		<td colspan="2">
			<?php echo form_submit($submit_input); ?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<a class="suspend_accont" href="<?=$url . 'panel/suspend_accont'; ?>" title="غیر فعال کردن حساب کاربری">انسداد حساب کاربری</a>
		</td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشد.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#f00;">لطفا رمز عبور فعلی خود را صحیح وارد کنید.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#3acc17;">رمز عبور و نام کاربری حساب شما با موفقیت تغییر یافت.</p>';
	}
	elseif ($notice == 4)
	{
		echo '<p style="color:#3acc17;">نام کاربری با موفقیت تغییر یافت.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای امنیت بیشتر بهتر است در بازه های زمانی معینی رمز عبور خود را تغییر دهید.</p>
<p>رمز عبور قوی و غیر قابل پیش بینی رمز عبوری است که شامل حروف، اعداد، کاراکترهای ویژه می باشد.</p>
<p>رمز عبور هر شخص مانند کلید گاوصندوق هر فرد است، پس کلید گاوصندوق اطلاعات خود را در اختیار دیگران قرار ندهید.</p>
<p>با انسداد حساب کاربری خود، به صورت بلند مدت امکان دسترسی به پنل کاربری و روزمه آنلاین شما غیر ممکن خواهد شد. در صورت پشیمانی مجبور به عضویت دوباره خواهید شد.</p>
<p>در صورتی که قصد تغییر رمز عبور خود را ندارید و فقط قصد تغییر نام کاربری خود را دارید لطفا فیلد رمز عبور جدید و تکرار آن را خالی رها کنید و تنها نام کاربری جدید خود را وارد کرده و رمز عبور فعلی خود را وارد کنید.</p>
<?php
	echo form_close();
?>