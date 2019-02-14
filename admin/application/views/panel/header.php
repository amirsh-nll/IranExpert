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
		<!--JS-->
		<script type="text/javascript" src="../../../assets/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			    var imgRegex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			    $("input[load-image=true]").change(function (evt) {
			        var changeBtn = $(this);
			        if (typeof (FileReader) === "undefined") { alert("This browser does not support HTML5 FileReader."); return; }
			        // 
			        $($(this)[0].files).each(function () {
			            var file = $(this)[0];
			            if (imgRegex.test(file.name.toLowerCase())) {
			                var reader = new FileReader();
			                reader.onload = function (e) { $(changeBtn.attr("href-image")).attr("src", e.target.result); }
			                reader.readAsDataURL(file);
			            }
			            else {
			                alert("Invalid format.");
			            }
			        });
			    });
			});
		</script>
		<!--JS-->
	</head>
	<?php
		$system_address = 'http://localhost/';
		$current_method	= $this->router->fetch_method();
		switch ($current_method) {
			case 'home':{$active_menu_number = 1;}					break;
			case 'new_user':{$active_menu_number = 2;}				break;
			case 'list_user':{$active_menu_number = 3;}				break;
			case 'view_user_information':{$active_menu_number = 3;}	break;
			case 'user_edit':{$active_menu_number = 3;}				break;
			case 'user_ban':{$active_menu_number = 3;}				break;
			case 'user_message':{$active_menu_number = 3;}			break;
			case 'list_image':{$active_menu_number = 4;}			break;
			case 'report':{$active_menu_number = 5;}				break;
			case 'activity':{$active_menu_number = 6;}				break;	
			case 'activity_edit':{$active_menu_number = 6;}			break;
			case 'province':{$active_menu_number = 7;}				break;
			case 'province_edit':{$active_menu_number = 7;}			break;
			case 'slideshow':{$active_menu_number = 8;}				break;
			case 'message':{$active_menu_number = 9;}				break;
			case 'read_message':{$active_menu_number = 9;}			break;
			default:{$active_menu_number = 1;}						break;
		}
	?>
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
						<li <?php if($active_menu_number==1){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/home" titile="پیشخوان">پیشخوان</a></li>
						<li <?php if($active_menu_number==2){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/new_user" titile="افزودن کاربر جدید">افزودن کاربر جدید</a></li>
						<li <?php if($active_menu_number==3){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/list_user" titile="لیست کاربران">لیست کاربران</a></li>
						<li <?php if($active_menu_number==4){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/list_image" titile="لیست تصاویر">لیست تصاویر</a></li>
						<li <?php if($active_menu_number==5){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/report" titile="گزارش ها">گزارش ها</a></li>
						<li <?php if($active_menu_number==6){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/activity" titile="زمینه های فعالیت">زمینه های فعالیت</a></li>
						<li <?php if($active_menu_number==7){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/province" titile="استان ها">استان ها</a></li>
						<li <?php if($active_menu_number==8){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/slideshow" titile="اسلاید شو">اسلاید شو</a></li>
						<li <?php if($active_menu_number==9){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/message" titile="پیام ها">پیام ها</a></li>
						<li class="system_menu"><a target="_blank" href="<?php echo $system_address; ?>" titile="مشاهده سامانه">مشاهده سامانه</a></li>
						<li class="out_menu"><a href="<?=$url; ?>panel/out" titile="خروج">خروج</a></li>
					</ul>
				</div>
			</div>
			<div class="left_content">