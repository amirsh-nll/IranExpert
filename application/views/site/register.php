	<body>
		<div class="logo">
			<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
		</div>
		<div class="box">
			<?php echo form_open('form/register','method="post"'); ?>
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
						$repassword_input = array(
							'name'			=>	'repassword',
							'placeholder'	=>	'تکرار رمز عبور',
							'maxlength'		=>	'40',
							'required'		=>	'required'
						);
						$rules_check_input = array(
							'name'			=>	'rules_check',
							'value'			=>	'1'
						);
						$captcha_input = array(
							'name'			=>	'captcha',
							'placeholder'	=>	'گد امنیتی',
							'required'		=>	'required',
							'maxlength'		=> 	'5'
						);
						$submit_input = array(
							'name'			=>	'submit',
							'value'			=>	'ثبت نام'
						);
						echo form_input($email_input);
						echo form_password($password_input);
						echo form_password($repassword_input);
						echo '<p class="accept_rules">' . form_checkbox($rules_check_input);
						echo '<a href="' . $url . 'rules" title="صفحه قونین">قوانین</a> سامانه را می پذیرم.</p>';
						echo $captcha['image'];
						echo form_input($captcha_input);
						
						if(!empty(validation_errors()))
						{
							echo '<p style="color:#f55;">اطلاعات وارد شده معتبر نمی باشند.</p>';
						}

					?>
					<p><a href="<?=$url; ?>index" title="Back To HomePage">بازگشت به صفحه اصلی</a></p>
					<p><a href="<?=$url; ?>login" title="Login iranExpert">ورود به سامانه</a></p>
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
							echo '<p style="color:#f77;">در صورت عدم تایید قوانین شما اجازه ثبت نام ندارید.</p>';
						}
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>