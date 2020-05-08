/*
 Navicat Premium Data Transfer

 Source Server         : STAR Dev
 Source Server Type    : MySQL
 Source Server Version : 100407
 Source Host           : 10.106.1.120:3306
 Source Schema         : star_core

 Target Server Type    : MySQL
 Target Server Version : 100407
 File Encoding         : 65001

 Date: 20/12/2019 15:09:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subject_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `causer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `causer_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `activity_log_log_name_index`(`log_name`) USING BTREE,
  INDEX `subject`(`subject_id`, `subject_type`) USING BTREE,
  INDEX `causer`(`causer_id`, `causer_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for applications
-- ----------------------------
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of applications
-- ----------------------------
INSERT INTO `applications` VALUES ('8f62e302-ed63-4222-bde0-f183060a3c80', 'Eagle Eye', 'Administration application', 'fa fa-cogs', 'http://app.master', '2019-12-17 10:13:01', '2019-12-18 13:05:26');
INSERT INTO `applications` VALUES ('8f659488-b0bc-4035-a5e9-162615abf360', 'Admissions', NULL, 'fa fa-list', 'http://admission.apc.edu.ph', '2019-12-18 18:21:04', '2019-12-18 18:21:04');

-- ----------------------------
-- Table structure for audits
-- ----------------------------
DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `new_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tags` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `audits_auditable_type_auditable_id_index`(`auditable_type`, `auditable_id`) USING BTREE,
  INDEX `audits_user_id_user_type_index`(`user_id`, `user_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_group_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_link_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'list',
  `active_pattern` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On',
  `permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `links_application_id_foreign`(`application_id`) USING BTREE,
  INDEX `links_resource_group_id_foreign`(`resource_group_id`) USING BTREE,
  INDEX `links_permission_id_foreign`(`permission_id`) USING BTREE,
  CONSTRAINT `links_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `links_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `links_resource_group_id_foreign` FOREIGN KEY (`resource_group_id`) REFERENCES `resource_groups` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('8f62e302-fee1-4f8b-918f-cbd3ff783651', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Links', NULL, '/link', 'fa fa-link', '/link*', 0, 'On', '8f633925-ba42-4a2a-b218-1b7569111948', '2019-12-17 10:13:01', '2019-12-18 12:06:29');
INSERT INTO `links` VALUES ('8f62e8fb-6054-4fab-84a9-e22f5c0f93b2', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Users', NULL, '/user', 'fa fa-users', '/user*', 0, 'On', '8f650e59-0507-4964-aa7a-305e60e750c9', '2019-12-17 10:29:43', '2019-12-18 12:13:52');
INSERT INTO `links` VALUES ('8f62e94e-1a21-4075-bace-f8931c7a5409', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Roles', NULL, '/role', 'fa fa-user-tag', '/role*', 0, 'On', '8f634321-763c-4b2f-9980-1946e75058c9', '2019-12-17 10:30:37', '2019-12-18 12:14:09');
INSERT INTO `links` VALUES ('8f62e994-4b73-40ca-885a-693c18fd98a2', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Permissions', NULL, '/permission', 'fa fa-user-shield', '/permission*', 0, 'On', '8f650502-ad0c-49d6-acd5-ac472719ca9a', '2019-12-17 10:31:23', '2019-12-18 12:14:22');
INSERT INTO `links` VALUES ('8f62e9f0-d984-4818-9caf-8bfa504312c7', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Groups', NULL, '/resourcegroup', 'fa fa-folder-open', '/resourcegroup*', 0, 'On', '8f65061a-419e-468a-9940-54b331ff3c90', '2019-12-17 10:32:24', '2019-12-18 12:14:39');
INSERT INTO `links` VALUES ('8f62ea23-fc27-4fc2-8225-9ad66119ea2f', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Applications', NULL, '/application', 'fa fa-list', '/application', 0, 'On', '8f650420-5d61-4339-b61e-c5a0726708a2', '2019-12-17 10:32:57', '2019-12-18 12:15:25');
INSERT INTO `links` VALUES ('8f62ea7a-9902-4b86-bbd1-525e58389ab9', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'Telescope', NULL, '/telescope', 'fa fa-stethoscope', '/telescope', 100, 'On', NULL, '2019-12-17 10:33:54', '2019-12-18 16:44:50');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (8, '2018_08_08_100000_create_telescope_entries_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (10, '2019_11_28_01836_create_applications_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_11_29_014024_create_resource_groups_table', 1);
INSERT INTO `migrations` VALUES (12, '2019_11_29_092745_create_activity_log_table', 1);
INSERT INTO `migrations` VALUES (13, '2019_11_29_092745_create_audits_table', 1);
INSERT INTO `migrations` VALUES (14, '2019_11_29_092745_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (15, '2019_11_29_093751_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (16, '2019_11_29_110558_create_links_table', 1);
INSERT INTO `migrations` VALUES (17, '2019_12_02_045001_create_settings_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('8f62e301-d6e6-4e6a-8d7c-ac43c86f2720', 'Modules\\User\\Entities\\User', '173645d9-a98c-49ac-99b6-6f78f4de2deb');
INSERT INTO `model_has_roles` VALUES ('8f62e301-d6e6-4e6a-8d7c-ac43c86f2720', 'Modules\\User\\Entities\\User', '8f62e301-9ee0-4cf3-a838-8b2b42b565b5');
INSERT INTO `model_has_roles` VALUES ('8f62e302-609a-4b9c-9e33-0053c7c17348', 'Modules\\User\\Entities\\User', '8f62e301-9ee0-4cf3-a838-8b2b42b565b5');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `client_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_personal_access_clients_client_id_index`(`client_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource_group_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `permissions_application_id_foreign`(`application_id`) USING BTREE,
  INDEX `permissions_resource_group_id_foreign`(`resource_group_id`) USING BTREE,
  INDEX `permissions_name_index`(`name`) USING BTREE,
  CONSTRAINT `permissions_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `permissions_resource_group_id_foreign` FOREIGN KEY (`resource_group_id`) REFERENCES `resource_groups` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('8f6323d2-434c-4d54-867c-c2a393deeb4f', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f633925-ba42-4a2a-b218-1b7569111948', 'create-link', 'api', 'Create Link', NULL, 'Yes', '2019-12-17 13:14:15', '2019-12-17 14:39:14');
INSERT INTO `permissions` VALUES ('8f6337e0-5f43-4a43-b11f-74d03f3df22d', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f633925-ba42-4a2a-b218-1b7569111948', 'edit-link', 'web', 'Edit Link', NULL, 'Yes', '2019-12-17 14:10:19', '2019-12-17 14:40:38');
INSERT INTO `permissions` VALUES ('8f6337fd-b63f-48b2-8e4f-d730b1c1a995', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f633925-ba42-4a2a-b218-1b7569111948', 'delete-link', 'web', 'Delete Link', NULL, 'Yes', '2019-12-17 14:10:39', '2019-12-17 14:40:29');
INSERT INTO `permissions` VALUES ('8f633925-ba42-4a2a-b218-1b7569111948', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-link', 'web', 'Links', NULL, 'Yes', '2019-12-17 14:13:53', '2019-12-18 12:02:22');
INSERT INTO `permissions` VALUES ('8f634321-763c-4b2f-9980-1946e75058c9', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-role', 'web', 'Roles', NULL, 'Yes', '2019-12-17 14:41:48', '2019-12-18 12:02:06');
INSERT INTO `permissions` VALUES ('8f634345-7416-49fc-b77a-d7eb0feebbba', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f634321-763c-4b2f-9980-1946e75058c9', 'create-role', 'web', 'Create Role', NULL, 'Yes', '2019-12-17 14:42:11', '2019-12-17 14:42:11');
INSERT INTO `permissions` VALUES ('8f650346-88c9-41b5-b374-e3e2c1550cdc', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f634321-763c-4b2f-9980-1946e75058c9', 'edit-role', 'web', 'Edit Role', NULL, 'Yes', '2019-12-18 11:34:54', '2019-12-18 11:34:54');
INSERT INTO `permissions` VALUES ('8f650368-b1d3-46d5-994d-bb2d4c0f0ad4', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f634321-763c-4b2f-9980-1946e75058c9', 'delete-role', 'web', 'Delete Role', NULL, 'Yes', '2019-12-18 11:35:16', '2019-12-18 11:35:16');
INSERT INTO `permissions` VALUES ('8f650420-5d61-4339-b61e-c5a0726708a2', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-application', 'web', 'Applications', NULL, 'Yes', '2019-12-18 11:37:16', '2019-12-18 12:01:46');
INSERT INTO `permissions` VALUES ('8f65045b-4cf9-4085-870b-9fa75fb0feda', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650420-5d61-4339-b61e-c5a0726708a2', 'create-application', 'web', 'Create Application', NULL, 'Yes', '2019-12-18 11:37:55', '2019-12-18 11:37:55');
INSERT INTO `permissions` VALUES ('8f65047c-c962-4d24-90e1-4097e17706ee', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650420-5d61-4339-b61e-c5a0726708a2', 'edit-application', 'web', 'Edit Application', NULL, 'Yes', '2019-12-18 11:38:17', '2019-12-18 11:38:17');
INSERT INTO `permissions` VALUES ('8f6504cd-ddc1-47d0-9012-20b1d6a98ee3', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650420-5d61-4339-b61e-c5a0726708a2', 'delete-application', 'web', 'Delete Application', NULL, 'Yes', '2019-12-18 11:39:10', '2019-12-18 11:39:10');
INSERT INTO `permissions` VALUES ('8f650502-ad0c-49d6-acd5-ac472719ca9a', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-permission', 'web', 'Permissions', NULL, 'Yes', '2019-12-18 11:39:45', '2019-12-18 12:03:08');
INSERT INTO `permissions` VALUES ('8f650533-bca3-4d16-8574-262a45ffee63', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650502-ad0c-49d6-acd5-ac472719ca9a', 'create-permission', 'web', 'Create Permission', NULL, 'Yes', '2019-12-18 11:40:17', '2019-12-18 11:40:17');
INSERT INTO `permissions` VALUES ('8f65054e-8415-495b-9afd-d7b2fe634159', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650502-ad0c-49d6-acd5-ac472719ca9a', 'edit-permission', 'web', 'Edit Permission', NULL, 'Yes', '2019-12-18 11:40:35', '2019-12-18 11:40:35');
INSERT INTO `permissions` VALUES ('8f650596-4a01-4d7e-9197-6c8116740605', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f650502-ad0c-49d6-acd5-ac472719ca9a', 'delete-permission', 'web', 'Delete Permission', NULL, 'Yes', '2019-12-18 11:41:22', '2019-12-18 11:41:22');
INSERT INTO `permissions` VALUES ('8f65061a-419e-468a-9940-54b331ff3c90', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-resource-group', 'web', 'Resource Groups', NULL, 'Yes', '2019-12-18 11:42:48', '2019-12-18 12:03:27');
INSERT INTO `permissions` VALUES ('8f650657-5e1f-49de-b939-d3be9fac5c48', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f65061a-419e-468a-9940-54b331ff3c90', 'edit-resource-group', 'web', 'Edit Resource Group', NULL, 'Yes', '2019-12-18 11:43:28', '2019-12-18 11:43:28');
INSERT INTO `permissions` VALUES ('8f650680-552c-4ff2-8a2d-0bfc790660f3', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f65061a-419e-468a-9940-54b331ff3c90', 'create-resource-group', 'web', 'Create Resource Group', NULL, 'Yes', '2019-12-18 11:43:55', '2019-12-18 11:43:55');
INSERT INTO `permissions` VALUES ('8f65069a-f4ef-45f2-a8f3-7e81697c176d', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', '8f65061a-419e-468a-9940-54b331ff3c90', 'delete-resource-group', 'web', 'Delete Resource Group', NULL, 'Yes', '2019-12-18 11:44:12', '2019-12-18 11:44:12');
INSERT INTO `permissions` VALUES ('8f650e59-0507-4964-aa7a-305e60e750c9', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'view-user', 'web', 'Users', NULL, 'Yes', '2019-12-18 12:05:51', '2019-12-18 12:05:51');
INSERT INTO `permissions` VALUES ('8f651876-da11-45c5-b330-4c9f03d07613', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f6563ac-0372-4a04-9e27-81a2a960d6ce', NULL, 'access-telescope', 'web', 'Laravel Telescope', NULL, 'Yes', '2019-12-18 12:34:09', '2019-12-18 16:45:08');
INSERT INTO `permissions` VALUES ('8f654cc8-8336-4b44-8173-2c8720b7d575', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'impersonate-user', 'web', 'Impersonate User', NULL, 'Yes', '2019-12-18 15:00:26', '2019-12-18 15:00:26');
INSERT INTO `permissions` VALUES ('8f6594df-9150-4c70-9eb8-fa99ca82b2a8', '8f659488-b0bc-4035-a5e9-162615abf360', '8f6594ab-2386-4326-ad11-96dba382ae8b', NULL, 'create-applicant', 'web', 'Create Applicant', NULL, 'Yes', '2019-12-18 18:22:01', '2019-12-18 18:22:01');
INSERT INTO `permissions` VALUES ('8f679f32-4c41-4d71-ac4f-f1665fed60d3', '8f62e302-ed63-4222-bde0-f183060a3c80', '8f62e302-f618-4b64-ad49-d4559860b49f', NULL, 'assign-user-roles', 'web', 'Assign User Roles', NULL, 'Yes', '2019-12-19 18:42:32', '2019-12-19 18:42:32');

-- ----------------------------
-- Table structure for resource_groups
-- ----------------------------
DROP TABLE IF EXISTS `resource_groups`;
CREATE TABLE `resource_groups`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'list',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `resource_groups_application_id_foreign`(`application_id`) USING BTREE,
  CONSTRAINT `resource_groups_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resource_groups
-- ----------------------------
INSERT INTO `resource_groups` VALUES ('8f62e302-f618-4b64-ad49-d4559860b49f', '8f62e302-ed63-4222-bde0-f183060a3c80', 'Administration', NULL, 'fa fa-cogs', '2019-12-17 10:13:01', NULL);
INSERT INTO `resource_groups` VALUES ('8f6563ac-0372-4a04-9e27-81a2a960d6ce', '8f62e302-ed63-4222-bde0-f183060a3c80', 'Minions', NULL, 'fa-fa-list', '2019-12-18 16:04:26', '2019-12-18 16:04:26');
INSERT INTO `resource_groups` VALUES ('8f6594ab-2386-4326-ad11-96dba382ae8b', '8f659488-b0bc-4035-a5e9-162615abf360', 'Front Liners', NULL, 'fa-fa-list', '2019-12-18 18:21:27', '2019-12-18 18:21:27');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('8f6323d2-434c-4d54-867c-c2a393deeb4f', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f6337e0-5f43-4a43-b11f-74d03f3df22d', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f6337fd-b63f-48b2-8e4f-d730b1c1a995', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f633925-ba42-4a2a-b218-1b7569111948', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f634321-763c-4b2f-9980-1946e75058c9', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f634345-7416-49fc-b77a-d7eb0feebbba', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650346-88c9-41b5-b374-e3e2c1550cdc', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650368-b1d3-46d5-994d-bb2d4c0f0ad4', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650420-5d61-4339-b61e-c5a0726708a2', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f65045b-4cf9-4085-870b-9fa75fb0feda', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f65047c-c962-4d24-90e1-4097e17706ee', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f6504cd-ddc1-47d0-9012-20b1d6a98ee3', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650502-ad0c-49d6-acd5-ac472719ca9a', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650533-bca3-4d16-8574-262a45ffee63', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f65054e-8415-495b-9afd-d7b2fe634159', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650596-4a01-4d7e-9197-6c8116740605', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f65061a-419e-468a-9940-54b331ff3c90', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650657-5e1f-49de-b939-d3be9fac5c48', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650680-552c-4ff2-8a2d-0bfc790660f3', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f65069a-f4ef-45f2-a8f3-7e81697c176d', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650e59-0507-4964-aa7a-305e60e750c9', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f650e59-0507-4964-aa7a-305e60e750c9', '8f62e302-609a-4b9c-9e33-0053c7c17348');
INSERT INTO `role_has_permissions` VALUES ('8f651876-da11-45c5-b330-4c9f03d07613', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f651876-da11-45c5-b330-4c9f03d07613', '8f62e302-609a-4b9c-9e33-0053c7c17348');
INSERT INTO `role_has_permissions` VALUES ('8f654cc8-8336-4b44-8173-2c8720b7d575', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f654cc8-8336-4b44-8173-2c8720b7d575', '8f62e302-609a-4b9c-9e33-0053c7c17348');
INSERT INTO `role_has_permissions` VALUES ('8f6594df-9150-4c70-9eb8-fa99ca82b2a8', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f6594df-9150-4c70-9eb8-fa99ca82b2a8', '8f62e302-609a-4b9c-9e33-0053c7c17348');
INSERT INTO `role_has_permissions` VALUES ('8f679f32-4c41-4d71-ac4f-f1665fed60d3', '8f62e301-d6e6-4e6a-8d7c-ac43c86f2720');
INSERT INTO `role_has_permissions` VALUES ('8f679f32-4c41-4d71-ac4f-f1665fed60d3', '8f62e302-609a-4b9c-9e33-0053c7c17348');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `roles_name_index`(`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('8f62e301-d6e6-4e6a-8d7c-ac43c86f2720', 'Super Admin', 'web', 'Super administrator rights', '2019-12-17 10:13:01', NULL);
INSERT INTO `roles` VALUES ('8f62e302-609a-4b9c-9e33-0053c7c17348', 'Admin', 'web', 'Administrator rights', '2019-12-17 10:13:01', '2019-12-20 10:35:33');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE INDEX `sessions_id_unique`(`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('vSDFsEM8VNNjKyoipY91rfHMGdCzHSv8y5w2VoJg', '173645d9-a98c-49ac-99b6-6f78f4de2deb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2EzNU9KY2FBdU53NktOTmtIWTZUQ0gzVmM0ZzZEaEtHOHNsc3pFTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovL2FwcC5tYXN0ZXIvbGluay9jcmVhdGUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovL2FwcC5tYXN0ZXIvYXBwbGljYXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiMTczNjQ1ZDktYTk4Yy00OWFjLTk5YjYtNmY3OGY0ZGUyZGViIjt9', 1576823602);
INSERT INTO `sessions` VALUES ('x3t8AvvskssM42NydcHZzvlPO2BaE0SCIxf5lKy2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36', 'YToxOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1576819714);

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for telescope_entries
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE `telescope_entries`  (
  `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`sequence`) USING BTREE,
  UNIQUE INDEX `telescope_entries_uuid_unique`(`uuid`) USING BTREE,
  INDEX `telescope_entries_batch_id_index`(`batch_id`) USING BTREE,
  INDEX `telescope_entries_type_should_display_on_index_index`(`type`, `should_display_on_index`) USING BTREE,
  INDEX `telescope_entries_family_hash_index`(`family_hash`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for telescope_entries_tags
-- ----------------------------
DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE `telescope_entries_tags`  (
  `entry_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  INDEX `telescope_entries_tags_entry_uuid_tag_index`(`entry_uuid`, `tag`) USING BTREE,
  INDEX `telescope_entries_tags_tag_index`(`tag`) USING BTREE,
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for telescope_monitoring
-- ----------------------------
DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE `telescope_monitoring`  (
  `tag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE,
  UNIQUE INDEX `users_id_number_unique`(`id_number`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('173645d9-a98c-49ac-99b6-6f78f4de2deb', 'bravod', '2017-00027', 'Employee', 'Heremias Delos Santos III', 'Heremias', 'Oczon', 'Delos Santos III', 'bravod@apc.edu.ph', NULL, '$2y$10$ce7HejMXL985b14fWL9JnO4ovgNpmUtXsNvxjauyAP4o4n9mwrfzK', NULL, '2019-12-18 14:53:03', '2019-12-18 14:53:03', NULL);
INSERT INTO `users` VALUES ('8f62e301-9ee0-4cf3-a838-8b2b42b565b5', 'superadmin', '0000-00000', 'Employee', 'Super Admin', 'Super', '', 'Admin', 'superadmin@apc.edu.ph', NULL, '$2y$10$M1Jdb3RnPtQSXW6QZhrQL.4vIU98UUY0VdU28cAWCSYyL6eRxhnza', NULL, '2019-12-17 10:13:01', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
