-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 10 2019 г., 09:44
-- Версия сервера: 5.5.53-MariaDB
-- Версия PHP: 5.6.29

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
(1, NULL, '2019-07-02 18:29:36', '2019-07-06 17:25:19', 'PHP DEVELOPER', 'PHP DEVELOPER<div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div>', 'Ivano-Frankivsk', '48.936592', '24.705023', 'NPGroup', 'Full time developer', 1),
(2, NULL, '2019-07-06 02:26:35', '2019-07-06 17:27:19', 'Javascript Middle ', 'Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle Javascript Middle ', 'Lviv', '49.841977', '24.031722', 'SoftServe', 'Office work', 1),
(3, NULL, '2019-07-06 02:53:46', '2019-07-06 17:27:53', 'PHP DEVELOPER Kraków', 'PHP DEVELOPER Kraków<div>PHP DEVELOPER Kraków<br></div>', 'Kraków', '50.062624', '19.936734', 'KRAKOW ONLINE', 'remote developer', 1),
(4, NULL, '2019-07-06 17:29:05', '2019-07-06 17:41:48', 'Java Dev', 'Java Dev<div>Java Dev<br></div><div>Java Dev<br></div><div>Java Dev<br></div><div><br></div>', 'Ivano-Frankivsk', '48.887908', '24.0333', 'softjourn', 'JAVA', 1);

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
(1, 'sitename', '', 'Impresso', '2019-07-02 10:35:16', '2019-07-02 19:16:08'),
(2, 'sitename_part1', '', 'Impresso', '2019-07-02 10:35:16', '2019-07-02 19:16:08'),
(3, 'sitename_part2', '', '', '2019-07-02 10:35:16', '2019-07-02 19:16:08'),
(4, 'sitename_short', '', 'IM', '2019-07-02 10:35:16', '2019-07-02 19:16:08'),
(5, 'site_description', '', 'LaraAdmin is a open-source Laravel Admin Panel for quick-start Admin based applications and boilerplate for CRM or CMS systems.', '2019-07-02 10:35:16', '2019-07-02 19:16:08'),
(6, 'sidebar_search', '', '0', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(7, 'show_messages', '', '0', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(8, 'show_notifications', '', '0', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(9, 'show_tasks', '', '0', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(10, 'show_rightsidebar', '', '0', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(11, 'skin', '', 'skin-white', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(12, 'layout', '', 'fixed', '2019-07-02 10:35:16', '2019-07-02 19:16:09'),
(13, 'default_email', '', 'test@example.com', '2019-07-02 10:35:16', '2019-07-02 19:16:09');

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
(1, 'Users', '#', 'fa-group', 'custom', 0, 2, '2019-07-02 10:35:16', '2019-07-10 00:28:38'),
(2, 'Users', 'users', 'fa-group', 'module', 1, 1, '2019-07-02 10:35:16', '2019-07-10 00:27:59'),
(6, 'Roles', 'roles', 'fa-user-plus', 'module', 1, 4, '2019-07-02 10:35:16', '2019-07-10 00:28:38'),
(8, 'Permissions', 'permissions', 'fa-magic', 'module', 1, 5, '2019-07-02 10:35:16', '2019-07-10 00:28:38'),
(9, 'Jobs', 'jobs', 'fa fa-joomla', 'module', 0, 1, '2019-07-02 18:28:47', '2019-07-10 00:27:59'),
(11, 'User_Educations', 'user_educations', 'fa fa-archive', 'module', 1, 2, '2019-07-10 00:25:16', '2019-07-10 00:28:35'),
(12, 'User_certifications', 'user_certifications', 'fa fa-certificate', 'module', 1, 3, '2019-07-10 00:27:06', '2019-07-10 00:28:38');

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
(12, 'User_certifications', 'User_certifications', 'user_certifications', 'title', 'User_certification', 'User_certificationsController', 'fa-certificate', 1, '2019-07-10 00:25:44', '2019-07-10 00:27:06');

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
(92, 'file', 'File', 12, 9, 0, '', 0, 0, 0, '', 0, '2019-07-10 00:44:30', '2019-07-10 00:44:30'),
(93, 'url', 'URL', 11, 22, 0, '', 0, 256, 0, '', 0, '2019-07-10 00:44:56', '2019-07-10 00:44:56'),
(94, 'file', 'File', 11, 9, 0, '', 0, 0, 0, '', 0, '2019-07-10 00:45:05', '2019-07-10 00:45:05'),
(95, 'status', 'Status', 12, 7, 0, '', 0, 0, 1, '@validation_statuses', 0, '2019-07-10 01:09:33', '2019-07-10 01:09:33'),
(96, 'user_id', 'User', 12, 7, 0, '', 0, 0, 1, '@users', 0, '2019-07-10 01:09:49', '2019-07-10 01:09:49');

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
(12, 1, 12, 1, 1, 1, 1, '2019-07-10 00:27:06', '2019-07-10 00:27:06');

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
(92, 1, 92, 'write', '2019-07-10 00:44:30', '2019-07-10 00:44:30'),
(93, 1, 93, 'write', '2019-07-10 00:44:56', '2019-07-10 00:44:56'),
(94, 1, 94, 'write', '2019-07-10 00:45:05', '2019-07-10 00:45:05'),
(95, 1, 95, 'write', '2019-07-10 01:09:34', '2019-07-10 01:09:34'),
(96, 1, 96, 'write', '2019-07-10 01:09:49', '2019-07-10 01:09:49');

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
(28, 'image-2', 'D:\\PROGRAMS\\OpenServer\\domains\\impresso.me\\storage\\uploads\\2019-07-10-055454-image-2.png', 'png', '', 9, 'noz2w7pahxnfjawyo7n5', 0, NULL, '2019-07-10 02:54:54', '2019-07-10 02:54:54');

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
  `certificate_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `is_verified`, `job_title`, `company_title`, `photo`, `photo_id`, `photo_selfie`, `location_title`, `top_skills`, `soft_skills`, `impress`, `phone`, `provider`, `provider_id`, `varification_pending`, `longitude`, `latitude`, `university_title`, `certificate_title`) VALUES
(1, 'Super Admin', 'admin@mail.com', '$2y$10$4arodD96t8qQfS5kKEjqkuzEe5sgEaDa3SicF2P1wfduF3F4njA3u', 1, 'ffJvRgIHzUtylCl73YHVznOnOzDSQpXvrESMf3XdQYhqiCnJZwVh9EsXg5Kl', NULL, '2019-07-02 10:35:31', '2019-07-06 02:30:10', 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', 0, '', '', '', ''),
(2, 'Test User', 'test_user@mail.com', '$2y$10$zLZOlINBwA.W9XUHUgWdyOJMsAArP.vYSa2g9cQneRpHyDXsT5BBa', 3, NULL, NULL, '2019-07-02 18:14:40', '2019-07-08 02:19:26', 0, 'PHP DEVELOPER', 'NPG', 0, 0, 0, 'Ivano-Frankivsk, Ukraine', 'Top Skills 1\r\nTop Skills 2\r\nTop Skills 3', 'Soft Skills 1\r\nSoft Skills 2\r\nSoft Skills 3', 'Impress ', '123123123123', '', '', 0, '49.26', '24.8', '', ''),
(3, '', 'admintest@mail.com', '$2y$10$CpNlJjwPdMbu.eHjGvpIaeFO9Yft44M0BUPY5NR7NhyOSvo4ef.DG', 1, NULL, '2019-07-07 11:33:20', '2019-07-03 17:28:56', '2019-07-07 11:33:20', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d100837281', 0, '', '', '', ''),
(4, '', 'admintest2@mail.com', '$2y$10$eLn4lIxas650/CDamWSrIOBCsRcv27E1GpIecF5c7yWIZMyuRGi9G', 1, NULL, '2019-07-07 11:33:22', '2019-07-03 17:32:11', '2019-07-07 11:33:22', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d10cb14862', 0, '', '', '', ''),
(5, '', 'admintest3@mail.com', '$2y$10$LgNjaBD0WTQF2mBKzljDMuF81lp4X.yHY.gSeqssmGP5hsshOeSs.', 1, NULL, '2019-07-07 11:33:25', '2019-07-03 17:32:46', '2019-07-07 11:33:25', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d10ee8ed89', 0, '', '', '', ''),
(6, '', 'admintest4@mail.com', '$2y$10$MBpT/Nez5K1XmdrQ9xkjOeP6gsFyRMhVimZxuG88lZBCVEIpDnE5G', 1, NULL, '2019-07-07 11:33:27', '2019-07-03 17:33:39', '2019-07-07 11:33:27', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1123ca6d6', 0, '', '', '', ''),
(7, '', 'admintest5@mail.com', '$2y$10$qLk6kygfbUougQQ5itMG..FPtMevJ3zzMWfO0E2r7c6KSO3hFah.6', 1, NULL, '2019-07-07 11:33:29', '2019-07-03 17:33:45', '2019-07-07 11:33:29', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1129466c6', 0, '', '', '', ''),
(8, '', 'admintest6@mail.com', '$2y$10$M5nqHq0FX35AiOKyRjKDO..kbZhIN3.ui6mFdWHye1476/WN7q1cu', 1, NULL, '2019-07-07 11:33:33', '2019-07-03 17:34:45', '2019-07-07 11:33:33', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1d1165892ee', 0, '', '', '', ''),
(9, '', 'admintest7@mail.com', '$2y$10$kWPE.2f96xSN4BZW2lsXzubCmUki1xq08RWdwkUENeLv5dB2z4qjW', 3, 'OqJQ30seUmoeUpplPm7zmgElVdtRuCR6Ba4820D3SuIuy6Ss1lNpElvf2iYx', NULL, '2019-07-03 17:35:11', '2019-07-10 02:55:29', 0, '', '', 0, 27, 28, '', '', '', '', '', 'site', '5d1d117f5e54b', 1, '', '', '', ''),
(10, 'Ivan Developer', 'admintest10@mail.com', '$2y$10$Qlicv9YF79qen6CKyQZJHOJeEHHap43kS7uItq1evEjivbpVMKS76', 3, 'PvIFBGCHZfhoi5LzBz0m10QbwVXQa1Q7zec7APzqKUDu3COYzw334ezXABsF', NULL, '2019-07-03 17:45:54', '2019-07-10 02:50:28', 1, 'DEVELOPER', 'NPG', 0, 21, 22, '', '', '', '', '', 'site', '5d1d14029a182', 0, '48.936001', '24.703206', '', ''),
(11, '', 'iivanshp@gmail.com', '$2y$10$GVGokl7Z4eosdYoUj5Vov.XOAKY8bITjX72jEnsjcFi5.wMFYmsj6', 3, NULL, NULL, '2019-07-04 17:52:03', '2019-07-04 17:52:03', 0, '', '', 0, 0, 0, '', '', '', '', '', 'site', '5d1e66f361ce6', 0, '', '', '', ''),
(12, 'Name ', 'iivanshp+test@gmail.com', '$2y$10$akFWxJPbNfeEg/QP3x70V.ra6I8unkh3Ohdb63LqsgsfJE0SHB9Am', 3, NULL, NULL, '2019-07-04 17:52:53', '2019-07-08 02:21:49', 1, 'Security', 'SOFTSERVE', 24, 0, 0, 'Lviv', '', '', '', '', 'site', '5d1e672500993', 0, '48.887908', '23.95456', '', ''),
(13, 'Ivan Tester', 'iivanshp+test1@gmail.com', '$2y$10$JRteP68AXZ4I5oHHZLp2r.Zpn6uP1HHr07p0ZHlpLClh5thtZtHFq', 3, NULL, NULL, '2019-07-04 17:54:37', '2019-07-08 18:40:18', 1, 'Project Manager', 'Surfs Up Chill', 23, 0, 0, 'Ivano-Frankivsk', 'Top Skills\r\nTop Skills 2\r\nTop Skills 3', 'Top Skills 1\r\nTop Skills 2 \r\nTop Skills 3', 'Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress Impress ', '123', 'site', '5d1e678daa847', 0, '48.936436', '24.001', 'University of Copenhagen', 'Bachelor of Science (Physiotherapy)');

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
  `file` int(11) NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_certifications`
--

INSERT INTO `user_certifications` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `url`, `file`, `status`, `user_id`) VALUES
(1, NULL, '2019-07-10 00:40:17', '2019-07-10 01:11:26', 'Blockchain Council Certificate', '', 23, 3, 13),
(2, NULL, '2019-07-10 02:43:34', '2019-07-10 02:43:34', 'Scheduler', '', 0, 3, 10);

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
  `file` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_educations`
--

INSERT INTO `user_educations` (`id`, `deleted_at`, `created_at`, `updated_at`, `title`, `speciality`, `status`, `user_id`, `url`, `file`) VALUES
(1, NULL, '2019-07-10 00:29:32', '2019-07-10 00:39:09', 'University of Copenhagen', 'University of Copenhagen', 1, 13, '', 0),
(2, NULL, '2019-07-10 00:29:59', '2019-07-10 00:39:16', 'DHS Considers Separating Kids From Adults at Mexico Border', 'University of Copenhagen', 3, 13, '', 0),
(3, NULL, '2019-07-10 02:41:46', '2019-07-10 02:41:46', 'DHS Considers Separating Kids From Adults at Mexico Border', 'Speciality / Domain', 3, 10, '', 0),
(4, NULL, '2019-07-10 02:42:25', '2019-07-10 02:42:25', 'Scheduler', 'Speciality / Domain asd Speciality / Domain', 2, 10, '', 0);

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
-- Индексы таблицы `validation_statuses`
--
ALTER TABLE `validation_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `la_configs`
--
ALTER TABLE `la_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `la_menus`
--
ALTER TABLE `la_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `module_fields`
--
ALTER TABLE `module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT для таблицы `module_field_types`
--
ALTER TABLE `module_field_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `role_module_fields`
--
ALTER TABLE `role_module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT для таблицы `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `user_certifications`
--
ALTER TABLE `user_certifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user_educations`
--
ALTER TABLE `user_educations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `user_certifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_certifications_status_foreign` FOREIGN KEY (`status`) REFERENCES `validation_statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_educations`
--
ALTER TABLE `user_educations`
  ADD CONSTRAINT `user_educations_status_foreign` FOREIGN KEY (`status`) REFERENCES `validation_statuses` (`id`),
  ADD CONSTRAINT `user_educations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
