<h2>پنل کاربری -) پیام ها</h2>
<div id="table_view"></div>
<p><strong>لیست پیام ها:</strong></p>
	<?php
		if($message_item!=0)
		{
	?>
			<table width="100%" cellpadding="0" cellspacing="0" class="retrive_data_table">
			<tr>
				<td>نام</td>
				<td>عنوان پیام</td>
				<td>تاریخ/زمان</td>
				<td></td>
			</tr>
			<?php foreach ($message_item as $my_message): ?>
				<tr<?php if($my_message['status']==1){echo ' style="background:#ccf;"';} ?>>
					<td style="width:25%; padding-right:5px;"><?php echo $my_message['full_name']; ?></td>
					<td style="width:50%; padding-right:5px;"><?php echo $my_message['title']; ?></td>
					<td style="width:20%; text-align:center;"><?php echo $this->jdf->jdate("j F Y", $my_message['time']); ?></td>
					<td style="text-align:center;">
						<a class="retrive_data_table_read" href="<?php echo base_url() . 'panel/read_message/' . $my_message['id'] . '#content_view'; ?>" title="مشاهده پیام"><span class="fa fa-lg fa-eye"></span></a>
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
					<td>نام</td>
					<td>عنوان پیام</td>
				</tr>
				<tr>
					<td colspan="2">پیامی برای نمایش موجود نیست.</td>
				</tr>
			</table>
			<?php
		}
	?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>پیام های شما در بالا لیست شده است بهتر است برای جذب مخاطبان خود پیام های آنها را با ایمیل شخصی خود پاسخگو باشید.</p>