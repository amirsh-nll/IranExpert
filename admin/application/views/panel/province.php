<h2>پنل مدیریت -) استان ها</h2>
<?php 
	echo form_open('admin/insert_province', 'method="post" class="panel_form"');
	$province_input = array(
		'name'			=>	'province',
		'placeholder'	=>	'نام استان',
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
		<td>نام استان</td>
		<td><?php echo form_input($province_input); ?></td>
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
<p><strong>لیست استان ها:</strong></p>
<?php
	if($province!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام استان</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<?php foreach ($province as $my_province): ?>
				<tr style="font-size:19px;">
					<td style="width:80%; padding:5px; text-align:center;"><?php echo $my_province['name']; ?></td>
					<td style="width:20%; text-align:center;">
						<a href="<?=$url; ?>panel/province_edit/<?php echo $my_province['id']; ?>" class="retrive_data_table_edit" title="ویرایش اطلاعات"><span class="fa fa-lg fa-edit"></span></a>
						<a href="<?=$url; ?>panel/delete_province/<?php echo $my_province['id']; ?>" class="retrive_data_table_delete" title="مسدود سازی"><span class="fa fa-lg fa-close"></span></a>
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
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/province/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td></tr><tr>';
						}
						else
						{
							echo '<td><a title="صفحه ' . $i . '" href="' . $url . 'panel/province/' . $i . '">' . $this->jdf->tr_num($i) . '</a></td>';
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
				<td>نام استان</td>
				<td>عملیات مدیریتی</td>
			</tr>
			<tr>
				<td colspan="2">هیچ استانی برای نمایش موجود نیست.</td>
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
<p>با کمک فرم بالا می توانید برای کاربران خود استان اضافه کنید</p>
<p>استان ها را کاربران می توانند به صورت صریح استفاده کنند و از آنها در نمایش آدرس خود بهره ببرند.</p>