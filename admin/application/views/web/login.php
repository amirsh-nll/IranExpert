<!DOCTYPE html>
<html>
	<head>
		<!--Meta-->
		<meta charset="utf-8">
		<title>ورود به پنل مدیریت</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Meta-->
		<!--Assets-->
		<link rel="stylesheet" href="<?=$url; ?>assets/css/login.css" />
		<link rel="stylesheet" href="<?=$url; ?>assets/css/font-awesome.css">
		<link rel="stylesheet" href="<?=$url; ?>assets/css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/ico" href="<?=$url; ?>assets/image/favicon.png" >
		<!--Assets-->
	</head>
	<body>
		<div class="logo">
			<img src="<?=$url; ?>assets/image/logo.png" title="سامانه پروفایل آنلاین ایرانیان" alt="سامانه پروفایل آنلاین ایرانیان" />
		</div>
		<div class="box">
			<?php echo form_open('web/auth', 'method="post"'); ?>
				<div class="box_right">
					<?php
						$email_input = array(
							'name'			=>	'email',
							'placeholder'	=>	'ایمیل',
							'maxlength'		=>	'70',
							'required'		=>	'required'
						);
						$password_input = array(
							'name'			=>	'password',
							'placeholder'	=>	'رمز عبور',
							'maxlength'		=>	'40',
							'required'		=>	'required'
						);
						$captcha_input = array(
							'name'			=>	'captcha',
							'placeholder'	=>	'کد امنیتی',
							'required'		=>	'required',
							'maxlength'		=> 	'5'
						);
						$submit_input = array(
							'name'			=>	'submit',
							'value'			=>	'ورود'
						);
						echo form_input($email_input);
						echo form_password($password_input);
						echo $captcha['image'];
						echo form_input($captcha_input);
					?>
				</div>
				<div class="box_left">
					<?php
						echo form_submit($submit_input);
					?>
				</div>
				<div class="box_right">
					<?php
						if($notice==1)
						{
							echo '<p style="color:#f77;">اطلاعات وارد شده معتبر نمی باشند.</p>';
						}
						elseif($notice==2)
						{
							echo '<p style="color:#f77;">لطفا کد امنیتی را صحیح وارد کنید.</p>';
						}
						elseif($notice==3)
						{
							echo '<p style="color:#f77;">برای دسترسی به محتوای درخواستی ابتدا وارد شوید.</p>';
						}
						elseif($notice==4)
						{
							echo '<p style="color:#f77;">برای ادامه لطفا دوباره با اطلاعات کاربری خود وارد شوید.</p>';
						}
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>