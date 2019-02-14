<h2>پنل کاربری -) اطلاعات فردی</h2>
<?php
	echo form_open('user/update_person', 'method="post" class="panel_form"');

	$first_name_input = array(
		'name'			=>	'person_first_name',
		'placeholder'	=>	'نام',
		'maxlength'		=>	'50',
		'required'		=>	'required',
		'value'			=>	$first_name_value
	);
	$last_name_input = array(
		'name'			=>	'person_last_name',
		'placeholder'	=>	'نام خانوادگی',
		'maxlength'		=>	'50',
		'required'		=>	'required',
		'value'			=>	$last_name_value
	);
	for($i=1;$i<=31;$i++)
	{
		$birth_day_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1;$i<=12;$i++)
	{
		$birth_month_item[$i]=$this->jdf->tr_num($i);
	}
	for($i=1395;$i>=1301;$i--)
	{
		$birth_year_item[$i]=$this->jdf->tr_num($i);
	}
	$person_activity_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'آرایشی و بهداشتی',
		'2'				=>	'آموزش الکترونیک',
		'3'				=>	'آموزش پزشکی',
		'4'				=>	'آموزش عالی',
		'5'				=>	'آموزش فنی حرفه ای و مربیگری',
		'6'				=>	'آموزش مدیریت',
		'7'				=>	'آموزش و پرورش',
		'8'				=>	'اتوماسیون صنعتی',
		'9'				=>	'اثاثیه منزل',
		'10'			=>	'ادبیات',
		'11'			=>	'اقتصاد',
		'12'			=>	'الهیات و معارف اسلامی',
		'13'			=>	'املاک و مستغلات',
		'14'			=>	'امنیت کامپیوتر و شبکه',
		'15'			=>	'امنیت و تحقیقات',
		'16'			=>	'امور بین الملل',
		'17'			=>	'انبارداری',
		'18'			=>	'انتشارات',
		'19'			=>	'انرژی تجدید پذیر و محیط زیست',
		'20'			=>	'انیمیشن',
		'21'			=>	'اوقات فراغت',
		'22'			=>	'ایمنی عمومی',
		'23'			=>	'اینترنت',
		'24'			=>	'برنامه نویسی',
		'25'			=>	'بازاریابی و تبلیغات',
		'26'			=>	'بازی های رایانه ای',
		'27'			=>	'باستان شناسی',
		'28'			=>	'بانکداری',
		'29'			=>	'برون سپاری',
		'30'			=>	'بسته بندی',
		'31'			=>	'بسیج',
		'32'			=>	'بشر دوستی',
		'33'			=>	'بهداشت، سلامتی و تناسب اندام',
		'34'			=>	'بیمارستان و خدمات درمانی',
		'35'			=>	'بیمه',
		'36'			=>	'بیوتکنولوژی',
		'37'			=>	'پارچه',
		'38'			=>	'پلاستیک',
		'39'			=>	'پوشاک و مد',
		'40'			=>	'تجارت بین الملل',
		'41'			=>	'تجهیزات پزشکی',
		'42'			=>	'تحقیقات',
		'43'			=>	'ترجمه',
		'44'			=>	'تصاویر متحرک و فیلم',
		'45'			=>	'تنباکو',
		'46'			=>	'تولید مواد غذایی',
		'47'			=>	'ثبت اختراعات و امور مالکیت فکری',
		'48'			=>	'چاپ',
		'49'			=>	'حسابداری',
		'50'			=>	'حل اختلاف',
		'51'			=>	'حمل و نقل /  راه آهن',
		'52'			=>	'حمل و نقل و تحویل',
		'53'			=>	'خدمات اطلاع رسانی',
		'54'			=>	'خدمات بهداشت روان',
		'55'			=>	'خدمات حقوقی',
		'56'			=>	'خدمات رفاهی و تفریحی',
		'57'			=>	'خدمات شهری',
		'58'			=>	'خدمات فردی و خانواده',
		'59'			=>	'خدمات فناوری اطلاعات',
		'60'			=>	'خدمات مالی',
		'61'			=>	'خدمات محیط زیست',
		'62'			=>	'خدمات مصرف کننده',
		'63'			=>	'خرده فروشی',
		'64'			=>	'خوار و بار',
		'65'			=>	'خودرو',
		'66'			=>	'خیریه ها',
		'67'			=>	'داروسازی',
		'68'			=>	'دام داری',
		'69'			=>	'دامپزشکی',
		'70'			=>	'دریایی',
		'71'			=>	'دستگاه های صنعتی',
		'72'			=>	'دفاع و فضا',
		'73'			=>	'راه آهن',
		'74'			=>	'رسانه های آنلاین',
		'75'			=>	'رسانه و صدا و سیما',
		'76'			=>	'رستوران ها',
		'77'			=>	'روابط عمومی و ارتباطات',
		'78'			=>	'روان شناسی و روان پزشکی',
		'79'			=>	'روحانی دینی و مذهبی',
		'80'			=>	'زبان شناسی',
		'81'			=>	'زمین شناسی',
		'82'			=>	'ساخت و ساز',
		'83'			=>	'سازمان غیر انتفاعی',
		'84'			=>	'سازمان مدنی و اجتماعی',
		'85'			=>	'سازمان های سیاسی',
		'86'			=>	'سپاه و ارتش',
		'87'			=>	'سخت افزار کامپیوتر',
		'88'			=>	'سرگرمی',
		'89'			=>	'سرمایه گذاری بانکی',
		'90'			=>	'سرمایه و سهام خصوصی',
		'91'			=>	'سفر و گردشگری',
		'92'			=>	'سوپر مارکت',
		'93'			=>	'شبکه های کامپیوتری',
		'94'			=>	'شرکت های خدماتی',
		'95'			=>	'شیشه، سرامیک و بتن',
		'96'			=>	'شیلات',
		'97'			=>	'صنایع شیمیایی',
		'98'			=>	'صنعت برق / الکترونیک',
		'99'			=>	'طب سنتی و گیاهی',
		'100'			=>	'طراحی صنعتی',
		'101'			=>	'طراحی گرافیکی',
		'102'			=>	'طراح وب',
		'103'			=>	'عکاسی',
		'104'			=>	'عمده فروشی',
		'105'			=>	'غذا و نوشیدنی',
		'106'			=>	'فروش تجهیزات الکترونیک',
		'107'			=>	'فناوری نانو',
		'108'			=>	'قضایی',
		'109'			=>	'کاریابی',
		'110'			=>	'کاغذ و محصولات جنگل',
		'111'			=>	'کالاهای لوکس و جواهر',
		'112'			=>	'کالاهای مصرفی',
		'113'			=>	'کتابخانه',
		'114'			=>	'کشاورزی',
		'115'			=>	'کشتی سازی',
		'116'			=>	'لجستیک و زنجیره تامین',
		'117'			=>	'لوازم خانگی',
		'118'			=>	'لوازم و تجهیزات کسب و کار',
		'119'			=>	'لوازم ورزشی',
		'120'			=>	'مجلس شورای اسلامی',
		'121'			=>	'مخابرات',
		'122'			=>	'مدیریت',
		'123'			=>	'مدیریت دولتی',
		'124'			=>	'مدیریت سرمایه گذاری',
		'125'			=>	'مشاوره حقوقی',
		'126'			=>	'مشاوره مدیریت',
		'127'			=>	'مصالح ساختمانی',
		'128'			=>	'مطبوعات',
		'129'			=>	'معدن و فلزات',
		'130'			=>	'معماری و نقشه کشی',
		'131'			=>	'مکانیک و یا مهندسی صنایع',
		'132'			=>	'منابع انسانی',
		'133'			=>	'مهندسی عمران',
		'134'			=>	'موزه',
		'135'			=>	'موسیقی',
		'136'			=>	'نرم افزار کامپیوتر',
		'137'			=>	'نفت و انرژی',
		'138'			=>	'نمایشگاه و سمینار',
		'139'			=>	'نهادهای مذهبی',
		'140'			=>	'نویسندگی و ویراستاری',
		'141'			=>	'نیروی انتظامی',
		'142'			=>	'نیمه هادی ها',
		'143'			=>	'هتل و مهمانداری',
		'144'			=>	'هنر های زیبا',
		'145'			=>	'هنر و صنایع دستی',
		'156'			=>	'هنرهای نمایشی',
		'147'			=>	'هواپیمایی / خطوط هوایی',
		'148'			=>	'هوانوردی و هوافضا',
		'149'			=>	'واردات و صادرات',
		'150'			=>	'وایرلس',
		'151'			=>	'ورزش'
	);
	$gender_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'آقا',
		'2'				=>	'خانم'
	);
	$marriage_item = array(
		'0'				=>	'نامشخص',
		'1'				=>	'مجرد',
		'2'				=>	'متاهل'
	);
	$about_input = array(
		'name'			=>	'person_about',
		'maxlength'		=>	'1000',
		'value'			=>	$about_value
	);
	$submit_input = array(
		'name'			=>	'person_submit',
		'value'			=>	'بروز رسانی'
	);
?>

<table>
	<tr>
		<td><strong>نام</strong></td>
		<td><?php echo form_input($first_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>نام خانوادگی</strong></td>
		<td><?php echo form_input($last_name_input); ?></td>
	</tr>
	<tr>
		<td><strong>تاریخ تولد</strong></td>
		<td><?php echo form_dropdown('person_birth_day', $birth_day_item,$birth_day_value,'class="birth_item"'); echo form_dropdown('person_birth_month', $birth_month_item,$birth_month_value,'class="birth_item"'); echo form_dropdown('person_birth_year', $birth_year_item,$birth_year_value,'class="birth_item"'); ?></td>
	</tr>
	<tr>
		<td><strong>زمینه فعالیت</strong></td>
		<td><?php echo form_dropdown('person_activity', $person_activity_item, $activity_value); ?></td>
	</tr>
	<tr>
		<td><strong>جنسیت</strong></td>
		<td><?php echo form_dropdown('person_gender', $gender_item, $gender_value); ?></td>
	</tr>
	<tr>
		<td><strong>وضعیت تاهل</strong></td>
		<td><?php echo form_dropdown('person_marriage', $marriage_item, $marriage_value); ?></td>
	</tr>
	<tr>
		<td><strong>درباره من</strong></td>
		<td><?php echo form_textarea($about_input); ?></td>
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
?>

<p>&nbsp;</p>
<p><strong>راهنمایی:</strong></p>
<p>برای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.</p>
<p>در این صفحه شما میتوانید اطلاعات فردی خود را وارد کنید که این اطلاعات در شناسایی افراد حقیقی نقش موثری دارند.</p>
<p>از توزیع اطلاعات شخصی و محرمانه سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.</p>

<?php
	echo form_close();
?>