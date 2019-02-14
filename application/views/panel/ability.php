<h2>توانایی ها</h2>
<?php
	echo form_open('data/ability','method="post" class="panel_form"');

	$ability_title_input = array(
		'name'			=>	'ability_title',
		'place_holder'	=>	'عنوان شغل',
		'maxlength'		=>	'100',
		'required'		=>	'required'
	);
	$ability_description = array(
		'name'			=>	'ability_description',
		'maxlength'		=>	'255',
	);
	$submit_input = array(
		'name'			=>	'ability_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان توانایی</td>
		<td><?php echo form_input($ability_title_input); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
		<td><?php echo form_textarea($ability_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<p>&nbsp;</p>
<p>لیست توانایی ها :</p>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن توانایی ها خود کارفرمایان و بازدیدکنندگان را برای انتخاب خود ترغیب می کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 تونایی را دارید پس با ثبت توانایی های برجسته ی خود معتبر شوید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>