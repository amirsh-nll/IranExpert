<h2>پنل کاربری -) توانایی ها -) ویرایش توانایی ها</h2>
<?php
	echo form_open('user/update_ability', 'method="post" class="panel_form"');

	$ability_item 	= $ability_item[0];

	$ability_title_input = array(
		'name'			=>	'ability_title',
		'place_holder'	=>	'عنوان توانایی',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$ability_item['title']
	);
	$ability_description = array(
		'name'			=>	'ability_description',
		'maxlength'		=>	'500',
		'value'			=>	$ability_item['description']
	);
	$submit_input = array(
		'name'			=>	'ability_submit',
		'value'			=>	'ثبت'
	);
?> 

<table>
	<tr>
		<td><strong>عنوان توانایی</strong></td>
		<td><?php echo form_input($ability_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($ability_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/ability#table_view'; ?>" title="بازگشت">بازگشت</a>
		</td>
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
<p>در این بخش با وارد کردن توانایی ها خود کارفرمایان و بازدیدکنندگان را برای انتخاب خود ترغیب می کنید.</p>
<?php
	echo form_close();
?>