<h2>پنل کاربری -) علاقه مندی ها</h2>
<?php
	echo form_open('user/add_favorite', 'method="post" class="panel_form"');

	$favorite_title_input = array(
		'name'			=>	'favorite_title',
		'place_holder'	=>	'عنوان علاقه مندی',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$favorite_description = array(
		'name'			=>	'favorite_description',
		'maxlength'		=>	'255',
	);
	$submit_input = array(
		'name'			=>	'favorite_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان علاقه مندی</td>
		<td><?php echo form_input($favorite_title_input); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
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
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از 5 رکورد داشته باشید.</p>';
	}
?>

<p>&nbsp;</p>
<p>لیست علاقه مندی ها :</p>
<?php
	if($favorite_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام علاقه مندی</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($favorite_item as $my_favorite): ?>
				<tr>
					<td style="width:20%;"><?php echo $my_favorite['title']; ?></td>
					<td style="width:80%;"><?php echo $my_favorite['description']; ?></td>
					<td><a href="<?php echo base_url() . 'user/delete_favorite/' . $my_favorite['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a></td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td style="width:20%;">نام علاقه مندی</td>
				<td style="width:80%;">توضیحات</td>
				<td></td>
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
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن علاقه مندی های خود می توانید شخصیت، رفتار و عملکرد خود را برای دیگران قابل درک کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 علاقه مندی را دارید و با این محدودیت شما می توانید علایق قوی تر خود را به ثبت برسانید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>