	<body>
		<div class="logo">
			<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
		</div>
		<div class="box">
			<?php echo form_open('user/forget', 'method="post"'); ?>
				<div class="box_right">
					<?php
						$email_input = array(
							'name'=>'email',
							'placeholder'=>'ایمیل',
							'required'=>'required'
						);
						$captcha_input = array(
							'name'=>'captcha',
							'placeholder'=>'گد امنیتی',
							'required'=>'required'
						);
						$submit_input = array(
							'name'=>'submit',
							'value'=>'بازیابی'
						);
						echo form_input($email_input);
						echo $captcha['image'];
						echo form_input($captcha_input);

						if(!empty(validation_errors()))
						{
							echo '<p style="color:#f55;">اطلاعات وارد شده معتبر نمی باشند.</p>';
						}
						
					?>
					<p><a href="<?=$url; ?>web/index" title="Back To HomePage">بازگشت به صفحه اصلی</a></p>
					<p><a href="<?=$url; ?>web/register" title="Register iranExpert">عضویت در سامانه</a></p>
					<p><a href="<?=$url; ?>web/login" title="Login iranExpert">ورود به سامانه</a></p>
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
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>