<h2>اطلاعات فردی</h2>
<?php
	echo form_open('user/edit_person','method="post" class="panel_form"');

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
		$birth_day_item[$i]=$i;
	}
	for($i=1;$i<=12;$i++)
	{
		$birth_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$birth_year_item[$i]=$i;
	}
	$gender_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'مرد',
		'2'				=>	'زن'
	);
	$marriage_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'مجرد',
		'2'				=>	'متاهل'
	);
	$about_input = array(
		'name'			=>	'person_about',
		'maxlength'		=>	'255',
		'value'			=>	$about_value
	);
	$submit_input = array(
		'name'			=>	'person_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>نام</td>
		<td><?php echo form_input($first_name_input); ?></td>
	</tr>
	<tr>
		<td>نام خانوادگی</td>
		<td><?php echo form_input($last_name_input); ?></td>
	</tr>
	<tr>
		<td>تاریخ تولد</td>
		<td><?php echo form_dropdown('person_birth_day', $birth_day_item,$birth_day_value,'class="birth_item"'); echo form_dropdown('person_birth_month', $birth_month_item,$birth_month_value,'class="birth_item"'); echo form_dropdown('person_birth_year', $birth_year_item,$birth_year_value,'class="birth_item"'); ?></td>
	</tr>
	<tr>
		<td>جنسیت</td>
		<td><?php echo form_dropdown('person_gender', $gender_item, $gender_value); ?></td>
	</tr>
	<tr>
		<td>وضعیت تاهل</td>
		<td><?php echo form_dropdown('person_marriage', $marriage_item, $marriage_value); ?></td>
	</tr>
	<tr>
		<td>درباره من</td>
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
<p>راهنمایی : </p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این صفحه شما میتوانید اطلاعات فردی خود را وارد کنید که این اطلاعات در شناسایی افراد حقیقی نقش موثری دارند.</p>
<p>از توزیع اطلاعات شخصی و محرمانه شخصی سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.</p>

<?php
	echo form_close();
?>