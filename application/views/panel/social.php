<h2>شبکه های اجتماعی</h2>
<?php
	echo form_open('data/social','method="post" class="panel_form"');

	$social_url_input = array(
		'name'			=>	'social_url',
		'placeholder'	=>	'آدرس http://test.com/user',
		'maxlength'		=>	'255',
		'required'		=>	'required'
	);
	$social_type_item = array(
		'1'				=>	'فیس بوک',
		'2'				=>	'لینکداین',
		'3'				=>	'اینستاگرام',
		'4'				=>	'توییتر',
		'5'				=>	'گوگل پلاس'
	);
	$submit_input = array(
		'name'			=>	'social_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>نوع شبکه اجتماعی</td>
		<td><?php echo form_dropdown('social_type', $social_type_item); ?></td>
	</tr>
	<tr>
		<td>آدرس پروفایل</td>
		<td><?php echo form_input($social_url_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<p>&nbsp;</p>
<p>لیست شبکه های اجتماعی :</p>

<p>&nbsp;</p>
<p>راهنمایی : </p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن پروفایل شبکه های اجتماعی دیگر می توانید به تسریع یافتن شما توسط افراد کمک کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 لینک شبکه اجتماعی را دارید و شما قادر هستید همه را برای یک نوع از شبکه های اجتماعی استفاده کنید و یا از هر کدام یکبار بهره ببرید.</p>

<?php
	echo form_close();
?>