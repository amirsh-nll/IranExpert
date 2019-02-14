<h2>اطلاعات فردی</h2>
<?php
	echo form_open('data/person','method="post" class="panel_form"');

	$first_name_input = array(
		'name'=>'first_name',
		'placeholder'=>'نام',
		'maxlength'=>'50',
		'required'=>'required'
	);
	$last_name_input = array(
		'name'=>'last_name',
		'placeholder'=>'نام خانوادگی',
		'maxlength'=>'50',
		'required'=>'required'
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
		'0'=>'نامشخص',
		'1'=>'مرد',
		'2'=>'زن'
	);
	$marriage_item = array(
		'0'=>'نامشخص',
		'1'=>'مجرد',
		'2'=>'متاهل'
	);
	$about_input = array(
		'name'=>'about',
		'maxlength'=>'255'
	);
	$submit_input = array(
		'name'=>'person_submit',
		'value'=>'ثبت'
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
		<td><?php echo form_dropdown('birth_day', $birth_day_item,'','class="birth_item"'); echo form_dropdown('birth_month', $birth_month_item,'','class="birth_item"'); echo form_dropdown('birth_year', $birth_year_item,'','class="birth_item"'); ?></td>
	</tr>
	<tr>
		<td>جنسیت</td>
		<td><?php echo form_dropdown('gender', $gender_item); ?></td>
	</tr>
	<tr>
		<td>وضعیت تاهل</td>
		<td><?php echo form_dropdown('marriage', $marriage_item); ?></td>
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

<p>&nbsp;</p>
<p>راهنمایی : </p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این صفحه شما میتوانید اطلاعات فردی خود را وارد کنید که این اطلاعات در شناسایی افراد حقیقی نقش موثری دارند.</p>
<p>از توزیع اطلاعات شخصی و محرمانه شخصی سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.</p>

<?php
	echo form_close();
?>