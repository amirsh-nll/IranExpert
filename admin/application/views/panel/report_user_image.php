<h2>پنل مدیریت -) گزارش ها -) ریز گزارش تصاویر پروفایل کاربران</h2>
<div id="report_view"></div>
<?php
	echo '<p><strong>ریز گزارش تصاویر پروفایل کاربران:</strong></p>';
	echo $chart;
	echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report_user_image">بروز رسانی</a><a class="back_key" title="بازگشت" href="http://localhost/admin/panel/report">بازگشت</a><div class="clear"></div>';
	echo '<p>&nbsp;</p>';
	echo '<p><strong>' . $this->jdf->tr_num(10) . ' کاربران با عکس پروفایل پیش فرض:</strong></p>';
	if($user_default_image_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>مشاهده تصویر</td>
			</tr>
			<?php $i=1; foreach ($user_default_image_data as $my_user_default_image_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_user_default_image_data['middle_name']; ?></td>
					<td><a href="../../upload/<?php echo $my_user_default_image_data['file_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده تصویر"><span class="fa fa-lg fa-globe"></span></a></td>
				</tr>
			<?php $i+=1; endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>مشاهده تصویر</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' کاربران با عکس پروفایل شخصی:</strong></p>';
	if($user_undefault_image_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>مشاهده تصویر</td>
			</tr>
			<?php $i=1; foreach ($user_undefault_image_data as $my_user_undefault_image_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_user_undefault_image_data['middle_name']; ?></td>
					<td><a href="../../upload/<?php echo $my_user_undefault_image_data['file_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده تصویر"><span class="fa fa-lg fa-globe"></span></a></td>
				</tr>
			<?php $i+=1; endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>مشاهده تصویر</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>