<h2>پنل مدیریت -) استان ها</h2>
<?php 
	echo form_open('admin/edit_province', 'method="post" class="panel_form"');
	$province_input = array(
		'name'			=>	'province',
		'placeholder'	=>	'نام استان',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$province_name_value
	);
	$submit_input = array(
		'name'			=>	'submit',
		'value'			=>	'ثبت'
	);
?>
<table>
	<tr>
		<td>زمینه فعالیت</td>
		<td><?php echo form_input($province_input); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a href="<?=$url; ?>panel/province" class="return_key" title="بازگشت">بازگشت</a>
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
<p>با کمک فرم بالا می توانید نام استان مورد نظر خود را ویرایش کنید.</p>