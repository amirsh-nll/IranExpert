<h2>علاقه مندی ها</h2>
<?php
	echo form_open('data/favorite','method="post" class="panel_form"');

	$favorite_title_input = array(
		'name'=>'favorite_title',
		'place_holder'=>'عنوان شغل',
		'maxlength'=>'100',
		'required'=>'required'
	);
	$favorite_description = array(
		'name'=>'favorite_description',
		'maxlength'=>'255',
	);
	$submit_input = array(
		'name'=>'favorite_submit',
		'value'=>'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان علاقه مندی</td>
		<td><?php echo form_input($favorite_title_input); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
		<td><?php echo form_textarea($favorite_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<p>&nbsp;</p>
<p>لیست علاقه مندی ها :</p>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن علاقه مندی های خود می توانید شخصیت، رفتار و عملکرد خود را برای دیگران قابل درک کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 علاقه مندی را دارید و با این محدودیت شما می توانید علایق قوی تر خود را به ثبت برسانید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>