<h2>پنل کاربری -) پیام ها -) مشاهده</h2>
<div id="content_view"></div>

<?php 
	$message_item = $message_item[0];
	if(empty($message_item['full_name']))
	{
		$message_item['full_name'] = 'بدون نام';
	}
	if(empty($message_item['title']))
	{
		$message_item['title'] = 'بدون عنوان';
	}
?>

<p class="report_message"><a title="گزارش تخلف" href="<?php echo $url . 'panel/report_message/' . $message_item['id']; ?>"><span>گزارش تخلف این پیام</span><span class="fa fa-lg fa-bullhorn"></span></a></p>

<table width="100%" class="retrive_once_message">
	<tr>
		<td>نام فرستنده</td>
		<td><strong><?php echo $message_item['full_name']; ?></strong></td>
	</tr>
	<tr>
		<td>عنوان پیام</td>
		<td><strong><?php echo $message_item['title']; ?></strong></td>
	</tr>
	<tr>
		<td>ایمیل فرستنده</td>
		<td><strong dir="ltr"><?php echo $message_item['email']; ?></strong></td>
	</tr>
	<tr>
		<td>زمان ارسال پیام</td>
		<td><strong><?php echo $this->jdf->jdate("j F Y - H:i:s", $message_item['time']); ?></strong></td>
	</tr>
	<tr>
		<td>پیام</td>
		<td><strong><?php echo $message_item['message']; ?></strong></td>
	</tr>
</table>
<p>&nbsp;</p>
<a class="return_key" href="<?=$url . 'panel/message#table_view'; ?>" title="بازگشت">بازگشت</a>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
	if ($notice == 1)
	{
		echo '<p style="color:#3acc17;">این پیام به عنوان تخلف به ما گزارش شد، در آینده ای نزدیک نتیجه را به اطلاعتان خواهیم رساند.</p>';
	}
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>شما می توانید با پاسخدهی به پیام های خود به کمک ایمیلتان بین بازدیدکنددگان معتبر باشید.</p>
<p>در صورتی که محتوای پیام یا بخشی از آن دارای محتوای متخلفانه است آن را به ما گزارش تا پیگیر موضوع باشیم.</p>