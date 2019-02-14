<h2>پنل مدیریت -) ارسال پیام گروهی</h2>
<?php
	echo form_open('admin/broadcast_message', 'method="post" class="panel_form"');
	$radio_input_1 = array(
		'name'          => 'type',
        'value'         => '1',
        'checked'       => true
	);
	$radio_input_2 = array(
		'name'          => 'type',
        'value'         => '2',
        'checked'       => false
	);
	$radio_input_3 = array(
		'name'          => 'type',
        'value'         => '3',
        'checked'       => false
	);
	$title_input = array(
		'name'			=>	'title',
		'placeholder'	=>	'عنوان (اختیاری)',
		'maxlength'		=> 	100
	);
	$message_input = array(
		'name'			=>	'message',
		'maxlength'		=> 	2000
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=> 	'ارسال پیام گروهی',
		'style'			=>	'width:70% !important;'
	);

	$activity_item[0] = 'بر اساس زمینه فعالیت';
	$activity_item 	  = $activity_item + $activity;
	$province_item[0] = 'بر اساس استان محل زندگی';
	$province_item    = $province_item + $province;
?>

<table>
	<tr>
		<td colspan="2"><strong>قصد ارسال پیام گروهی برای چه گروهی را دارید:</strong></td>
	</tr>
	<tr>
		<td><?php echo form_radio($radio_input_1); ?></td>
		<td><strong>تمام کاربران وبسایت</strong></td>
	</tr>
	<tr>
		<td><?php echo form_radio($radio_input_2); ?></td>
		<td><?php echo form_dropdown('activity_id', $activity_item, 0); ?></td>
	</tr>
	<tr>
		<td><?php echo form_radio($radio_input_3); ?></td>
		<td><?php echo form_dropdown('province_id', $province_item, 0); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>عنوان:</strong></td>
		<td><?php echo form_input($title_input); ?></td>
	</tr>
	<tr>
		<td><strong>پیام:</strong></td>
		<td><?php echo form_textarea($message_input); ?></td>
	</tr>
	<tr>
		<td style="border:none;"></td>
		<td><?php echo form_submit($submit_input); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<?php
	if($notice == 1)
	{
		echo '<p style="color:#f00;">اطلاعات وارد شده نامعتبر می باشند.</p>';
	}
	elseif ($notice == 2)
	{
		echo '<p style="color:#3acc17;">پیام گروهی با موفقیت برای کاربران ارسال گردید.</p>';
	}
	elseif ($notice == 3)
	{
		echo '<p style="color:#f00;">در این دسته مخاطبی برای دریافت پیام گروهی موجود نیست.</p>';
	}
?>

<p>&nbsp;</p>
<div id="table_view">&nbsp;</div>
<p><strong>لیست پیام های گروهی:</strong></p>
<?php
	if($broadcast_item!=0)
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>عنوان پیام</td>
				<td>تعداد گیرندگان</td>
				<td>تاریخ</td>
				<td></td>
			</tr>
			<?php foreach ($broadcast_item as $my_broadcast_item): ?>
				<tr>
					<td style="width:45%; padding-right:5px;"><?php echo $my_broadcast_item['title']; ?></td>
					<td style="width:20%; text-align:center;"><?php echo $this->jdf->tr_num($my_broadcast_item['user_send_count']); ?> کاربر</td>
					<td style="width:20%; text-align:center;"><?php echo $this->jdf->jdate("j F Y", $my_broadcast_item['time']); ?></td>
					<td style="text-align:center;">
						<a class="retrive_data_table_read" href="<?php echo base_url() . 'panel/read_broadcast_message/' . $my_broadcast_item['id'] . '#content_view'; ?>" title="مشاهده پیام"><span class="fa fa-lg fa-eye"></span></a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php
	}
	else
	{
		?>
		<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
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

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این بخش می توانید به کاربران خود پیام دهید و آنها از صندوق پیام های خود پیام شما را بخوانند.</p>
<p>از ارسال پیام های گروهی به صورت متداوم و متوالی خودداری نمایید زیرا کاربران شما این پیام ها را به عنوان اسپم می دانند.</p>
<p>طریقه ی صحبت کردن و جمله بندی شما ممکن است در رفتار کاربر و استفاده از سامانه تغییر یابد پس مانند مدیران به آنها پیام دهید.</p>