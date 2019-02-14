<h2>پنل مدیریت -) گزارش ها -) ریز گزارش کاربران</h2>
<div id="report_view"></div>
<?php
	echo '<p><strong>ریز گزارش کاربران:</strong></p>';
	echo $chart;
	echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report_user">بروز رسانی</a><a class="back_key" title="بازگشت" href="http://localhost/admin/panel/report">بازگشت</a><div class="clear"></div>';
	echo '<p>&nbsp;</p>';
	echo '<p><strong>' . $this->jdf->tr_num(10) . ' کاربر آخر ورود داده امروز:</strong></p>';
	if($deactive_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>وضعیت کاربر</td>
			</tr>
			<?php $i=1; foreach ($deactive_data as $my_deactive_data): if($my_deactive_data['status']==1){$my_deactive_data['status']="فعال";} else{$my_deactive_data['status']="غیر فعال";} ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_deactive_data['middle_name']; ?></td>
					<td><?php echo $my_deactive_data['status']; ?></td>
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
				<td>وضعیت کاربر</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' کاربر آخر ورود داده امروز:</strong></p>';
	if($active_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>وضعیت کاربر</td>
			</tr>
			<?php $i=1; foreach ($active_data as $my_active_data): if($my_active_data['status']==1){$my_active_data['status']="فعال";} else{$my_active_data['status']="غیر فعال";} ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_active_data['middle_name']; ?></td>
					<td><?php echo $my_active_data['status']; ?></td>
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
				<td>وضعیت کاربر</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>