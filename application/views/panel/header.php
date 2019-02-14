<!DOCTYPE html>
<html>
	<head>
		<!--Meta-->
		<meta charset="utf-8">
		<title><?=$title; ?></title>
		<!--Meta-->
		<!--Assets-->
		<link rel="stylesheet" href="<?=$url; ?>assets/css/panel.css" />
		<link rel="stylesheet" href="<?=$url; ?>assets/css/font-awesome.css">
		<link rel="stylesheet" href="<?=$url; ?>assets/css/font-awesome.min.css">
		<link rel="shortcut icon" type="image/ico" href="<?=$url; ?>assets/image/favicon.png" >
		<!--Assets-->
	</head>

	<body>
		<div class="header">
			<div class="header_content">
				<div class="logo">
					<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
				</div>
				<div class="navbar">
					<a style="color:#49b73c;" href="<?=$url; ?>panel/message" title="<?=$message_unread; ?> پیام ها خوانده نشده">
						<span style="margin-left:5px;"><?=$message_unread; ?></span><span class="fa fa-lg fa-envelope"></span>
					</a>
					<a  style="color:#ff4c00;" href="<?=$url; ?>panel/out" title="خروج">
						<span class="fa fa-lg fa-plug"></span>
					</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="content">
		<div id="content_view">&nbsp;</div>
			<div class="right_content">
				<div class="menu">
					<ul>
						<li><a href="<?=$url; ?>panel/home" titile="پیشخوان">پیشخوان</a></li>
						<li><a href="<?=$url; ?>panel/image" titile="تصویر کاربری">تصویر کاربری</a></li>
						<li><a href="<?=$url; ?>panel/person" titile="اطلاعات فردی">اطلاعات فردی</a></li>
						<li><a href="<?=$url; ?>panel/contact" titile="اطلاعات تماس">اطلاعات تماس</a></li>
						<li><a href="<?=$url; ?>panel/lesson" titile="اطلاعات تحصیلی">اطلاعات تحصیلی</a></li>
						<li><a href="<?=$url; ?>panel/job" titile="اطلاعات شغلی">اطلاعات شغلی</a></li>
						<li><a href="<?=$url; ?>panel/ability" titile="توانایی ها">توانایی ها</a></li>
						<li><a href="<?=$url; ?>panel/project" titile="پروژه ها">پروژه ها</a></li>
						<li><a href="<?=$url; ?>panel/article" titile="مقالات">مقالات</a></li>
						<li><a href="<?=$url; ?>panel/achievement" titile="افتخارات">افتخارات</a></li>
						<li><a href="<?=$url; ?>panel/favorite" titile="علاقه مندی ها">علاقه مندی ها</a></li>
						<li><a href="<?=$url; ?>panel/social" titile="شبکه های اجتماعی">شبکه های اجتماعی</a></li>
						<li><a href="<?=$url; ?>panel/state" titile="آمار">آمار</a></li>
						<li><a href="<?=$url; ?>panel/message" titile="پیام ها">پیام ها</a></li>
						<li><a href="<?=$url; ?>panel/setting" titile="تنظیمات">تنظیمات</a></li>
						<li><a href="<?=$url; ?>panel/profile" titile="مشاهده پروفایل" target="_blank">مشاهده پروفایل</a></li>
						<li><a href="<?=$url; ?>panel/out" titile="مشاهده پروفایل">خروج</a></li>
					</ul>
				</div>
			</div>
			<div class="left_content">