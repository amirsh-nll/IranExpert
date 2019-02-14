<h2>پنل مدیریت -) زمینه فعالیت</h2>
<?php 
	echo form_open('admin/insert_activity', 'method="post" class="panel_form"');
	$activity_input = array(
		'name'			=>	'activity',
		'placeholder'	=>	'زمینه فعالیت',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت'
	);
?>
<table>
	<tr>
		<td>زمینه فعالیت</td>
		<td><?php echo form_input($activity_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
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
<div id="retrive_data_table"></div>
<p>&nbsp;</p>
<p><strong>لیست زمینه های فعالیت:</strong></p>
<?php
	if($activity!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>زمینه فعالیت</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($activity as $my_activity): ?>
				<tr style="font-size:19px;">
					<td style="width:80%; padding:5px; text-align:center;"><?php echo $my_activity['name']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/activity_edit/<?php echo $my_activity['id']; ?>" class="retrive_data_table_edit" title="ویرایش اطلاعات"><span class="fa fa-lg fa-edit"></span></a>
						<a href="<?=$url; ?>panel/delete_activity/<?php echo $my_activity['id']; ?>" class="retrive_data_table_delete" title="مسدود سازی"><span class="fa fa-lg fa-close"></span></a>
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
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/activity/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td></tr><tr>';
						}
						else
						{
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/activity/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td>';
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
				<td>زمینه فعالیت</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="2">هیچ زمینه فعالیتی برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>
<?php
	if($notice == 3)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 4)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>با کمک فرم بالا می توانید زمینه ی فعالیت جدیدی به این فیلد برای کاربران اضافه کنید.</p>
<p>زمینه های فعالیت بالا در حال حاظر قابل انتخاب توسط کاربران می باشند در واقع این زمینه ها را شما ایجاد کردید.</p>