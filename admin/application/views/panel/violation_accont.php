<h2>پنل مدیریت -) تخلف کاربران</h2>
<?php
	if($violation!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام کاربری</td>
				<td>شرح تخلف</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($violation as $my_violation): ?>
				<tr style="font-size:19px;">
					<td style="width:20%; padding:5px; text-align:center;"><?php echo $my_violation['middle_name']; ?></td>
					<td style="width:60%; padding:5px;">نوع تخلف:<?php echo $my_violation['type']; ?><br />شرح تخلف:<?php echo $my_violation['reason']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/user_ban/<?php echo $my_violation['middle_name']; ?>" target="_blank" class="retrive_data_table_ban" title="وضعیت کاربر"><span class="fa fa-lg fa-ban"></span></a>
						<a href="../../profile/<?php echo $my_violation['middle_name']; ?>" target="_blank" class="retrive_data_table_globe" title="مشاهده پروفایل"><span class="fa fa-lg fa-globe"></span></a>
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
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/violation/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td></tr><tr>';
						}
						else
						{
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/violation/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td>';
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
				<td>شرح تخلف</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="3">هیچ تخلفی موجود نمی باشد.</td>
			</tr>
		</table>
		<?php
	}
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این صفحه تخلف کابران خود که از کانال ارتباطی بازدیدکنندگان آنها ارسال شده است را مشاهده می کنید.</p>
<p>شما می توانید با مشاهده این تخلفات روی کاربران خود دید بهتری داشته باشید و از ادامه ی فعالیت غیرمجاز آنها جلوگیری نمایید.</p>
<p>در صورتی که تخلف هر کاربر برای شما مشخص شد و قصد مسدود نمودن کاربر مورد نظر را دارید جلوی یکی از تخلفات فرد خاطی در بخش تنظیمات مدیریتی وضعیت کاربر را انتخاب و آن را غیرفعال نمایید.</p>