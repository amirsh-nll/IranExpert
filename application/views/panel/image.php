<h2>تصویر کاربری</h2>
<?php
	echo form_open_multipart('user/add_image','method="post" class="panel_form"');

	$image_file_input 	= '<input type="file" name="userfile" />';
	$image_submit 		= array(
		'name'		=>	'image_submit',
		'value'		=>	'آپلود'
	);
?>
<p>بارگذاری تصویر جدید:</p>
<table class="image_upload_table">
	<tr>
		<td style="width:50%;"><?php echo $image_file_input; ?></td>
		<td style="width:50%;"><?php echo form_submit($image_submit); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">تصویر انتخابی شما شرایط بارگذاری را ندارد.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">تصویر شما با موفقیت بارگذاری شد.</p>';
	}
?>

<p>&nbsp;</p>
<p>تصویر فعلی :</p>
<img style="max-width:200px;" src="<?php echo $url . "upload/" . $active_image; ?>" title="تصویر فعلی شما" alt="تصویر فعلی شما" />

<p>&nbsp;</p>
<p>راهنمایی:</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>عكس کاربری پروفایل شخصی شما نباید دارای محتوای غیرمجاز یا توهین آمیز باشد.</p>
<p>در این صفحه شما میتوانید تصویر خود را بارگذاری کنید و رزومه ی خود را برای بازدید کنندگان معتبر ببخشید.</p>
<p>تصویر کاربری استاندارد برای سیستم در حال حاظر تصاویری هستند که مربع شکل هستند یعنی اندازه عرض عکس با طول عکس برابر باشند.</p>
<p>تصاویر آقایان بهتر است با پوشش رسمی باشد و تصاویر خانم هم بهتر است با پوشش مناسب استفاده شود تا از خطر افراد سودجو در امان بمانند.</p>
<p>سعی کنید از فرمت های رایج تصویر برای تثویر خود استفاده کنید که دارای تناقض با سیستم ما نباشد؛ ضمنا حداکثر حجم فایل شما باید حداکثر 5 مگابات باشد.</p>
<?php
	echo form_close();
?>