<h2>پنل کاربری -) مقالات</h2>
<?php
	echo form_open('user/add_article', 'method="post" class="panel_form"');

	$article_title_input = array(
		'name'			=>	'article_title',
		'place_holder'	=>	'عنوان مقاله',
		'maxlength'		=>	'70',
		'required'		=>	'required'
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
		'maxlength'		=>	'500'
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
		<td><?php echo form_dropdown('article_start_month', $article_start_month_item, '', 'class="article_item"'); echo form_dropdown('article_start_year', $article_start_year_item, '', 'class="article_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>پایان مقاله</strong></td>
		<td><?php echo form_dropdown('article_end_month', $article_end_month_item, '', 'class="article_item"'); echo form_dropdown('article_end_year', $article_end_year_item, '', 'class="article_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>توضیحات</strong></td>
		<td><?php echo form_textarea($article_description); ?></td>
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
	elseif ($notice == 7)
	{
		echo '<p style="color:#f00;">لطفا تاریخ شروع را تاریخی قبل از تاریخ پایان انتخاب کنید.</p>';
	}
?>

<div id="table_view">&nbsp;</div>
<p>&nbsp;</p>
<p><strong>لیست مقاله ها:</strong></p>
<?php
	if($article_item!=0)
	{
		?>
		<table cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>عنوان مقاله</td>
				<td>شروع مقاله</td>
				<td>پایان مقاله</td>
				<td>توضیحات</td>
				<td></td>
			</tr>
			<?php foreach ($article_item as $my_article): ?>
				<tr>
					<td style="width:18%;"><?php echo $my_article['title']; ?></td>
					<td style="width:15%; text-align:center;"><?php echo $this->jdf->tr_num($my_article['start']); ?></td>
					<td style="width:15%; text-align:center;"><?php echo $this->jdf->tr_num($my_article['end']); ?></td>
					<td style="width:45%;"><?php echo $my_article['description']; ?></td>
					<td style="width:7%;">
						<a class="retrive_data_table_update" href="<?php echo base_url() . 'panel/update_article/' . $my_article['id']; ?>" title="ویرایش"><span class="fa fa-lg fa-edit"></span></a>
						<a class="retrive_data_table_delete" href="<?php echo base_url() . 'user/delete_article/' . $my_article['id']; ?>" title="حذف"><span class="fa fa-lg fa-close"></span></a>
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
				<td style="width:18%;">عنوان مقاله</td>
				<td style="width:15%;">شروع مقاله</td>
				<td style="width:15%;">پایان مقاله</td>
				<td style="width:45%;">توضیحات</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">مقاله ای برای نمایش موجود نیست.</td>
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
<p><strong>راهنمایی:</strong></p>
<p>در حال حاظر شما اجازه ثبت <?php echo $this->jdf->tr_num(20); ?> مقاله را دارید.</p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این بخش با وارد کردن مقاله های خود می توانید بازدیدکنندگان را مجذوب کنید.</p>
<?php
	echo form_close();
?>