<h2>پنل مدیریت -) لیست کاربران -) مسدودسازی</h2>
<?php
	echo form_open('admin/user_ban', 'method="post" class="panel_form"');
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
		<td>وضعیت کاربر:</td>
		<td><?php echo form_dropdown('user_status', $status_item, $status_value); ?></td>
	</tr>
	<tr>
		<td style="border:none;"></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/list_user" class="return_key" title="بازگشت">بازگشت</a>
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
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این بخش شما قادر به فعال یا غیر فعال سازی کاربران خود خواهید بود.</p>
<p>دقت کنید که عملیات مسدود سازی ممکن است برای کاربر ناراحت کننده باشد پس با دقت و صبر بیشتر در این بخش فعالیت کنید.</p>