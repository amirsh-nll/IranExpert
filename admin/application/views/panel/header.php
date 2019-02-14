<!DOCTYPE html>
<html>
	<head>
		<!--Meta-->
		<meta charset="utf-8">
		<title><?=$title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
						<span style="margin-left:5px;"><?php echo $this->jdf->tr_num($message_unread); ?></span><span class="fa fa-lg fa-envelope"></span>
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
						<li><a href="<?=$url; ?>panel/new_user" titile="افزودن کاربر جدید">افزودن کاربر جدید</a></li>
						<li><a href="<?=$url; ?>panel/list_user" titile="لیست کاربران">لیست کاربران</a></li>
						<li><a href="<?=$url; ?>panel/list_image" titile="لیست تصاویر">لیست تصاویر</a></li>
						<li><a href="<?=$url; ?>panel/report" titile="گزارش ها">گزارش ها</a></li>
						<li><a href="<?=$url; ?>panel/message" titile="پیام ها">پیام ها</a></li>
						<li><a href="<?=$url; ?>panel/out" titile="خروج">خروج</a></li>
					</ul>
				</div>
			</div>
			<div class="left_content">