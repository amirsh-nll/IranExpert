<h2>پنل مدیریت -) لیست تصاویر</h2>
<?php
	if($images!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>نام فایل</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($images as $my_image): ?>
				<tr>
					<td style="width:30%; padding:5px; text-align:center;"><?php echo $my_image['middle_name']; ?></td>
					<td style="width:50%; padding:5px; text-align:center;"><?php echo $my_image['file_name']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/delete_image/<?php echo $my_image['middle_name'] . '/' . $current_page; ?>" class="retrive_data_table_delete" title="حذف تصویر"><span class="fa fa-lg fa-close"></span></a>
						<a href="../../../../upload/<?php echo $my_image['file_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده تصویر"><span class="fa fa-lg fa-globe"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
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
<p>در این صفحه با استفاده از عملیات های مدیریتی می توانید روی  تصاویر کاربران خود مدیریت داشته باشید.</p>
<p>عملیات های مدیریتی روی تصاویر کاربران در حال حاظر روبروی آنها قرار دارد که با استفاده از هر مورد می توانید عملیات خود را روی تصاویر کاربر مورد نظر انجام دهید.</p>