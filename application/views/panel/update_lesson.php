<h2>پنل کاربری -) اطلاعات تحصیلی -) ویرایش</h2>
<?php
	echo form_open('user/update_lesson', 'method="post" class="panel_form"');

	$lesson_item 	= $lesson_item[0];
	$start 			= explode('/', $lesson_item['start']);
	$end 			= explode('/', $lesson_item['end']);

	$lesson_title_input = array(
		'name'			=>	'lesson_title',
		'place_holder'	=>	'عنوان دوره',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$lesson_item['title']
	);
	for($i=1;$i<=12;$i++)
	{
		$lesson_start_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$lesson_start_year_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$lesson_end_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$lesson_end_year_item[$i]=$this->jdf->tr_num($i);
	}
	$lesson_description = array(
		'name'			=>	'lesson_description',
		'maxlength'		=>	'500',
		'value'			=>	$lesson_item['description']
	);
	$submit_input = array(
		'name'			=>	'lesson_submit',
		'value'			=>	'بروزرسانی'
	);
?>

<table>
	<tr>
		<td><strong>عنوان دوره</strong></td>
		<td><?php echo form_input($lesson_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع دوره</strong></td>
		<td><?php echo form_dropdown('lesson_start_month', $lesson_start_month_item, $start[1], 'class="lesson_item"'); echo form_dropdown('lesson_start_year', $lesson_start_year_item, $start[0], 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان دوره</strong></td>
		<td><?php echo form_dropdown('lesson_end_month', $lesson_end_month_item, $end[1], 'class="lesson_item"'); echo form_dropdown('lesson_end_year', $lesson_end_year_item, $end[0], 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($lesson_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/lesson#table_view'; ?>" title="بازگشت">بازگشت</a>
		</td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت بروزرسانی شد.</p>';
	}
?>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>قبل از ویرایش لطفا اطلاعات قبلی خود را مشاهده کنید ممکن است به صورت اشتباهی وارد این بخش شده باشید و اطلاعات صحیح خود را از بین ببرید.</p>
<?php
	echo form_close();
?>