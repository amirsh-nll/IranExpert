<h2>پنل کاربری -) شبکه های اجتماعی</h2>
<?php
	echo form_open('user/add_social', 'method="post" class="panel_form"');

	$social_url_input = array(
		'name'			=>	'social_url',
		'placeholder'	=>	'آدرس http://test.com/user',
		'maxlength'		=>	'255',
		'required'		=>	'required'
	);
	$social_type_item = array(
		'1'				=>	'فیس بوک',
		'2'				=>	'لینکداین',
		'3'				=>	'اینستاگرام',
		'4'				=>	'توییتر',
		'5'				=>	'گوگل پلاس'
	);
	$submit_input = array(
		'name'			=>	'social_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td>نوع شبکه اجتماعی</td>
		<td><?php echo form_dropdown('social_type', $social_type_item); ?></td>
	</tr>
	<tr>
		<td>آدرس پروفایل</td>
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
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از 5 رکورد داشته باشید.</p>';
	}
?>

<p>&nbsp;</p>
<p>لیست شبکه های اجتماعی :</p>

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
							default:{$type= 'نامشخص';}
						}
					?>
					<td style="width:20%;"><?php echo $type ?></td>
					<td style="width:80%;"><?php echo $my_social['url']; ?></td>
					<td><a href="<?php echo base_url() . 'user/delete_social/' . $my_social['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a></td>
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
				<td style="width:20%;">شبکه اجتماعی</td>
				<td style="width:80%;">آدرس</td>
				<td></td>
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
<p>راهنمایی : </p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن پروفایل شبکه های اجتماعی دیگر می توانید به تسریع یافتن شما توسط افراد کمک کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 لینک شبکه اجتماعی را دارید و شما قادر هستید همه را برای یک نوع از شبکه های اجتماعی استفاده کنید و یا از هر کدام یکبار بهره ببرید.</p>

<?php
	echo form_close();
?>