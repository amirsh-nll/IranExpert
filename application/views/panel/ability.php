<h2>پنل کاربری -) توانایی ها</h2>
<?php
	echo form_open('user/add_ability', 'method="post" class="panel_form"');

	$ability_title_input = array(
		'name'			=>	'ability_title',
		'place_holder'	=>	'عنوان توانایی',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$ability_description = array(
		'name'			=>	'ability_description',
		'maxlength'		=>	'500',
	);
	$submit_input = array(
		'name'			=>	'ability_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان توانایی</strong></td>
		<td><?php echo form_input($ability_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($ability_description); ?></td>
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
<p><strong>لیست توانایی ها:</strong></p>

<?php
	if($ability_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام توانایی</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($ability_item as $my_ability): ?>
				<tr>
					<td style="width:28%;"><?php echo $my_ability['title']; ?></td>
					<td style="width:65%;"><?php echo $my_ability['description']; ?></td>
					<td style="width:7%;">
					<a class="retrive_data_table_edit" href="<?php echo base_url() . 'panel/update_ability/' . $my_ability['id'] . '#content_view'; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_ability/' . $my_ability['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
					</td>
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
				<td style="width:28%;">نام توانایی</td>
				<td style="width:65%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">هیچ تونایی برای شما موجود نیست.</td>
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
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> تونایی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن توانایی ها خود کارفرمایان و بازدیدکنندگان را برای انتخاب خود ترغیب می کنید.</p>
<?php
	echo form_close();
?>