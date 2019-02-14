		<div class="box">
			<?php echo form_open($url . 'form/violation', 'method="post"'); ?>
				<div class="box_right">
					<?php
						$violation_type_item = array(
							'1'				=>	'توزیع محتوای نژادی یا قومی ، دینی و ...',
							'2'				=>	'هرزنامه',
							'3'				=>	'تصویر غیرمجاز یا توهین آمیز',
							'4'				=>	'توزیع اطلاعات شخصی و محرمانه شخصی سایر افراد',
							'5'				=>	'متفرقه'
						);
						$violation_reason_input = array(
							'name'			=>	'violation_reason',
							'required'		=>	'required',
							'maxlength'		=> 	'1000'
						);
						$captcha_input = array(
							'name'			=>'captcha',
							'placeholder'	=>'کد امنیتی',
							'required'		=>'required',
							'maxlength'		=> 	'5'
						);
						$submit_input = array(
							'name'			=>'submit',
							'value'			=>'گزارش'
						);
						echo form_dropdown('violation_type', $violation_type_item);
						echo form_textarea($violation_reason_input);
						echo $captcha['image'];
						echo form_input($captcha_input);

						if(!empty(validation_errors()))
						{
							echo '<p style="color:#f55;">اطلاعات وارد شده معتبر نمی باشند.</p>';
						}
						
					?>
					<p><a href="<?=$url; ?>profile/<?=$middle_name; ?>" title="بازگشت">بازگشت به پروفایل</a></p>
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
							echo '<p style="color:#0f0;">تخلف کاربر مورد نظر ثبت شد و سریعا به آن رسیدگی خواهد شد.</p>';
						}
					?>
				</div>
				<div class="clear"></div>
			<?php echo form_close(); ?>
		</div>
	</body>

</html>