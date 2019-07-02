-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 03 2019 г., 01:48
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
  `location_coords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `deleted_at`, `created_at`, `updated_at`, `job_title`, `description`, `location_title`, `location_coords`) VALUES
(1, NULL, '2019-07-02 18:29:36', '2019-07-02 18:29:36', 'PHP DEVELOPER', 'PHP DEVELOPER<div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div><div>PHP DEVELOPER<br></div>', 'Ivano-Frankivsk', '{\r\n\'lat\': \'\',\r\n\'lon\':\'\',\r\n}');

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
(1, 'Users', '#', 'fa-group', 'custom', 0, 1, '2019-07-02 10:35:16', '2019-07-02 18:00:05'),
(2, 'Users', 'users', 'fa-group', 'module', 1, 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(6, 'Roles', 'roles', 'fa-user-plus', 'module', 1, 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(8, 'Permissions', 'permissions', 'fa-magic', 'module', 1, 0, '2019-07-02 10:35:16', '2019-07-02 10:35:16'),
(9, 'Jobs', 'jobs', 'fa fa-joomla', 'module', 0, 0, '2019-07-02 18:28:47', '2019-07-02 18:28:47');

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
(9, 'Jobs', 'Jobs', 'jobs', 'job_title', 'Job', 'JobsController', 'fa-joomla', 1, '2019-07-02 18:26:24', '2019-07-02 18:28:47');

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
(4, 'password', 'Password', 1, 17, 0, '', 6, 250, 1, '', 0, '2019-07-02 10:35:15', '2019-07-02 10:35:15'),
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
(61, 'location_coords', 'Location Coords', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:11:22', '2019-07-02 18:11:22'),
(62, 'impress', 'Impress', 1, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:11:58', '2019-07-02 18:11:58'),
(63, 'phone', 'Phone', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:12:24', '2019-07-02 18:12:24'),
(64, 'job_title', 'Job Title', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:27:06', '2019-07-02 18:27:06'),
(65, 'description', 'Description', 9, 11, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:27:31', '2019-07-02 18:27:31'),
(66, 'location_title', 'Location title', 9, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:27:54', '2019-07-02 18:27:54'),
(67, 'location_coords', 'Location Coords', 9, 21, 0, '', 0, 0, 0, '', 0, '2019-07-02 18:28:19', '2019-07-02 18:28:19'),
(68, 'provider', 'Provider', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:39:47', '2019-07-02 18:39:47'),
(69, 'provider_id', 'Provider ID', 1, 22, 0, '', 0, 256, 0, '', 0, '2019-07-02 18:40:01', '2019-07-02 18:40:01');

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
(9, 1, 9, 1, 1, 1, 1, '2019-07-02 18:28:47', '2019-07-02 18:28:47');

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
(61, 1, 61, 'write', '2019-07-02 18:11:22', '2019-07-02 18:11:22'),
(62, 1, 62, 'write', '2019-07-02 18:11:58', '2019-07-02 18:11:58'),
(63, 1, 63, 'write', '2019-07-02 18:12:24', '2019-07-02 18:12:24'),
(64, 1, 64, 'write', '2019-07-02 18:27:08', '2019-07-02 18:27:08'),
(65, 1, 65, 'write', '2019-07-02 18:27:31', '2019-07-02 18:27:31'),
(66, 1, 66, 'write', '2019-07-02 18:27:55', '2019-07-02 18:27:55'),
(67, 1, 67, 'write', '2019-07-02 18:28:20', '2019-07-02 18:28:20'),
(68, 1, 68, 'write', '2019-07-02 18:39:47', '2019-07-02 18:39:47'),
(69, 1, 69, 'write', '2019-07-02 18:40:02', '2019-07-02 18:40:02');

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
  `location_coords` text COLLATE utf8_unicode_ci NOT NULL,
  `impress` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `is_verified`, `job_title`, `company_title`, `photo`, `photo_id`, `photo_selfie`, `location_title`, `top_skills`, `soft_skills`, `location_coords`, `impress`, `phone`, `provider`, `provider_id`) VALUES
(1, 'Super Admin', 'admin@mail.com', '$2y$10$4arodD96t8qQfS5kKEjqkuzEe5sgEaDa3SicF2P1wfduF3F4njA3u', 1, 'bAj8OIdeV6sON0116pg8tpJfM0XIxfbjTZ282AHNE8Q60URj9I0MTZigzcpO', NULL, '2019-07-02 10:35:31', '2019-07-02 18:05:36', 1, '', '', 0, 0, 0, '', '', '', '', '', '', '', ''),
(2, 'Test User', 'test_user@mail.com', '$2y$10$6JEsLJV.BK2.P.ueNOeHK.fyPp/N6DPxp8vQFBN8NJOmZWDN0RMBC', 3, NULL, NULL, '2019-07-02 18:14:40', '2019-07-02 19:27:58', 0, 'PHP DEVELOPER', 'NPG', 0, 0, 0, 'Ivano-Frankivsk, Ukraine', 'Top Skills 1\r\nTop Skills 2\r\nTop Skills 3', 'Soft Skills 1\r\nSoft Skills 2\r\nSoft Skills 3', '{\r\n\'lat\': \'\',\r\n\'lon\':\'\'\r\n}', 'Impress ', '123123123123', '', '');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `la_configs`
--
ALTER TABLE `la_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `la_menus`
--
ALTER TABLE `la_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `module_fields`
--
ALTER TABLE `module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `role_module_fields`
--
ALTER TABLE `role_module_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
