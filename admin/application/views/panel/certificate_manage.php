<h2>پنل مدیریت -) مجوزهای رسمیت -) مدیریت مجوز</h2>
<?php
	echo form_open($url . 'admin/certificate_manage', 'method="post" class="panel_form"');
	$status_item = array(
		'0'	=>	'غیر فعال',
		'1'	=>	'فعال'
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>نام کاربری:</td>
		<td><?=$middle_name; ?></td>
	</tr>
	<tr>
		<td>تاریخ شروع:</td>
		<td><?=$this->jdf->jdate("j/F/Y", $certificate['start_date']); ?></td>
	</tr>
	<tr>
		<td>تاریخ پایان:</td>
		<td><?=$this->jdf->jdate("j/F/Y", $certificate['end_date']); ?></td>
	</tr>
	<tr>
		<td>وضعیت کاربر:</td>
		<td><?php echo form_dropdown('certificate_status', $status_item, $certificate['status']); ?></td>
	</tr>
	<tr>
		<td style="border:none;"></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/certificate" class="return_key" title="بازگشت">بازگشت</a>
		</td>
	</tr>
</table>
<?php echo form_close(); ?>
<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">مجوز رسمیت پروفایل با موفقیت تغییر وضعیت یافت.</p>';
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این بخش شما قادر به فعال یا غیر فعال سازی مجوز رسمیت افراد هستید.</p>
<p>دقت کنید که عملیات رسمیت پروفایل افراد را با دقت بررسی کنید تا کاربران با هویت برای بازدیدکنندگان مشخص باشند.</p>