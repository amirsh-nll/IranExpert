<h2>پنل مدیریت -) گزارش ها -) ریز گزارش بازدید پروفایل ها</h2>
<div id="report_view"></div>
<?php
	echo '<p><strong>ریز گزارش بازدید پروفایل ها:</strong></p>';
	echo $chart;
	echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report_view_profile">بروز رسانی</a><a class="back_key" title="بازگشت" href="http://localhost/admin/panel/report">بازگشت</a><div class="clear"></div>';
	echo '<p>&nbsp;</p>';
	echo '<p><strong>' . $this->jdf->tr_num(10) . ' رزومه پربازدید امروز:</strong></p>';
	if($today_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تعداد بازدید</td>
			</tr>
			<?php $i=1; foreach ($today_data as $my_today_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_today_data['middle_name']; ?></td>
					<td><?php echo $my_today_data['today']; ?></td>
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
				<td>تعداد بازدید</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' رزومه پربازدید دیروز:</strong></p>';
	if($yesterday_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تعداد بازدید</td>
			</tr>
			<?php $i=1; foreach ($yesterday_data as $my_yesterday_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_yesterday_data['middle_name']; ?></td>
					<td><?php echo $my_yesterday_data['yesterday']; ?></td>
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
				<td>تعداد بازدید</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}

	echo '<p>&nbsp;</p><p><strong>' . $this->jdf->tr_num(10) . ' رزومه پربازدید سامانه:</strong></p>';
	if($total_data!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>ردیف</td>
				<td>نام کاربری</td>
				<td>تعداد بازدید</td>
			</tr>
			<?php $i=1; foreach ($total_data as $my_total_data): ?>
				<tr style="font-size:25px; text-align:center;">
					<td><?php echo $this->jdf->tr_num($i); ?></td>
					<td><?php echo $my_total_data['middle_name']; ?></td>
					<td><?php echo $my_total_data['total']; ?></td>
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
				<td>تعداد بازدید</td>
			</tr>
			<tr>
				<td colspan="3">داده ای موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>