<h2>پنل مدیریت -) مجوزهای رسمیت</h2>
<?php
	if($certificate!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>تاریخ شروع</td>
				<td>تاریخ پایان</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($certificate as $my_certificate): ?>
				<tr style="font-size:19px;">
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $my_certificate['middle_name']; ?></td>
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $this->jdf->jdate("j/F/Y", $my_certificate['start_date']); ?></td>
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $this->jdf->jdate("j/F/Y", $my_certificate['end_date']); ?></td>
					<td style="width:20%; text-align:center;">
						<a target="_blank" href="<?=$url; ?>panel/view_user_information/<?php echo $my_certificate['middle_name']; ?>" class="retrive_data_table_eye" title="مشاهده اطلاعات کاربر"><span class="fa fa-lg fa-eye"></span></a>
						<a target="_blank" href="../../upload/<?php echo $my_certificate['identity_1']; ?>" target="_blank" class="retrive_data_table_upload" title="مشاهده مدرک شناسایی اول"><span class="fa fa-lg fa-upload"></span></a>
						<a target="_blank" href="../../upload/<?php echo $my_certificate['identity_2']; ?>" class="retrive_data_table_upload" title="مشاهده مدرک شناسایی دوم"><span class="fa fa-lg fa-upload"></span></a>
						<a href="<?=$url; ?>panel/certificate_manage/<?php echo $my_certificate['id']; ?>" class="retrive_data_table_certificate" title="مدیریت مجوز رسمیت"><span class="fa fa-lg fa-certificate"></span></a>
						<a href="../../profile/<?php echo $my_certificate['middle_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده پروفایل"><span class="fa fa-lg fa-globe"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<table class="page_number" width="100%">
			<tr>
				<?php
					for($i=1;$i<=$page_count;$i++)
					{

						if($i/10==round($i/10))
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
				<td>تاریخ شروع</td>
				<td>تاریخ پایان</td>
			</tr>
			<tr>
				<td colspan="3">هیچ درخواست مجوزی در سیستم موجو نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این بخش می توانید بر روی درخواست های مجوزهای رسمیت حساب کاربری افراد مدیریت داشته باشید.</p>
<p>درخواست رسمیت برای حساب های کاربری افراد ابتدا با پر کردن اطلاعات فردی و تماس انجام می گیرد و در مرحله ی بعد به ارسال مدارک شناسایی خواهد رسید.</p>
<p>شما باید اطعالات کاربر مورد نظر را بازخوانی، مدارک را بررسی و بعد از تشخصی صحت مدارک و اطلاعات فرد مجوز رسمیت حساب کاربری کاربر را صادر نمایید تا از نشان رسمیت در رزومه خود بهره ببرد.</p>