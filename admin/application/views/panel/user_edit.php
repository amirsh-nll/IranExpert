<h2>پنل مدیریت -) لیست کاربران -) ویرایش اطلاعات</h2>
<?php 
	echo form_open('admin/user_edit', 'method="post" class="panel_form"');
	$middle_name_input = array(
		'name'			=>	'middle_name_user',
		'placeholder'	=>	'نام',
		'maxlength'		=>	'70',
		'value'			=>	$middle_name_value
	);
	$first_name_input = array(
		'name'			=>	'person_first_name',
		'placeholder'	=>	'نام',
		'maxlength'		=>	'50',
		'value'			=>	$first_name_value
	);
	$last_name_input = array(
		'name'			=>	'person_last_name',
		'placeholder'	=>	'نام خانوادگی',
		'maxlength'		=>	'50',
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
	$about_input = array(
		'name'			=>	'person_about',
		'maxlength'		=>	'1000',
		'value'			=>	$about_value
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
		'maxlength'		=>	'500',
		'value'			=>	$address_value
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت'
	);
?>
<table>
	<tr>
		<td><strong>نام کاربری:</strong></td>
		<td><?php echo form_input($middle_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>نام:</strong></td>
		<td><?php echo form_input($first_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>نام خانوادگی:</strong></td>
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
		<td><strong>درباره من</strong></td>
		<td><?php echo form_textarea($about_input); ?></td>
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
		<td><?php echo form_dropdown('contact_province_id', $province_item, $province_id_value); ?></td>
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
		<td style="border:none;"></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/list_user" class="return_key" title="بازگشت">بازگشت</a>
		</td>
	</tr>
</table>
<div id="notice_view">&nbsp;</div>
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
<p>با کمک فرم بالا می تواند اطلاعات کاربر مورد نظر خود را ویرایش کنید.</p>
<p>اطلاعات کاربران شما بعد از ویرایش قابل بازیابی نیستند پس حتما دقت کنید.