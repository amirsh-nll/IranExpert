<h2>پنل کاربری -) مقالات -) ویرایش</h2>
<?php
	echo form_open($url . 'user/update_article', 'method="post" class="panel_form"');

	$article_item 	= $article_item[0];
	$start 			= explode('/', $article_item['start']);
	$end 			= explode('/', $article_item['end']);

	$article_title_input = array(
		'name'			=>	'article_title',
		'place_holder'	=>	'عنوان مقاله',
		'maxlength'		=>	'70',
		'required'		=>	'required',
		'value'			=>	$article_item['title']
	);
	for($i=1;$i<=12;$i++)
	{
		$article_start_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$article_start_year_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$article_end_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$article_end_year_item[$i]=$this->jdf->tr_num($i);
	}
	$article_description = array(
		'name'			=>	'article_description',
		'maxlength'		=>	'500',
		'value'			=>	$article_item['description']

	);
	$submit_input = array(
		'name'			=>	'article_submit',
		'value'			=>	'ثبت'
	);
?>

<table>
	<tr>
		<td><strong>عنوان مقاله</strong></td>
		<td><?php echo form_input($article_title_input); ?></td>
	</tr>
	<tr>
		<td><strong>شروع مقاله</strong></td>
		<td><?php echo form_dropdown('article_start_month', $article_start_month_item, $start[1], 'class="article_item"'); echo form_dropdown('article_start_year', $article_start_year_item, $start[0], 'class="article_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان مقاله</strong></td>
		<td><?php echo form_dropdown('article_end_month', $article_end_month_item, $end[1], 'class="article_item"'); echo form_dropdown('article_end_year', $article_end_year_item, $end[0], 'class="article_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($article_description); ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo form_submit($submit_input); ?>
			<a class="return_key" href="<?=$url . 'panel/Article#table_view'; ?>" title="بازگشت">بازگشت</a>
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
		echo '<p style="color:#3acc17;">اطلاعات با موفقیت ذخیره شد.</p>';
	}
	elseif ($notice == 7)
	{
		echo '<p style="color:#f00;">لطفا تاریخ شروع را تاریخی قبل از تاریخ پایان انتخاب کنید.</p>';
	}
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن مقاله های خود می توانید بازدیدکنندگان را مجذوب کنید.</p>
<?php
	echo form_close();
?>