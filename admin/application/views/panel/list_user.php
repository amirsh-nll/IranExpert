<h2>پنل مدیریت -) لیست کاربران</h2>
<?php
	if($user!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>ایمیل</td>
				<td>اخرین ورود به سایت</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($user as $my_user): ?>
				<tr style="font-size:19px;">
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $my_user['middle_name']; ?></td>
					<td style="width:40%; padding:5px; text-align:center;"><?php echo $my_user['email']; ?></td>
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $my_user['last_login']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/view_user_information/<?php echo $my_user['middle_name']; ?>" class="retrive_data_table_eye" title="نمایش اطلاعات"><span class="fa fa-lg fa-eye"></span></a>
						<a href="<?=$url; ?>panel/user_edit/<?php echo $my_user['middle_name']; ?>" class="retrive_data_table_edit" title="ویرایش اطلاعات"><span class="fa fa-lg fa-edit"></span></a>
						<a href="<?=$url; ?>panel/user_ban/<?php echo $my_user['middle_name']; ?>" class="retrive_data_table_ban" title="مسدود سازی"><span class="fa fa-lg fa-ban"></span></a>
						<a href="<?=$url; ?>panel/user_message/<?php echo $my_user['middle_name']; ?>" class="retrive_data_table_comment" title="ارسال پیام"><span class="fa fa-lg fa-comment"></span></a>
						<a href="../../profile/<?php echo $my_user['middle_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده پروفایل"><span class="fa fa-lg fa-globe"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<table class="page_number">
			<tr>
				<?php
					for($i=1;$i<=$page_count;$i++)
					{

						if($i/18==round($i/18))
						{
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/list_user/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td></tr><tr>';
						}
						else
						{
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/list_user/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td>';
						}
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
				<td>ایمیل</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="3">هیچ کاربری برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این صفحه با استفاده از عملیات های مدیریتی می توانید روی کاربران خود مدیریت داشته باشید.</p>
<p>عملیات های مدیریتی روی کاربران در حال حاظر روبروی آنها قرار دارد که با استفاده از هر مورد می توانید عملیات خود را روی کاربر مورد نظر انجام دهید.</p>