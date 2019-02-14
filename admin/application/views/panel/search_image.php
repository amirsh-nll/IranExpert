<h2>پنل مدیریت -) لیست تصاویر -) جستجو</h2>
<p><strong>جستجو کاربران:</strong></p>
<?php
	echo form_open($url . 'admin/search_image', 'method="post" class="search_user"');
	$search_input = array(
		'name'			=>	'search',
		'placeholder'	=>	'جستجو کاربر',
		'maxlength'		=>	'70',
		'style'			=>	'width:100% !important;'
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'جستجو'
	);
?>
<table width="100%" id="search_box">
	<tr>
		<td width="70%"><?php echo form_input($search_input); ?></td>
		<td width="30%"><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<?php
	echo form_close();
?>

<p>&nbsp;</p>
<p><strong>لیست تصاویر:</strong></p>
<?php
	if($images!=0)
	{
		foreach ($images as $my_image)
		{
			echo '<div class="image_list_item"><img width="200" height="200" src="../../../../upload/' . $my_image['file_name'] . '" title="' . $my_image['middle_name'] . '" /><p>نام کاربری: ' . $my_image['middle_name'] . '</p><a class="delete_active_image" href="' . $url . 'panel/delete_image/' . $my_image['middle_name'] . '" title="حذف"><span class="fa fa-lg fa-close"></span><span style="font-size:20px;">حذف تصویر</span></a></div>';
		}
		echo '<div class="clear"></div>';
	}
	else
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>نام فایل</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="5">هیچ تصویری برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این صفحه می توانید تصاویر کاربران متخلف را مشاهده کنید و با حذف تصاویر غیر مجاز مدیریت قاطعی روی کاربران داشته باشید.</p>