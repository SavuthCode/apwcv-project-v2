

CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO banners VALUES("8","20221027124522.png","Main Banner","0","2022-10-27 12:45:22","2022-10-27 12:45:22","wwwww");



CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_kh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=689 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO categories VALUES("688","test","តេសត","test","20221029065021.png","1","2022-10-29 06:50:21","2022-10-29 11:16:41");



CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO contacts VALUES("2","APWVC","info.apwvc@gmail.com","0885620981","សមាគមលើកកម្ពស់ពលករ នឹង អតិតពលករដើម្បីសប្បរសធម៏ / APWVC","2022-10-27 07:15:43","2022-10-27 12:43:47");



CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `date_expiry` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO employees VALUES("2","Neak","Sophea","7qo3dpzjmd","female","0962570987","26-10-2022","test","sopheacambodia1680@gmail.com","Phnom Penh","20221026033226.png","1","","2022-10-26 15:32:26","2022-10-27 09:01:37");



CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;




CREATE TABLE `general_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_access` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `developed_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int DEFAULT NULL,
  `theme` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO general_settings VALUES("1","APWVC","20221026080732.jpg","own","d/m/Y","Neak Sophea","standard","1","default.css","2018-07-06 13:13:11","2022-10-26 08:07:32");



CREATE TABLE `medias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO medias VALUES("5","test","test","20221030034900.1667101736946communityIcon_btdkmklrsxs81.png","image","688","1","2022-10-30 03:49:00","2022-10-30 03:49:00");



CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO migrations VALUES("1","0000_00_00_000000_create_websockets_statistics_entries_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("3","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("4","2015_05_06_194030_create_youtube_access_tokens_table","1");
INSERT INTO migrations VALUES("5","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("6","2019_12_14_000001_create_personal_access_tokens_table","1");
INSERT INTO migrations VALUES("7","2022_10_08_135923_create_medias_table","1");
INSERT INTO migrations VALUES("8","2022_10_11_104442_create_permission_tables","1");
INSERT INTO migrations VALUES("9","2022_10_26_015904_create_employees_table","1");



CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;




CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO permissions VALUES("109","image-index","web","2022-10-26 03:58:10","2022-10-26 04:24:10");
INSERT INTO permissions VALUES("110","video-index","web","2022-10-26 04:20:46","2022-10-26 04:20:46");
INSERT INTO permissions VALUES("111","book-index","web","2022-10-26 04:21:37","2022-10-26 04:21:37");
INSERT INTO permissions VALUES("112","video-create","web","2022-10-26 04:51:35","2022-10-26 04:51:35");
INSERT INTO permissions VALUES("113","backup-database","web","2022-10-26 04:56:54","2022-10-26 07:27:45");
INSERT INTO permissions VALUES("114","general-setting","web","2022-10-26 04:57:02","2022-10-26 07:27:57");
INSERT INTO permissions VALUES("115","send-notification","web","2022-10-26 04:57:10","2022-10-26 07:28:10");
INSERT INTO permissions VALUES("117","users-index","web","2022-10-26 09:38:33","2022-10-26 09:38:33");
INSERT INTO permissions VALUES("118","users-add","web","2022-10-26 09:39:02","2022-10-26 09:39:02");
INSERT INTO permissions VALUES("120","users-edit","web","2022-10-26 12:07:21","2022-10-26 12:07:21");
INSERT INTO permissions VALUES("121","users-delete","web","2022-10-26 12:07:39","2022-10-26 12:07:39");
INSERT INTO permissions VALUES("122","employees-add","web","2022-10-26 13:00:05","2022-10-26 13:00:05");
INSERT INTO permissions VALUES("123","employees-index","web","2022-10-26 13:00:36","2022-10-26 13:00:36");
INSERT INTO permissions VALUES("124","employees-edit","web","2022-10-26 15:28:57","2022-10-26 15:28:57");
INSERT INTO permissions VALUES("125","employees-delete","web","2022-10-26 15:29:25","2022-10-26 15:29:25");
INSERT INTO permissions VALUES("126","category","web","2022-10-28 15:13:49","2022-10-28 15:13:49");



CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO personal_access_tokens VALUES("1","App\Models\User","3","MyApp","597da62cb3aaae474499a9b8f301db06ba2d15af21c69e70b4901b5771ce9f31","["*"]","","","2022-10-26 12:04:41","2022-10-26 12:04:41");



CREATE TABLE `role_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_has_permissions VALUES("109","1");
INSERT INTO role_has_permissions VALUES("110","1");
INSERT INTO role_has_permissions VALUES("111","1");
INSERT INTO role_has_permissions VALUES("113","1");
INSERT INTO role_has_permissions VALUES("114","1");
INSERT INTO role_has_permissions VALUES("115","1");
INSERT INTO role_has_permissions VALUES("117","1");
INSERT INTO role_has_permissions VALUES("118","1");
INSERT INTO role_has_permissions VALUES("120","1");
INSERT INTO role_has_permissions VALUES("121","1");
INSERT INTO role_has_permissions VALUES("122","1");
INSERT INTO role_has_permissions VALUES("123","1");
INSERT INTO role_has_permissions VALUES("124","1");
INSERT INTO role_has_permissions VALUES("125","1");
INSERT INTO role_has_permissions VALUES("126","1");



CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","Admin","admin can access all data...","web","1","2018-06-02 06:46:44","2018-06-03 06:13:05");
INSERT INTO roles VALUES("2","User","User can access ","web","1","2018-10-22 09:38:13","2018-10-22 09:38:13");
INSERT INTO roles VALUES("4","Customer","Customer has specific acess..","web","0","2018-06-02 07:05:27","2022-10-27 12:46:34");



CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("1","NEAK","Sophea","0962570987","admin@gmail.com","$2y$10$i6biavn8na//OdM/MDDvp.9UZIsXN9gTrbCMayPJBTgXLLizl2QDW","","1","","1","bpjVQoYrz0qkAJ1bgrFMgGSWDeslvNbqNiZ8jy4Aj1qjEQQW26C9Te5idOGR","2022-10-26 06:43:03","2022-10-27 12:39:49");
INSERT INTO users VALUES("2","Ven","Sokvuth","086880690","user@gmail.com","$2y$10$zJNIJiIzt44FAwRL9vq3he43GIXGO6SCw8tr8xKmP9XPrQpkGuhaC","","1","","2","e4pAqhVDexGvqRhmjKLONv35pzT7gW10S3uYwLGxt4MPVJv5sFwsWOdrU6z5","2022-10-26 06:43:03","2022-10-26 06:43:03");
INSERT INTO users VALUES("3","Chan","chaqweqweq","5345345wqeq","admin123@admin.com","$2y$10$R./0UQ6lfGIAxTqNDY3bTusj95jQtguEAPv2CJr6mJ1nwl39I62Hy","","0","","2","","2022-10-26 12:04:41","2022-10-26 12:48:36");



CREATE TABLE `websockets_statistics_entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;




CREATE TABLE `youtube_access_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `access_token` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO youtube_access_tokens VALUES("1","{"access_token":"ya29.a0Aa4xrXP_qPSSG9w_r7CjKakO5CMx_yL5fXrow5k0CtrSgxo_SF0NPkQNH1IVZIcEOFL_fBeZ1OptbfU_n6vkFCcyHNuESMVdmNcL8Xu7viyfojxKzNNraX4sPdpn9hsZqJjicOepxVi6GE_M2PAMQ3xjEBRRfQaCgYKATASARMSFQEjDvL9byJrXW2ATrTUYuKfxJn_gA0165","expires_in":3598,"scope":"https:\/\/www.googleapis.com\/auth\/youtube.upload https:\/\/www.googleapis.com\/auth\/youtube.readonly https:\/\/www.googleapis.com\/auth\/youtube","token_type":"Bearer","created":1667216158}","2022-10-31 11:35:58");
INSERT INTO youtube_access_tokens VALUES("2","{"access_token":"ya29.a0Aa4xrXN6ZhJ5LGw6nIobAlUvlzxowuY8fs2Evm7BZRFiwltVi6fH_41CWZHl33T4tsLYG666jKVSUTxyJZ1DWkyAzgbpUwebLqWMNmF-2QmKYnbN98eonbV_ViOGAe-_U31cqXgXD024SalWOl0TprzoAEtZfQaCgYKATASARMSFQEjDvL9BqRv90qWmxWVLY86gRH9mQ0165","expires_in":3594,"scope":"https:\/\/www.googleapis.com\/auth\/youtube https:\/\/www.googleapis.com\/auth\/youtube.readonly https:\/\/www.googleapis.com\/auth\/youtube.upload","token_type":"Bearer","created":1667301906}","2022-11-01 11:25:06");

