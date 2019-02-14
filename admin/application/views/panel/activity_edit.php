<h2>پنل مدیریت -) زمینه فعالیت -) ویرایش</h2>
<?php 
	echo form_open($url . 'admin/edit_activity', 'method="post" class="panel_form"');
	$activity_input = array(
		'name'			=>	'activity',
		'placeholder'	=>	'زمینه فعالیت',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$activity_name_value
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت'
	);
?>
<table>
	<tr>
		<td>زمینه فعالیت</td>
		<td><?php echo form_input($activity_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/activity" class="return_key" title="بازگشت">بازگشت</a>
		</td>
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
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>با کمک فرم بالا می توانید زمینه ی فعالیت مورد نظر خود را ویرایش کنید.</p>