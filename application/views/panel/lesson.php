<h2>پنل کاربری -) اطلاعات تحصیلی</h2>
<?php
	echo form_open('user/add_lesson', 'method="post" class="panel_form"');

	$lesson_title_input = array(
		'name'			=>	'lesson_title',
		'place_holder'	=>	'عنوان دوره',
		'maxlength'		=>	'70',
		'required'		=>	'required'
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
	);
	$submit_input = array(
		'name'			=>	'lesson_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان دوره</strong></td>
		<td><?php echo form_input($lesson_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع دوره</strong></td>
		<td><?php echo form_dropdown('lesson_start_month', $lesson_start_month_item, '', 'class="lesson_item"'); echo form_dropdown('lesson_start_year', $lesson_start_year_item, '', 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان دوره</strong></td>
		<td><?php echo form_dropdown('lesson_end_month', $lesson_end_month_item, '', 'class="lesson_item"'); echo form_dropdown('lesson_end_year', $lesson_end_year_item, '', 'class="lesson_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($lesson_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>

<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">شما نمی توانید در این بخش بیش از' . $this->jdf->tr_num(20) . 'رکورد داشته باشید.</p>';
	}
?>

<p>&nbsp;</p>
<div id="table_view">&nbsp;</div>
<p><strong>لیست دوره های تحصیلی:</strong></p>
<?php
	if($lesson_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام دوره</td>
				<td>شروع دوره</td>
				<td>پایان دوره</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($lesson_item as $my_lesson): ?>
				<tr>
					<td style="width:18%;"><?php echo $my_lesson['title']; ?></td>
					<td style="width:15%; text-align:center;"><?php echo $this->jdf->tr_num($my_lesson['start']); ?></td>
					<td style="width:15%; text-align:center;"><?php echo $this->jdf->tr_num($my_lesson['end']); ?></td>
					<td style="width:45%; text-align:justify;"><?php echo $my_lesson['description']; ?></td>
					<td style="width:7%;">
						<a class="retrive_data_table_edit" href="<?php echo base_url() . 'panel/update_lesson/' . $my_lesson['id'] . '#content_view'; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_lesson/' . $my_lesson['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td style="width:18%;">نام دوره</td>
				<td style="width:15%;">شروع دوره</td>
				<td style="width:15%;">پایان دوره</td>
				<td style="width:45%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">دوره ای برای نمایش موجود نیست.</td>
			</tr>
		</table>
		<?php
	}
?>

<?php
	if($notice == 4)
	{
		echo '<p style="color:#f00;">حذف امکان پذیر نمی باشد.</p>';
	}
	elseif ($notice == 5)
	{
		echo '<p style="color:#3acc17;">رکورد مورد نظر با موفقیت حذف شد.</p>';
	}
?>

<p>&nbsp;</p>
<p>راهنمایی :</p>
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> دوره ی تحصیلی را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن دوره های تحصیلی دانشگاهی و آکادمیک های مراکز فنی و ... می توانید قدرت علمی خود را نمایان کنید.</p>
<?php
	echo form_close();
?>