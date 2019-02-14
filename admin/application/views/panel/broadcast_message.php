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
		'value'			=> 	'ارسال پیام گروهی'
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
?>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این بخش می توانید به کاربران خود پیام دهید و آنها از صندوق پیام های خود پیام شما را بخوانند.</p>
<p>از ارسال پیام های گروهی به صورت متداوم و متوالی خودداری نمایید زیرا کاربران شما این پیام ها را به عنوان اسپم می دانند.</p>
<p>طریقه ی صحبت کردن و جمله بندی شما ممکن است در رفتار کاربر و استفاده از سامانه تغییر یابد پس مانند مدیران به آنها پیام دهید.</p>