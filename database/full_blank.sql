-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2016 at 08:15 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iranexpert`
--

-- --------------------------------------------------------

--
-- Table structure for table `irex_ability`
--

CREATE TABLE `irex_ability` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_achievement`
--

CREATE TABLE `irex_achievement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_activity`
--

CREATE TABLE `irex_activity` (
  `id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_activity`
--

INSERT INTO `irex_activity` (`id`, `name`) VALUES
(1, 'نامشخص');

-- --------------------------------------------------------

--
-- Table structure for table `irex_article`
--

CREATE TABLE `irex_article` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `start` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `end` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_broadcast`
--

CREATE TABLE `irex_broadcast` (
  `id` int(11) NOT NULL,
  `user_send_count` int(11) NOT NULL,
  `time` double NOT NULL,
  `type` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `message` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_captcha`
--

CREATE TABLE `irex_captcha` (
  `id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_persian_ci NOT NULL,
  `word` varchar(20) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_certificate`
--

CREATE TABLE `irex_certificate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `identity_1` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `identity_2` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `start_date` double NOT NULL,
  `end_date` double NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_contact`
--

CREATE TABLE `irex_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `mobile_number` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `postal_code` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_contact`
--

INSERT INTO `irex_contact` (`id`, `user_id`, `email`, `mobile_number`, `phone_number`, `postal_code`, `province_id`, `city_name`, `address`) VALUES
(1, 1, '', '', '', '', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `irex_favorite`
--

CREATE TABLE `irex_favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_image`
--

CREATE TABLE `irex_image` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `time` double NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_image`
--

INSERT INTO `irex_image` (`id`, `user_id`, `file_name`, `time`, `description`) VALUES
(1, 1, 'default.png', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `irex_job`
--

CREATE TABLE `irex_job` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `start` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `end` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_lesson`
--

CREATE TABLE `irex_lesson` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `start` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `end` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_login`
--

CREATE TABLE `irex_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` double NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_message`
--

CREATE TABLE `irex_message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` double NOT NULL,
  `status` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `message` text COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_page`
--

CREATE TABLE `irex_page` (
  `id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_page`
--

INSERT INTO `irex_page` (`id`, `title`, `content`) VALUES
(1, 'درباره ما', 'تارنما چیست ؟ ویکی : وب‌گاه،تارگاه،تارنما، سایت یا وب‌سایت مجموعه‌ای از صفحات وب است که دارای یک دامنه اینترنتی یا زیردامنه اینترنتی مشترک‌اند و به صورت مجموعه‌ای از صفحات مرتبط که داده‌هایی نظیر متن، صدا، تصویر و فیلم، روی آن‌ها ارائه می‌شود، روی شبکه ی اینترنت قرار می‌گیرد.صفحه ی وب سندی است که معمولاً به صورت اچ‌تی‌ام‌ال نوشته می‌شود و همواره با استفاده از پروتکل اچ‌تی‌تی‌پی می‌توان به آن دسترسی پیدا کرد. پروتکل اچ‌تی‌تی‌پی اطلاعات را از کارساز وب‌گاه به مرورگر وب کاربر منتقل می‌کند تا این اطلاعات برای کاربر نمایش داده شوند. همه ی وب‌گاهها در کنار هم یک تار جهان‌گستر بزرگ از اطلاعات را درست می‌کنند. دسترسی به صفحات وب‌گاه از طریق یک ریشه ی مشترک یوآرال با نام صفحه اصلی امکان‌پذیر است که این صفحه ی اصلی از لحاظ فیزیکی روی همان کارساز قرار می‌گیرد. یوآرال‌های صفحات آن‌ها را به صورت هرمی سازمان‌دهی می‌کنند اگرچه ابرپیوندهای موجود میانشان تعیین می‌کنند که چگونه کاربر اطلاعات را ببینند و چگونه ترافیک وب، بین بخش‌های مختلف وب‌گاه پخش شود. برای دسترسی به اطلاعات برخی از سایت‌های وب می‌بایست حق اشتراک داشته باشید.\r\n\r\nسامانه آنلاین پروفایل ایرانیان یک سامانه پارسی بوده که در تاریخ پاییز و زمستان سال ۱۳۹۵ خورشیدی بر پایه سیستم شخصی اختصاصی کدنویسی شده و توسط آقای امیر شکری راه اندازی شد این وبسایت در حال حاظر قصد دارد تا با ارائه ی خدمات تحت وب ارائه ی صفحات شخصی بتواند به شما کمک کند؛ سامانه پروفایل آنلاین ایرنیان یک سرویس کاربر محور می باشد که در کشور ایران راه اندازی شده است .\r\n\r\nتلفن تماس : +۹۸٫۹۱۲۸۴۹۶۰۳۴\r\n\r\nایمیل : amirsh.nll@gmail.com\r\n\r\nآدرس : ایران، تهران، دماوند\r\n\r\nلطفا در حفظ و نگهداری وبسایت کوشا باشید .'),
(2, 'قوانین', 'کاربر گرامی لطفا قبل از استفاده و یا ثبت نام در سرویس ایرانی " سامانه پروفایل آنلاین ایرانیان " موارد ذیل را کاملا مطالعه نمایید . در صورتیکه مایل به استفاده از خدمات این وب سایت می باشید حتما باید توافقنامه زیر را قبول نمایید در غیر اینصورت مجاز به استفاده از این سامانه نیستید.\r\n\r\nاز توزیع محتوای نژادی یا قومی ، دینی و ... خودداری کنید.\r\n\r\nبرای کمک به مبارزه و جلوگیری از هرزنامه از نام حقیقی خود استفاده نمایید .\r\n\r\nعكس کاربری پروفایل شخصی شما نباید دارای محتوای غیرمجاز یا توهین آمیز باشد.\r\n\r\nدر صورت رعایت نکردن هرکدام از موارد فوق حساب کاربری شما در سیستم مسدود می شود.\r\n\r\nدر صورت مشاهده تخلف شما به عنوان یک کاربر در این سامانه حق گزارش تخلف را خواهید داشت.\r\n\r\nاز توزیع اطلاعات شخصی و محرمانه شخصی سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.\r\n\r\nتمام هدف ما ارائه خدمات به کاربران عزیز ایرانی می باشد ، لذا از شما تقاضا داریم تا اطلاعات خود را بدون اغراق و با در نظر گرفتن واقعیت وارد نمایید تا این وبسایت برای شما کاربردی باشد.\r\n\r\n( تاریخ بروز رسانی قوانین : پاییز و زمستان ۱۳۹۵ خورشیدی )'),
(3, 'پیشخوان پنل کاربران', 'کاربر گرامی عزیز، خوش آمدید. \r\nشما می توانید با استفاده از منوی سمت راست پنل کاربری خود به بخش های مختلف بروید و اطلاعات خود را تکمیل کنید.\r\nبعد از پر کردن اطلاعات خود به راحتی می توانید با کلیک روی مشاهده پروفایل، صفحه ی شخصی خود را ببینید و لذت ببرید.\r\n \r\nمروری بر قوانین سامانه:\r\nکاربر گرامی لطفا قبل از استفاده و یا ثبت نام در سرویس ایرانی " سامانه پروفایل آنلاین ایرانیان " موارد ذیل را کاملا مطالعه نمایید. در صورتیکه مایل به استفاده از خدمات این وب سایت می باشید حتما باید توافقنامه زیر را قبول نمایید در غیر اینصورت مجاز به استفاده از این سامانه نیستید.\r\nاز توزیع محتوای نژادی یا قومی ، دینی و... خودداری کنید.\r\nبرای کمک به مبارزه و جلوگیری از هرزنامه از اطلاعات حقیقی خود استفاده نمایید.\r\nعكس کاربری پروفایل شخصی شما نباید دارای محتوای غیرمجاز یا توهین آمیز باشد.\r\nدر صورت رعایت نکردن هرکدام از موارد فوق حساب کاربری شما در سیستم مسدود می شود.\r\nدر صورت مشاهده تخلف شما به عنوان یک کاربر در این سامانه حق گزارش تخلف را خواهید داشت.\r\nتصاویر آقایان بهتر است با پوشش رسمی باشد و تصاویر خانم هم بهتر است با پوشش مناسب استفاده شود تا از خطر افراد سودجو در امان بمانند.\r\nاز توزیع اطلاعات شخصی و محرمانه سایر افراد و یا استفاده از حساب شخص دیگری یا باز کردن حساب به نام فرد دیگر خودداری فرمایید.\r\nتمام هدف ما ارائه خدمات به کاربران عزیز ایرانی می باشد، لذا از شما تقاضا داریم تا اطلاعات خود را بدون اغراق و با در نظر گرفتن واقعیت وارد نمایید تا این وبسایت برای شما کاربرد مثبت داشته باشد.\r\n( تاریخ بروز رسانی قوانین : پاییز و زمستان سال ۱۳۹۵ خورشیدی )');

-- --------------------------------------------------------

--
-- Table structure for table `irex_person`
--

CREATE TABLE `irex_person` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `birthday` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `activity_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `marriage` int(11) NOT NULL,
  `webpage_url` text COLLATE utf8_persian_ci NOT NULL,
  `about` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_person`
--

INSERT INTO `irex_person` (`id`, `user_id`, `first_name`, `last_name`, `birthday`, `activity_id`, `gender`, `marriage`, `webpage_url`, `about`) VALUES
(1, 1, '', '', '1395/01/01', 1, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `irex_project`
--

CREATE TABLE `irex_project` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `start` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `end` varchar(7) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_province`
--

CREATE TABLE `irex_province` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_province`
--

INSERT INTO `irex_province` (`id`, `name`) VALUES
(1, 'نامشخص');

-- --------------------------------------------------------

--
-- Table structure for table `irex_reminder`
--

CREATE TABLE `irex_reminder` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_slideshow`
--

CREATE TABLE `irex_slideshow` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_slideshow`
--

INSERT INTO `irex_slideshow` (`id`, `file_name`, `title`, `description`) VALUES
(1, 'slide1.png', 'اسلاید اول', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36// IP:::1'),
(2, 'slide2.png', 'اسلاید دوم', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36// IP:::1');

-- --------------------------------------------------------

--
-- Table structure for table `irex_social`
--

CREATE TABLE `irex_social` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `url` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irex_statistics`
--

CREATE TABLE `irex_statistics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `today` int(11) NOT NULL,
  `yesterday` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `last_visit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_statistics`
--

INSERT INTO `irex_statistics` (`id`, `user_id`, `today`, `yesterday`, `total`, `last_visit`) VALUES
(1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `irex_user`
--

CREATE TABLE `irex_user` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `email` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `middle_name` varchar(70) COLLATE utf8_persian_ci NOT NULL,
  `status` int(11) NOT NULL,
  `time` double NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irex_user`
--

INSERT INTO `irex_user` (`id`, `type`, `email`, `password`, `middle_name`, `status`, `time`, `description`) VALUES
(1, 1, 'admin@localhost.com', 'e6d67fed862c439aa6e911ce49c7857d', 'admin', 0, 0, 'IranExpert Admin :D');

-- --------------------------------------------------------

--
-- Table structure for table `irex_violation`
--

CREATE TABLE `irex_violation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `reason` text COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `irex_ability`
--
ALTER TABLE `irex_ability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_achievement`
--
ALTER TABLE `irex_achievement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_activity`
--
ALTER TABLE `irex_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irex_article`
--
ALTER TABLE `irex_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_broadcast`
--
ALTER TABLE `irex_broadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irex_captcha`
--
ALTER TABLE `irex_captcha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `irex_certificate`
--
ALTER TABLE `irex_certificate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_contact`
--
ALTER TABLE `irex_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `irex_favorite`
--
ALTER TABLE `irex_favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_image`
--
ALTER TABLE `irex_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_job`
--
ALTER TABLE `irex_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_lesson`
--
ALTER TABLE `irex_lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_login`
--
ALTER TABLE `irex_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_message`
--
ALTER TABLE `irex_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_page`
--
ALTER TABLE `irex_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irex_person`
--
ALTER TABLE `irex_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `irex_project`
--
ALTER TABLE `irex_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_province`
--
ALTER TABLE `irex_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irex_reminder`
--
ALTER TABLE `irex_reminder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_slideshow`
--
ALTER TABLE `irex_slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irex_social`
--
ALTER TABLE `irex_social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_statistics`
--
ALTER TABLE `irex_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `irex_user`
--
ALTER TABLE `irex_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `middle_name` (`middle_name`);

--
-- Indexes for table `irex_violation`
--
ALTER TABLE `irex_violation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `irex_ability`
--
ALTER TABLE `irex_ability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_achievement`
--
ALTER TABLE `irex_achievement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_activity`
--
ALTER TABLE `irex_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_article`
--
ALTER TABLE `irex_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_broadcast`
--
ALTER TABLE `irex_broadcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_captcha`
--
ALTER TABLE `irex_captcha`
  MODIFY `id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_certificate`
--
ALTER TABLE `irex_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_contact`
--
ALTER TABLE `irex_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_favorite`
--
ALTER TABLE `irex_favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_image`
--
ALTER TABLE `irex_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_job`
--
ALTER TABLE `irex_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_lesson`
--
ALTER TABLE `irex_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_login`
--
ALTER TABLE `irex_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_message`
--
ALTER TABLE `irex_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_page`
--
ALTER TABLE `irex_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `irex_person`
--
ALTER TABLE `irex_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_project`
--
ALTER TABLE `irex_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_province`
--
ALTER TABLE `irex_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_reminder`
--
ALTER TABLE `irex_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_slideshow`
--
ALTER TABLE `irex_slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `irex_social`
--
ALTER TABLE `irex_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `irex_statistics`
--
ALTER TABLE `irex_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_user`
--
ALTER TABLE `irex_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `irex_violation`
--
ALTER TABLE `irex_violation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `irex_ability`
--
ALTER TABLE `irex_ability`
  ADD CONSTRAINT `irex_ability_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_achievement`
--
ALTER TABLE `irex_achievement`
  ADD CONSTRAINT `irex_achievement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_article`
--
ALTER TABLE `irex_article`
  ADD CONSTRAINT `irex_article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_certificate`
--
ALTER TABLE `irex_certificate`
  ADD CONSTRAINT `irex_certificate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_contact`
--
ALTER TABLE `irex_contact`
  ADD CONSTRAINT `irex_contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `irex_contact_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `irex_province` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `irex_favorite`
--
ALTER TABLE `irex_favorite`
  ADD CONSTRAINT `irex_favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_image`
--
ALTER TABLE `irex_image`
  ADD CONSTRAINT `irex_image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `irex_job`
--
ALTER TABLE `irex_job`
  ADD CONSTRAINT `irex_job_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_lesson`
--
ALTER TABLE `irex_lesson`
  ADD CONSTRAINT `irex_lesson_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_login`
--
ALTER TABLE `irex_login`
  ADD CONSTRAINT `irex_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_message`
--
ALTER TABLE `irex_message`
  ADD CONSTRAINT `irex_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_person`
--
ALTER TABLE `irex_person`
  ADD CONSTRAINT `irex_person_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `irex_person_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `irex_activity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `irex_project`
--
ALTER TABLE `irex_project`
  ADD CONSTRAINT `irex_project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_reminder`
--
ALTER TABLE `irex_reminder`
  ADD CONSTRAINT `irex_reminder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_social`
--
ALTER TABLE `irex_social`
  ADD CONSTRAINT `irex_social_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_statistics`
--
ALTER TABLE `irex_statistics`
  ADD CONSTRAINT `irex_statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `irex_violation`
--
ALTER TABLE `irex_violation`
  ADD CONSTRAINT `irex_violation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `irex_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
