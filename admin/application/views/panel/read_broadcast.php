<h2>پنل کاربری -) پیام گروهی -) مشاهده</h2>
<div id="content_view"></div>

<?php
	$broadcast_item = $broadcast_item[0];
?>
<table class="retrive_once_message">
	<tr>
		<td>نوع ارسال:</td>
		<td><strong><?php echo $broadcast_item['type']; ?></strong></td>
	</tr>
	<tr>
		<td>تعداد گیرندگان:</td>
		<td><strong><?php echo $broadcast_item['user_send_count']; ?> کاربر</strong></td>
	</tr>
	<tr>
		<td>عنوان پیام</td>
		<td><strong><?php echo $broadcast_item['title']; ?></strong></td>
	</tr>
	<tr>
		<td>زمان ارسال پیام</td>
		<td><strong><?php echo $this->jdf->jdate("j F Y - H:i:s", $broadcast_item['time']); ?></strong></td>
	</tr>
	<tr>
		<td>پیام</td>
		<td style="text-align:justify;"><strong><?php echo $broadcast_item['message']; ?></strong></td>
	</tr>
</table>
<p>&nbsp;</p>
<a class="return_key" href="<?=$url . 'panel/broadcast_message#table_view'; ?>" title="بازگشت">بازگشت</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>شما می توانید با پاسخدهی به پیام های خود به کمک ایمیلتان بین بازدیدکنددگان معتبر باشید.</p>
<p>در صورتی که محتوای پیام یا بخشی از آن دارای محتوای متخلفانه است آن را به ما گزارش تا پیگیر موضوع باشیم.</p>