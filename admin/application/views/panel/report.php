<h2>پنل مدیریت -) گزارش های سایت</h2>
<p><strong>گزارش ها:</strong></p>
<ul class="report_key">
	<li><a style="<?php if($report_section==0){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report#report_view" title="همه گزارش ها">همه گزارش ها</a></li>
	<li><a style="<?php if($report_section==1){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/1#report_view" title="بازدید سایت اصلی">بازدید سایت اصلی</a></li>
	<li><a style="<?php if($report_section==2){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/2#report_view" title="بازدید پروفایل ها">بازدید پروفایل ها</a></li>
	<li><a style="<?php if($report_section==3){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/3#report_view" title="گزارش کاربران">گزارش کاربران</a></li>
	<li><a style="<?php if($report_section==4){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/4#report_view" title="گزارش تصاویر پروفایل ها">گزارش تصاویر پروفایل ها</a></li>
	<li><a style="<?php if($report_section==5){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/5#report_view" title="گزارش ورود کاربران به پنل">گزارش ورود کاربران به پنل</a></li>
	<li><a style="<?php if($report_section==6){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/6#report_view" title="گزارش عضویت کاربران">گزارش عضویت کاربران</a></li>
	<li><a style="<?php if($report_section==7){echo 'font-weight:bold;';} ?>" href="<?=$url; ?>panel/report/7#report_view" title="گزارش تولد کاربران">گزارش تولد کاربران</a></li>
</ul>
<div id="report_view"></div>
<?php
	if($chart_1!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش بازدید سایت اصلی:</strong></p>';
		echo $chart_1;
		if($report_section==1)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/1">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_2!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش بازدید کل پروفایل ها:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_view_profile" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_2;
		if($report_section==2)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/2">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_3!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش کاربران:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_user" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_3;
		if($report_section==3)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/3">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_4!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش تصاویر پروفایل کاربران:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_user_image" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_4;
		if($report_section==4)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/4">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_5!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش دفعات ورود به پنل توسط کاربران:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_user_login" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_5;
		if($report_section==5)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/5">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_6!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش عضویت کاربران:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_user_register" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_6;
		if($report_section==6)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/6">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
	if($chart_7!='')
	{
		echo '<p>&nbsp;</p><p><strong>گزارش تولد کاربران:</strong> (<a class="report_full_key" href="' . $url . 'panel/report_user_birthday" title="جزئیات بیشتر">جزئیات بیشتر</a>)</p>';
		echo $chart_7;
		if($report_section==7)
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report/7">بروز رسانی</a><div class="clear"></div>';
		}
		else
		{
			echo '<a class="refresh_key" id="refresh_key" title="بروزرسانی" rel="report" href="http://localhost/admin/panel/report">بروز رسانی</a><div class="clear"></div>';
		}
	}
?>
<p>&nbsp;</p>