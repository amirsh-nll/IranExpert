<h2>پنل کاربری -) علاقه مندی ها</h2>
<?php
	echo form_open($url . 'user/add_favorite', 'method="post" class="panel_form"');

	$favorite_title_input = array(
		'name'			=>	'favorite_title',
		'place_holder'	=>	'عنوان علاقه مندی',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$favorite_description = array(
		'name'			=>	'favorite_description',
		'maxlength'		=>	'500'
	);
	$submit_input = array(
		'name'			=>	'favorite_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان علاقه مندی</strong></td>
		<td><?php echo form_input($favorite_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($favorite_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از' . $this->jdf->tr_num(20) . 'رکورد داشته باشید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست علاقه مندی ها:</strong></p>
<?php
	if($favorite_item!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام علاقه مندی</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($favorite_item as $my_favorite): ?>
				<tr>
					<td style="width:23%;"><?php echo $my_favorite['title']; ?></td>
					<td style="width:70%;"><?php echo $my_favorite['description']; ?></td>
					<td style="width:7%;">
						<a class="retrive_data_table_update" href="<?php echo base_url() . 'panel/update_favorite/' . $my_favorite['id']; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_favorite/' . $my_favorite['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
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
				<td style="width:23%;">نام علاقه مندی</td>
				<td style="width:70%;">توضیحات</td>
				<td style="width:7%;"></td>
			</tr>
			<tr>
				<td colspan="5">هیچ علاقه مندی برای شما موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>

<?php
	if($notice == 4)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 5)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> علاقه مندی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن علاقه مندی های خود می توانید شخصیت، رفتار و عملکرد خود را برای دیگران قابل درک کنید.</p>
<?php
	echo form_close();
?>