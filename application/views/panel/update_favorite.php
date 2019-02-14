<h2>پنل کاربری -) علاقه مندی ها -) ویرایش</h2>
<?php
	echo form_open($url . 'user/update_favorite', 'method="post" class="panel_form"');

	$favorite_item = $favorite_item[0];

	$favorite_title_input = array(
		'name'			=>	'favorite_title',
		'place_holder'	=>	'عنوان علاقه مندی',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$favorite_item['title']
	);
	$favorite_description = array(
		'name'			=>	'favorite_description',
		'maxlength'		=>	'500',
		'value'			=>	$favorite_item['description']
	);
	$submit_input = array(
		'name'			=>	'favorite_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان علاقه مندی</strong></td>
		<td><?php echo form_input($favorite_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($favorite_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/favorite#table_view'; ?>" title="بازگشت">بازگشت</a>
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
<p>در حال حاظر شما اجازه ثبت 20 علاقه مندی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن علاقه مندی های خود می توانید شخصیت، رفتار و عملکرد خود را برای دیگران قابل درک کنید.</p>
<?php
	echo form_close();
?>