	<body>
		<div class="logo">
			<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
		</div>
		<div class="box">
			<?php echo form_open('user/auth', 'method="post"'); ?>
				<div class="box_right">
					<?php
						$email_input = array(
							'name'=>'email',
							'placeholder'=>'ایمیل'
						);
						$password_input = array(
							'name'=>'password',
							'placeholder'=>'رمز عبور'
						);
						$captcha_input = array(
							'name'=>'captcha',
							'placeholder'=>'گد امنیتی'
						);
						$submit_input = array(
							'name'=>'submit',
							'value'=>'ورود'
						);
						echo form_input($email_input);
						echo form_password($password_input);
						echo $captcha['image'];
						echo form_input($captcha_input);
					?>
					<p><a href="<?=$url; ?>web/forget" title="Forget Password">رمز عبور خود را فراموش کرده اید؟</a></p>
					<p><a href="<?=$url; ?>web/index" title="Back To HomePage">بازگشت به صفحه اصلی</a></p>
					<p><a href="<?=$url; ?>web/register" title="Register iranExpert">عضویت در سامانه</a></p>
				</div>
				<div class="box_left">
					<?php
						echo form_submit($submit_input);
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>