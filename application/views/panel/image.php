<h2>پنل کاربری -) تصویر کاربری</h2>
<?php
	echo form_open_multipart('user/add_image', 'method="post" class="panel_form"');

	$image_file_input 	= '<input type="file" name="userfile" />';
	$image_submit 		= array(
		'name'		=>	'image_submit',
		'value'		=>	'آپلود'
	);
?>
<p><strong>بارگذاری تصویر جدید:</strong></p>
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
<p><strong>تصویر فعلی:</strong></p>

<div class="active_image">
	<p>
		<img style="max-width:300px;" src="<?php echo $url . "upload/" . $active_image; ?>" title="تصویر فعلی شما" alt="تصویر فعلی شما" />
	</p>
	<p>
		<a class="delete_active_image" href="<?php echo base_url() . "user/delete_image"; ?>" title="حذف">
			<span class="fa fa-lg fa-close"></span>
			<span style="font-size:20px;">حذف تصویر</span>
		</a>
	</p>
</div>
<div class="clear"></div>

<?php
	if($notice == 3)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 4)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>عكس کاربری پروفایل شخصی شما نباید دارای محتوای غیرمجاز یا توهین آمیز باشد.</p>
<p>در این صفحه شما میتوانید تصویر خود را بارگذاری کنید و رزومه ی خود را برای بازدید کنندگان رسمی سازید.</p>
<p>تصویر کاربری استاندارد برای سیستم در حال حاظر تصاویری هستند که مستطیل شکل هستند یعنی اندازه عرض عکس با طول عکس رابطه معنایی خاصی داشته باشند.</p>
<p>تصاویر آقایان بهتر است با پوشش رسمی باشد و تصاویر خانم ها هم بهتر است با پوشش مناسب استفاده شود تا از خطر افراد سودجو در امان بمانند.</p>
<p>سعی کنید از فرمت های رایج تصویر برای تصویر خود استفاده کنید که دارای تناقض با سیستم ما نباشد؛ ضمنا حداکثر حجم فایل شما باید حداکثر 7 مگابایت باشد.</p>
<?php
	echo form_close();
?>