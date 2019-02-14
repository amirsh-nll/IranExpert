<h2>پنل کاربری -) شبکه های اجتماعی</h2>
<?php
	echo form_open('user/add_social', 'method="post" class="panel_form"');

	$social_url_input = array(
		'name'			=>	'social_url',
		'placeholder'	=>	'آدرس http://test.com/user',
		'maxlength'		=>	'500',
		'required'		=>	'required'
	);
	$social_type_item = array(
		'1'				=>	'فیس بوک',
		'2'				=>	'لینکداین',
		'3'				=>	'اینستاگرام',
		'4'				=>	'توییتر',
		'5'				=>	'گوگل پلاس',
		'6'				=>	'تلگرام'
	);
	$submit_input = array(
		'name'			=>	'social_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>نوع شبکه اجتماعی</strong></td>
		<td><?php echo form_dropdown('social_type', $social_type_item); ?></td>
	</tr>
	<tr>
		<td><strong>آدرس پروفایل</strong></td>
		<td><?php echo form_input($social_url_input); ?></td>
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
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از' . $this->jdf->tr_num(6) . 'رکورد داشته باشید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست شبکه های اجتماعی:</strong></p>

<?php
	if($social_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>شبکه اجتماعی</td>
				<td>آدرس</td>
				<td></td>
			</tr>
			<?php foreach ($social_item as $my_social): ?>
				<tr>
					<?php
						switch($my_social['type'])
						{
							case 1:{$type = 'فیس بوک';} break;
							case 2:{$type = 'لینکداین';} break;
							case 3:{$type = 'اینستاگرام';} break;
							case 4:{$type = 'توییتر';} break;
							case 5:{$type = 'گوگل پلاس';} break;
							case 6:{$type = 'تلگرام';} break;
							default:{$type= 'نامشخص';}
						}
					?>
					<td style="width:28%;"><?php echo $type ?></td>
					<td style="width:65%;"><?php echo $my_social['url']; ?></td>
					<td style="width:7%;">
						<a class="retrive_data_table_update" href="<?php echo base_url() . 'panel/update_social/' . $my_social['id']; ?>" title="حذف"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_social/' . $my_social['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
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
				<td style="width:28%;">شبکه اجتماعی</td>
				<td style="width:65%;">آدرس</td>
				<td style="width:7%;"></td>
			</tr>
			<tr>
				<td colspan="5">شبکه ی اجتماعی خاصی برای نمایش موجود نیست.</td>
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
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(6); ?> لینک شبکه اجتماعی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن پروفایل شبکه های اجتماعی دیگر می توانید به یافتن خود توسط افراد دیگر کمک کنید.</p>

<?php
	echo form_close();
?>