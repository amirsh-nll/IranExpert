<h2>پنل کاربری -) اطلاعات فردی</h2>
<?php
	echo form_open($url . 'user/update_person', 'method="post" class="panel_form"');

	$first_name_input = array(
		'name'			=>	'person_first_name',
		'placeholder'	=>	'نام',
		'maxlength'		=>	'50',
		'required'		=>	'required',
		'value'			=>	$first_name_value
	);
	$last_name_input = array(
		'name'			=>	'person_last_name',
		'placeholder'	=>	'نام خانوادگی',
		'maxlength'		=>	'50',
		'required'		=>	'required',
		'value'			=>	$last_name_value
	);
	for($i=1;$i<=31;$i++)
	{
		$birth_day_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$birth_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$birth_year_item[$i]=$this->jdf->tr_num($i);
	}

	$person_activity_item = $activity;

	$gender_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'آقا',
		'2'				=>	'خانم'
	);
	$marriage_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'مجرد',
		'2'				=>	'متاهل'
	);
	$webpage_url_input = array(
		'name'			=>	'webpage_url',
		'placeholder'	=>	'آدرس http://test.com/user',
		'maxlength'		=>	'500',
		'value'			=>	$webpage_url_value
	);
	$about_input = array(
		'name'			=>	'person_about',
		'maxlength'		=>	'1000',
		'value'			=>	$about_value
	);
	$submit_input = array(
		'name'			=>	'person_submit',
		'value'			=>	'بروز رسانی'
	);
?>

<table>
	<tr>
		<td><strong>نام</strong></td>
		<td><?php echo form_input($first_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>نام خانوادگی</strong></td>
		<td><?php echo form_input($last_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>تاریخ تولد</strong></td>
		<td><?php echo form_dropdown('person_birth_day', $birth_day_item,$birth_day_value,'class="birth_item"'); echo form_dropdown('person_birth_month', $birth_month_item,$birth_month_value,'class="birth_item"'); echo form_dropdown('person_birth_year', $birth_year_item,$birth_year_value,'class="birth_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>زمینه فعالیت</strong></td>
		<td><?php echo form_dropdown('person_activity_id', $person_activity_item, $activity_id_value); ?></td>
	</tr>
	<tr>
		<td><strong>جنسیت</strong></td>
		<td><?php echo form_dropdown('person_gender', $gender_item, $gender_value); ?></td>
	</tr>
	<tr>
		<td><strong>وضعیت تاهل</strong></td>
		<td><?php echo form_dropdown('person_marriage', $marriage_item, $marriage_value); ?></td>
	</tr>
	<tr>
		<td><strong>وبسایت/وبلاگ</strong></td>
		<td><?php echo form_input($webpage_url_input); ?></td>
	</tr>
	<tr>
		<td><strong>درباره من</strong></td>
		<td><?php echo form_textarea($about_input); ?></td>
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
<p>در این صفحه شما میتوانید اطلاعات فردی خود را وارد کنید که این اطلاعات در شناسایی افراد حقیقی نقش موثری دارند.</p>
<p>از توزیع اطلاعات شخصی و محرمانه سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.</p>

<?php
	echo form_close();
?>