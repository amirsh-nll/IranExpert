		<div class="content">
			<h2>تماس با ما:</h2>
			<?php
				echo form_open($url . "form/send_message", 'method="post" class="message_box" id="message_form"');
				$name_input = array(
					'name'			=>	'name',
					'placeholder'	=>	'نام (اختیاری)',
					'maxlength'		=> 	100
				);
				$title_input = array(
					'name'			=>	'title',
					'placeholder'	=>	'عنوان (اختیاری)',
					'maxlength'		=> 	100
				);
				$email_input = array(
					'name'			=>	'email',
					'required'		=>	'required',
					'placeholder'	=>	'ایمیل (اجباری)',
					'maxlength'		=> 	70
				);
				$message_input = array(
					'name'			=>	'message',
					'maxlength'		=> 	500
				);
				$captcha_input = array(
					'name'			=>	'captcha',
					'required'		=>	'required',
					'placeholder'	=>	'کد امنیتی را وارد کنید',
					'maxlength'		=> 	5
				);
				$submit_input = array(
					'name'			=>	'submit',
					'value'			=> 	'ارسال پیام'
				);

				echo '<p>' . form_input($name_input) . '<p>'		;
				echo '<p>' . form_input($title_input) . '<p>'		;
				echo '<p>' . form_input($email_input) . '<p>'		;
				echo '<p>' . form_textarea($message_input) . '<p>'	;
				echo '<p>' . $captcha['image'] . '<p>'				;
				echo '<p>' . form_input($captcha_input) . '<p>'		;
				echo '<p>' . form_submit($submit_input) . '<p>'		;

				if($notice!=0)
				{
					switch($notice)
					{
						case 1:{
							echo '<p style="color:#f00;">اطلاعات فرم بالا نامعتبر می باشد.</p>';
						} break;
						case 2:{
							echo '<p style="color:#3acc17;">دوست عزیز پیام شما با موفقیت ارسال گردید.</p>';
						} break;
						case 3:{
							echo '<p style="color:#f00;">لطفا کد امنیتی را صحیح وارد کنید.</p>';
						} break;
					}
				}
				echo form_close();
			?>
		</div>
		<div class="clear">&nbsp;</div>