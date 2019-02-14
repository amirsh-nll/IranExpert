<h2>پنل کاربری -) اطلاعات تماس</h2>
<?php
	echo form_open($url . 'user/update_contact', 'method="post" class="panel_form"');

	$email_input = array(
		'name'			=>	'contact_email',
		'placeholder'	=>	'ایمیل قابل نمایش در رزومه',
		'maxlength'		=>	'70',
		'value'			=>	$email_value
	);
	$mobile_number_input = array(
		'name'			=>	'contact_mobile_number',
		'placeholder'	=>	'همراه',
		'maxlength'		=>	'20',
		'value'			=>	$mobile_number_value
	);
	$phone_number_input = array(
		'name'			=>	'contact_phone_number',
		'placeholder'	=>	'تلفن',
		'maxlength'		=>	'20',
		'value'			=>	$phone_number_value
	);
	$postal_code_input = array(
		'name'			=>	'contact_postal_code',
		'placeholder'	=>	'کد پستی',
		'maxlength'		=>	'20',
		'value'			=>	$postal_code_value
	);

	$province_item 	= $province;
	
	$city_name_input = array(
		'name'			=>	'contact_city_name',
		'placeholder'	=>	'نام شهر',
		'maxlength'		=>	'50',
		'value'			=>	$city_name_value
	);
	
	$address_input = array(
		'name'			=>	'contact_address',
		'maxlength'		=>	'2000',
		'value'			=>	$address_value
	);
	$submit_input = array(
		'name'			=>	'contact_submit',
		'value'			=>	'بروز رسانی'
	);
?>

<table>
	<tr>
		<td><strong>ایمیل عمومی</strong></td>
		<td><?php echo form_input($email_input); ?></td>
	</tr>
	<tr>
		<td><strong>شماره همراه</strong></td>
		<td><?php echo form_input($mobile_number_input); ?></td>
	</tr>
	<tr>
		<td><strong>شماره تماس</strong></td>
		<td><?php echo form_input($phone_number_input); ?></td>
	</tr>
	<tr>
		<td><strong>کد پستی</strong></td>
		<td><?php echo form_input($postal_code_input); ?></td>
	</tr>
	<tr>
		<td><strong>استان</strong></td>
		<td><?php echo form_dropdown('contact_province', $province_item, $province_id_value); ?></td>
	</tr>
	<tr>
		<td><strong>شهر</strong></td>
		<td><?php echo form_input($city_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>آدرس</strong></td>
		<td><?php echo form_textarea($address_input); ?></td>
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

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این صفحه شما میتوانید اطلاعات تماس خود را وارد کنید تا افراد بازدید کننده به راحتی بتوانند با شما ارتباط برقرار کنند.</p>
<p>از توزیع اطلاعات شخصی و محرمانه سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.</p>
<p>برای امنیت ایمیل شخصی شما در برابر اسپمرها، ما در این سامانه ایمیل قابل نمایش شما را با ایمیل ورود به سامانه جدا ساختیم تا بتوانید به انتخاب خودتان ایمیل مورد نظرتان را در رزومه خود نمایش دهید.</p>

<?php
	echo form_close();
?>