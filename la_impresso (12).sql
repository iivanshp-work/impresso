-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 13 2019 г., 09:02
-- Версия сервера: 5.5.53-MariaDB
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `la_impresso`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buy_credits`
--

CREATE TABLE `buy_credits` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `xims_amount` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `price` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `save_text` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `buy_credits`
--

INSERT INTO `buy_credits` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `xims_amount`, `price`, `save_text`) VALUES
(1, NULL, '2019-07-30 09:04:25', '2019-07-30 09:04:25', '90 tokens', '90', '9', ''),
(2, NULL, '2019-07-30 09:08:15', '2019-07-30 09:08:15', '300 tokens\r\n+ 50 tokens', '350', '27', 'Save 14%'),
(3, NULL, '2019-07-30 09:08:55', '2019-07-30 09:08:55', '500 tokens\r\n+ 200 tokens', '700', '45', 'Save 28%'),
(4, NULL, '2019-07-30 09:09:24', '2019-07-30 09:09:24', '1000 tokens\r\n+ 500 tokens', '1500', '90', 'Save 33%'),
(5, '2019-08-02 01:27:35', '2019-08-02 01:27:08', '2019-08-02 01:27:35', 'Test price', '100', '5', '');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_iso_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `deleted_at`, `created_at`, `updated_at`, `country`, `country_code`, `country_iso_code`) VALUES
(1, NULL, '2019-09-12 01:30:09', '2019-09-12 01:30:09', 'Argentina', '54', 'AR'),
(2, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Australia', '61', 'AU'),
(3, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Belgium', '32', 'BE'),
(4, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Bulgaria', '359', 'BG'),
(5, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Canada', '1', 'CA'),
(6, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Chile', '56', 'CL'),
(7, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'China', '86', 'CN'),
(8, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Colombia', '57', 'CO'),
(10, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Croatia', '385', 'CR'),
(11, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Cyprus', '357', 'CY'),
(12, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Czech Republic', '420', 'CZ'),
(13, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Denmark', '45', 'DK'),
(14, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Egypt', '20', 'EG'),
(16, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'France', '33', 'FR'),
(17, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Germany', '49', 'DE'),
(18, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Greece', '30', 'GR'),
(19, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Hong Kong', '852', 'HK'),
(20, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'India', '91', 'IN'),
(21, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Indonesia', '62', 'ID'),
(22, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Ireland', '353', 'IE'),
(23, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Italy', '39', 'IT'),
(24, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Kenya', '254', 'KE'),
(25, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Malaysia', '60', 'MY'),
(26, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Mexico', '52', 'MX'),
(27, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Netherlands', '31', 'NL'),
(28, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'New Zealand', '64', 'NZ'),
(29, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Poland', '48', 'PL'),
(30, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Portugal', '351', 'PT'),
(31, NULL, '2019-09-12 01:30:28', '2019-09-13 02:13:27', 'Russia', '7', 'RU'),
(32, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Singapore', '65', 'SG'),
(33, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'South Korea', '82', 'SK'),
(34, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Spain', '34', 'ES'),
(35, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Switzerland', '41', 'CH'),
(36, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Taiwan', '886', 'TW'),
(37, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Thailand', '66', 'TH'),
(38, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Turkey', '90', 'TR'),
(39, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'United Arab Emirates', '971', 'AE'),
(40, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'United Kingdom', '44', 'GB'),
(41, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'United States', '1', 'US'),
(42, NULL, '2019-09-12 01:30:28', '2019-09-12 01:30:28', 'Vietnam', '84', 'VN');

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `name`, `tags`, `color`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administration', '[]', '#000', NULL, '2019-07-02 10:35:16', '2019-07-02 10:35:16');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `location_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `company_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `deleted_at`, `created_at`, `updated_at`, `job_title`, `description`, `location_title`, `longitude`, `latitude`, `company_title`, `short_description`, `status`) VALUES
(1, NULL, '2019-07-02 18:29:36', '2019-08-02 01:33:00', 'PHP DEVELOPER', 'PHP DEVELOPER<div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div>', 'Ivano-Frankivsk', '24.705023', '48.936592', 'NPGroup', 'Full time developer', 1),
(2, NULL, '2019-07-06 02:26:35', '2019-08-02 01:32:42', 'Javascript Middle ', 'Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle ', 'Lviv', '24.029717', '49.839683', 'SoftServe', 'Office work', 1),
(3, NULL, '2019-07-06 02:53:46', '2019-08-02 01:32:32', 'PHP DEVELOPER Kraków', 'PHP DEVELOPER Kraków<div>PHP DEVELOPER Kraków<br></div>', 'Kraków', '19.9449799', '50.0646501', 'KRAKOW ONLINE', 'remote developer', 1),
(4, NULL, '2019-07-06 17:29:05', '2019-08-02 01:33:10', 'Java Dev', 'Java Dev<div>Java Dev<br></div><div>Java Dev<br></div><div>Java Dev<br></div><div><br></div>', 'Ivano-Frankivsk', '24.0333', '48.887908', 'softjourn', 'JAVA', 1),
(5, NULL, '2019-07-20 17:20:31', '2019-08-02 01:32:23', 'Tester', 'Tester at PB', 'Kiev', '30.5234', '50.4501', 'PB', 'Tester at PB', 1),
(6, NULL, '2019-07-20 17:21:29', '2019-08-02 01:32:10', 'Project Manager', 'Project Manager at  Dnipro CO', 'Dnipro', '35.046183', '48.464717', 'Dnipro CO', 'Project Manager at  Dnipro CO', 1),
(7, NULL, '2019-07-20 17:22:30', '2019-08-02 01:32:01', 'Designer', 'Design De Design De', 'kharkiv', '36.230383', '49.9935', 'Design De', 'Design De Design De', 1),
(8, NULL, '2019-07-20 17:22:31', '2019-08-02 01:31:50', 'Designer', 'Design De Design De', 'kharkiv', '36.230383', '49.9935', 'Design De', 'Design De Design De', 1),
(9, NULL, '2019-07-20 17:24:54', '2019-08-02 01:40:12', 'App developer', '<h1 jstcache=\"781\" class=\"GLOBAL__gm2-headline-5 section-hero-header-title-title\" jsan=\"7.GLOBAL__gm2-headline-5,7.section-hero-header-title-title\" style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; border-radius: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 1.375rem; line-height: 1.75rem; font-family: \"Google Sans\", Roboto, Arial, sans-serif; list-style: none; margin-top: 0px; margin-bottom: 0px; outline: 0px; overflow: visible; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0);\">Impresso Labs App dev</h1>', 'Lausanne, Switzerland', '6.6322734', '46.519653512', 'Impresso', 'Impresso Labs', 1),
(10, '2019-08-02 01:31:37', '2019-08-02 01:15:27', '2019-08-02 01:31:37', 'QWEQWE', 'QWE', 'Madrid, Spain', '-3.7037902', '40.4167754', 'QWEQWE', 'QWEQWE', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs_ads`
--

CREATE TABLE `jobs_ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `jobs_ads`
--

INSERT INTO `jobs_ads` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `status`, `text`) VALUES
(1, NULL, '2019-07-24 18:49:58', '2019-08-02 01:33:41', 'AD 1', 1, '<strong>Your CV makes money. </strong><br />\r\nWhat about you?'),
(2, NULL, '2019-07-24 19:31:56', '2019-08-02 01:34:21', 'AD 2', 1, '<p>Your CV makes money.<br />\r\nWhat about you?</p>\r\n'),
(3, '2019-08-02 01:33:22', '2019-07-24 19:32:05', '2019-08-02 01:33:22', 'Def3', 1, '<p>Def3</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `la_configs`
--

CREATE TABLE `la_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `la_configs`
--

INSERT INTO `la_configs` (`id`, `key`, `section`, `value`, `created_at`, `updated_at`) VALUES
(1, 'sitename', '', 'Impresso', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(2, 'sitename_part1', '', 'Impresso', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(3, 'sitename_part2', '', '', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(4, 'sitename_short', '', 'IM', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(5, 'site_description', '', 'Impresso  is a job searching & prof. meetups system', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(6, 'sidebar_search', '', '0', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(7, 'show_messages', '', '0', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(8, 'show_notifications', '', '0', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(9, 'show_tasks', '', '0', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(10, 'show_rightsidebar', '', '0', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(11, 'skin', '', 'skin-white', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(12, 'layout', '', 'fixed', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(13, 'default_email', '', 'test@example.com', '2019-07-02 10:35:16', '2019-08-02 01:22:40'),
(14, 'validation_value', '', '30', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(15, 'initial_credits_amount', '', '30', '2019-07-02 10:35:16', '2019-09-12 02:25:15'),
(16, 'new_jobs_radius', '', '100', '2019-09-12 01:30:28', '2019-09-12 02:25:15'),
(17, 'invite_xims_amount', '', '30', '2019-09-12 01:30:28', '2019-09-12 02:25:15'),
(18, 'accepted_invite_xims_amount', '', '23', '2019-09-12 01:30:28', '2019-09-12 02:25:15');

-- --------------------------------------------------------

--
-- Структура таблицы `la_menus`
--

CREATE TABLE `la_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'module',
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hierarchy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `la_menus`
--

INSERT INTO `la_menus` (`id`, `name`, `url`, `icon`, `type`, `parent`, `hierarchy`, `created_at`, `updated_at`) VALUES
(1, 'Users', '#', 'fa-group', 'custom', 0, 2, '2019-07-02 10:35:16', '2019-07-23 00:28:53'),
(2, 'Users', 'users', 'fa-group', 'module', 1, 1, '2019-07-02 10:35:16', '2019-07-15 18:00:20'),
(9, 'Jobs', 'jobs', 'fa fa-joomla', 'module', 18, 1, '2019-07-02 18:28:47', '2019-07-24 19:02:43'),
(11, 'User_Educations', 'user_educations', 'fa fa-archive', 'module', 1, 2, '2019-07-10 00:25:16', '2019-07-15 18:00:20'),
(12, 'User_certifications', 'user_certifications', 'fa fa-certificate', 'module', 1, 3, '2019-07-10 00:27:06', '2019-07-15 18:00:20'),
(13, 'Administrators', 'administrators', 'fa-adn', 'custom', 0, 1, '2019-07-15 18:00:09', '2019-07-23 00:28:53'),
(14, 'User_Purchases', 'user_purchases', 'fa fa-cc-stripe', 'module', 1, 4, '2019-07-18 00:34:37', '2019-07-18 01:01:55'),
(15, 'User_Transactions', 'user_transactions', 'fa fa-money', 'module', 1, 5, '2019-07-18 00:48:42', '2019-07-18 01:02:01'),
(16, 'Notifications', 'notifications', 'fa fa-bell-o', 'module', 0, 4, '2019-07-23 00:28:27', '2019-07-24 19:02:54'),
(17, 'Jobs_ADs', 'jobs_ads', 'fa fa-buysellads', 'module', 18, 2, '2019-07-24 18:30:56', '2019-07-24 19:02:45'),
(18, 'Jobs', '#', 'fa-joomla', 'custom', 0, 3, '2019-07-24 19:02:25', '2019-07-24 19:02:54'),
(20, 'Buy_Credits', 'buy_credits', 'fa fa-credit-card', 'module', 0, 5, '2019-07-30 09:02:26', '2019-07-30 09:02:43'),
(22, 'Meetup_reasons', 'meetup_reasons', 'fa fa-th-list', 'module', 1, 7, '2019-09-12 02:07:16', '2019-09-12 02:07:50'),
(23, 'Countries list', 'countries', 'fa-cubes', 'custom', 1, 6, '2019-09-12 02:08:39', '2019-09-12 02:09:14');

-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `longitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `locaiton_data` text COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`id`, `deleted_at`, `created_at`, `updated_at`, `latitude`, `longitude`, `city`, `country`, `locaiton_data`, `country_code`) VALUES
(2, NULL, '2019-07-24 03:04:13', '2019-07-24 03:04:13', '48.936', '24.703', 'Ivano-Frankivs\'k', 'Ukraine', '{\"address_components\":[{\"long_name\":\"2\",\"short_name\":\"2\",\"types\":[\"street_number\"]},{\"long_name\":\"Naberezhna im. Vasylya Stefanyka Street\",\"short_name\":\"Naberezhna im. Vasylya Stefanyka St\",\"types\":[\"route\"]},{\"long_name\":\"Ivano-Frankivs\'k\",\"short_name\":\"Ivano-Frankivs\'k\",\"types\":[\"locality\",\"political\"]},{\"long_name\":\"Ivano-Frankivs\'ka city council\",\"short_name\":\"Ivano-Frankivs\'ka city council\",\"types\":[\"administrative_area_level_3\",\"political\"]},{\"long_name\":\"Ivano-Frankivs\'ka oblast\",\"short_name\":\"Ivano-Frankivs\'ka oblast\",\"types\":[\"administrative_area_level_1\",\"political\"]},{\"long_name\":\"Ukraine\",\"short_name\":\"UA\",\"types\":[\"country\",\"political\"]},{\"long_name\":\"76000\",\"short_name\":\"76000\",\"types\":[\"postal_code\"]}],\"formatted_address\":\"Naberezhna im. Vasylya Stefanyka St, 2, Ivano-Frankivs\'k, Ivano-Frankivs\'ka oblast, Ukraine, 76000\",\"geometry\":{\"location\":{\"lat\":48.9358255,\"lng\":24.7034064},\"location_type\":\"ROOFTOP\",\"viewport\":{\"northeast\":{\"lat\":48.937174480292,\"lng\":24.704755380291},\"southwest\":{\"lat\":48.934476519709,\"lng\":24.702057419708}}},\"place_id\":\"ChIJE8f_QwbBMEcRFj3kAiigdNk\",\"plus_code\":{\"compound_code\":\"WPP3+89 Ivano-Frankivsk, Ivano-Frankivsk Oblast, Ukraine\",\"global_code\":\"8GW6WPP3+89\"},\"types\":[\"street_address\"]}', 'UA'),
(3, NULL, '2019-07-24 17:59:52', '2019-07-24 17:59:52', '49.841977', '24.031722', 'L\'viv', 'Ukraine', '{\"address_components\":[{\"long_name\":\"Ratusha\",\"short_name\":\"Ratusha\",\"types\":[\"premise\"]},{\"long_name\":\"1\",\"short_name\":\"1\",\"types\":[\"street_number\"]},{\"long_name\":\"Rynok Square\",\"short_name\":\"Rynok Square\",\"types\":[\"route\"]},{\"long_name\":\"Halytskyi District\",\"short_name\":\"Halytskyi District\",\"types\":[\"political\",\"sublocality\",\"sublocality_level_1\"]},{\"long_name\":\"L\'viv\",\"short_name\":\"L\'viv\",\"types\":[\"locality\",\"political\"]},{\"long_name\":\"L\'vivs\'ka city council\",\"short_name\":\"L\'vivs\'ka city council\",\"types\":[\"administrative_area_level_3\",\"political\"]},{\"long_name\":\"L\'vivs\'ka oblast\",\"short_name\":\"L\'vivs\'ka oblast\",\"types\":[\"administrative_area_level_1\",\"political\"]},{\"long_name\":\"Ukraine\",\"short_name\":\"UA\",\"types\":[\"country\",\"political\"]},{\"long_name\":\"79000\",\"short_name\":\"79000\",\"types\":[\"postal_code\"]}],\"formatted_address\":\"Ratusha, Rynok Square, 1, L\'viv, L\'vivs\'ka oblast, Ukraine, 79000\",\"geometry\":{\"bounds\":{\"northeast\":{\"lat\":49.8422676,\"lng\":24.0322031},\"southwest\":{\"lat\":49.8415382,\"lng\":24.0309333}},\"location\":{\"lat\":49.8417365,\"lng\":24.0316915},\"location_type\":\"ROOFTOP\",\"viewport\":{\"northeast\":{\"lat\":49.843251880291,\"lng\":24.032917180291},\"southwest\":{\"lat\":49.840553919708,\"lng\":24.030219219708}}},\"place_id\":\"ChIJ9zgir23dOkcRCzLPzabCemU\",\"types\":[\"premise\"]}', 'UA'),
(4, NULL, '2019-07-24 18:01:16', '2019-07-24 18:01:16', '48.93', '24.7', 'Ivano-Frankivs\'k', 'Ukraine', '{\"address_components\":[{\"long_name\":\"12\",\"short_name\":\"12\",\"types\":[\"street_number\"]},{\"long_name\":\"Vulytsya Karpat\\u00b7s\\u02b9ka\",\"short_name\":\"Vulytsya Karpat\\u00b7s\\u02b9ka\",\"types\":[\"route\"]},{\"long_name\":\"Ivano-Frankivs\'k\",\"short_name\":\"Ivano-Frankivs\'k\",\"types\":[\"locality\",\"political\"]},{\"long_name\":\"Ivano-Frankivs\'ka city council\",\"short_name\":\"Ivano-Frankivs\'ka city council\",\"types\":[\"administrative_area_level_3\",\"political\"]},{\"long_name\":\"Ivano-Frankivs\'ka oblast\",\"short_name\":\"Ivano-Frankivs\'ka oblast\",\"types\":[\"administrative_area_level_1\",\"political\"]},{\"long_name\":\"Ukraine\",\"short_name\":\"UA\",\"types\":[\"country\",\"political\"]},{\"long_name\":\"76000\",\"short_name\":\"76000\",\"types\":[\"postal_code\"]}],\"formatted_address\":\"Vulytsya Karpat\\u00b7s\\u02b9ka, 12, Ivano-Frankivs\'k, Ivano-Frankivs\'ka oblast, Ukraine, 76000\",\"geometry\":{\"location\":{\"lat\":48.9298845,\"lng\":24.6995241},\"location_type\":\"ROOFTOP\",\"viewport\":{\"northeast\":{\"lat\":48.931233480292,\"lng\":24.700873080292},\"southwest\":{\"lat\":48.928535519708,\"lng\":24.698175119708}}},\"place_id\":\"ChIJ70TNp4rBMEcRGd666As5ImA\",\"plus_code\":{\"compound_code\":\"WMHX+XR Ivano-Frankivsk, Ivano-Frankivsk Oblast, Ukraine\",\"global_code\":\"8GW6WMHX+XR\"},\"types\":[\"establishment\",\"gym\",\"health\",\"point_of_interest\"]}', 'UA');

-- --------------------------------------------------------

--
-- Структура таблицы `meetup_reasons`
--

CREATE TABLE `meetup_reasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `meetup_reasons`
--

INSERT INTO `meetup_reasons` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `status`) VALUES
(1, NULL, '2019-09-13 02:35:50', '2019-09-13 02:38:09', 'Asking for advice', 1),
(2, NULL, '2019-09-13 02:36:18', '2019-09-13 02:36:18', 'Job inquiry', 1),
(3, NULL, '2019-09-13 02:36:34', '2019-09-13 02:38:02', 'Business collaboration', 1),
(4, NULL, '2019-09-13 02:36:52', '2019-09-13 02:36:52', 'Similar interests', 1),
(5, NULL, '2019-09-13 02:37:07', '2019-09-13 02:37:07', 'New opportunity', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_05_26_050000_create_modules_table', 1),
('2014_05_26_055000_create_module_field_types_table', 1),
('2014_05_26_060000_create_module_fields_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_12_01_000000_create_uploads_table', 1),
('2016_05_26_064006_create_departments_table', 1),
('2016_05_26_064007_create_employees_table', 1),
('2016_05_26_064446_create_roles_table', 1),
('2016_07_05_115343_create_role_user_table', 1),
('2016_07_06_140637_create_organizations_table', 1),
('2016_07_07_134058_create_backups_table', 1),
('2016_07_07_134058_create_menus_table', 1),
('2016_09_10_163337_create_permissions_table', 1),
('2016_09_10_163520_create_permission_role_table', 1),
('2016_09_22_105958_role_module_fields_table', 1),
('2016_09_22_110008_role_module_table', 1),
('2016_10_06_115413_create_la_configs_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_db` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `view_col` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fa_icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fa-cube',
  `is_gen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `label`, `name_db`, `view_col`, `model`, `controller`, `fa_icon`, `is_gen`, `created_at`, `updated_at`) VALUES
(1, 'Users', 'Users', 'users', 'name', 'User', 'UsersController', 'fa-group', 1, '2019-07-02 10:35:15', '2019-07-02 10:35:16'),
(2, 'Uploads', 'Uploads', 'uploads', 'name', 'Upload', 'UploadsController', 'fa-files-o', 1, '2019-07-02 10:35:15', '2019-07-02 10:35:16'),
(5, 'Roles', 'Roles', 'roles', 'name', 'Role', 'RolesController', 'fa-user-plus', 1, '2019-07-02 10:35:15', '2019-07-02 10:35:16'),
(8, 'Permissions', 'Permissions', 'permissions', 'name', 'Permission', 'PermissionsController', 'fa-magic', 1, '2019-07-02 10:35:15', '2019-07-02 10:35:16'),
(9, 'Jobs', 'Jobs', 'jobs', 'job_title', 'Job', 'JobsController', 'fa-joomla', 1, '2019-07-02 18:26:24', '2019-07-02 18:28:47'),
(10, 'Validation_statuses', 'Validation_statuses', 'validation_statuses', 'title', 'Validation_status', 'Validation_statusesController', 'fa-asterisk', 1, '2019-07-10 00:17:29', '2019-07-10 00:18:02'),
(11, 'User_Educations', 'User_Educations', 'user_educations', 'title', 'User_Education', 'User_EducationsController', 'fa-archive', 1, '2019-07-10 00:23:20', '2019-07-10 00:25:16'),
(12, 'User_certifications', 'User_certifications', 'user_certifications', 'title', 'User_certification', 'User_certificationsController', 'fa-certificate', 1, '2019-07-10 00:25:44', '2019-07-10 00:27:06'),
(13, 'User_Purchases', 'User_Purchases', 'user_purchases', 'purchase_amount', 'User_Purchase', 'User_PurchasesController', 'fa-cc-stripe', 1, '2019-07-18 00:31:27', '2019-07-18 00:34:37'),
(14, 'User_Transactions', 'User_Transactions', 'user_transactions', 'amount', 'User_Transaction', 'User_TransactionsController', 'fa-money', 1, '2019-07-18 00:38:16', '2019-07-18 00:48:42'),
(15, 'Stripe_Charges', 'Stripe_Charges', 'stripe_charges', 'data', 'Stripe_Charge', 'Stripe_ChargesController', 'fa-cube', 0, '2019-07-22 01:46:08', '2019-07-22 01:46:35'),
(16, 'Notifications', 'Notifications', 'notifications', 'title', 'Notification', 'NotificationsController', 'fa-bell-o', 1, '2019-07-23 00:26:55', '2019-07-23 00:28:27'),
(17, 'Users_Notifications', 'Users_Notifications', 'users_notifications', 'user_id', 'Users_Notification', 'Users_NotificationsController', 'fa-bell-slash', 1, '2019-07-23 01:09:47', '2019-07-23 01:15:23'),
(18, 'Locations', 'Locations', 'locations', 'city', 'Location', 'LocationsController', 'fa-location-arrow', 1, '2019-07-24 02:18:37', '2019-07-24 02:20:39'),
(19, 'Jobs_ADs', 'Jobs_ADs', 'jobs_ads', 'title', 'Jobs_AD', 'Jobs_ADsController', 'fa-buysellads', 1, '2019-07-24 18:30:01', '2019-07-24 18:30:56'),
(20, 'Buy_Credits', 'Buy_Credits', 'buy_credits', 'title', 'Buy_Credit', 'Buy_CreditsController', 'fa-credit-card', 1, '2019-07-30 08:55:25', '2019-07-30 09:02:26'),
(21, 'Countries', 'Countries', 'countries', 'country', 'Country', 'CountriesController', 'fa-cubes', 1, '2019-09-12 01:27:13', '2019-09-12 01:29:02'),
(22, 'Meetup_reasons', 'Meetup_reasons', 'meetup_reasons', 'title', 'Meetup_reason', 'Meetup_reasonsController', 'fa-th-list', 1, '2019-09-12 02:03:09', '2019-09-12 02:07:16');

-- --------------------------------------------------------

--
-- Структура таблицы `module_fields`
--

CREATE TABLE `module_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `colname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module` int(10) UNSIGNED NOT NULL,
  `field_type` int(10) UNSIGNED NOT NULL,
  `unique` tinyint(1) NOT NULL DEFAULT '0',
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minlength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `maxlength` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `popup_vals` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `module_fields`
--

INSERT INTO `module_fields` (`id`, `colname`, `label`, `module`, `field_type`, `unique`, `defaultvalue`, `minlength`, `maxlength`, `required`, `popup_vals`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Name', 1, 16, 0, '', 5, 250, 1, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(3, 'email', 'Email', 1, 8, 1, '', 0, 250, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(4, 'password', 'Password', 1, 17, 0, '', 6, 250, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(5, 'type', 'User Type', 1, 7, 0, '', 0, 0, 1, '@roles', 0, '2019-07-02 10:35:15', '2019-07-02 18:03:35'),
(6, 'name', 'Name', 2, 16, 0, '', 5, 250, 1, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(7, 'path', 'Path', 2, 19, 0, '', 0, 250, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(8, 'extension', 'Extension', 2, 19, 0, '', 0, 20, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(9, 'caption', 'Caption', 2, 19, 0, '', 0, 250, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(10, 'user_id', 'Owner', 2, 7, 0, '1', 0, 0, 0, '@users', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(11, 'hash', 'Hash', 2, 19, 0, '', 0, 250, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(12, 'public', 'Is Public', 2, 2, 0, '0', 0, 0, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(30, 'name', 'Name', 5, 16, 1, '', 1, 250, 1, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(31, 'display_name', 'Display Name', 5, 19, 0, '', 0, 250, 1, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(32, 'description', 'Description', 5, 21, 0, '', 0, 1000, 0, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(33, 'parent', 'Parent Role', 5, 7, 0, '1', 0, 0, 0, '@roles', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(49, 'name', 'Name', 8, 16, 1, '', 1, 250, 1, '', 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(50, 'display_name', 'Display Name', 8, 19, 0, '', 0, 250, 1, '', 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(51, 'description', 'Description', 8, 21, 0, '', 0, 1000, 0, '', 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(52, 'is_verified', 'Verified', 1, 2, 0, '0', 0, 0, 1, '', 0, '2019-07-02 18:04:27', '2019-07-02 18:04:27'),
(53, 'job_title', 'Job Title', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:06:27', '2019-07-02 18:06:27'),
(54, 'company_title', 'Company', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:07:53', '2019-07-02 18:07:53'),
(55, 'photo', 'Photo', 1, 12, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:08:20', '2019-07-02 18:08:20'),
(56, 'photo_id', 'Photo ID', 1, 12, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:08:39', '2019-07-02 18:08:39'),
(57, 'photo_selfie', 'Photo Selfie', 1, 12, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:09:09', '2019-07-02 18:09:09'),
(58, 'location_title', 'Location', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:09:38', '2019-07-02 18:09:38'),
(59, 'top_skills', 'Top Skills', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:10:36', '2019-07-02 18:10:36'),
(60, 'soft_skills', 'Soft Skills', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:10:54', '2019-07-02 18:10:54'),
(62, 'impress', 'Impress', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:11:58', '2019-07-02 18:11:58'),
(63, 'phone', 'Phone', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:12:24', '2019-07-02 18:12:24'),
(64, 'job_title', 'Job Title', 9, 22, 0, '', 0, 256, 1, '', 0, '2019-07-02 18:27:06', '2019-07-06 17:52:06'),
(65, 'description', 'Description', 9, 11, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:27:31', '2019-07-02 18:27:31'),
(66, 'location_title', 'Location title', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:27:54', '2019-07-02 18:27:54'),
(68, 'provider', 'Provider', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:39:47', '2019-07-02 18:39:47'),
(69, 'provider_id', 'Provider ID', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:40:01', '2019-07-02 18:40:01'),
(70, 'varification_pending', 'Pending Verification', 1, 2, 0, '0', 0, 0, 0, '', 0, '2019-07-04 17:20:07', '2019-07-04 17:20:07'),
(71, 'longitude', 'Location Longitude', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 02:10:19', '2019-07-06 02:10:19'),
(72, 'latitude', 'Location Latitude', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 02:10:51', '2019-07-06 02:10:51'),
(73, 'longitude', 'Location Longitude', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 02:19:26', '2019-07-06 02:19:26'),
(74, 'latitude', 'Location Latitude', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 02:19:39', '2019-07-06 02:19:39'),
(75, 'company_title', 'Company', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 17:23:38', '2019-07-06 17:23:38'),
(76, 'short_description', 'Short description', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-06 17:24:12', '2019-07-06 17:24:12'),
(77, 'status', 'Status', 9, 2, 0, '1', 0, 0, 1, '', 0, '2019-07-06 17:24:35', '2019-07-06 17:24:35'),
(78, 'university_title', 'University Title', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-08 18:36:28', '2019-07-08 18:36:28'),
(79, 'certificate_title', 'Certificate Title', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-08 18:36:55', '2019-07-08 18:36:55'),
(81, 'title', 'Title', 10, 22, 0, '', 0, 256, 1, '', 0, '2019-07-10 00:18:51', '2019-07-10 00:18:51'),
(82, 'title', 'Title', 11, 22, 0, '', 0, 256, 1, '', 0, '2019-07-10 00:23:57', '2019-07-10 00:23:57'),
(83, 'speciality', 'Speciality / Domain', 11, 22, 0, '', 0, 256, 0, '', 0, '2019-07-10 00:24:32', '2019-07-10 00:24:32'),
(84, 'status', 'Status', 11, 7, 0, '1', 0, 0, 1, '@validation_statuses', 0, '2019-07-10 00:25:02', '2019-07-10 00:25:02'),
(85, 'title', 'Title', 12, 22, 0, '', 0, 256, 1, '', 0, '2019-07-10 00:26:03', '2019-07-10 00:26:03'),
(87, 'user_id', 'User', 11, 7, 0, '', 0, 0, 1, '@users', 0, '2019-07-10 00:30:56', '2019-07-10 00:31:40'),
(91, 'url', 'URL', 12, 22, 0, '', 0, 256, 0, '', 0, '2019-07-10 00:44:16', '2019-07-10 00:44:16'),
(93, 'url', 'URL', 11, 22, 0, '', 0, 256, 0, '', 0, '2019-07-10 00:44:56', '2019-07-10 00:44:56'),
(95, 'status', 'Status', 12, 7, 0, '', 0, 0, 1, '@validation_statuses', 0, '2019-07-10 01:09:33', '2019-07-10 01:09:33'),
(96, 'user_id', 'User', 12, 7, 0, '', 0, 0, 1, '@users', 0, '2019-07-10 01:09:49', '2019-07-10 01:09:49'),
(97, 'files_uploaded', 'Files', 11, 24, 0, '', 0, 0, 0, '', 0, '2019-07-13 00:38:54', '2019-07-13 00:38:54'),
(98, 'files_uploaded', 'Files', 12, 24, 0, '', 0, 0, 0, '', 0, '2019-07-13 01:06:09', '2019-07-13 01:06:09'),
(99, 'full_name_birth', 'Full Name & Birth', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-14 06:08:11', '2019-07-14 06:08:11'),
(102, 'city', 'Address city', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-14 06:09:36', '2019-07-14 06:09:36'),
(103, 'address', 'Address line', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-14 06:11:17', '2019-07-14 06:11:17'),
(104, 'address2', 'Address line 2', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-14 06:11:28', '2019-07-14 06:11:28'),
(105, 'credits_count', 'Credits Count', 1, 6, 0, '', 0, 11, 0, '', 0, '2019-07-18 00:29:19', '2019-07-18 00:29:19'),
(106, 'user_id', 'User', 13, 7, 0, '', 0, 0, 1, '@users', 0, '2019-07-18 00:31:55', '2019-07-18 00:31:55'),
(107, 'purchase_amount', 'Purchase Amount', 13, 6, 0, '', 0, 256, 1, '', 0, '2019-07-18 00:32:26', '2019-07-18 00:32:26'),
(108, 'payment_id', 'Payment ID', 13, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 00:33:33', '2019-07-18 00:33:33'),
(109, 'status', 'Status', 13, 22, 0, '', 0, 256, 1, '', 0, '2019-07-18 00:34:07', '2019-07-18 00:34:07'),
(110, 'user_id', 'User', 14, 7, 0, '', 0, 0, 1, '@users', 0, '2019-07-18 00:38:30', '2019-07-18 00:38:30'),
(111, 'amount', 'Amount', 14, 6, 0, '', 0, 11, 1, '', 0, '2019-07-18 00:39:45', '2019-07-18 00:39:45'),
(112, 'notes', 'Notes', 14, 21, 0, '', 0, 0, 0, '', 0, '2019-07-18 00:42:42', '2019-07-18 00:42:42'),
(113, 'type', 'Type', 14, 22, 0, '', 0, 256, 1, '', 0, '2019-07-18 00:44:51', '2019-07-18 00:44:51'),
(115, 'by_user_id', 'By User', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 00:47:38', '2019-07-18 00:47:38'),
(116, 'purchase_id', 'Purchase', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 17:54:39', '2019-07-18 17:54:39'),
(117, 'share_id', 'Share', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 17:59:45', '2019-07-18 17:59:45'),
(118, 'education_id', 'Education', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 18:00:01', '2019-07-18 18:00:01'),
(119, 'certificate_id', 'Certificate', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-18 18:00:16', '2019-07-18 18:00:16'),
(120, 'transaction_id', 'Transaction Id', 13, 22, 0, '', 0, 256, 0, '', 0, '2019-07-20 01:21:33', '2019-07-20 01:21:33'),
(121, 'old_credits_amount', 'Old Credits Amount', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-20 01:22:03', '2019-07-20 01:22:03'),
(122, 'new_credits_amount', 'New Credits Amount', 14, 22, 0, '', 0, 256, 0, '', 0, '2019-07-20 01:22:28', '2019-07-20 01:22:28'),
(123, 'added_init_credits', 'Added Init Credits', 1, 22, 0, '0', 0, 256, 0, '', 0, '2019-07-20 02:13:37', '2019-07-20 02:13:37'),
(124, 'data', 'Data', 15, 21, 0, '', 0, 0, 0, '', 0, '2019-07-22 01:46:30', '2019-07-22 01:46:30'),
(125, 'title', 'Title', 16, 22, 0, '', 0, 256, 1, '', 0, '2019-07-23 00:27:24', '2019-07-23 00:27:24'),
(126, 'notification_text', 'Notification Text', 16, 21, 0, '', 0, 0, 0, '', 0, '2019-07-23 00:27:49', '2019-07-23 00:27:49'),
(127, 'status', 'Status', 16, 2, 0, '0', 0, 0, 0, '', 0, '2019-07-23 00:28:20', '2019-07-23 00:28:20'),
(128, 'user_id', 'User ID', 17, 22, 0, '', 0, 256, 1, '', 0, '2019-07-23 01:10:08', '2019-07-23 01:10:08'),
(129, 'type', 'Type', 17, 22, 0, '', 0, 256, 1, '', 0, '2019-07-23 01:10:27', '2019-07-23 01:10:56'),
(130, 'notification_text', 'Notification Text', 17, 21, 0, '', 0, 0, 0, '', 0, '2019-07-23 01:10:47', '2019-07-23 01:10:47'),
(131, 'reference_id', 'Reference ID', 17, 22, 0, '', 0, 256, 0, '', 0, '2019-07-23 01:15:15', '2019-07-23 01:15:15'),
(132, 'notif_view_date', 'Notification viewed', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-23 01:19:03', '2019-07-23 01:19:03'),
(133, 'latitude', 'latitude', 18, 22, 0, '', 0, 256, 1, '', 0, '2019-07-24 02:19:28', '2019-07-24 02:19:28'),
(134, 'longitude', 'longitude', 18, 22, 0, '', 0, 256, 1, '', 0, '2019-07-24 02:19:44', '2019-07-24 02:19:44'),
(135, 'city', 'city', 18, 22, 0, '', 0, 256, 0, '', 0, '2019-07-24 02:19:57', '2019-07-24 02:19:57'),
(136, 'country', 'country', 18, 22, 0, '', 0, 256, 0, '', 0, '2019-07-24 02:20:09', '2019-07-24 02:20:09'),
(137, 'locaiton_data', 'locaiton_data', 18, 21, 0, '', 0, 0, 0, '', 0, '2019-07-24 02:20:24', '2019-07-24 02:20:24'),
(138, 'country_code', 'country_code', 18, 22, 0, '', 0, 256, 0, '', 0, '2019-07-24 17:52:45', '2019-07-24 17:52:45'),
(139, 'title', 'Title', 19, 22, 0, '', 0, 256, 1, '', 1, '2019-07-24 18:30:19', '2019-07-24 18:30:19'),
(141, 'status', 'Status', 19, 2, 0, '1', 0, 0, 1, '', 3, '2019-07-24 18:30:47', '2019-07-24 18:30:47'),
(142, 'text', 'Text', 19, 21, 0, '', 0, 0, 0, '', 2, '2019-07-24 18:34:59', '2019-07-24 18:34:59'),
(143, 'share_count', 'Share Count', 1, 22, 0, '0', 0, 256, 0, '', 0, '2019-07-24 19:38:43', '2019-07-24 19:38:43'),
(144, 'push_not_tokens', 'Push Notif Tokens', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-29 12:30:52', '2019-07-29 12:30:52'),
(145, 'title', 'Title', 20, 21, 0, '', 0, 0, 1, '', 0, '2019-07-30 08:57:18', '2019-07-30 08:57:24'),
(146, 'xims_amount', 'Xims Amount', 20, 22, 0, '', 0, 256, 1, '', 0, '2019-07-30 08:58:14', '2019-07-30 08:58:14'),
(147, 'price', 'Price', 20, 22, 0, '', 0, 256, 1, '', 0, '2019-07-30 08:58:37', '2019-07-30 08:58:37'),
(148, 'save_text', 'Save Text', 20, 22, 0, '', 0, 256, 0, '', 0, '2019-07-30 08:59:02', '2019-07-30 09:03:56'),
(149, 'credits_amount', 'Credits Amount', 13, 6, 0, '', 0, 11, 1, '', 0, '2019-07-30 10:13:56', '2019-07-30 10:13:56'),
(150, 'country', 'Country', 21, 22, 0, '', 0, 256, 1, '', 0, '2019-09-12 01:27:45', '2019-09-12 01:27:45'),
(151, 'country_code', 'Country code', 21, 22, 0, '', 0, 256, 1, '', 0, '2019-09-12 01:28:09', '2019-09-12 01:28:09'),
(152, 'country_iso_code', 'Country ISO Code', 21, 22, 0, '', 0, 256, 1, '', 0, '2019-09-12 01:28:42', '2019-09-12 01:28:42'),
(153, 'title', 'Title', 22, 22, 0, '', 0, 256, 1, '', 0, '2019-09-12 02:03:25', '2019-09-12 02:03:33'),
(154, 'status', 'Status', 22, 2, 0, '1', 0, 0, 1, '', 0, '2019-09-12 02:03:51', '2019-09-12 02:03:51');

-- --------------------------------------------------------

--
-- Структура таблицы `module_field_types`
--

CREATE TABLE `module_field_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `module_field_types`
--

INSERT INTO `module_field_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Address', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(2, 'Checkbox', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(3, 'Currency', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(4, 'Date', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(5, 'Datetime', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(6, 'Decimal', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(7, 'Dropdown', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(8, 'Email', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(9, 'File', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(10, 'Float', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(11, 'HTML', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(12, 'Image', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(13, 'Integer', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(14, 'Mobile', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(15, 'Multiselect', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(16, 'Name', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(17, 'Password', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(18, 'Radio', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(19, 'String', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(20, 'Taginput', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(21, 'Textarea', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(22, 'TextField', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(23, 'URL', '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
(24, 'Files', '2019-07-02 10:35:15', '2019-07-02 10:35:15');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `notification_text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `notification_text`, `status`) VALUES
(1, NULL, '2019-07-23 00:43:41', '2019-07-23 00:58:55', 'Test', '<p><strong>test Notification</strong></p>\r\n', 1),
(2, NULL, '2019-07-23 01:07:41', '2019-07-23 01:07:41', 'test', '<p><strong>test</strong></p>\r\n', 0),
(3, NULL, '2019-07-24 00:55:54', '2019-07-24 00:55:54', 'New Features', '<p>News Features in app.</p>\r\n', 1),
(4, NULL, '2019-08-02 01:27:57', '2019-08-02 01:27:57', 'Test Notification', '<p>Test Notification</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN_PANEL', 'Admin Panel', 'Admin Panel Permission', NULL, '2019-07-02 10:35:16', '2019-07-02 10:35:16');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `parent`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SUPER_ADMIN', 'Super Admin', 'Full Access Role', 1, NULL, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(3, 'USER', 'User', '', 0, NULL, '2019-07-02 18:01:14', '2019-07-02 18:01:14');

-- --------------------------------------------------------

--
-- Структура таблицы `role_module`
--

CREATE TABLE `role_module` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `acc_view` tinyint(1) NOT NULL,
  `acc_create` tinyint(1) NOT NULL,
  `acc_edit` tinyint(1) NOT NULL,
  `acc_delete` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_module`
--

INSERT INTO `role_module` (`id`, `role_id`, `module_id`, `acc_view`, `acc_create`, `acc_edit`, `acc_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(2, 1, 2, 1, 1, 1, 1, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(5, 1, 5, 1, 1, 1, 1, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(8, 1, 8, 1, 1, 1, 1, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(9, 1, 9, 1, 1, 1, 1, '2019-07-02 18:28:47', '2019-07-02 18:28:47'),
(10, 1, 10, 1, 1, 1, 1, '2019-07-10 00:18:02', '2019-07-10 00:18:02'),
(11, 1, 11, 1, 1, 1, 1, '2019-07-10 00:25:16', '2019-07-10 00:25:16'),
(12, 1, 12, 1, 1, 1, 1, '2019-07-10 00:27:06', '2019-07-10 00:27:06'),
(13, 1, 13, 1, 1, 1, 1, '2019-07-18 00:34:37', '2019-07-18 00:34:37'),
(14, 1, 14, 1, 1, 1, 1, '2019-07-18 00:48:43', '2019-07-18 00:48:43'),
(15, 1, 16, 1, 1, 1, 1, '2019-07-23 00:28:27', '2019-07-23 00:28:27'),
(16, 1, 17, 1, 1, 1, 1, '2019-07-23 01:15:23', '2019-07-23 01:15:23'),
(17, 1, 18, 1, 1, 1, 1, '2019-07-24 02:20:39', '2019-07-24 02:20:39'),
(18, 1, 19, 1, 1, 1, 1, '2019-07-24 18:30:56', '2019-07-24 18:30:56'),
(19, 1, 20, 1, 1, 1, 1, '2019-07-30 09:02:26', '2019-07-30 09:02:26'),
(20, 1, 21, 1, 1, 1, 1, '2019-09-12 01:29:02', '2019-09-12 01:29:02'),
(21, 1, 22, 1, 1, 1, 1, '2019-09-12 02:07:16', '2019-09-12 02:07:16');

-- --------------------------------------------------------

--
-- Структура таблицы `role_module_fields`
--

CREATE TABLE `role_module_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `field_id` int(10) UNSIGNED NOT NULL,
  `access` enum('invisible','readonly','write') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_module_fields`
--

INSERT INTO `role_module_fields` (`id`, `role_id`, `field_id`, `access`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(3, 1, 3, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(4, 1, 4, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(5, 1, 5, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(6, 1, 6, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(7, 1, 7, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(8, 1, 8, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(9, 1, 9, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(10, 1, 10, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(11, 1, 11, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(12, 1, 12, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(30, 1, 30, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(31, 1, 31, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(32, 1, 32, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(33, 1, 33, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(49, 1, 49, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(50, 1, 50, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(51, 1, 51, 'write', '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(52, 1, 52, 'write', '2019-07-02 18:04:27', '2019-07-02 18:04:27'),
(53, 1, 53, 'write', '2019-07-02 18:06:27', '2019-07-02 18:06:27'),
(54, 1, 54, 'write', '2019-07-02 18:07:53', '2019-07-02 18:07:53'),
(55, 1, 55, 'write', '2019-07-02 18:08:21', '2019-07-02 18:08:21'),
(56, 1, 56, 'write', '2019-07-02 18:08:40', '2019-07-02 18:08:40'),
(57, 1, 57, 'write', '2019-07-02 18:09:10', '2019-07-02 18:09:10'),
(58, 1, 58, 'write', '2019-07-02 18:09:38', '2019-07-02 18:09:38'),
(59, 1, 59, 'write', '2019-07-02 18:10:36', '2019-07-02 18:10:36'),
(60, 1, 60, 'write', '2019-07-02 18:10:54', '2019-07-02 18:10:54'),
(62, 1, 62, 'write', '2019-07-02 18:11:58', '2019-07-02 18:11:58'),
(63, 1, 63, 'write', '2019-07-02 18:12:24', '2019-07-02 18:12:24'),
(64, 1, 64, 'write', '2019-07-02 18:27:08', '2019-07-02 18:27:08'),
(65, 1, 65, 'write', '2019-07-02 18:27:31', '2019-07-02 18:27:31'),
(66, 1, 66, 'write', '2019-07-02 18:27:55', '2019-07-02 18:27:55'),
(68, 1, 68, 'write', '2019-07-02 18:39:47', '2019-07-02 18:39:47'),
(69, 1, 69, 'write', '2019-07-02 18:40:02', '2019-07-02 18:40:02'),
(70, 1, 70, 'write', '2019-07-04 17:20:09', '2019-07-04 17:20:09'),
(71, 1, 71, 'write', '2019-07-06 02:10:19', '2019-07-06 02:10:19'),
(72, 1, 72, 'write', '2019-07-06 02:10:51', '2019-07-06 02:10:51'),
(73, 1, 73, 'write', '2019-07-06 02:19:26', '2019-07-06 02:19:26'),
(74, 1, 74, 'write', '2019-07-06 02:19:40', '2019-07-06 02:19:40'),
(75, 1, 75, 'write', '2019-07-06 17:23:40', '2019-07-06 17:23:40'),
(76, 1, 76, 'write', '2019-07-06 17:24:12', '2019-07-06 17:24:12'),
(77, 1, 77, 'write', '2019-07-06 17:24:35', '2019-07-06 17:24:35'),
(78, 1, 78, 'write', '2019-07-08 18:36:29', '2019-07-08 18:36:29'),
(79, 1, 79, 'write', '2019-07-08 18:36:56', '2019-07-08 18:36:56'),
(81, 1, 81, 'write', '2019-07-10 00:18:51', '2019-07-10 00:18:51'),
(82, 1, 82, 'write', '2019-07-10 00:23:58', '2019-07-10 00:23:58'),
(83, 1, 83, 'write', '2019-07-10 00:24:33', '2019-07-10 00:24:33'),
(84, 1, 84, 'write', '2019-07-10 00:25:03', '2019-07-10 00:25:03'),
(85, 1, 85, 'write', '2019-07-10 00:26:03', '2019-07-10 00:26:03'),
(87, 1, 87, 'write', '2019-07-10 00:30:57', '2019-07-10 00:30:57'),
(91, 1, 91, 'write', '2019-07-10 00:44:16', '2019-07-10 00:44:16'),
(93, 1, 93, 'write', '2019-07-10 00:44:56', '2019-07-10 00:44:56'),
(95, 1, 95, 'write', '2019-07-10 01:09:34', '2019-07-10 01:09:34'),
(96, 1, 96, 'write', '2019-07-10 01:09:49', '2019-07-10 01:09:49'),
(97, 1, 97, 'write', '2019-07-13 00:38:54', '2019-07-13 00:38:54'),
(98, 1, 98, 'write', '2019-07-13 01:06:10', '2019-07-13 01:06:10'),
(99, 1, 99, 'write', '2019-07-14 06:08:12', '2019-07-14 06:08:12'),
(102, 1, 102, 'write', '2019-07-14 06:09:36', '2019-07-14 06:09:36'),
(103, 1, 103, 'write', '2019-07-14 06:11:17', '2019-07-14 06:11:17'),
(104, 1, 104, 'write', '2019-07-14 06:11:28', '2019-07-14 06:11:28'),
(105, 1, 105, 'write', '2019-07-18 00:29:20', '2019-07-18 00:29:20'),
(106, 1, 106, 'write', '2019-07-18 00:31:56', '2019-07-18 00:31:56'),
(107, 1, 107, 'write', '2019-07-18 00:32:27', '2019-07-18 00:32:27'),
(108, 1, 108, 'write', '2019-07-18 00:33:33', '2019-07-18 00:33:33'),
(109, 1, 109, 'write', '2019-07-18 00:34:07', '2019-07-18 00:34:07'),
(110, 1, 110, 'write', '2019-07-18 00:38:31', '2019-07-18 00:38:31'),
(111, 1, 111, 'write', '2019-07-18 00:39:46', '2019-07-18 00:39:46'),
(112, 1, 112, 'write', '2019-07-18 00:42:42', '2019-07-18 00:42:42'),
(113, 1, 113, 'write', '2019-07-18 00:44:51', '2019-07-18 00:44:51'),
(115, 1, 115, 'write', '2019-07-18 00:47:38', '2019-07-18 00:47:38'),
(116, 1, 116, 'write', '2019-07-18 17:54:39', '2019-07-18 17:54:39'),
(117, 1, 117, 'write', '2019-07-18 17:59:45', '2019-07-18 17:59:45'),
(118, 1, 118, 'write', '2019-07-18 18:00:01', '2019-07-18 18:00:01'),
(119, 1, 119, 'write', '2019-07-18 18:00:16', '2019-07-18 18:00:16'),
(120, 1, 120, 'write', '2019-07-20 01:21:34', '2019-07-20 01:21:34'),
(121, 1, 121, 'write', '2019-07-20 01:22:03', '2019-07-20 01:22:03'),
(122, 1, 122, 'write', '2019-07-20 01:22:28', '2019-07-20 01:22:28'),
(123, 1, 123, 'write', '2019-07-20 02:13:37', '2019-07-20 02:13:37'),
(124, 1, 124, 'write', '2019-07-22 01:46:32', '2019-07-22 01:46:32'),
(125, 1, 125, 'write', '2019-07-23 00:27:25', '2019-07-23 00:27:25'),
(126, 1, 126, 'write', '2019-07-23 00:27:49', '2019-07-23 00:27:49'),
(127, 1, 127, 'write', '2019-07-23 00:28:20', '2019-07-23 00:28:20'),
(128, 1, 128, 'write', '2019-07-23 01:10:08', '2019-07-23 01:10:08'),
(129, 1, 129, 'write', '2019-07-23 01:10:28', '2019-07-23 01:10:28'),
(130, 1, 130, 'write', '2019-07-23 01:10:48', '2019-07-23 01:10:48'),
(131, 1, 131, 'write', '2019-07-23 01:15:16', '2019-07-23 01:15:16'),
(132, 1, 132, 'write', '2019-07-23 01:19:03', '2019-07-23 01:19:03'),
(133, 1, 133, 'write', '2019-07-24 02:19:30', '2019-07-24 02:19:30'),
(134, 1, 134, 'write', '2019-07-24 02:19:45', '2019-07-24 02:19:45'),
(135, 1, 135, 'write', '2019-07-24 02:19:57', '2019-07-24 02:19:57'),
(136, 1, 136, 'write', '2019-07-24 02:20:09', '2019-07-24 02:20:09'),
(137, 1, 137, 'write', '2019-07-24 02:20:24', '2019-07-24 02:20:24'),
(138, 1, 138, 'write', '2019-07-24 17:52:45', '2019-07-24 17:52:45'),
(139, 1, 139, 'write', '2019-07-24 18:30:19', '2019-07-24 18:30:19'),
(141, 1, 141, 'write', '2019-07-24 18:30:47', '2019-07-24 18:30:47'),
(142, 1, 142, 'write', '2019-07-24 18:34:59', '2019-07-24 18:34:59'),
(143, 1, 143, 'write', '2019-07-24 19:38:44', '2019-07-24 19:38:44'),
(144, 1, 144, 'write', '2019-07-29 12:30:52', '2019-07-29 12:30:52'),
(145, 1, 145, 'write', '2019-07-30 08:57:18', '2019-07-30 08:57:18'),
(146, 1, 146, 'write', '2019-07-30 08:58:14', '2019-07-30 08:58:14'),
(147, 1, 147, 'write', '2019-07-30 08:58:37', '2019-07-30 08:58:37'),
(148, 1, 148, 'write', '2019-07-30 08:59:02', '2019-07-30 08:59:02'),
(149, 1, 149, 'write', '2019-07-30 10:13:56', '2019-07-30 10:13:56'),
(150, 1, 150, 'write', '2019-09-12 01:27:46', '2019-09-12 01:27:46'),
(151, 1, 151, 'write', '2019-09-12 01:28:10', '2019-09-12 01:28:10'),
(152, 1, 152, 'write', '2019-09-12 01:28:42', '2019-09-12 01:28:42'),
(153, 1, 153, 'write', '2019-09-12 02:03:26', '2019-09-12 02:03:26'),
(154, 1, 154, 'write', '2019-09-12 02:03:51', '2019-09-12 02:03:51');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `stripe_charges`
--

CREATE TABLE `stripe_charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `stripe_charges`
--

INSERT INTO `stripe_charges` (`id`, `deleted_at`, `created_at`, `updated_at`, `data`) VALUES
(1, NULL, '2019-07-26 07:30:49', NULL, '{\"token\":{\"id\":\"tok_1F0QhIAiptOMRf9BN1oXKjIi\",\"object\":\"token\",\"card\":{\"id\":\"card_1F0QhIAiptOMRf9BfliImNLu\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564137048,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F0QhIAiptOMRf9BN1oXKjIi\",\"currency\":\"USD\",\"amount\":\"3\",\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F0QhJAiptOMRf9BRiA811a7\",\"object\":\"charge\",\"amount\":300,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F0QhJAiptOMRf9B7tGFqHS5\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564137049,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":0,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F0QhIAiptOMRf9BfliImNLu\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F0QhJAiptOMRf9BRiA811a7\\/rcpt_FVRaXH40LpioFY9jZs9qI2QkQNbQKrV\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F0QhJAiptOMRf9BRiA811a7\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F0QhIAiptOMRf9BfliImNLu\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(2, NULL, '2019-07-29 12:18:36', NULL, '{\"token\":{\"id\":\"tok_1F1acRAiptOMRf9Bipr2fi9q\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1acRAiptOMRf9BzTTUGuzi\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564413515,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1acRAiptOMRf9Bipr2fi9q\",\"currency\":\"USD\",\"amount\":\"3\",\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1acSAiptOMRf9BfDAV6w0u\",\"object\":\"charge\",\"amount\":300,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1acSAiptOMRf9Bhclwbs1V\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564413516,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":64,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1acRAiptOMRf9BzTTUGuzi\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1acSAiptOMRf9BfDAV6w0u\\/rcpt_FWduFWhF48oXLWvco6IxVJFMYJHWqaw\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1acSAiptOMRf9BfDAV6w0u\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1acRAiptOMRf9BzTTUGuzi\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(3, NULL, '2019-07-29 12:18:55', NULL, '{\"token\":{\"id\":\"tok_1F1ackAiptOMRf9BGMz7br2o\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1ackAiptOMRf9Bh26AA1ys\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564413534,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1ackAiptOMRf9BGMz7br2o\",\"currency\":\"USD\",\"amount\":\"3\",\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1aclAiptOMRf9B0fjz4J8X\",\"object\":\"charge\",\"amount\":300,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1aclAiptOMRf9BJMXvrdki\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564413535,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $3 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":28,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1ackAiptOMRf9Bh26AA1ys\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1aclAiptOMRf9B0fjz4J8X\\/rcpt_FWduI5qmB1krpqR94vQjStjnP7q9s4l\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1aclAiptOMRf9B0fjz4J8X\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1ackAiptOMRf9Bh26AA1ys\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(4, NULL, '2019-07-30 10:12:12', NULL, '{\"token\":{\"id\":\"tok_1F1v7fAiptOMRf9BpbQu3KGl\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1v7fAiptOMRf9Ba0THtZer\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564492331,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1v7fAiptOMRf9BpbQu3KGl\",\"currency\":\"USD\",\"amount\":\"27\",\"description\":\"Charge - $27 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1v7gAiptOMRf9BOp1UqbmU\",\"object\":\"charge\",\"amount\":2700,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1v7gAiptOMRf9Bo5ssi0SS\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564492332,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $27 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":26,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1v7fAiptOMRf9Ba0THtZer\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1v7gAiptOMRf9BOp1UqbmU\\/rcpt_FWz5JCq5rvBszE04ISVA2o0BA950Hvc\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1v7gAiptOMRf9BOp1UqbmU\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1v7fAiptOMRf9Ba0THtZer\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(5, NULL, '2019-07-30 10:18:36', NULL, '{\"token\":{\"id\":\"tok_1F1vDrAiptOMRf9B4PXGuzns\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1vDrAiptOMRf9Bwt7POweq\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564492715,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1vDrAiptOMRf9B4PXGuzns\",\"currency\":\"USD\",\"amount\":\"9\",\"description\":\"Charge - $9 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1vDsAiptOMRf9BXce9Ikku\",\"object\":\"charge\",\"amount\":900,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1vDsAiptOMRf9BXTXM2JFq\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564492716,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $9 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":10,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1vDrAiptOMRf9Bwt7POweq\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1vDsAiptOMRf9BXce9Ikku\\/rcpt_FWzCILhw1IRLe3nlahQkxbQnDtw6bhf\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1vDsAiptOMRf9BXce9Ikku\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1vDrAiptOMRf9Bwt7POweq\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(6, NULL, '2019-07-30 12:33:55', NULL, '{\"token\":{\"id\":\"tok_1F1xKoAiptOMRf9Bxxxjh7OI\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1xKoAiptOMRf9BEleqkOZI\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564500834,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1xKoAiptOMRf9Bxxxjh7OI\",\"currency\":\"USD\",\"amount\":\"90\",\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1xKpAiptOMRf9BF080Y4NW\",\"object\":\"charge\",\"amount\":9000,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1xKpAiptOMRf9BqKMGk1oy\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564500835,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":54,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1xKoAiptOMRf9BEleqkOZI\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1xKpAiptOMRf9BF080Y4NW\\/rcpt_FX1NRaHs4uGFZp9uh1aOGW4QiGJlim2\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1xKpAiptOMRf9BF080Y4NW\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1xKoAiptOMRf9BEleqkOZI\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(7, NULL, '2019-07-30 12:40:56', NULL, '{\"token\":{\"id\":\"tok_1F1xRbAiptOMRf9B4MahNXS6\",\"object\":\"token\",\"card\":{\"id\":\"card_1F1xRbAiptOMRf9BuNOXV9KL\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"93.175.195.69\",\"created\":1564501255,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F1xRbAiptOMRf9B4MahNXS6\",\"currency\":\"USD\",\"amount\":\"90\",\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F1xRcAiptOMRf9ByLP5XRUZ\",\"object\":\"charge\",\"amount\":9000,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F1xRcAiptOMRf9BQiAklJE1\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564501256,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":20,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F1xRbAiptOMRf9BuNOXV9KL\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F1xRcAiptOMRf9ByLP5XRUZ\\/rcpt_FX1UjF4pFlyRpcFvH1CWzGjJ6wZoH8i\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F1xRcAiptOMRf9ByLP5XRUZ\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F1xRbAiptOMRf9BuNOXV9KL\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"dt2g0RspBKaJk4PA\",\"funding\":\"credit\",\"last4\":\"4242\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(8, NULL, '2019-07-31 01:28:05', NULL, '{\"token\":{\"id\":\"tok_1F29PyAiptOMRf9BA8ibOHXz\",\"object\":\"token\",\"card\":{\"id\":\"card_1F29PyAiptOMRf9BJrN2DjlP\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"31.148.253.44\",\"created\":1564547282,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F29PyAiptOMRf9BA8ibOHXz\",\"currency\":\"USD\",\"amount\":\"90\",\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F29PzAiptOMRf9BmUmoRuNF\",\"object\":\"charge\",\"amount\":9000,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F29PzAiptOMRf9BZgjZEYzb\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1564547283,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $90 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":27,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F29PyAiptOMRf9BJrN2DjlP\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F29PzAiptOMRf9BmUmoRuNF\\/rcpt_FXDrgttexEWjOqsznZtbI4022W4geJG\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F29PzAiptOMRf9BmUmoRuNF\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F29PyAiptOMRf9BJrN2DjlP\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2022,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}'),
(9, NULL, '2019-08-10 11:30:23', NULL, '{\"token\":{\"id\":\"tok_1F5vaGAiptOMRf9BUZonr1Qw\",\"object\":\"token\",\"card\":{\"id\":\"card_1F5vaGAiptOMRf9Bjti5JFal\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"client_ip\":\"31.148.253.44\",\"created\":1565447416,\"livemode\":false,\"type\":\"card\",\"used\":false},\"charge_params\":{\"source\":\"tok_1F5vaGAiptOMRf9BUZonr1Qw\",\"currency\":\"USD\",\"amount\":\"27\",\"description\":\"Charge - $27 from admintest23@mail.com (USER ID: 16)\"},\"charge\":{\"id\":\"ch_1F5vaIAiptOMRf9BjDQeZDx4\",\"object\":\"charge\",\"amount\":2700,\"amount_refunded\":0,\"application\":null,\"application_fee\":null,\"application_fee_amount\":null,\"balance_transaction\":\"txn_1F5vaIAiptOMRf9Bt0JdQfFw\",\"billing_details\":{\"address\":{\"city\":null,\"country\":null,\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":null,\"name\":null,\"phone\":null},\"captured\":true,\"created\":1565447418,\"currency\":\"usd\",\"customer\":null,\"description\":\"Charge - $27 from admintest23@mail.com (USER ID: 16)\",\"destination\":null,\"dispute\":null,\"failure_code\":null,\"failure_message\":null,\"fraud_details\":[],\"invoice\":null,\"livemode\":false,\"metadata\":[],\"on_behalf_of\":null,\"order\":null,\"outcome\":{\"network_status\":\"approved_by_network\",\"reason\":null,\"risk_level\":\"normal\",\"risk_score\":37,\"seller_message\":\"Payment complete.\",\"type\":\"authorized\"},\"paid\":true,\"payment_intent\":null,\"payment_method\":\"card_1F5vaGAiptOMRf9Bjti5JFal\",\"payment_method_details\":{\"card\":{\"brand\":\"visa\",\"checks\":{\"address_line1_check\":null,\"address_postal_code_check\":null,\"cvc_check\":null},\"country\":\"US\",\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"three_d_secure\":null,\"wallet\":null},\"type\":\"card\"},\"receipt_email\":null,\"receipt_number\":null,\"receipt_url\":\"https:\\/\\/pay.stripe.com\\/receipts\\/acct_1EyuYNAiptOMRf9B\\/ch_1F5vaIAiptOMRf9BjDQeZDx4\\/rcpt_Fb7pAo2P2HGUboY6q4dUJmbjGT8Yl7A\",\"refunded\":false,\"refunds\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\/v1\\/charges\\/ch_1F5vaIAiptOMRf9BjDQeZDx4\\/refunds\"},\"review\":null,\"shipping\":null,\"source\":{\"id\":\"card_1F5vaGAiptOMRf9Bjti5JFal\",\"object\":\"card\",\"address_city\":null,\"address_country\":null,\"address_line1\":null,\"address_line1_check\":null,\"address_line2\":null,\"address_state\":null,\"address_zip\":null,\"address_zip_check\":null,\"brand\":\"Visa\",\"country\":\"US\",\"customer\":null,\"cvc_check\":null,\"dynamic_last4\":null,\"exp_month\":11,\"exp_year\":2020,\"fingerprint\":\"bQIltmhav331n8GU\",\"funding\":\"unknown\",\"last4\":\"1111\",\"metadata\":[],\"name\":null,\"tokenization_method\":null},\"source_transfer\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"succeeded\",\"transfer_data\":null,\"transfer_group\":null}}');

-- --------------------------------------------------------

--
-- Структура таблицы `uploads`
--

CREATE TABLE `uploads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hash` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `uploads`
--

INSERT INTO `uploads` (`id`, `name`, `path`, `extension`, `caption`, `user_id`, `hash`, `public`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-03-223013-image-1.png', 'png', '', 1, '9fzm2rx9y14tljlt8cuv', 0, NULL, '2019-07-03 19:30:13', '2019-07-03 19:30:14'),
(2, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-03-223104-image-1.png', 'png', '', 1, 'eynzu2fyxs5fu8dhinqx', 0, NULL, '2019-07-03 19:31:04', '2019-07-03 19:31:04'),
(3, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-200938-image-1.png', 'png', '', 10, 'ya8sc6ikhdi8a1th29xo', 0, NULL, '2019-07-04 17:09:38', '2019-07-04 17:09:38'),
(4, 'bg-login', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-201020-bg-login.png', 'png', '', 10, 'cwq4dds9lxhktdygysjf', 0, NULL, '2019-07-04 17:10:20', '2019-07-04 17:10:20'),
(5, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-201144-image-1.png', 'png', '', 10, 'bslirw54nmqdmi9ui5kz', 0, NULL, '2019-07-04 17:11:44', '2019-07-04 17:11:44'),
(6, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-201154-image-2.png', 'png', '', 10, 'zh2nllysi9cviaymu0q0', 0, NULL, '2019-07-04 17:11:54', '2019-07-04 17:11:54'),
(7, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202144-image-1.png', 'png', '', 10, 'clxgwbprexwu0pj7jwkt', 0, NULL, '2019-07-04 17:21:44', '2019-07-04 17:21:44'),
(8, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202151-image-2.png', 'png', '', 10, 'u4oiuvsa3vjgkzt0qwxz', 0, NULL, '2019-07-04 17:21:51', '2019-07-04 17:21:51'),
(9, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202305-image-1.png', 'png', '', 10, 'sfr2zt1mf8ymwcomhczk', 0, NULL, '2019-07-04 17:23:05', '2019-07-04 17:23:05'),
(10, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202309-image-2.png', 'png', '', 10, '9ds1mri1kiyiksg9int2', 0, NULL, '2019-07-04 17:23:09', '2019-07-04 17:23:09'),
(11, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202535-image-1.png', 'png', '', 10, 's2gg7lmmkfykqt3wlg52', 0, NULL, '2019-07-04 17:25:35', '2019-07-04 17:25:35'),
(12, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202539-image-2.png', 'png', '', 10, 'rqjiuykfdex7j3r2at6n', 0, NULL, '2019-07-04 17:25:39', '2019-07-04 17:25:39'),
(13, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202753-image-1.png', 'png', '', 10, 'qvyjleqzy9js7uzg4b82', 0, NULL, '2019-07-04 17:27:53', '2019-07-04 17:27:53'),
(14, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202757-image-2.png', 'png', '', 10, 'qnrou8kaiudv51zpfm6j', 0, NULL, '2019-07-04 17:27:57', '2019-07-04 17:27:57'),
(15, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202856-image-1.png', 'png', '', 10, '3batuddmnjsunezflca0', 0, NULL, '2019-07-04 17:28:56', '2019-07-04 17:28:56'),
(16, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202859-image-2.png', 'png', '', 10, 'cw0ntohkv2xtzzxj1knx', 0, NULL, '2019-07-04 17:28:59', '2019-07-04 17:28:59'),
(17, 'sprite', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202951-sprite.png', 'png', '', 10, 'c5l2sm6qr6mjjlc6hgb6', 0, NULL, '2019-07-04 17:29:51', '2019-07-04 17:29:51'),
(18, 'sprite', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-202953-sprite.png', 'png', '', 10, 'y2yw3y25qerjdnzwfwrc', 0, NULL, '2019-07-04 17:29:53', '2019-07-04 17:29:53'),
(19, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-203027-image-1.png', 'png', '', 10, 'lydtffqlgx0skf5cwyaq', 0, NULL, '2019-07-04 17:30:27', '2019-07-04 17:30:27'),
(20, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-203030-image-2.png', 'png', '', 10, 'ew32tx1ttajubgc76vfd', 0, NULL, '2019-07-04 17:30:30', '2019-07-04 17:30:30'),
(21, 'sprite', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-203108-sprite.png', 'png', '', 10, 'p2yhrggz3dolugtslayf', 0, NULL, '2019-07-04 17:31:08', '2019-07-04 17:31:08'),
(22, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-04-203110-image-1.png', 'png', '', 10, 'bsjv5mnchmcgyf95s1xz', 0, NULL, '2019-07-04 17:31:10', '2019-07-04 17:31:10'),
(23, 'avatar-big', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-07-143950-avatar-big.png', 'png', '', 1, 'mu5xzsrmjmslwr0sctgq', 0, NULL, '2019-07-07 11:39:50', '2019-07-07 11:39:50'),
(24, 'logo', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-08-052129-Logo.png', 'png', '', 1, 'e5sfoadzjslbaxwap27x', 0, NULL, '2019-07-08 02:21:29', '2019-07-08 02:21:29'),
(25, 'background-image', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-10-034544-background-image.png', 'png', '', 1, 'ied5erihn9gyjhfvjee1', 0, NULL, '2019-07-10 00:45:44', '2019-07-10 00:45:44'),
(26, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-10-055259-image-1.png', 'png', '', 9, 'fyumerzjc60f5gk4zj4k', 0, NULL, '2019-07-10 02:52:59', '2019-07-10 02:52:59'),
(27, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-10-055446-image-1.png', 'png', '', 9, 'rsntcv2f6jppz5ggi6wq', 0, NULL, '2019-07-10 02:54:46', '2019-07-10 02:54:46'),
(28, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-10-055454-image-2.png', 'png', '', 9, 'noz2w7pahxnfjawyo7n5', 0, NULL, '2019-07-10 02:54:54', '2019-07-10 02:54:54'),
(29, 'logo-small', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-063951-logo-small.png', 'png', '', 9, 'jg3okf63uk4mi932ifo0', 0, NULL, '2019-07-14 03:39:51', '2019-07-14 03:39:52'),
(30, 'sprite', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-063952-sprite.png', 'png', '', 9, 'bpjr06g53yci23jkerbc', 0, NULL, '2019-07-14 03:39:52', '2019-07-14 03:39:52'),
(31, 'sprite', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-064011-sprite.png', 'png', '', 9, 'po4thwnh8mipq8u9fb3u', 0, NULL, '2019-07-14 03:40:11', '2019-07-14 03:40:11'),
(32, 'logo-small', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-064501-logo-small.png', 'png', '', 9, 'xfk1fy1te98mg1gsidol', 0, NULL, '2019-07-14 03:45:01', '2019-07-14 03:45:01'),
(33, 'logo-impresso-labs', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-064848-logo-impresso-labs.png', 'png', '', 9, '3jpphytkeobhta8mclit', 0, NULL, '2019-07-14 03:48:48', '2019-07-14 03:48:48'),
(34, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-064951-image-1.png', 'png', '', 9, 'ntaosw8ruz4c8d7bgdtc', 0, NULL, '2019-07-14 03:49:51', '2019-07-14 03:49:51'),
(35, 'logo-small', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-065038-logo-small.png', 'png', '', 9, 'n0xpzrup2kr9zgyue69a', 0, NULL, '2019-07-14 03:50:38', '2019-07-14 03:50:38'),
(36, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-091307-user-3.png', 'png', '', 9, '7nwlkpnho9ozznqkwi7l', 0, NULL, '2019-07-14 06:13:07', '2019-07-14 06:13:07'),
(37, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-091604-user-3.png', 'png', '', 9, 'upupckelbq3j62zrbiay', 0, NULL, '2019-07-14 06:16:04', '2019-07-14 06:16:04'),
(38, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-14-091717-user-3.png', 'png', '', 9, 'oonp5emcbfq8p32nkmxn', 0, NULL, '2019-07-14 06:17:17', '2019-07-14 06:17:17'),
(39, 'color-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-032239-color-2.png', 'png', '', 9, 'iictvdt2uhu4z1snf62q', 0, NULL, '2019-07-17 00:22:39', '2019-07-17 00:22:39'),
(40, 'color-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-032355-color-2.png', 'png', '', 9, 'medbpcxgmm9k6hzc2r3e', 0, NULL, '2019-07-17 00:23:55', '2019-07-17 00:23:55'),
(41, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-032926-user-3.png', 'png', '', 9, 'r9kikdxjts4q76vrrvqn', 0, NULL, '2019-07-17 00:29:26', '2019-07-17 00:29:26'),
(42, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-032954-user-3.png', 'png', '', 9, 'v9spfrkx3nzvgafthslh', 0, NULL, '2019-07-17 00:29:54', '2019-07-17 00:29:54'),
(43, 'color-9', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-033018-color-9.png', 'png', '', 9, 'ronkieibyeixla0yfxot', 0, NULL, '2019-07-17 00:30:18', '2019-07-17 00:30:18'),
(44, 'color-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-17-041307-color-2.png', 'png', '', 9, 'q7qzrvbdkpgfjqe2l2qv', 0, NULL, '2019-07-17 01:13:07', '2019-07-17 01:13:07'),
(45, 'user-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-24-211333-user-2.jpg', 'jpg', '', 9, 'oje0pxxljczvfy80ybts', 0, NULL, '2019-07-24 18:13:33', '2019-07-24 18:13:33'),
(46, 'square', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-102107-Square.jpg', 'jpg', '', 16, '0m7hljtxuiqmga4t27pm', 0, NULL, '2019-07-26 07:21:07', '2019-07-26 07:21:07'),
(47, '15175889770', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-102200-15175889770.jpg', 'jpg', '', 16, '6fyihu1bjkmxebpt0kix', 0, NULL, '2019-07-26 07:22:00', '2019-07-26 07:22:00'),
(48, 'vertical-farming-chris-jacobs', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-102222-vertical-farming-chris-jacobs.jpg', 'jpg', '', 16, 'qvb9noy2ckmmvw5jsc4x', 0, NULL, '2019-07-26 07:22:22', '2019-07-26 07:22:22'),
(49, 'square', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-102237-Square.jpg', 'jpg', '', 16, '0r8cbbbdgccnwuxyeyfm', 0, NULL, '2019-07-26 07:22:37', '2019-07-26 07:22:37'),
(50, 'square', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-104341-Square.jpg', 'jpg', '', 16, 'jvvzng2dstetndvvo1th', 0, NULL, '2019-07-26 07:43:41', '2019-07-26 07:43:41'),
(51, 'users-without-trainings-ca-since-2017-01-01-00-00-00-2', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-104823-users-without_trainings-ca-since-2017-01-01_00_00_00 (2).csv', 'csv', '', 16, 'zuxflm0flxbraqasthgf', 0, NULL, '2019-07-26 07:48:23', '2019-07-26 07:48:23'),
(52, 'vertical-farming-chris-jacobs', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-104853-vertical-farming-chris-jacobs.jpg', 'jpg', '', 16, 'c7pxlu3fnfoh4wc8a3sd', 0, NULL, '2019-07-26 07:48:53', '2019-07-26 07:48:53'),
(53, 'square', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-104900-Square.jpg', 'jpg', '', 16, 'nexuy9fxg4hwkecz5awl', 0, NULL, '2019-07-26 07:49:00', '2019-07-26 07:49:00'),
(54, '1e3e723e3a0343dd9333a94384344d4e', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-104918-1e3e723e3a0343dd9333a94384344d4e.m3u8', 'm3u8', '', 16, 'bamoastzvk0z2r1hgsma', 0, NULL, '2019-07-26 07:49:18', '2019-07-26 07:49:18'),
(55, 'vertical-farming-chris-jacobs', '/home/me/domains/impresso.me/public_html/storage/uploads/2019-07-26-105758-vertical-farming-chris-jacobs.jpg', 'jpg', '', 16, 'xya3lkgt91qoclbgh1bl', 0, NULL, '2019-07-26 07:57:58', '2019-07-26 07:57:58'),
(56, 'user-3', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-31-043403-user-3.png', 'png', '', 16, 'otdfkaz0j3nmgnauc0pc', 0, NULL, '2019-07-31 01:34:03', '2019-07-31 01:34:03'),
(57, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-040423-image-1.png', 'png', '', 18, 'ho5ykweqmxyb422w9soe', 0, NULL, '2019-08-07 01:04:23', '2019-08-07 01:04:23'),
(58, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-040435-image-2.png', 'png', '', 18, 'e7oumypponq7vogwqcsg', 0, NULL, '2019-08-07 01:04:35', '2019-08-07 01:04:35'),
(59, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-040442-image-2.png', 'png', '', 18, '8wzrvpjauzcvmcic8eks', 0, NULL, '2019-08-07 01:04:42', '2019-08-07 01:04:42'),
(60, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-041456-image-1.png', 'png', '', 18, 'u2lqukfpu2sqobygyv2s', 0, NULL, '2019-08-07 01:14:56', '2019-08-07 01:14:56'),
(61, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-041502-image-2.png', 'png', '', 18, 'nflnjqvmyxqoktefljl0', 0, NULL, '2019-08-07 01:15:02', '2019-08-07 01:15:02'),
(62, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-042812-image-1.png', 'png', '', 18, 'pmxicfgvcig52fyv3blp', 0, NULL, '2019-08-07 01:28:12', '2019-08-07 01:28:12'),
(63, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-042909-image-1.png', 'png', '', 18, 'nvbz83f5ahhcbhqcb4zf', 0, NULL, '2019-08-07 01:29:09', '2019-08-07 01:29:09'),
(64, 'background-image', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-043105-background-image.png', 'png', '', 18, '9cbaxw5mh8zxxvtgrcjy', 0, NULL, '2019-08-07 01:31:05', '2019-08-07 01:31:05'),
(65, 'background-image', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-043140-background-image.png', 'png', '', 18, 'ieqdmnwev8h6vr1gnoly', 0, NULL, '2019-08-07 01:31:40', '2019-08-07 01:31:40'),
(66, 'image-1', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-044059-image-1.png', 'png', '', 18, 'xn73kz4vn1hnlfee9rci', 0, NULL, '2019-08-07 01:40:59', '2019-08-07 01:40:59'),
(67, 'background-image', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-044123-background-image.png', 'png', '', 18, '2twvmifujdkhrc58l54l', 0, NULL, '2019-08-07 01:41:23', '2019-08-07 01:41:23'),
(68, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-044625-Superb_sunset.jpg', 'jpg', '', 19, 'a1dsejfcrbh6viumvz6a', 0, NULL, '2019-08-07 01:46:25', '2019-08-07 01:46:25'),
(69, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045344-Superb_sunset.jpg', 'jpg', '', 19, 'beve6rhiauru75qbixmg', 0, NULL, '2019-08-07 01:53:44', '2019-08-07 01:53:44'),
(70, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045411-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 19, 'aocrt68u01m8awmx3zaw', 0, NULL, '2019-08-07 01:54:11', '2019-08-07 01:54:11'),
(71, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045500-Superb_sunset.jpg', 'jpg', '', 19, 'tbtsvt61lt41pupr2g7w', 0, NULL, '2019-08-07 01:55:00', '2019-08-07 01:55:00'),
(72, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045522-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 19, 'gdwmrf6qh9avlczuuweu', 0, NULL, '2019-08-07 01:55:22', '2019-08-07 01:55:22'),
(73, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045603-Superb_sunset.jpg', 'jpg', '', 19, 'a4omplu5zxhcgkrmi8rd', 0, NULL, '2019-08-07 01:56:03', '2019-08-07 01:56:03'),
(74, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045610-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 19, '5hajj4rhfrn6rhcpunm4', 0, NULL, '2019-08-07 01:56:10', '2019-08-07 01:56:10'),
(75, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045629-Superb_sunset.jpg', 'jpg', '', 19, 'iypv5z81ktyyiz1dyqfc', 0, NULL, '2019-08-07 01:56:29', '2019-08-07 01:56:29'),
(76, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-045930-Superb_sunset.jpg', 'jpg', '', 19, 'nrm3t5oqlnulvayio1aw', 0, NULL, '2019-08-07 01:59:30', '2019-08-07 01:59:30'),
(77, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050107-The_S_02_filter_edit2_06.jpg', 'jpg', '', 19, 'dpycv4hckjpgxazx1mrf', 0, NULL, '2019-08-07 02:01:07', '2019-08-07 02:01:07'),
(78, 'filename', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050457-завантаження.jpg', 'jpg', '', 19, 'yvdv6cdeorjbqva6celv', 0, NULL, '2019-08-07 02:04:57', '2019-08-07 02:04:57'),
(79, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050505-Superb_sunset.jpg', 'jpg', '', 19, 'ttq2uovyc3skltgeuute', 0, NULL, '2019-08-07 02:05:05', '2019-08-07 02:05:05'),
(80, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050510-The_S_02_filter_edit2_06.jpg', 'jpg', '', 19, 'oqflsgrfgqafgj2xtyvy', 0, NULL, '2019-08-07 02:05:10', '2019-08-07 02:05:10'),
(81, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050517-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 19, 'ng2xsrdxxpgjfeoqxzht', 0, NULL, '2019-08-07 02:05:17', '2019-08-07 02:05:17'),
(82, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050532-Superb_sunset.jpg', 'jpg', '', 19, 'zieoq6b1qdxaozaqwdlk', 0, NULL, '2019-08-07 02:05:32', '2019-08-07 02:05:32'),
(83, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050537-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 19, '2tdktu1v71a5gkwhnqrw', 0, NULL, '2019-08-07 02:05:37', '2019-08-07 02:05:37'),
(84, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050546-The_S_02_filter_edit2_06.jpg', 'jpg', '', 19, '8ubhthn195qody1e7im4', 0, NULL, '2019-08-07 02:05:46', '2019-08-07 02:05:46'),
(85, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050912-Superb_sunset.jpg', 'jpg', '', 20, 'rdt2fmmnxv4qyhtjpfsm', 0, NULL, '2019-08-07 02:09:12', '2019-08-07 02:09:12'),
(86, 'horizontal-line-calm-sea-on-260nw-1071791186', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050924-horizontal-line-calm-sea-on-260nw-1071791186.webp', 'webp', '', 20, 'knqi2jsjl6j0ec7fwxby', 0, NULL, '2019-08-07 02:09:24', '2019-08-07 02:09:24'),
(87, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-050938-Superb_sunset.jpg', 'jpg', '', 20, 'zzqfhaf0s2jwocthjvbl', 0, NULL, '2019-08-07 02:09:38', '2019-08-07 02:09:38'),
(88, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-051012-Superb_sunset.jpg', 'jpg', '', 20, 'wa37jqdgdxjcml7cejxv', 0, NULL, '2019-08-07 02:10:12', '2019-08-07 02:10:12'),
(89, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-051057-Superb_sunset.jpg', 'jpg', '', 20, 'eoto97q4abxuyhfs6ynn', 0, NULL, '2019-08-07 02:10:57', '2019-08-07 02:10:57'),
(90, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-07-051158-Superb_sunset.jpg', 'jpg', '', 20, '7bcx0ffnlmpfa4b3oupy', 0, NULL, '2019-08-07 02:11:58', '2019-08-07 02:11:58'),
(91, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-032835-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'ryyhgpwjeqaeeal1ssby', 0, NULL, '2019-08-23 00:28:35', '2019-08-23 00:28:36'),
(92, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-033129-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, '2yas7jgnmsnvx0fjzl2b', 0, NULL, '2019-08-23 00:31:29', '2019-08-23 00:31:29'),
(93, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-033722-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'ypzw22acioq8bhanjs7a', 0, NULL, '2019-08-23 00:37:22', '2019-08-23 00:37:22'),
(94, 'superb-sunset', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-033729-Superb_sunset.jpg', 'jpg', '', 16, 'uwhli4n9vayrvwetvjaz', 0, NULL, '2019-08-23 00:37:29', '2019-08-23 00:37:29'),
(95, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-034038-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'c4b7ucn4vs6apaqd8ovs', 0, NULL, '2019-08-23 00:40:38', '2019-08-23 00:40:38'),
(96, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-034043-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'sumepuf0noywaz4koni3', 0, NULL, '2019-08-23 00:40:43', '2019-08-23 00:40:43'),
(97, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-034737-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'kbgpsnw69qwv9wsmdftr', 0, NULL, '2019-08-23 00:47:37', '2019-08-23 00:47:37'),
(98, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-034741-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'o8d5ry5fy7pnqg2egyqp', 0, NULL, '2019-08-23 00:47:41', '2019-08-23 00:47:41'),
(99, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-040030-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, '78ghzlvcb5k0mcj4xci7', 0, NULL, '2019-08-23 01:00:30', '2019-08-23 01:00:30'),
(100, 'the-s-02-filter-edit2-06', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-08-23-040103-The_S_02_filter_edit2_06.jpg', 'jpg', '', 16, 'jsb1abs3t6rgsrxmruoa', 0, NULL, '2019-08-23 01:01:03', '2019-08-23 01:01:03');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `job_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `company_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `photo` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `photo_selfie` int(11) NOT NULL,
  `location_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `top_skills` text COLLATE utf8_unicode_ci NOT NULL,
  `soft_skills` text COLLATE utf8_unicode_ci NOT NULL,
  `impress` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `varification_pending` tinyint(1) NOT NULL DEFAULT '0',
  `longitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `university_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `full_name_birth` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `credits_count` decimal(15,3) NOT NULL DEFAULT '0.000',
  `added_init_credits` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `notif_view_date` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `share_count` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `push_not_tokens` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `is_verified`, `job_title`, `company_title`, `photo`, `photo_id`, `photo_selfie`, `location_title`, `top_skills`, `soft_skills`, `impress`, `phone`, `provider`, `provider_id`, `varification_pending`, `longitude`, `latitude`, `university_title`, `certificate_title`, `full_name_birth`, `city`, `address`, `address2`, `credits_count`, `added_init_credits`, `notif_view_date`, `share_count`, `push_not_tokens`) VALUES
(1, 'Super Admin', 'admin@mail.com', '$2y$10$4arodD96t8qQfS5kKEjqkuzEe5sgEaDa3SicF2P1wfduF3F4njA3u', 1, 'sUJdNp6MdWhYffglrRRrWjSZLM4OT8wKNcHHEcQPqX9HAWfGcYkksGtWzCtA', NULL, '2019-07-02 10:35:31', '2019-09-13 00:25:22', 1, '', '', 0, 0, 0, 'Ivano-Frankivs\'k, Ukraine', '', '', '', '', '', '', 0, '24.7', '48.93', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(2, 'Test User', 'test_user@mail.com', '$2y$10$zLZOlINBwA.W9XUHUgWdyOJMsAArP.vYSa2g9cQneRpHyDXsT5BBa', 3, NULL, '2019-08-02 01:48:17', '2019-07-02 18:14:40', '2019-08-02 01:48:17', 0, 'PHP DEVELOPER', 'NPG', 0, 0, 0, 'Ivano-Frankivsk, Ukraine', 'Top Skills 1\r\nTop Skills 2\r\nTop Skills 3', 'Soft Skills 1\r\nSoft Skills 2\r\nSoft Skills 3', 'Impress ', '123123123123', '', '', 0, '49.26', '24.8', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(3, '', 'admintest@mail.com', '$2y$10$CpNlJjwPdMbu.eHjGvpIaeFO9Yft44M0BUPY5NR7NhyOSvo4ef.DG', 1, NULL, '2019-07-07 11:33:20', '2019-07-03 17:28:56', '2019-07-07 11:33:20', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d100837281', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(4, '', 'admintest2@mail.com', '$2y$10$eLn4lIxas650/CDamWSrIOBCsRcv27E1GpIecF5c7yWIZMyuRGi9G', 1, NULL, '2019-07-07 11:33:22', '2019-07-03 17:32:11', '2019-07-07 11:33:22', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d10cb14862', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(5, '', 'admintest3@mail.com', '$2y$10$LgNjaBD0WTQF2mBKzljDMuF81lp4X.yHY.gSeqssmGP5hsshOeSs.', 1, NULL, '2019-07-07 11:33:25', '2019-07-03 17:32:46', '2019-07-07 11:33:25', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d10ee8ed89', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(6, '', 'admintest4@mail.com', '$2y$10$MBpT/Nez5K1XmdrQ9xkjOeP6gsFyRMhVimZxuG88lZBCVEIpDnE5G', 1, NULL, '2019-07-07 11:33:27', '2019-07-03 17:33:39', '2019-07-07 11:33:27', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1123ca6d6', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(7, '', 'admintest5@mail.com', '$2y$10$qLk6kygfbUougQQ5itMG..FPtMevJ3zzMWfO0E2r7c6KSO3hFah.6', 1, NULL, '2019-07-07 11:33:29', '2019-07-03 17:33:45', '2019-07-07 11:33:29', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1129466c6', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(8, '', 'admintest6@mail.com', '$2y$10$M5nqHq0FX35AiOKyRjKDO..kbZhIN3.ui6mFdWHye1476/WN7q1cu', 1, NULL, '2019-07-07 11:33:33', '2019-07-03 17:34:45', '2019-07-07 11:33:33', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1165892ee', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(9, 'Ivan', 'admintest7@mail.com', '$2y$10$kWPE.2f96xSN4BZW2lsXzubCmUki1xq08RWdwkUENeLv5dB2z4qjW', 3, 'dvTnJqICcYwCgWOLJcnE4Jrtr9f7D0wz8LLTbHfgGUQg9pfDEkKzS2qYKFJy', NULL, '2019-07-03 17:35:11', '2019-07-26 07:13:39', 1, 'PHP Developer', 'NPG', 38, 27, 28, 'Ivano-Frankivs\'k, Ukraine', 'qwe\nasdasd\nqwe', 'w\nwe\nwewe', 'test', '123345', 'site', '5d1d117f5e54b', 1, '24.7', '48.93', 'Precarpathian University', 'test', 'Full Name', 'City', 'address', 'address2', '169.220', '0', '2019-07-24 04:03:58', '0', ''),
(10, 'Ivan Developer', 'admintest10@mail.com', '$2y$10$Qlicv9YF79qen6CKyQZJHOJeEHHap43kS7uItq1evEjivbpVMKS76', 3, 'PvIFBGCHZfhoi5LzBz0m10QbwVXQa1Q7zec7APzqKUDu3COYzw334ezXABsF', '2019-08-02 01:48:39', '2019-07-03 17:45:54', '2019-08-02 01:48:39', 1, 'DEVELOPER', 'NPG', 0, 21, 22, '', '', '', '', '', 'site', '5d1d14029a182', 0, '48.936001', '24.703206', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(11, '', 'iivanshp@gmail.com', '$2y$10$GVGokl7Z4eosdYoUj5Vov.XOAKY8bITjX72jEnsjcFi5.wMFYmsj6', 3, NULL, '2019-08-02 01:48:24', '2019-07-04 17:52:03', '2019-08-02 01:48:24', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1e66f361ce6', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(12, 'Name ', 'iivanshp+test@gmail.com', '$2y$10$akFWxJPbNfeEg/QP3x70V.ra6I8unkh3Ohdb63LqsgsfJE0SHB9Am', 3, NULL, '2019-08-02 01:48:27', '2019-07-04 17:52:53', '2019-08-02 01:48:27', 1, 'Security', 'SOFTSERVE', 24, 0, 0, 'Lviv', '', '', '', '', 'site', '5d1e672500993', 0, '48.887908', '23.95456', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(13, 'Ivan Tester', 'iivanshp+test1@gmail.com', '$2y$10$6rYnLBWmTpg5UR5UgsazbeoGyaug52Kk.HGZ9U2vCKg4HisOfaASq', 3, NULL, '2019-08-02 01:48:30', '2019-07-04 17:54:37', '2019-08-02 01:48:30', 1, 'Project Manager', 'Surfs Up Chill', 23, 0, 0, 'Ivano-Frankivsk', 'Top Skills\r\nTop Skills 2\r\nTop Skills 3', 'Top Skills 1\r\nTop Skills 2 \r\nTop Skills 3', 'Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress ', '123', 'site', '5d1e678daa847', 0, '48.936436', '24.001', 'University of Copenhagen', 'Bachelor of Science (Physiotherapy)', '', '', '', '', '0.000', '0', '', '0', ''),
(14, 'test2', 'admin2@mail.com', '$2y$10$pdiZywyOs/hf8E2bgqz7peSI4/P19GPkIF/Bg8H74g0W.nfv8OXR2', 1, NULL, '2019-08-02 01:37:04', '2019-07-15 18:06:03', '2019-08-02 01:37:04', 0, '', '', 0, 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(15, 'User Test Gredits', 'user@user.user', '$2y$10$s00UJon1AII17gea89P/9uzxA7kI/Gwn/2Va1Ib7TFqy9gXYGU/qS', 3, 'whJPgL40lCgQF1sn9neU1joZgb7Abph07swb4LMZsr95Ua8kgJAo4qoSyi9F', '2019-08-02 01:48:32', '2019-07-20 02:23:58', '2019-08-02 01:48:32', 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '13.000', '1', '', '0', ''),
(16, 'Ivan Developer', 'admintest23@mail.com', '$2y$10$t5WEFw62ujhuQaUojcp2XOF9SdqriQY08l3yT2DKdND300id7lNQK', 3, '2eR5q6s937TTaSgEy1qDwKajAIlHo05ffavL04mP5PkSvCriEsY6bf8jV2FH', NULL, '2019-07-26 07:14:02', '2019-09-13 01:55:55', 1, 'Php', 'NPG Studio', 56, 99, 100, 'Ivano-Frankivs\'k, Ukraine', '1\n2\n3', '00\n\n', 'qwe IMPRESSIVE BIO', '1222131233', 'site', '5d3ad26a82799', 0, '24.7', '48.93', 'asd', 'cert', 'admintest23 1993 05 02', '123123', '123123', '123123', '6460.000', '1', '2019-09-12 04:04:54', '5', ''),
(17, 'Juliana', 'Juliana@mail.com', '$2y$10$lW0mXnO6ybFJy8BR3h5HS.LD.OBV9XBTEIHufdIVCAIQf3Bhhg7KG', 3, NULL, '2019-08-02 01:48:44', '2019-08-02 01:43:34', '2019-08-02 01:48:44', 0, '', '', 0, 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(18, '', 'test3@admin.com', '$2y$10$l/RMU8KHluIpB30kihOS2euCqIszjDqDyYXKRTmR6tOOPPi0KrSji', 3, 'icFpHTyNJICOBsUo0s7y1nhbrCB2XHLlUtXRSvcpRJCCyLggYwMx4BEY2PHm', NULL, '2019-08-07 00:46:20', '2019-08-07 01:45:14', 0, '', '', 0, 66, 67, 'Ivano-Frankivs\'k, Ukraine', '', '', '', '', 'site', '5d4a498c8f541', 1, '24.7', '48.93', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(19, '', 'test4@admin.com', '$2y$10$ynSNlqZajvo07koL46ktLe.F0P6eWJFlSTvWu7G6WE1wdYuGJZej2', 3, 'Y89efX6ShH2UYvvQo3BUYnAv8WTOWhIzTxjcuBkrI1CQrADw7BbRP36uQkEZ', NULL, '2019-08-07 01:45:30', '2019-08-07 02:06:29', 0, '', '', 0, 78, 84, 'Ivano-Frankivs\'k, Ukraine', '', '', '', '', 'site', '5d4a576a46950', 0, '24.7', '48.93', '', '', '', '', '', '', '0.000', '0', '', '0', ''),
(20, '', 'test5@admin.com', '$2y$10$REFUwkd0KcY61fsADjLPqOP/LpPSZ6Uv2zLIzPQ62.1Ocks4tSddm', 3, 'CJQxFIlN5qo2jNUo5gT2farWdu4QJrPgRSJFurLRVZen3Do9WbTmFGc3Di2z', NULL, '2019-08-07 02:06:59', '2019-08-10 00:48:41', 0, '', '', 0, 90, 0, 'Ivano-Frankivs\'k, Ukraine', '', '', '', '', 'site', '5d4a5c739f24c', 0, '24.7', '48.93', '', '', '', '', '', '', '0.000', '0', '', '0', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users_notifications`
--

CREATE TABLE `users_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `notification_text` text COLLATE utf8_unicode_ci NOT NULL,
  `reference_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users_notifications`
--

INSERT INTO `users_notifications` (`id`, `deleted_at`, `created_at`, `updated_at`, `user_id`, `type`, `notification_text`, `reference_id`) VALUES
(1, NULL, '2019-07-23 01:40:36', '2019-07-23 01:40:36', '9', 'no_xims', 'You’re out of XIMs', ''),
(2, NULL, '2019-07-23 02:44:02', '2019-07-23 02:44:02', '9', 'certificate_validation_success', 'Certificate Validation: success', '6'),
(3, NULL, '2019-07-26 07:27:26', '2019-07-26 07:27:26', '16', 'no_xims', 'You’re out of XIMs', ''),
(4, NULL, '2019-07-29 12:19:33', '2019-07-29 12:19:33', '16', 'no_xims', 'You’re out of XIMs', ''),
(5, NULL, '2019-07-30 12:34:04', '2019-07-30 12:34:04', '16', 'xim_purchase_complete', 'XIM purchase complete', '7'),
(6, NULL, '2019-07-30 12:41:18', '2019-07-30 12:41:18', '16', 'xim_purchase_complete', 'XIM purchase complete', '8'),
(7, NULL, '2019-08-02 01:33:00', '2019-08-02 01:33:00', '9', 'new_job', 'New jobs in your area!', '1'),
(8, NULL, '2019-08-02 01:33:00', '2019-08-02 01:33:00', '16', 'new_job', 'New jobs in your area!', '1'),
(9, NULL, '2019-08-02 01:33:10', '2019-08-02 01:33:10', '9', 'new_job', 'New jobs in your area!', '4'),
(10, NULL, '2019-08-02 01:33:10', '2019-08-02 01:33:10', '16', 'new_job', 'New jobs in your area!', '4'),
(11, NULL, '2019-09-12 01:01:17', '2019-09-12 01:01:17', '16', 'admin_manual', 'Notification Text', ''),
(12, NULL, '2019-09-12 01:01:21', '2019-09-12 01:01:21', '16', 'admin_manual', 'Notification Text', ''),
(13, NULL, '2019-09-12 01:01:25', '2019-09-12 01:01:25', '16', 'admin_manual', 'Notification Textasd', ''),
(14, NULL, '2019-09-12 01:04:52', '2019-09-12 01:04:52', '16', 'admin_manual', 'Notification Text\r\nNotification Text', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_certifications`
--

CREATE TABLE `user_certifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `files_uploaded` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_certifications`
--

INSERT INTO `user_certifications` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `url`, `status`, `user_id`, `files_uploaded`) VALUES
(1, '2019-08-02 01:48:30', '2019-07-10 00:40:17', '2019-08-02 01:48:30', 'Blockchain Council Certificate', '', 3, 13, '[]'),
(2, '2019-08-02 01:48:39', '2019-07-10 02:43:34', '2019-08-02 01:48:39', 'Scheduler', '', 3, 10, '[]'),
(3, NULL, '2019-07-13 11:31:49', '2019-07-13 11:48:27', 'http://impresso.me/public Skill Certifications very very long titlehttp://impresso.me/public Skill Certifications very very long title', 'http://api.newsy.npgtest.me/stories?tags[]=testing_tag1', 1, 9, ''),
(4, NULL, '2019-07-13 11:49:50', '2019-07-13 11:49:50', 'http://impresso.me/public Skill Certifications very very long title http://impresso.me/public Skill Certifications very very long title', 'http://api.newsy.npgtest.me/stories?tags[]=testing_tag1', 3, 9, ''),
(5, NULL, '2019-07-13 11:50:33', '2019-07-20 02:05:37', 'Certificate', 'http://api.newsy.npgtest.me/stories?tags[]=testing_tag1', 2, 9, ''),
(6, NULL, '2019-07-13 11:50:50', '2019-07-14 03:54:29', 'Certificate', '', 3, 9, '[\"35\"]'),
(7, NULL, '2019-08-10 01:28:14', '2019-08-10 01:28:14', 'http://impresso.me/public Skill Certifications very very long title', '', 1, 16, '[]'),
(8, NULL, '2019-08-10 02:07:48', '2019-08-10 02:07:48', 'http://impresso.me/public Skill Certifications very very long title\r\nhttp://impresso.me/public Skill Certifications very very long title', '', 1, 16, '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `user_educations`
--

CREATE TABLE `user_educations` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `speciality` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `files_uploaded` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_educations`
--

INSERT INTO `user_educations` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `speciality`, `status`, `user_id`, `url`, `files_uploaded`) VALUES
(1, '2019-08-02 01:48:30', '2019-07-10 00:29:32', '2019-08-02 01:48:30', 'University of Copenhagen', 'University of Copenhagen', 1, 13, '', '[\"28\",\"24\"]'),
(2, '2019-08-02 01:48:30', '2019-07-10 00:29:59', '2019-08-02 01:48:30', 'DHS Considers Separating Kids From Adults at Mexico Border', 'University of Copenhagen', 3, 13, '', '[]'),
(3, '2019-08-02 01:48:39', '2019-07-10 02:41:46', '2019-08-02 01:48:39', 'DHS Considers Separating Kids From Adults at Mexico Border', 'Speciality / Domain', 3, 10, '', '[]'),
(4, '2019-08-02 01:48:39', '2019-07-10 02:42:25', '2019-08-02 01:48:39', 'Scheduler', 'Speciality / Domain asd Speciality / Domain', 2, 10, '', '[]'),
(5, NULL, '2019-07-13 11:31:48', '2019-07-13 11:31:48', 'CertificateCertificate', 'Dest', 1, 9, '', ''),
(6, '2019-08-02 01:48:32', '2019-07-23 01:40:36', '2019-08-02 01:48:32', 'http://impresso.me/public Skill Certifications very very long title', 'http://impresso.me/public Skill Certifications very very long title', 2, 15, 'www.test.com', '[]'),
(7, NULL, '2019-08-10 01:31:29', '2019-08-10 01:31:29', 'http://impresso.me/public Skill Certifications very very long title', 'qweqweqwe', 1, 16, '', '[]'),
(8, NULL, '2019-08-10 01:59:35', '2019-08-10 01:59:35', 'Ivan', 'qwe', 1, 16, '', '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `user_purchases`
--

CREATE TABLE `user_purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `purchase_amount` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payment_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `transaction_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `credits_amount` decimal(15,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_purchases`
--

INSERT INTO `user_purchases` (`id`, `deleted_at`, `created_at`, `updated_at`, `user_id`, `purchase_amount`, `payment_id`, `status`, `transaction_id`, `credits_amount`) VALUES
(1, NULL, '2019-07-18 01:00:21', '2019-07-20 01:24:16', 9, '3', '5d2feed554ca0', '1', '2', '30.000'),
(2, NULL, '2019-07-26 07:30:49', '2019-07-26 07:30:49', 16, '3', 'ch_1F0QhJAiptOMRf9BRiA811a7', '0', '', '30.000'),
(3, NULL, '2019-07-29 12:18:36', '2019-07-29 12:18:36', 16, '3', 'ch_1F1acSAiptOMRf9BfDAV6w0u', '0', '', '30.000'),
(4, NULL, '2019-07-29 12:18:55', '2019-07-29 12:18:55', 16, '3', 'ch_1F1aclAiptOMRf9B0fjz4J8X', '0', '', '30.000'),
(5, NULL, '2019-07-30 10:12:12', '2019-07-30 10:16:49', 16, '27', 'ch_1F1v7gAiptOMRf9BOp1UqbmU', '1', '17', '350.000'),
(6, NULL, '2019-07-30 10:18:36', '2019-07-30 10:22:04', 16, '9', 'ch_1F1vDsAiptOMRf9BXce9Ikku', '1', '19', '90.000'),
(7, NULL, '2019-07-30 12:33:55', '2019-07-30 12:34:04', 16, '90', 'ch_1F1xKpAiptOMRf9BF080Y4NW', '1', '20', '1500.000'),
(8, NULL, '2019-07-30 12:40:56', '2019-07-30 12:41:18', 16, '90', 'ch_1F1xRcAiptOMRf9ByLP5XRUZ', '1', '21', '1500.000'),
(9, NULL, '2019-07-31 01:28:05', '2019-07-31 01:37:05', 16, '90', 'ch_1F29PzAiptOMRf9BmUmoRuNF', '1', '22', '1500.000'),
(10, NULL, '2019-08-10 11:30:23', '2019-08-10 11:30:23', 16, '27', 'ch_1F5vaIAiptOMRf9BjDQeZDx4', '0', '', '350.000');

-- --------------------------------------------------------

--
-- Структура таблицы `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `by_user_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `share_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `education_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `certificate_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `old_credits_amount` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `new_credits_amount` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `deleted_at`, `created_at`, `updated_at`, `user_id`, `amount`, `notes`, `type`, `by_user_id`, `purchase_id`, `share_id`, `education_id`, `certificate_id`, `old_credits_amount`, `new_credits_amount`) VALUES
(1, NULL, '2019-07-18 01:40:43', '2019-07-18 01:40:43', 9, '30.000', 'Credits buy', 'other', '1', '1', '', '5', '', '', ''),
(2, NULL, '2019-07-20 01:24:16', '2019-07-20 01:24:16', 9, '30.000', 'Automatic Accrual of credits for user purchase #1', 'purchase', '1', '1', '', '', '', '2', '32'),
(3, NULL, '2019-07-20 02:00:25', '2019-07-20 02:00:25', 9, '100.000', 'Added Credits to Users', 'other', '1', '', '', '', '', '32', '132'),
(4, NULL, '2019-07-20 02:05:37', '2019-07-20 02:05:37', 9, '-30.000', 'Certificate Validation Certificate - #5', 'validation_certificate', '9', '', '', '', '5', '132', '162'),
(5, NULL, '2019-07-20 02:07:13', '2019-07-20 02:07:13', 9, '-20.000', 'test', 'other', '1', '', '', '', '', '162', '182'),
(6, NULL, '2019-07-20 02:09:10', '2019-07-20 02:09:10', 9, '-10.000', 'test', 'other', '1', '', '', '', '', '182', '172'),
(7, '2019-08-02 01:48:32', '2019-07-20 02:24:15', '2019-08-02 01:48:32', 15, '30.000', 'Tokens which every user receives to start with.', 'user_validation', '15', '', '', '', '', '0', '30'),
(8, '2019-08-02 01:48:32', '2019-07-20 02:27:22', '2019-08-02 01:48:32', 15, '2.000', '', 'other', '1', '', '', '', '', '30', '32'),
(9, '2019-08-02 01:48:32', '2019-07-20 02:27:37', '2019-08-02 01:48:32', 15, '1.200', 'test', 'other', '1', '', '', '', '', '32', '33.2'),
(10, NULL, '2019-07-20 02:41:54', '2019-07-20 02:41:54', 9, '-2.780', 'Test negative values', 'other', '1', '', '', '', '', '172', '169.22'),
(11, '2019-08-02 01:48:32', '2019-07-20 17:09:47', '2019-08-02 01:48:32', 15, '10.000', 'Adding Credits for share', 'share', '1', '', '', '', '', '33,20', '43'),
(12, '2019-08-02 01:48:32', '2019-07-23 01:40:36', '2019-08-02 01:48:32', 15, '-30.000', 'Certificate Validation \"Scqwe\" - #6', 'validation_certificate', '15', '', '', '6', '', '43', '13'),
(13, '2019-07-30 10:17:05', '2019-07-30 10:16:41', '2019-07-30 10:17:05', 16, '350.000', 'Accrual of credits for user purchase #5', 'purchase', '1', '5', '', '', '', '0', '350'),
(14, '2019-07-30 10:17:13', '2019-07-30 10:16:44', '2019-07-30 10:17:13', 16, '350.000', 'Accrual of credits for user purchase #5', 'purchase', '1', '5', '', '', '', '350', '700'),
(15, '2019-07-30 10:17:21', '2019-07-30 10:16:47', '2019-07-30 10:17:21', 16, '350.000', 'Accrual of credits for user purchase #5', 'purchase', '1', '5', '', '', '', '700', '1050'),
(16, '2019-07-30 10:17:18', '2019-07-30 10:16:48', '2019-07-30 10:17:18', 16, '350.000', 'Accrual of credits for user purchase #5', 'purchase', '1', '5', '', '', '', '1050', '1400'),
(17, NULL, '2019-07-30 10:16:49', '2019-07-30 10:16:49', 16, '350.000', 'Accrual of credits for user purchase #5', 'purchase', '1', '5', '', '', '', '1400', '1750'),
(18, NULL, '2019-07-30 10:20:16', '2019-07-30 10:20:16', 16, '90.000', 'Accrual of credits for user purchase #6', 'purchase', '1', '6', '', '', '', '1750', '1840'),
(19, NULL, '2019-07-30 10:22:04', '2019-07-30 10:22:04', 16, '90.000', 'Accrual of credits for user purchase #6', 'purchase', '1', '6', '', '', '', '1840', '1930'),
(20, NULL, '2019-07-30 12:34:04', '2019-07-30 12:34:04', 16, '1500.000', 'Automatic Accrual of credits for user purchase #7', 'purchase', '1', '7', '', '', '', '1930', '3430'),
(21, NULL, '2019-07-30 12:41:18', '2019-07-30 12:41:18', 16, '1500.000', 'Automatic Accrual of credits for user purchase #8', 'purchase', '1', '8', '', '', '', '3430', '4930'),
(22, NULL, '2019-07-31 01:37:05', '2019-07-31 01:37:05', 16, '1500.000', 'Accrual of credits for user purchase #9', 'purchase', '1', '9', '', '', '', '4930', '6430'),
(23, NULL, '2019-08-02 01:34:44', '2019-08-02 01:34:44', 16, '30.000', 'Tokens which every user receives to start with.', 'user_validation', '16', '', '', '', '', '6430', '6460');

-- --------------------------------------------------------

--
-- Структура таблицы `validation_statuses`
--

CREATE TABLE `validation_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `validation_statuses`
--

INSERT INTO `validation_statuses` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`) VALUES
(1, NULL, '2019-07-10 00:20:19', '2019-07-10 00:21:56', 'New - not validated'),
(2, NULL, '2019-07-10 00:20:55', '2019-07-10 00:20:55', 'Request validation'),
(3, NULL, '2019-07-10 00:21:10', '2019-07-10 00:21:10', 'Validated'),
(4, NULL, '2019-07-10 00:21:24', '2019-07-10 00:21:24', 'Validation failed');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buy_credits`
--
ALTER TABLE `buy_credits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `jobs_ads`
--
ALTER TABLE `jobs_ads`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `la_configs`
--
ALTER TABLE `la_configs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `la_menus`
--
ALTER TABLE `la_menus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `meetup_reasons`
--
ALTER TABLE `meetup_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `module_fields`
--
ALTER TABLE `module_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_fields_module_foreign` (`module`),
  ADD KEY `module_fields_field_type_foreign` (`field_type`);

--
-- Индексы таблицы `module_field_types`
--
ALTER TABLE `module_field_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD KEY `roles_parent_foreign` (`parent`);

--
-- Индексы таблицы `role_module`
--
ALTER TABLE `role_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_module_role_id_foreign` (`role_id`),
  ADD KEY `role_module_module_id_foreign` (`module_id`);

--
-- Индексы таблицы `role_module_fields`
--
ALTER TABLE `role_module_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_module_fields_role_id_foreign` (`role_id`),
  ADD KEY `role_module_fields_field_id_foreign` (`field_id`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `stripe_charges`
--
ALTER TABLE `stripe_charges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `users_notifications`
--
ALTER TABLE `users_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_certifications`
--
ALTER TABLE `user_certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_certifications_status_foreign` (`status`),
  ADD KEY `user_certifications_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `user_educations`
--
ALTER TABLE `user_educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_educations_status_foreign` (`status`),
  ADD KEY `user_educations_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_purchases_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_transactions_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `validation_statuses`
--
ALTER TABLE `validation_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buy_credits`
--
ALTER TABLE `buy_credits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `jobs_ads`
--
ALTER TABLE `jobs_ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `la_configs`
--
ALTER TABLE `la_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `la_menus`
--
ALTER TABLE `la_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `meetup_reasons`
--
ALTER TABLE `meetup_reasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `module_fields`
--
ALTER TABLE `module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT для таблицы `module_field_types`
--
ALTER TABLE `module_field_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `role_module`
--
ALTER TABLE `role_module`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `role_module_fields`
--
ALTER TABLE `role_module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT для таблицы `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `stripe_charges`
--
ALTER TABLE `stripe_charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `users_notifications`
--
ALTER TABLE `users_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `user_certifications`
--
ALTER TABLE `user_certifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `user_educations`
--
ALTER TABLE `user_educations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `validation_statuses`
--
ALTER TABLE `validation_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `module_fields`
--
ALTER TABLE `module_fields`
  ADD CONSTRAINT `module_fields_field_type_foreign` FOREIGN KEY (`field_type`) REFERENCES `module_field_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_fields_module_foreign` FOREIGN KEY (`module`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_module`
--
ALTER TABLE `role_module`
  ADD CONSTRAINT `role_module_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_module_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_module_fields`
--
ALTER TABLE `role_module_fields`
  ADD CONSTRAINT `role_module_fields_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `module_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_module_fields_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_certifications`
--
ALTER TABLE `user_certifications`
  ADD CONSTRAINT `user_certifications_status_foreign` FOREIGN KEY (`status`) REFERENCES `validation_statuses` (`id`),
  ADD CONSTRAINT `user_certifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_educations`
--
ALTER TABLE `user_educations`
  ADD CONSTRAINT `user_educations_status_foreign` FOREIGN KEY (`status`) REFERENCES `validation_statuses` (`id`),
  ADD CONSTRAINT `user_educations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD CONSTRAINT `user_purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD CONSTRAINT `user_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
