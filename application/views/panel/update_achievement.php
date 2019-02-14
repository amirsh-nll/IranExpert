<h2>پنل کاربری -) افتخارات -) ویرایش</h2>
<?php
	echo form_open('user/update_achievement', 'method="post" class="panel_form"');

	$achievement_item 	= $achievement_item[0];

	$achievement_title_input = array(
		'name'			=>	'achievement_title',
		'place_holder'	=>	'عنوان افتخار',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$achievement_item['title']
	);
	$achievement_description = array(
		'name'			=>	'achievement_description',
		'maxlength'		=>	'500',
		'value'			=>	$achievement_item['description']
	);
	$submit_input = array(
		'name'			=>	'achievement_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان افتخار</strong></td>
		<td><?php echo form_input($achievement_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($achievement_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/achievement#table_view'; ?>" title="بازگشت">بازگشت</a>	
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
<p>در این بخش با وارد کردن افتخارات خود در مراحل مختلف زندگی خود می توانید خود را با دیگران متمایز کنید.</p>
<?php
	echo form_close();
?>