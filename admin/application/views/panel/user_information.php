<h2>پنل مدیریت -) لیست کاربران -) نمایش اطلاعات</h2>
<table class="panel_form user_information">
	<tr>
		<td>نام کاربری:</td>
		<td><?=$middle_name; ?></td>
	</tr>
	<tr>
		<td>نام کامل:</td>
		<td><?=$full_name; ?></td>
	</tr>
	<tr>
		<td>تاریخ تولد:</td>
		<td><?=$this->jdf->tr_num($birthday); ?></td>
	</tr>
	<tr>
		<td>وضعیت تاهل:</td>
		<td><?=$marriage; ?></td>
	</tr>
	<tr>
		<td>زمینه فعالیت:</td>
		<td><?=$activity; ?></td>
	</tr>
	<tr>
		<td>جنسیت:</td>
		<td><?=$gender; ?></td>
	</tr>
	<tr>
		<td>شماره همره:</td>
		<td><span dir="ltr"><?=$this->jdf->tr_num($mobile); ?></span></td>
	</tr>
	<tr>
		<td>شماره تماس:</td>
		<td><span dir="ltr"><?=$this->jdf->tr_num($phone); ?></span></td>
	</tr>
	<tr>
		<td>ایمیل:</td>
		<td><span dir="ltr"><?=$email; ?></span></td>
	</tr>
	<tr>
		<td>وبسایت/وبلاگ:</td>
		<td><span dir="ltr"><?=$webpage_url; ?></span></td>
	</tr>
	<tr>
		<td>کد پستی:</td>
		<td><?=$postal_code; ?></td>
	</tr>
	<tr>
		<td>آدرس محل سکونت:</td>
		<td><?=$address; ?></td>
	</tr>
	<tr>
		<td style="border:none;">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>وضعیت:</td>
		<td><?=$status; ?></td>
	</tr>
	<tr>
		<td>نوع کاربر:</td>
		<td><?=$type; ?></td>
	</tr>
	<tr>
		<td style="border:none;"></td>
		<td><a href="<?=$url; ?>panel/list_user" class="return_key" title="بازگشت">بازگشت</a></td>
	</tr>
</table>
<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>در این صفحه پیش نمایش اطلاعات کاربر مورد نظر خود را مشاهده کنید.</p>