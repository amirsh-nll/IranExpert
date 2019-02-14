<h2>پنل مدیریت -) لیست تصاویر</h2>
<?php
	if($images!=0)
	{
		foreach ($images as $my_image)
		{
			echo '<div class="image_list_item"><img width="200" height="200" src="../../../../upload/' . $my_image['file_name'] . '" title="' . $my_image['middle_name'] . '" /><p>نام کاربری: ' . $my_image['middle_name'] . '</p><a class="delete_active_image" href="' . $url . 'panel/delete_image/' . $my_image['middle_name'] . '" title="حذف"><span class="fa fa-lg fa-close"></span><span style="font-size:20px;">حذف تصویر</span></a></div>';
		}
		echo '<div class="clear"></div>';
?>
		<table class="page_number">
			<tr>
				<?php
					for($i=1;$i<=$page_count;$i++)
					{
						echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/list_image/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td>';
					}
				?>
			</tr>
		</table>
		<?php
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
<div id="notice_view">&nbsp;</div>
<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">مشکلی در حذف تصویر رخ داده است لطفا دوباره امتحان کنید.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">تصویر مورد نظر با موفقیت حذف شد.</p>';
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این صفحه می توانید تصاویر کاربران حتلف را مشاهده کنید و با حذف تصاویر غیر مجاز مدیریت قاطعی روی کاربران داشته باشید.</p>