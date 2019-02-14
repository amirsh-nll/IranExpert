<h2>پنل مدیریت -) گزارش ها -) ریز گزارش عضویت کاربران</h2>
<div id="report_view"></div>
<?php
	echo '<p><strong>ریز گزارش عضویت کاربران:</strong></p>';
	echo $chart;
	echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report_user_register">بروز رسانی</a><a class="back_key" title="بازگشت" href="http://localhost/admin/panel/report">بازگشت</a><div class="clear"></div>';
	echo '<p>&nbsp;</p>';
	echo '<p><strong>' . $this->jdf->tr_num(10) . ' کاربر عضو شده امروز:</strong></p>';
	if($today_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
			</tr>
			<?php $i=1; foreach ($today_data as $my_today_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_today_data['middle_name']; ?></td>
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
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' کاربر عضو شده دیروز:</strong></p>';
	if($month_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
			</tr>
			<?php $i=1; foreach ($month_data as $my_month_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_month_data['middle_name']; ?></td>
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
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>