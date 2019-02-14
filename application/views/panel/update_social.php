<h2>پنل کاربری -) شبکه های اجتماعی -) ویرایش</h2>
<?php
	echo form_open($url . 'user/update_social', 'method="post" class="panel_form"');

	$social_item = $social_item[0];

	$social_url_input = array(
		'name'			=>	'social_url',
		'placeholder'	=>	'آدرس http://test.com/user',
		'maxlength'		=>	'500',
		'required'		=>	'required',
		'value'			=>	$social_item['url']
	);
	$social_type_item = array(
		'1'				=>	'فیس بوک',
		'2'				=>	'لینکداین',
		'3'				=>	'اینستاگرام',
		'4'				=>	'توییتر',
		'5'				=>	'گوگل پلاس',
		'6'				=>	'تلگرام'
	);
	$submit_input = array(
		'name'			=>	'social_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>نوع شبکه اجتماعی</strong></td>
		<td><?php echo form_dropdown('social_type', $social_type_item, $social_item['type']); ?></td>
	</tr>
	<tr>
		<td><strong>آدرس پروفایل</strong></td>
		<td><?php echo form_input($social_url_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/social#table_view'; ?>" title="بازگشت">بازگشت</a>	
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
<p>در این بخش با وارد کردن پروفایل شبکه های اجتماعی دیگر می توانید به یافتن خود توسط افراد دیگر کمک کنید.</p>

<?php
	echo form_close();
?>