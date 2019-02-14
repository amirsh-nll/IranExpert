<h2>پنل مدیریت -) محتوای سایت</h2>
<?php
	echo form_open('admin/site_content', 'method="post" class="panel_form"');
	$rules_page_input = array(
		'name'			=>	'rules_page',
		'maxlength'		=>	'5000',
		'value'			=>	$rules_page_value
	);
	$about_page_input = array(
		'name'			=>	'about_page',
		'maxlength'		=>	'5000',
		'value'			=>	$about_page_value
	);
	$user_panel_page_input = array(
		'name'			=>	'user_panel',
		'maxlength'		=>	'5000',
		'value'			=>	$user_panel_page_value
	);
	$submit_input = array(
		'name'			=>	'person_submit',
		'value'			=>	'بروز رسانی'
	);
?>

<table width="100%">
	<tr>
		<td><strong>صفحه قوانین سایت</strong></td>
		<td><?php echo form_textarea($rules_page_input); ?></td>
	</tr>
	<tr>
		<td><strong>صفحه درباره ما</strong></td>
		<td><?php echo form_textarea($about_page_input); ?></td>
	</tr>
	<tr>
		<td><strong>صفحه پنل کاربران</strong></td>
		<td><?php echo form_textarea($user_panel_page_input); ?></td>
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
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>با کمک فرم بالا می توانید اطلاعات صفحات مختلف سایت را ویرایش کنید.</p>

<?php
	echo form_close();
?>