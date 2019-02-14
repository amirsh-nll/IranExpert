<h2>پنل کاربری -) افتخارات</h2>
<?php
	echo form_open($url . 'user/add_achievement', 'method="post" class="panel_form"');

	$achievement_title_input = array(
		'name'			=>	'achievement_title',
		'place_holder'	=>	'عنوان افتخار',
		'maxlength'		=>	'70',
		'required'		=>	'required'
	);
	$achievement_description = array(
		'name'			=>	'achievement_description',
		'maxlength'		=>	'500',
	);
	$submit_input = array(
		'name'			=>	'achievement_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان افتخار</strong></td>
		<td><?php echo form_input($achievement_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($achievement_description); ?></td>
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
	elseif ($notice == 7)
	{
		echo '<p style="color:#f00;">لطفا تاریخ شروع را تاریخی قبل از تاریخ پایان انتخاب کنید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست افتخارات:</strong></p>
<?php
	if($achievement_item!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام افتخار</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($achievement_item as $my_achievement): ?>
				<tr>
					<td style="width:23%;"><?php echo $my_achievement['title']; ?></td>
					<td style="width:70%;"><?php echo $my_achievement['description']; ?></td>
					<td style="width:7%;">
						<a class="retrive_data_table_update" href="<?php echo base_url() . 'panel/update_achievement/' . $my_achievement['id']; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_achievement/' . $my_achievement['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
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
				<td style="width:23%;">نام افتخار</td>
				<td style="width:70%;">توضیحات</td>
				<td style="width:7%;"></td>
			</tr>
			<tr>
				<td colspan="5">هیچ افتخاری برای شما موجود نیست.</td>
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
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> فتخار را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن افتخارات خود در مراحل مختلف زندگی خود می توانید خود را با دیگران متمایز کنید.</p>
<?php
	echo form_close();
?>