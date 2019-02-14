<h2>پنل کاربری -) رسمی کردن پروفایل</h2>
<?php
	echo form_open_multipart('user/certificate', 'method="post" class="panel_form"');

	$identity_card_1_input 	= '<input type="file" load-image="true" href-image="#imgTest1" accept="image/png, image/jpeg" id="btnImageFile" name="userfile1" />';
	$identity_card_2_input 	= '<input type="file" load-image="true" href-image="#imgTest2" accept="image/png, image/jpeg" id="btnImageFile" name="userfile2" />';
	$image_submit 		= array(
		'name'		=>	'image_submit',
		'value'		=>	'ثبت مدارک',
		'style'		=>	'float:none !important; width:40% !important;'
	);
?>
<p><strong>وضعیت پروفایل رسمی:</strong>
<?php
	if($certificate_status!=0)
	{
		echo '<span style="color:#3acc17;">در حال حاظر پروفایل شما یک رزومه رسمی می باشد و این رسمیت تا تاریخ <strong>' . $this->jdf->jdate("j/F/Y", $certificate_status) . '</strong> اعتبار دارد.</span>';
	}
	else
	{
		echo '<span style="color:#ff6600;">در حال حاظر پروفایل شما یک رزومه معمولی است و رسمی نمی باشد.<span>';
	}
?>
</p>
<p>&nbsp;</p>
<p><strong>بارگذاری مدارک:</strong></p>
<table width="100%">
	<tr>
		<td><strong>تصویر شناسنامه</strong></td>
		<td><?php echo $identity_card_1_input; ?></td>
	</tr>
	<tr>
		<td><strong>پیشنمایش</strong></td>
		<td><img src="<?=$url; ?>assets/image/preview.png" width="200" height="100" alt="Not found..." id="imgTest1" /></td>
	</tr>
	<tr>
		<td><strong>تصویر کارت ملی</strong></td>
		<td><?php echo $identity_card_2_input; ?></td>
	</tr>
	<tr>
		<td><strong>پیشنمایش</strong></td>
		<td><img src="<?=$url; ?>assets/image/preview.png" width="200" height="100" alt="Not found..." id="imgTest2" /></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($image_submit); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">مدارک انتخاب شده قابل بارگذاری نمی باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">مدارک با موفقیت ثبت شد منتظر رسمی شدن پروفایل خود باشید.</p>';
	}
	elseif($notice == 3)
	{
		echo '<p style="color:#f00;">اطلاعات فردی شما به طور کامل پر نشده است لطفا ابتدا این اطلاعات را تکمیل کنید.</p>';
	}
	elseif($notice == 4)
	{
		echo '<p style="color:#f00;">اطلاعات تماس شما به طور کامل پر نشده است لطفا ابتدا این اطلاعات را تکمیل کنید.</p>';
	}
	elseif($notice == 5)
	{
		echo '<p style="color:#f00;">در حال حاظر پروفایل شما رسمی می باشد و تا پایان دوره ی یکساله امکان درخواست مجدد نیست.</p>';
	}
?>

<p>&nbsp;</p>
<p>راهنمایی:</p>
<p>بعد از پر کردن اطلاعات فردی و تماس به طور کامل شما باید از فرم بالا اقدام به ارسال مدارک و رسمی کردن پروفایل خود کنید.</p>
<p>پروفایل افراد به صورت یک دوره ی یکساله رسمی خواهد شد و برای رسمی کردن پروفایل در سال بعد نیازمند پرداخت هزینه ی مجدد و طی مراحل قبل خواهید شد.</p>
<p>سعی کنید از فرمت های رایج تصویر برای مدارک خود استفاده کنید که دارای تناقض با سیستم ما نباشد؛ ضمنا حداکثر حجم فایل شما باید حداکثر ۷ مگابایت باشد.</p>