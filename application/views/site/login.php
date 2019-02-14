	<body>
		<div class="logo">
			<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
		</div>
		<div class="box">
			<?php echo form_open('form/login', 'method="post"'); ?>
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
							'placeholder'	=>	'گد امنیتی',
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
					<p><a href="<?=$url; ?>forget" title="Forget Password">رمز عبور خود را فراموش کرده اید؟</a></p>
					<p><a href="<?=$url; ?>index" title="Back To HomePage">بازگشت به صفحه اصلی</a></p>
					<p><a href="<?=$url; ?>register" title="Register iranExpert">عضویت در سامانه</a></p>
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
							echo '<p style="color:#0f0;">ثبت نام شما با موفقیت انجام شد برای ورود به پنل کاربری خود از فرم بالا اقدام کنید.</p>';
						}
						elseif($notice==5)
						{
							echo '<p style="color:#f77;">برای ادامه لطفا دوباره وارد شوید.</p>';
						}
						elseif($notice==6)
						{
							echo '<p style="color:#0f0;">حساب کاربری شما با موفقیت غیرفعال شد، میزبانی شما افتخار ما بود.</p>';
						}
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>