<h2>پنل کاربری -) لیست کاربران</h2>
<?php
	if($user!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>ایمیل</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($user as $my_user): ?>
				<tr>
					<td style="width:30%; padding:5px; text-align:center;"><?php echo $my_user['middle_name']; ?></td>
					<td style="width:50%; padding:5px; text-align:center;"><?php echo $my_user['email']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/" class="retrive_data_table_eye" title="نمایش اطلاعات"><span class="fa fa-lg fa-eye"></span></a>
						<a href="<?=$url; ?>panel/" class="retrive_data_table_edit" title="ویرایش اطلاعات"><span class="fa fa-lg fa-edit"></span></a>
						<a href="<?=$url; ?>panel/" class="retrive_data_table_ban" title="مسدود سازی"><span class="fa fa-lg fa-ban"></span></a>
						<a href="<?=$url; ?>panel/" class="retrive_data_table_comment" title="ارسال پیام"><span class="fa fa-lg fa-comment"></span></a>
						<a href="<?=$url; ?>panel/" class="retrive_data_table_globe" title="مشاهده پروفایل"><span class="fa fa-lg fa-globe"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>ایمیل</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="5">هیچ کاربری برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>