<div class="intero">
	<div class="intero_section1">
		<img src="<?=$url; ?>upload/<?=$data['image']; ?>" title="<?=$data['full_name']; ?>" alt="<?=$data['full_name']; ?>" />
		<div class="social">
			<?php
				foreach ($data['social'] as $social) {
					switch($social['type'])
					{
						case 1 :{ $social_icon = "facebook-square"; $social_type = "فیس بوک"; } break;
						case 2 :{ $social_icon = "linkedin-square"; $social_type = "لینداین"; } break;
						case 3 :{ $social_icon = "instagram"; $social_type = "اینستاگرام"; } break;
						case 4 :{ $social_icon = "twitter-square"; $social_type = "توییتر"; } break;
						case 5 :{ $social_icon = "google-plus-square"; $social_type = "گوگل پلاس"; } break;
						case 6 :{ $social_icon = "send-o"; $social_type = "تلگرام"; } break;
						default:{ $social_icon = "share-square"; $social_type = "نامشخص"; }
					};

					echo '<a href="' . $social['url'] . '" title="' . $social_type . '"><span class="fa fa-lg fa-' . $social_icon . '"></span></a>';
				}
			?>
		</div>
	</div>
	<div class="intero_section2">
		<h1><?=$data['full_name']; ?></h1>
		<p>تاریخ تولد : <?=$data['birthday']; ?></p>
		<p>وضعیت تاهل : <?=$data['marriage']; ?></p>
		<p>جنسیت : <?=$data['gender']; ?></p>
		<p>شماره همراه : <span dir="ltr"><?=$data['mobile']; ?></span></p>
		<p>شماره تماس : <span dir="ltr"><?=$data['phone']; ?></span></p>
		<p>آدرس ایمیل : <span dir="ltr"><?=$data['email']; ?></span></p>
		<p style="line-height:25px; !important">آدرس محل سکونت : <?=$data['address']; ?></p>
	</div>
	<div class="clear"></div>
</div>

<div class="content">
	
	<div class="content_item">
		<div class="content_item_right">
			<h3>تحصیلات</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['lesson']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ اطلاعات تحصیلی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['lesson'] as $lesson) {
						echo "<h2>" . $lesson['title'] . "</h2>";

						if(empty($lesson['description']))
						{
							$lesson['description'] = "یکی از پست های شغی بنده " . $lesson['title'] . " است.";
						}

						echo "<p> شروع: " . $lesson['start'] . " پایان: " . $lesson['end'] . " توضیحات: " . $lesson['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>پیشینه شغلی</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['job']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ پیشینه شغلی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['job'] as $job) {
						echo "<h2>" . $job['title'] . "</h2>";

						if(empty($job['description']))
						{
							$job['description'] = "یکی از پست های شغی بنده " . $job['title'] . " است.";
						}

						echo "<p> شروع: " . $job['start'] . " پایان: " . $job['end'] . " توضیحات: " . $job['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>توانایی ها</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['ability']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ توانایی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['ability'] as $ability) {
						echo "<h2>" . $ability['title'] . "</h2>";

						if(empty($ability['description']))
						{
							$ability['description'] = "یکی از توانایی های بنده " . $ability['title'] . " است.";
						}

						echo "<p>توضیحات: " . $ability['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>پروژه ها</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['project']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ پروژه ی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['project'] as $project) {
						echo "<h2>" . $project['title'] . "</h2>";

						if(empty($project['description']))
						{
							$project['description'] = "یکی از توانایی های بنده " . $project['title'] . " است.";
						}

						echo "<p>توضیحات: " . $project['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>مقالات</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['article']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ مقاله ی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['article'] as $article) {
						echo "<h2>" . $article['title'] . "</h2>";

						if(empty($article['description']))
						{
							$article['description'] = "یکی از توانایی های بنده " . $article['title'] . " است.";
						}

						echo "<p>توضیحات: " . $article['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>افتخارات</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['achievement']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ افتخاری خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['achievement'] as $achievement) {
						echo "<h2>" . $achievement['title'] . "</h2>";

						if(empty($achievement['description']))
						{
							$achievement['description'] = "یکی از توانایی های بنده " . $achievement['title'] . " است.";
						}

						echo "<p>توضیحات: " . $achievement['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>علایق</h3>
		</div>
		<div class="content_item_left">
			<?php
				if($data['favorite']==0)
				{
					echo "<h2>متاسفم...!!</h2><p>در حال حاظر هیچ علاقه مندی خاصی برای نمایش موجود نیست.</p>";
				}
				else
				{
					foreach ($data['favorite'] as $favorite) {
						echo "<h2>" . $favorite['title'] . "</h2>";

						if(empty($favorite['description']))
						{
							$favorite['description'] = "یکی از علایق بنده " . $favorite['title'] . " است.";
						}

						echo "<p>توضیحات: " . $favorite['description'] . "</p>";
					}
				}
			?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>مختصری درباره من</h3>
		</div>
		<div class="content_item_left">
			<?=$data['about']; ?>
		</div>
	</div>
	<div class="clear"></div>

	<div class="content_item">
		<div class="content_item_right">
			<h3>ارسال پیام برای من</h3>
		</div>
		<div class="content_item_left">
			<?php
				echo form_open("profile/send_message/" . $data['middle_name'], 'method="post" class="message_box"');
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
				$emial_input = array(
					'name'			=>	'email',
					'required'		=>	'required',
					'placeholder'	=>	'ایمیل (اجباری)',
					'maxlength'		=> 	70
				);
				$message_input = array(
					'name'			=>	'email',
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
				echo '<p>' . form_input($emial_input) . '<p>'		;
				echo '<p>' . form_textarea($message_input) . '<p>'	;
				echo '<p>' . $data['captcha']['image'] . '<p>'		;
				echo '<p>' . form_input($captcha_input) . '<p>'		;
				echo '<p>' . form_submit($submit_input) . '<p>'		;
			?>

			<?php
				echo form_close();
			?>
		</div>
	</div>
	<div class="clear"></div>

</div>