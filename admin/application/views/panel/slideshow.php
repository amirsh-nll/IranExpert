<h2>پنل مدیریت -) اسلایدشو</h2>
<?php 
	echo form_open_multipart('admin/new_slideshow', 'method="post" class="panel_form"');

	$image_file_input 	= '<input type="file" load-image="true" href-image="#imgTest" accept="image/png, image/jpeg" id="btnImageFile" name="userfile" />';
	$title_input = array(
		'name'			=>	'title',
		'placeholder'	=>	'عنوان',
		'maxlength'		=>	'70'
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت اسلاید'
	);
?>
<table>
	<tr>
		<td><strong>عنوان اسلایدشو</strong></td>
		<td><?php echo form_input($title_input); ?></td>
	</tr>
	<tr>
		<td><strong>فایل اسلایدشو</strong></td>
		<td><?php echo $image_file_input; ?></td>
	</tr>
	<tr>
		<td><strong>پیشنمایش</strong></td>
		<td><img src="<?=$url; ?>assets/image/preview.png" width="200" height="100" alt="Not found..." id="imgTest" /></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">اسلاید جدید با موفقیت ثبت شد.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">شما نمی توانید به طور همزمان بیش از 10 اسلادی داشته باشید.</p>';
	}
?>

<?php echo form_close(); ?>
<div id="slideshow_item"></div>
<p>&nbsp;</p>
<p><strong>لیست اسلایدها:</strong></p>
<?php
	if($slideshow_item!=0)
	{
		foreach ($slideshow_item as $my_slideshow)
		{
			echo '<div class="slideshow_item"><img width="200" height="100" src="../../../upload/' . $my_slideshow['file_name'] . '" title="' . $my_slideshow['title'] . '" /><a class="delete_active_image" href="' . $url . 'panel/delete_slideshow/' . $my_slideshow['id'] . '" title="حذف"><span class="fa fa-lg fa-close"></span><span style="font-size:20px;">حذف اسلاید</span></a></div>';
		}
		echo '<div class="clear"></div>';
	}
	else
	{
		echo 'هیچ اسلایدی موجود نیست.';
	}
?>

<?php
	if($notice == 4)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 5)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در حال حاظر شما مجاز به ثبت بیش از 10 اسلاید نیستید.</p>
<p>شما می توانید در این بخش اسلاید شو صفحه اصلی سامانه خود را کنترل کنید.</p>
<p>سعی کنید در اسلاید شو از فایل هایی با حجم کمتر و وضوح خوب استفاده کنید که به جذب کاربر کمک کنید.</p>
<p>حداکثر حجم تصویر می تواند <?php echo $this->jdf->tr_num(7); ?> مگابایت باشد و حداکثر ابعاد تصویر <?php echo $this->jdf->tr_num('400 * 900'); ?> می تواند باشد؛ تصویرهای مستطیلی شکل برای این بخش مناسبتر می باشند.</p>