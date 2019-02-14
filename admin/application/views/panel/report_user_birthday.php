<h2>پنل مدیریت -) گزارش ها -) ریز گزارش تولد کاربران</h2>
<div id="report_view"></div>
<?php
	echo '<p><strong>ریز گزارش تولد کاربران:</strong></p>';
	echo $chart;
	echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report_user">بروز رسانی</a><a class="back_key" title="بازگشت" href="http://localhost/admin/panel/report">بازگشت</a><div class="clear"></div>';
	echo '<p>&nbsp;</p>';
	echo '<p><strong>' . $this->jdf->tr_num(10) . ' کاربر متولد امروز:</strong></p>';
	if($user_birthday_today_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تاریخ تولد</td>
			</tr>
			<?php $i=1; foreach ($user_birthday_today_data as $my_user_birthday_today_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_user_birthday_today_data['middle_name']; ?></td>
					<td><?php echo $this->jdf->tr_num($my_user_birthday_today_data['birthday']); ?></td>
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
				<td>تاریخ تولد</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' کاربر متولد دیروز:</strong></p>';
	if($user_birthday_yesterday_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تاریخ تولد</td>
			</tr>
			<?php $i=1; foreach ($user_birthday_yesterday_data as $my_user_birthday_yesterday_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_user_birthday_yesterday_data['middle_name']; ?></td>
					<td><?php echo $this->jdf->tr_num($my_user_birthday_yesterday_data['birthday']); ?></td>
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
				<td>تاریخ تولد</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' کاربر متولد این ماه:</strong></p>';
	if($user_birthday_month_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تاریخ تولد</td>
			</tr>
			<?php $i=1; foreach ($user_birthday_month_data as $my_user_birthday_month_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_user_birthday_month_data['middle_name']; ?></td>
					<td><?php echo $this->jdf->tr_num($my_user_birthday_month_data['birthday']); ?></td>
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
				<td>تاریخ تولد</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>