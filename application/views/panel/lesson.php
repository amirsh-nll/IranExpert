<h2>اطلاعات تحصیلی</h2>
<?php
	echo form_open('data/lesson','method="post" class="panel_form"');

	$lesson_title_input = array(
		'name'=>'lesson_title',
		'place_holder'=>'عنوان دوره',
		'maxlength'=>'100',
		'required'=>'required'
	);
	for($i=1;$i<=12;$i++)
	{
		$lesson_start_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$lesson_start_year_item[$i]=$i;
	}
	for($i=1;$i<=12;$i++)
	{
		$lesson_end_month_item[$i]=$i;
	}
	for($i=1395;$i>=1301;$i--)
	{
		$lesson_end_year_item[$i]=$i;
	}
	$lesson_description = array(
		'name'=>'lesson_description',
		'maxlength'=>'255',
	);
	$submit_input = array(
		'name'=>'lesson_submit',
		'value'=>'ثبت'
	);
?>

<table>
	<tr>
		<td>عنوان دوره</td>
		<td><?php echo form_input($lesson_title_input); ?></td>
	</tr>
	<tr>
		<td>شروع دوره</td>
		<td><?php echo form_dropdown('lesson_start_month', $lesson_start_month_item, '', 'class="lesson_item"'); echo form_dropdown('lesson_start_year', $lesson_start_year_item, '', 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td>پایان دوره</td>
		<td><?php echo form_dropdown('lesson_end_month', $lesson_end_month_item, '', 'class="lesson_item"'); echo form_dropdown('lesson_end_year', $lesson_end_year_item, '', 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td>توضیحات</td>
		<td><?php echo form_textarea($lesson_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<p>&nbsp;</p>
<p>لیست دوره های تحصیلی :</p>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن دوره های تحصیلی دانشگاهی و آکادمیک های مراکز فنی و ... می توانید قدرت علمی خود را نمایان کنید.</p>
<p>در حال حاظر شما اجازه ثبت 5 دوره ی تحصیلی را دارید و با این محدودیت شما می توانید دوره ها و مدارک پر اهمیت تر خود را به ثبت برسانید و از موارد جزئی چشم پوشی کنید.</p>
<?php
	echo form_close();
?>