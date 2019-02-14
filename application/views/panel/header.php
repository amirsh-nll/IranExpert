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
			    var imgRegex = /^([a-zA-Z0-9\s_\(\)\,\!\@\#\$\%\^\&\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
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
		<script>
		   $(document).ready(function(){
		 
		        $this.ajaxSetup({cache:false});
		        $(".refresh_key").click(function(){
		            var refresh_key = $(this).attr("href");
		 
		            $("#refresh_key").html("لطفا منتظر بمانید...");
		            $("#body").load(refresh_key);
		        return false;
		        });
		 
		    });
		</script>
		<!--JS-->
	</head>
	<?php
		$current_method	= $this->router->fetch_method();
		switch ($current_method) {
			case 'home':{$active_menu_number = 1;}					break;
			case 'image':{$active_menu_number = 2;}					break;
			case 'person':{$active_menu_number = 3;}				break;
			case 'contact':{$active_menu_number = 4;}				break;
			case 'lesson':{$active_menu_number = 5;}				break;
			case 'update_lesson':{$active_menu_number = 5;}			break;
			case 'job':{$active_menu_number = 6;}					break;	
			case 'update_job':{$active_menu_number = 6;}			break;
			case 'ability':{$active_menu_number = 7;}				break;
			case 'update_ability':{$active_menu_number = 7;}		break;
			case 'project':{$active_menu_number = 8;}				break;
			case 'update_project':{$active_menu_number = 8;}		break;
			case 'article':{$active_menu_number = 9;}				break;
			case 'update_article':{$active_menu_number = 9;}		break;
			case 'achievement':{$active_menu_number = 10;}			break;
			case 'update_achievement':{$active_menu_number = 10;}	break;
			case 'favorite':{$active_menu_number = 11;}				break;
			case 'update_favorite':{$active_menu_number = 11;}		break;
			case 'social':{$active_menu_number = 12;}				break;
			case 'update_social':{$active_menu_number = 12;}		break;
			case 'statistics':{$active_menu_number = 13;}			break;
			case 'message':{$active_menu_number = 14;}				break;
			case 'read_message':{$active_menu_number = 14;}			break;
			case 'setting':{$active_menu_number = 15;}				break;
			case 'suspend_accont':{$active_menu_number = 15;}		break;
			case 'certificate':{$active_menu_number = 16;}			break;
			case 'reminder':{$active_menu_number = 17;}				break;
			default:{$active_menu_number = 1;}						break;
		}
	?>
	<body id="body">
		<div class="header">
			<div class="header_content">
				<div class="logo">
					<img src="<?=$url; ?>assets/image/logo.png" title="iranExpert Logo" alt="iranExpert Logo" />
				</div>
				<div class="navbar">
					<a style="color:#ff951a;" href="<?=$url; ?>panel/reminder#table_view" title="<?=$reminder_count; ?> یادآور">
						<span style="margin-left:5px;"><?php echo $this->jdf->tr_num($reminder_count); ?></span><span class="fa fa-lg fa-bell"></span>
					</a>
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
						<li <?php if($active_menu_number==1){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/home" title="پیشخوان">پیشخوان</a></li>
						<li <?php if($active_menu_number==2){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/image" title="تصویر کاربری">تصویر کاربری</a></li>
						<li <?php if($active_menu_number==3){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/person" title="اطلاعات فردی">اطلاعات فردی</a></li>
						<li <?php if($active_menu_number==4){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/contact" title="اطلاعات تماس">اطلاعات تماس</a></li>
						<li <?php if($active_menu_number==5){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/lesson" title="اطلاعات تحصیلی">اطلاعات تحصیلی</a></li>
						<li <?php if($active_menu_number==6){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/job" title="اطلاعات شغلی">اطلاعات شغلی</a></li>
						<li <?php if($active_menu_number==7){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/ability" title="توانایی ها">توانایی ها</a></li>
						<li <?php if($active_menu_number==8){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/project" title="پروژه ها">پروژه ها</a></li>
						<li <?php if($active_menu_number==9){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/article" title="مقالات">مقالات</a></li>
						<li <?php if($active_menu_number==10){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/achievement" title="افتخارات">افتخارات</a></li>
						<li <?php if($active_menu_number==11){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/favorite" title="علاقه مندی ها">علاقه مندی ها</a></li>
						<li <?php if($active_menu_number==12){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/social" title="شبکه های اجتماعی">شبکه های اجتماعی</a></li>
						<li <?php if($active_menu_number==13){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/statistics" title="آمار">آمار</a></li>
						<li <?php if($active_menu_number==14){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/message" title="پیام ها">پیام ها</a></li>
						<li <?php if($active_menu_number==15){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/setting" title="تنظیمات">تنظیمات</a></li>
						<li <?php if($active_menu_number==16){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/certificate" title="رسمی کردن پروفایل">رسمی کردن پروفایل</a></li>
						<li <?php if($active_menu_number==17){echo 'class="active_menu"';} ?>><a href="<?=$url; ?>panel/reminder" title="یادآورها">یادآورها</a></li>
						<li class="profile_menu"><a href="<?=$url; ?>panel/profile" titile="مشاهده پروفایل" target="_blank">مشاهده پروفایل</a></li>
						<li class="out_menu"><a href="<?=$url; ?>panel/out" title="مشاهده پروفایل">خروج</a></li>
					</ul>
				</div>
			</div>
			<div class="left_content">