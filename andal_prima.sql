/*
 Navicat Premium Data Transfer

 Source Server         : db lokal
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : andal_prima

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 26/11/2024 09:32:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Admin', 'admin@example.com', '$2y$12$R8Stwo4RE8dxIfQxHHSOGe5DrflCYUAvr8ZeAHtrXqYqEAyB8hGKe', '2024-08-19 10:20:13', '2024-08-19 10:20:13');

-- ----------------------------
-- Table structure for booking_dropship_identities
-- ----------------------------
DROP TABLE IF EXISTS `booking_dropship_identities`;
CREATE TABLE `booking_dropship_identities`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int UNSIGNED NOT NULL,
  `ktp_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bank_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_account_number` bigint NULL DEFAULT NULL,
  `bank_account_holder_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of booking_dropship_identities
-- ----------------------------
INSERT INTO `booking_dropship_identities` VALUES (1, 1, NULL, 'BCA', 123412412, 'name orang bank', '2024-08-20 22:48:46', NULL, NULL);

-- ----------------------------
-- Table structure for booking_items
-- ----------------------------
DROP TABLE IF EXISTS `booking_items`;
CREATE TABLE `booking_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_variant_id` int UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL,
  `price` int NULL DEFAULT NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `qty` int NOT NULL,
  `product_variant_item_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of booking_items
-- ----------------------------
INSERT INTO `booking_items` VALUES (1, 18, 1, 1000000, 'tes note', '2024-08-20 22:46:12', NULL, NULL, 12, 11);
INSERT INTO `booking_items` VALUES (3, 19, 1, 500000, 'oke', '2024-08-20 22:46:12', NULL, NULL, 5, 14);
INSERT INTO `booking_items` VALUES (4, 1, 2, 150, 'Please handle with care', '2024-08-22 15:40:08', NULL, NULL, 2, 1);
INSERT INTO `booking_items` VALUES (5, 2, 2, 75, NULL, '2024-08-22 15:40:08', NULL, NULL, 1, 3);
INSERT INTO `booking_items` VALUES (6, 1, 3, 150, 'Please handle with care', '2024-08-22 15:47:35', NULL, NULL, 2, 1);
INSERT INTO `booking_items` VALUES (7, 2, 3, 75, NULL, '2024-08-22 15:47:35', NULL, NULL, 1, 3);
INSERT INTO `booking_items` VALUES (8, 1, 4, 150, 'Please handle with care', '2024-10-28 03:40:45', NULL, NULL, 2, 1);
INSERT INTO `booking_items` VALUES (9, 2, 4, 75, NULL, '2024-10-28 03:40:45', NULL, NULL, 1, 3);
INSERT INTO `booking_items` VALUES (10, 9, 8, 4500000, 'null', '2024-11-25 17:12:52', NULL, NULL, 5, NULL);
INSERT INTO `booking_items` VALUES (11, 1, 8, 20000000, '15x15', '2024-11-25 17:12:52', NULL, NULL, 2, 1);
INSERT INTO `booking_items` VALUES (12, 1, 8, 20000000, '1.1mm', '2024-11-25 17:12:52', NULL, NULL, 2, 2);

-- ----------------------------
-- Table structure for booking_shippings
-- ----------------------------
DROP TABLE IF EXISTS `booking_shippings`;
CREATE TABLE `booking_shippings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int UNSIGNED NULL DEFAULT NULL,
  `shipping_id` int UNSIGNED NULL DEFAULT NULL,
  `price` int NULL DEFAULT NULL,
  `shipping_district_id` int UNSIGNED NULL DEFAULT NULL,
  `shipping_subdistrict_id` int UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of booking_shippings
-- ----------------------------
INSERT INTO `booking_shippings` VALUES (1, 1, 1, 300000, 27, 1, '2024-08-20 22:13:00', NULL, NULL);
INSERT INTO `booking_shippings` VALUES (2, 2, NULL, NULL, 5, 3, '2024-08-22 15:40:08', NULL, NULL);
INSERT INTO `booking_shippings` VALUES (3, 3, NULL, NULL, 5, 3, '2024-08-22 15:47:35', NULL, NULL);
INSERT INTO `booking_shippings` VALUES (4, 4, NULL, NULL, 5, 3, '2024-10-28 03:40:45', NULL, NULL);
INSERT INTO `booking_shippings` VALUES (8, 8, NULL, NULL, 45, NULL, '2024-11-25 17:12:52', NULL, NULL);

-- ----------------------------
-- Table structure for booking_status
-- ----------------------------
DROP TABLE IF EXISTS `booking_status`;
CREATE TABLE `booking_status`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of booking_status
-- ----------------------------
INSERT INTO `booking_status` VALUES (1, 'Order Receipt', '#FFD700');
INSERT INTO `booking_status` VALUES (2, 'Paid', '#32CD32');
INSERT INTO `booking_status` VALUES (3, 'Ship', '#1E90FF');
INSERT INTO `booking_status` VALUES (4, 'Confirmed', '#008000');
INSERT INTO `booking_status` VALUES (5, 'Delivered', '#4B0082');
INSERT INTO `booking_status` VALUES (6, 'Edit', '#FFA500');
INSERT INTO `booking_status` VALUES (7, 'Reject', '#FF4500');

-- ----------------------------
-- Table structure for booking_status_histories
-- ----------------------------
DROP TABLE IF EXISTS `booking_status_histories`;
CREATE TABLE `booking_status_histories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `booking_status_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of booking_status_histories
-- ----------------------------
INSERT INTO `booking_status_histories` VALUES (1, 1, 1, '2024-05-01 02:29:50', NULL);
INSERT INTO `booking_status_histories` VALUES (2, 1, 2, '2024-04-30 21:18:24', NULL);
INSERT INTO `booking_status_histories` VALUES (3, 1, 3, '2024-04-30 21:24:26', NULL);
INSERT INTO `booking_status_histories` VALUES (4, 1, 1, '2024-05-01 02:55:18', NULL);
INSERT INTO `booking_status_histories` VALUES (5, 1, 2, '2024-05-01 02:55:28', NULL);
INSERT INTO `booking_status_histories` VALUES (6, 1, 3, '2024-05-01 04:35:53', NULL);
INSERT INTO `booking_status_histories` VALUES (7, 2, 2, '2024-05-01 16:32:57', NULL);
INSERT INTO `booking_status_histories` VALUES (8, 1, 3, '2024-05-01 16:34:05', NULL);
INSERT INTO `booking_status_histories` VALUES (9, 1, 2, '2024-08-22 10:08:30', '2024-08-22 10:08:30');
INSERT INTO `booking_status_histories` VALUES (10, 3, 2, '2024-08-22 15:47:35', NULL);
INSERT INTO `booking_status_histories` VALUES (11, 3, 4, '2024-10-11 10:12:53', '2024-10-11 10:12:53');
INSERT INTO `booking_status_histories` VALUES (12, 1, 6, '2024-10-11 10:23:54', '2024-10-11 10:23:54');
INSERT INTO `booking_status_histories` VALUES (13, 3, 7, '2024-10-11 10:28:49', '2024-10-11 10:28:49');
INSERT INTO `booking_status_histories` VALUES (14, 3, 2, '2024-10-11 11:04:19', '2024-10-11 11:04:19');
INSERT INTO `booking_status_histories` VALUES (15, 3, 5, '2024-10-11 11:04:45', '2024-10-11 11:04:45');
INSERT INTO `booking_status_histories` VALUES (16, 1, 4, '2024-10-11 11:04:59', '2024-10-11 11:04:59');
INSERT INTO `booking_status_histories` VALUES (17, 3, 6, '2024-10-11 16:23:40', '2024-10-11 16:23:40');
INSERT INTO `booking_status_histories` VALUES (18, 3, 5, '2024-10-11 16:53:33', '2024-10-11 16:53:33');
INSERT INTO `booking_status_histories` VALUES (19, 4, 2, '2024-10-28 03:40:45', NULL);
INSERT INTO `booking_status_histories` VALUES (20, 8, 2, '2024-11-25 17:12:52', NULL);

-- ----------------------------
-- Table structure for bookings
-- ----------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_type_id` int UNSIGNED NULL DEFAULT NULL,
  `client_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone_number` bigint NOT NULL,
  `client_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `npwp` bigint NULL DEFAULT NULL,
  `ongkir` int NULL DEFAULT NULL,
  `shipping_area_id` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_pos` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `additional_price_percentage` int NULL DEFAULT NULL,
  `commission_percentage` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bookings
-- ----------------------------
INSERT INTO `bookings` VALUES (1, 1, 'Hans', 82123456574, 'hans@mail.com', NULL, 300000, 4, 'Jl. Kesehatan, No.25, Karang Ranji', 44327, '2024-05-01 01:44:20', NULL, NULL, NULL, NULL);
INSERT INTO `bookings` VALUES (2, 1, 'John Doe', 123456789, 'john@example.com', NULL, NULL, 5, '123 Main St', 12345, '2024-08-22 15:40:08', NULL, NULL, NULL, NULL);
INSERT INTO `bookings` VALUES (3, 1, 'John Doe', 123456789, 'john@example.com', NULL, NULL, 5, '123 Main St', 12345, '2024-08-22 15:47:35', NULL, NULL, NULL, NULL);
INSERT INTO `bookings` VALUES (4, 1, 'John Doe', 123456789, 'john@example.com', NULL, NULL, 5, '123 Main St', 12345, '2024-10-28 03:40:45', NULL, NULL, NULL, NULL);
INSERT INTO `bookings` VALUES (8, 1, 'habibi', 8574821232, 'buds@gmail.com', NULL, NULL, 6, 'ssda', 322134, '2024-11-25 17:12:52', NULL, NULL, 24500000, NULL);

-- ----------------------------
-- Table structure for client_types
-- ----------------------------
DROP TABLE IF EXISTS `client_types`;
CREATE TABLE `client_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of client_types
-- ----------------------------
INSERT INTO `client_types` VALUES (1, 'End User');
INSERT INTO `client_types` VALUES (2, 'Dropship');

-- ----------------------------
-- Table structure for markup_and_commisions
-- ----------------------------
DROP TABLE IF EXISTS `markup_and_commisions`;
CREATE TABLE `markup_and_commisions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `additional_price_percentage` int NULL DEFAULT NULL,
  `commission_percentage` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_type_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of markup_and_commisions
-- ----------------------------
INSERT INTO `markup_and_commisions` VALUES (1, 5, 3, '2024-08-17 13:15:40', '2024-08-17 13:15:40', 2);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (4, '2024_08_14_154521_create_user_roles_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_08_14_154522_create_users_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_08_15_152141_create_products_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_08_15_154038_create_product_types_table', 2);
INSERT INTO `migrations` VALUES (8, '2024_08_15_155104_create_product_variants_table', 3);
INSERT INTO `migrations` VALUES (9, '2024_08_15_155412_create_product_variant_items_table', 4);
INSERT INTO `migrations` VALUES (10, '2024_08_16_140956_create_sessions_table', 5);
INSERT INTO `migrations` VALUES (11, '2024_08_17_115026_create_shippings_table', 6);
INSERT INTO `migrations` VALUES (12, '2024_08_17_115802_create_shipping_areas_table', 7);
INSERT INTO `migrations` VALUES (14, '2024_08_17_121428_create_shipping_districts_table', 8);
INSERT INTO `migrations` VALUES (15, '2024_08_17_121917_create_shipping_subdistricts_table', 9);
INSERT INTO `migrations` VALUES (16, '2024_08_17_124039_create_variant_item_types_table', 9);
INSERT INTO `migrations` VALUES (17, '2024_08_17_131443_create_markup_and_commisions_table', 10);
INSERT INTO `migrations` VALUES (18, '2024_08_17_131751_create_client_types_table', 11);
INSERT INTO `migrations` VALUES (19, '2024_08_17_132059_create_booking_status_histories_table', 12);
INSERT INTO `migrations` VALUES (20, '2024_08_17_132242_create_booking_statuses_table', 13);
INSERT INTO `migrations` VALUES (21, '2024_08_17_141142_create_booking_dropship_identities_table', 14);
INSERT INTO `migrations` VALUES (22, '2024_08_17_141155_create_booking_items_table', 14);
INSERT INTO `migrations` VALUES (23, '2024_08_17_141202_create_booking_shippings_table', 14);
INSERT INTO `migrations` VALUES (24, '2024_08_17_141751_create_bookings_table', 15);
INSERT INTO `migrations` VALUES (25, '2024_08_18_163326_create_personal_access_tokens_table', 16);
INSERT INTO `migrations` VALUES (26, '2024_08_19_022414_create_thickness_types_table', 17);
INSERT INTO `migrations` VALUES (27, '2024_08_19_024509_create_personal_access_tokens_table', 18);
INSERT INTO `migrations` VALUES (28, '2024_08_19_024647_create_admins_table', 18);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (1, 'App\\Models\\Admin', 1, 'admin-token', 'cd03db9e8613dc4364b4eaebbaac021011100d1dc06486d653f37a376e16ba92', '*', NULL, NULL, '2024-10-08 23:32:59', '2024-11-26 09:30:02');

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_types
-- ----------------------------
INSERT INTO `product_types` VALUES (1, 'Besi', '2024-04-21 14:33:29', NULL, NULL);
INSERT INTO `product_types` VALUES (2, 'Struktural', '2024-04-21 16:04:29', NULL, NULL);
INSERT INTO `product_types` VALUES (3, 'test product type', '2024-08-19 16:43:10', NULL, NULL);

-- ----------------------------
-- Table structure for product_variant_items
-- ----------------------------
DROP TABLE IF EXISTS `product_variant_items`;
CREATE TABLE `product_variant_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `variant_item_type_id` int NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `add_price` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_variant_items_product_variant_id_foreign`(`product_variant_id` ASC) USING BTREE,
  CONSTRAINT `product_variant_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_variant_items
-- ----------------------------
INSERT INTO `product_variant_items` VALUES (1, 1, 1, '15x15', '2024-05-01 09:59:22', '2024-05-01 02:59:22', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (2, 1, 2, '1.1mm', '2024-05-01 09:59:22', '2024-05-01 02:59:22', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (3, 2, 1, '65 x 42 x 5,5 sni', '2024-05-01 01:37:16', '2024-04-30 18:37:16', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (4, 1, 1, '100m', '2024-05-01 09:59:22', '2024-05-01 02:59:22', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (5, 1, 1, '90CM', '2024-05-01 09:59:22', '2024-05-01 02:59:22', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (6, 14, 1, '12', '2024-04-30 16:33:44', '2024-04-30 16:33:44', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (7, 14, 1, '111', '2024-04-30 16:33:44', '2024-04-30 16:33:44', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (8, 15, 1, '123', '2024-04-30 16:34:19', '2024-04-30 16:34:19', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (9, 16, 1, '1x1m', '2024-04-30 17:01:54', '2024-04-30 17:01:54', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (10, 16, 1, '10cm', '2024-04-30 17:01:54', '2024-04-30 17:01:54', NULL, NULL);
INSERT INTO `product_variant_items` VALUES (11, 18, 2, 'tes varian 1 item name 1', '2024-08-19 16:21:39', NULL, NULL, NULL);
INSERT INTO `product_variant_items` VALUES (12, 18, 2, 'tes varian 1 item name 2', '2024-08-19 16:21:39', NULL, NULL, NULL);
INSERT INTO `product_variant_items` VALUES (13, 19, 2, 'tes varian 2 item name 1', '2024-08-19 16:21:39', NULL, NULL, NULL);
INSERT INTO `product_variant_items` VALUES (14, 19, 1, 'tes varian 2 item name 2', '2024-08-19 16:21:39', NULL, NULL, NULL);
INSERT INTO `product_variant_items` VALUES (15, 20, 3, 'tes varian 3 item name 1', '2024-08-20 03:05:30', NULL, NULL, 1000.00);
INSERT INTO `product_variant_items` VALUES (16, 20, 3, 'tes varian 3 item name 2', '2024-08-20 03:05:30', NULL, NULL, 1200.00);
INSERT INTO `product_variant_items` VALUES (17, 21, 2, 'tes varian 4 item name 1', '2024-08-20 03:05:30', NULL, NULL, 300.00);
INSERT INTO `product_variant_items` VALUES (18, 21, 1, 'tes varian 4 item name 2', '2024-08-20 03:05:30', NULL, NULL, 400.00);
INSERT INTO `product_variant_items` VALUES (19, 23, 3, 'iki bagus', '2024-09-06 13:53:38', NULL, NULL, 10000.00);
INSERT INTO `product_variant_items` VALUES (20, 23, 3, 'iki mntp', '2024-09-06 13:53:38', NULL, NULL, 12000.00);
INSERT INTO `product_variant_items` VALUES (21, 23, 1, 'iki kandel', '2024-09-06 13:53:38', NULL, NULL, 15000.00);
INSERT INTO `product_variant_items` VALUES (22, 23, 1, 'iki tipis', '2024-09-06 13:53:38', NULL, NULL, 20000.00);
INSERT INTO `product_variant_items` VALUES (23, 24, 2, '2mm', '2024-09-06 13:53:38', NULL, NULL, 30000.00);
INSERT INTO `product_variant_items` VALUES (24, 24, 2, '3m', '2024-09-06 13:53:38', NULL, NULL, 35000.00);
INSERT INTO `product_variant_items` VALUES (25, 24, 2, '2x3m', '2024-09-06 13:53:38', NULL, NULL, 37000.00);
INSERT INTO `product_variant_items` VALUES (26, 24, 1, 'okeh', '2024-09-06 13:53:38', NULL, NULL, 40000.00);
INSERT INTO `product_variant_items` VALUES (27, 25, 2, '30m', '2024-10-13 16:30:41', NULL, NULL, 0.00);
INSERT INTO `product_variant_items` VALUES (28, 25, 1, '23', '2024-10-13 16:30:41', NULL, NULL, 200.00);
INSERT INTO `product_variant_items` VALUES (29, 26, 3, '20', '2024-10-13 16:30:41', NULL, NULL, 2000.00);

-- ----------------------------
-- Table structure for product_variants
-- ----------------------------
DROP TABLE IF EXISTS `product_variants`;
CREATE TABLE `product_variants`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price` int NOT NULL,
  `descriptions` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `po_status` tinyint NOT NULL DEFAULT 0,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_variants_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_variants
-- ----------------------------
INSERT INTO `product_variants` VALUES (1, 'Hollow Besi 15 x 15', 10000000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 1, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (2, 'SNI', 1000000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 1, 3, '2024-09-05 22:28:55', '2024-04-30 18:37:16', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (9, 'Varian Baru', 900000, 'Pipa Besi 1” <br>', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (10, 'Varian Baru', 900000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (11, 'Varian Baru', 900000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (12, 'Varian Baru', 900000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (13, 'Coba Variant', 90000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (14, 'Cobs', 2000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (15, 'Hans', 90000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 2, '2024-09-05 22:28:55', '2024-05-01 02:59:22', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (16, 'Beton Super', 900000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 4, '2024-09-05 22:28:55', '2024-04-30 17:01:54', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (17, 'Sample Variant', 100000, 'This is a sample product variant', 1, 2, '2024-09-05 22:28:55', '2024-08-18 16:55:39', NULL, 'images/tY1dbFeCzQPC5IoH213dXt5hsfWiLy7bftlqTUQR.jpg', 100);
INSERT INTO `product_variants` VALUES (18, 'tes product variant 1', 1000000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 1, 5, '2024-09-05 22:28:55', NULL, NULL, 'http://127.0.0.1:8000/storage/images/4Q5XOHPmJ9ZOPtpaiYL1ct0Wo0PymcU6j1kWhtag.jpg', 100);
INSERT INTO `product_variants` VALUES (19, 'tes product variant 2', 1500000, 'Pipa Besi 1” <br>\r\n                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>\r\n                                untuk pipa asli toleransi +- 10% <br>\r\n                                light sni 2.6mm <br>\r\n                                med sni 3.2mm <br>\r\n                                welded sch40 3.4mm <br>\r\n                                seamless sch40 3.4mm', 0, 5, '2024-09-05 22:28:55', NULL, NULL, 'http://127.0.0.1:8000/storage/images/4Q5XOHPmJ9ZOPtpaiYL1ct0Wo0PymcU6j1kWhtag.jpg', 100);
INSERT INTO `product_variants` VALUES (20, 'tes product variant 3', 1000000, '5mm lebih mantep', 1, 7, '2024-09-05 22:28:55', NULL, NULL, 'http://127.0.0.1:8000/storage/images/24G6hCzOQI28f1sJ3fySXAqDH1kGNTcdWKfAEtgi.jpg', 100);
INSERT INTO `product_variants` VALUES (21, 'tes product variant 4', 1500000, '2mm lebih mantep juga', 0, 7, '2024-09-05 22:28:55', NULL, NULL, 'http://127.0.0.1:8000/storage/images/24G6hCzOQI28f1sJ3fySXAqDH1kGNTcdWKfAEtgi.jpg', 100);
INSERT INTO `product_variants` VALUES (23, 'atap marmer', 1000000, 'Pipa Besi 1” <br> Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>untuk pipa asli toleransi +- 10% <br>light sni 2.6mm <br>med sni 3.2mm <br>welded sch40 3.4mm <br>seamless sch40 3.4mm', 1, 8, '2024-09-06 21:46:09', NULL, NULL, 'http://127.0.0.1:8000/storage/images/24G6hCzOQI28f1sJ3fySXAqDH1kGNTcdWKfAEtgi.jpg', 200);
INSERT INTO `product_variants` VALUES (24, 'lantai besi', 1500000, 'Pipa Besi 1” <br> Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>untuk pipa asli toleransi +- 10% <br>light sni 2.6mm <br>med sni 3.2mm <br>welded sch40 3.4mm <br>seamless sch40 3.4mm', 0, 8, '2024-09-06 21:46:07', NULL, NULL, 'http://127.0.0.1:8000/storage/images/24G6hCzOQI28f1sJ3fySXAqDH1kGNTcdWKfAEtgi.jpg', 100);
INSERT INTO `product_variants` VALUES (25, 'varian 1', 20000, 'ini descipsi varian 1', 1, 9, '2024-11-24 21:30:01', NULL, NULL, 'http://127.0.0.1:8000/storage/images/qe6wZmSkyt2Q1sx01FIni9uf5EqapMHwnxC71oWN.jpg', 100);
INSERT INTO `product_variants` VALUES (26, 'varian 2 besi', 30000, 'ini descipsinya varain 2', 0, 9, '2024-11-24 21:30:08', NULL, NULL, 'http://127.0.0.1:8000/storage/images/G28gffmD20PTM6x9lIF2L0PlKRWZHSCyDnimyw34.jpg', 100);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_type_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (2, 'Hollow Besi', NULL, '2024-05-01 09:59:22', NULL, '2024-05-01 02:59:22', NULL, 1);
INSERT INTO `products` VALUES (3, 'unp besi sni', NULL, '2024-05-01 01:37:16', NULL, '2024-04-30 18:37:16', NULL, 2);
INSERT INTO `products` VALUES (4, 'Beton', NULL, '2024-04-30 17:01:54', NULL, '2024-04-30 17:01:54', NULL, 2);
INSERT INTO `products` VALUES (5, 'tes product', 1, '2024-08-19 16:21:39', NULL, NULL, NULL, 2);
INSERT INTO `products` VALUES (7, 'tes product 2', 1, '2024-08-20 03:05:30', NULL, NULL, NULL, 3);
INSERT INTO `products` VALUES (8, 'tes product 2', 1, '2024-09-06 13:53:38', NULL, NULL, NULL, 3);
INSERT INTO `products` VALUES (9, 'besi baru', 1, '2024-10-13 16:30:41', NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_activity` int NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('vfGl3ePnkmlFUCwSA8S2IvA9BasXZT7PsTvytwSQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFdzRWd0VmJxVWc0Zzh5TGNycXk3NjhGckZ3SVZxcGYwYnVQM3JwOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1732588203, NULL);
INSERT INTO `sessions` VALUES ('wmoL1JQSHDy9sGjtdP7Z2kjJ13fm6XcPBR2Sy2BM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3ZKOW1WcnBPeVdma3RkZFRVa1dUcmFETlg0ekRHd2ZnVVRsRDNzbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732555054, NULL);

-- ----------------------------
-- Table structure for shipping_areas
-- ----------------------------
DROP TABLE IF EXISTS `shipping_areas`;
CREATE TABLE `shipping_areas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shipping_areas
-- ----------------------------
INSERT INTO `shipping_areas` VALUES (1, 'Jakarta Pusat', '2024-03-27 16:22:02', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (2, 'Jakarta Timur', '2024-03-27 16:22:02', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (3, 'Jakarta Barat', '2024-03-27 16:22:18', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (4, 'Jakarta Selatan', '2024-03-27 16:22:18', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (5, 'Jakarta Utara', '2024-03-27 16:22:34', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (6, 'Kota Bekasi', '2024-03-27 16:29:36', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (7, 'Kab Bekasi', '2024-03-27 16:29:36', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (8, 'Kab Bogor', '2024-03-27 16:30:23', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (9, 'Kota Bogor', '2024-03-27 16:30:23', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (10, 'Kota Depok', '2024-03-27 16:30:52', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (11, 'Kota Tangerang', '2024-03-27 16:30:52', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (12, 'Kota Tangerang Selatan', '2024-03-27 16:31:35', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (13, 'Kab Tangerang', '2024-03-27 16:31:35', NULL, NULL);
INSERT INTO `shipping_areas` VALUES (14, 'Kab Serang', '2024-03-27 16:31:59', NULL, NULL);

-- ----------------------------
-- Table structure for shipping_districts
-- ----------------------------
DROP TABLE IF EXISTS `shipping_districts`;
CREATE TABLE `shipping_districts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipping_area_id` int UNSIGNED NOT NULL,
  `price` int UNSIGNED NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 207 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shipping_districts
-- ----------------------------
INSERT INTO `shipping_districts` VALUES (1, 5, 300000, 'Cilincing', '2024-03-27 16:24:20', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (2, 5, 300000, 'Kelapa Gading', '2024-03-27 16:24:20', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (3, 5, 300000, 'Koja', '2024-03-27 16:25:04', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (4, 5, 300000, 'Pademangan', '2024-03-27 16:25:04', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (5, 5, 200000, 'Penjaringan', '2024-03-27 16:25:43', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (6, 5, 300000, 'Tanjung Priok', '2024-03-27 16:25:43', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (7, 1, 300000, 'Cempaka Putih', '2024-03-27 16:26:25', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (8, 1, 300000, 'Gambir', '2024-03-27 16:26:25', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (9, 1, 300000, 'Johar Baru', '2024-03-27 16:26:53', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (10, 1, 300000, 'Kemayoran', '2024-03-27 16:26:53', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (11, 1, 300000, 'Menteng', '2024-03-27 16:27:33', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (12, 1, 300000, 'Sawah Besar', '2024-03-27 16:27:33', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (13, 1, 300000, 'Senen', '2024-03-27 16:28:03', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (14, 1, 150000, 'Tanah Abang', '2024-03-27 16:28:03', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (15, 2, 250000, 'Duren Sawit', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (16, 2, 250000, 'Jatinegara', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (17, 2, 250000, 'Kramat Jati', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (18, 2, 250000, 'Makasar', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (19, 2, 250000, 'Matraman', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (20, 2, 150000, 'Pasar Rebo', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (21, 2, 300000, 'Pulo Gadung', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (22, 2, 150000, 'Cipayung', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (23, 2, 150000, 'Ciracas', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (24, 2, 250000, 'Cakung', '2024-03-27 20:23:21', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (25, 4, 0, 'Kebayoran Baru', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (26, 4, 0, 'Kebayoran Lama', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (27, 4, 50000, 'Pesanggrahan', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (28, 4, 0, 'Cilandak', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (29, 4, 200000, 'Tebet', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (30, 4, 250000, 'Setiabudi', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (31, 4, 150000, 'Pasar Minggu', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (32, 4, 150000, 'Pancoran', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (33, 4, 150000, 'Jagakarsa', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (34, 4, 150000, 'Mampang Prapatan', '2024-03-27 20:38:27', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (35, 3, 0, 'Cengkareng', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (36, 3, 150000, 'Grogol', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (37, 3, 0, 'Kalideres', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (38, 3, 100000, 'Kebon Jeruk', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (39, 3, 0, 'Kembangan', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (40, 3, 150000, 'Palmerah', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (41, 3, 250000, 'Taman Sari', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (42, 3, 200000, 'Tambora', '2024-03-27 20:40:49', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (43, 6, 300000, 'Bantar Gebang', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (44, 6, 300000, 'Bekasi Barat', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (45, 6, 300000, 'Bekasi Selatan', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (46, 6, 300000, 'Bekasi Timur', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (47, 6, 300000, 'Bekasi Utara', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (48, 6, 300000, 'Jati Sampurna', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (49, 6, 300000, 'Jatiasih', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (50, 6, 300000, 'Medan Satria', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (51, 6, 300000, 'Mustika Jaya', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (52, 6, 250000, 'Pondok Gede', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (53, 6, 200000, 'Pondok Melati', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (54, 6, 300000, 'Rawalumbu', '2024-03-27 20:47:10', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (55, 7, 350000, 'Cibitung', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (56, 7, 400000, 'Cikarang Barat', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (57, 7, 600000, 'Cikarang Pusat', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (58, 7, 600000, 'Cikarang Selatan', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (59, 7, 600000, 'Cikarang Timur', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (60, 7, 600000, 'Cikarang Utara', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (61, 7, 800000, 'Karang Bahagia', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (62, 7, 800000, 'Kedungwaringin', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (63, 7, 1000000, 'Muara Gembong', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (64, 7, 1000000, 'Pabayuran', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (65, 7, 700000, 'Serang Baru', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (66, 7, 400000, 'Setu', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (67, 7, 1000000, 'Suka Karya', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (68, 7, 800000, 'Sukatani', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (69, 7, 800000, 'Tambelang', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (70, 7, 350000, 'Tambun Selatan', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (71, 7, 600000, 'Tambun Utara', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (72, 7, 400000, 'Tarumajaya', '2024-03-27 20:51:30', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (73, 8, 500000, 'Babakan Medang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (74, 8, 300000, 'Bojonggede', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (75, 8, 500000, 'Caringin', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (76, 8, 600000, 'Cariu', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (77, 8, 350000, 'Ciampea', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (78, 8, 800000, 'Ciawi', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (79, 8, 350000, 'Cibinong', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (80, 8, 400000, 'Cibungbulang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (81, 8, 600000, 'Cigombong', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (82, 8, 350000, 'Cigudeg', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (83, 8, 500000, 'Cijeruk', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (84, 8, 300000, 'Cileungsi', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (85, 8, 400000, 'Ciomas', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (86, 8, 0, 'Cisarua', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (87, 8, 300000, 'Citeureup', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (88, 8, 350000, 'Dramaga', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (89, 8, 400000, 'Gn Putri', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (90, 8, 150000, 'Gn Sindur', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (91, 8, 500000, 'Jasinga', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (92, 8, 600000, 'Jonggol', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (93, 8, 250000, 'Kemang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (94, 8, 400000, 'Klapa Nunggal', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (95, 8, 400000, 'Leuwiliang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (96, 8, 400000, 'Leuwisadeng', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (97, 8, 600000, 'Megamendung', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (98, 8, 600000, 'Nanggung', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (99, 8, 700000, 'Pamijahan', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (100, 8, 150000, 'Parung', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (101, 8, 200000, 'Parung Panjang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (102, 8, 300000, 'Ranca Bungur', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (103, 8, 300000, 'Rumpin', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (104, 8, 700000, 'Sukajaya', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (105, 8, 700000, 'Sukamakmur', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (106, 8, 350000, 'Sukaraja', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (107, 8, 200000, 'Tajurhalang', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (108, 8, 600000, 'Tamansari', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (109, 8, 800000, 'Tanjungsari', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (110, 8, 400000, 'Tenjo', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (111, 8, 500000, 'Tenjolaya', '2024-03-27 21:10:47', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (112, 9, 350000, 'Bogor Barat', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (113, 9, 400000, 'Bogor Selatan', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (114, 9, 400000, 'Bogor Tengah', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (115, 9, 400000, 'Bogor Timur', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (116, 9, 400000, 'Bogor Utara', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (117, 9, 350000, 'Bogor Sereal', '2024-03-27 21:12:18', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (118, 10, 200000, 'Beji', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (119, 10, 75000, 'Bojongsari', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (120, 10, 300000, 'Cilodong', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (121, 10, 250000, 'Cimanggis', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (122, 10, 100000, 'Cinere', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (123, 10, 250000, 'Cipayung', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (124, 10, 150000, 'Limo', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (125, 10, 200000, 'Pancoran Mas', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (126, 10, 100000, 'Sawangan', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (127, 10, 250000, 'Sukmajaya', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (128, 10, 300000, 'Tapos', '2024-03-27 21:14:50', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (129, 11, 100000, 'Batuceper', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (130, 11, 200000, 'Benda', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (131, 11, 150000, 'Cibodas', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (132, 11, 0, 'Ciledug', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (133, 11, 50000, 'Cipondoh', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (134, 11, 200000, 'Jatiuwung', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (135, 11, 0, 'Karang Tengah', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (136, 11, 150000, 'Karawaci', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (137, 11, 0, 'Larangan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (138, 11, 150000, 'Neglasari', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (139, 11, 150000, 'Periuk', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (140, 11, 0, 'Pinang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (141, 11, 100000, 'Tangerang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (142, 12, 0, 'Ciputat', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (143, 12, 0, 'Ciputat Timur', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (144, 12, 0, 'Pamulang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (145, 12, 0, 'Pondok Aren', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (146, 12, 0, 'Serpong', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (147, 12, 0, 'Serpong Utara', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (148, 12, 0, 'Setu', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (149, 13, 250000, 'Balaraja', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (150, 13, 250000, 'Cikupa', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (151, 13, 150000, 'Cisauk', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (152, 13, 250000, 'Cisoka', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (153, 13, 200000, 'Curug', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (154, 13, 400000, 'Gunung Kaler', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (155, 13, 300000, 'Jambe', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (156, 13, 300000, 'Jayanti', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (157, 13, 150000, 'Kelapa Dua', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (158, 13, 400000, 'Kemiri', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (159, 13, 200000, 'Kosambi', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (160, 13, 300000, 'Kresek', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (161, 13, 400000, 'Kronjo', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (162, 13, 150000, 'Legok', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (163, 13, 600000, 'Mauk', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (164, 13, 600000, 'Mekar Baru', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (165, 13, 75000, 'Pagedangan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (166, 13, 250000, 'Pakuaji', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (167, 13, 250000, 'Panongan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (168, 13, 200000, 'Pasar Kemis', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (169, 13, 250000, 'Rajeg', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (170, 13, 200000, 'Sepatan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (171, 13, 200000, 'Sepatan Timur', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (172, 13, 250000, 'Sindang Jaya', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (173, 13, 400000, 'Solear', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (174, 13, 300000, 'Sukadiri', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (175, 13, 300000, 'Sukamulya', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (176, 13, 200000, 'Teluknaga', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (177, 13, 300000, 'Tigaraksa', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (178, 14, 1200, 'Anyar', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (179, 14, 400000, 'Bandung', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (180, 14, 700000, 'Baros', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (181, 14, 400000, 'Binuang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (182, 14, 800000, 'Bojonegara', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (183, 14, 500000, 'Carenang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (184, 14, 300000, 'Cikande', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (185, 14, 700000, 'Cikeusal', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (186, 14, 1200000, 'Cinangka', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (187, 14, 1000000, 'Ciomas', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (188, 14, 500000, 'Ciruas', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (189, 14, 400000, 'Gn Sari', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (190, 14, 400000, 'Jawilan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (191, 14, 400000, 'Kibin', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (192, 14, 400000, 'Kopo', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (193, 14, 400000, 'Kragilan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (194, 14, 800000, 'Kramatwatu', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (195, 14, 600000, 'Lebah Wangi', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (196, 14, 0, 'Mancak', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (197, 14, 600000, 'Pabuaran', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (198, 14, 1200000, 'Padarincang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (199, 14, 600000, 'Pamarayan', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (200, 14, 600000, 'Petir', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (201, 14, 700000, 'Pontang', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (202, 14, 1200000, 'Pulo Ampel', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (203, 14, 800000, 'Tanara', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (204, 14, 800000, 'Tirtayasa', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (205, 14, 700000, 'Tunjung Teja', '2024-03-27 21:39:23', NULL, NULL);
INSERT INTO `shipping_districts` VALUES (206, 14, 700000, 'Waringin Kurung', '2024-03-27 21:39:23', NULL, NULL);

-- ----------------------------
-- Table structure for shipping_subdistricts
-- ----------------------------
DROP TABLE IF EXISTS `shipping_subdistricts`;
CREATE TABLE `shipping_subdistricts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shipping_district_id` int UNSIGNED NOT NULL,
  `price` int UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shipping_subdistricts
-- ----------------------------
INSERT INTO `shipping_subdistricts` VALUES (1, 25, 100000, '2024-04-15 16:19:29', NULL, NULL, 'Selong');
INSERT INTO `shipping_subdistricts` VALUES (2, 25, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Gunung');
INSERT INTO `shipping_subdistricts` VALUES (3, 5, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Kramat Pela');
INSERT INTO `shipping_subdistricts` VALUES (4, 3, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Gandaria Utara');
INSERT INTO `shipping_subdistricts` VALUES (5, 25, 150000, '2024-04-15 16:21:51', NULL, NULL, 'Cipete Utara');
INSERT INTO `shipping_subdistricts` VALUES (6, 25, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Melawai');
INSERT INTO `shipping_subdistricts` VALUES (7, 25, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Pulo');
INSERT INTO `shipping_subdistricts` VALUES (8, 25, 100000, '2024-04-15 16:21:51', NULL, NULL, 'Petogogan');
INSERT INTO `shipping_subdistricts` VALUES (9, 25, 150000, '2024-04-15 16:21:51', NULL, NULL, 'Rawa Barat');
INSERT INTO `shipping_subdistricts` VALUES (10, 25, 200000, '2024-04-15 16:21:51', NULL, NULL, 'Senayan');
INSERT INTO `shipping_subdistricts` VALUES (11, 26, 100000, '2024-04-15 16:23:48', NULL, NULL, 'Grogol Utara');
INSERT INTO `shipping_subdistricts` VALUES (12, 26, 100000, '2024-04-15 16:23:48', NULL, NULL, 'Grogol Selatan');
INSERT INTO `shipping_subdistricts` VALUES (13, 26, 75000, '2024-04-15 16:23:48', NULL, NULL, 'Cipulir');
INSERT INTO `shipping_subdistricts` VALUES (14, 26, 100000, '2024-04-15 16:23:48', NULL, NULL, 'Kebayoran Lama Selatan');
INSERT INTO `shipping_subdistricts` VALUES (15, 26, 100000, '2024-04-15 16:23:48', NULL, NULL, 'Kebayoran Lama Utara');
INSERT INTO `shipping_subdistricts` VALUES (16, 26, 100000, '2024-04-15 16:23:48', NULL, NULL, 'Pondok Pinang');
INSERT INTO `shipping_subdistricts` VALUES (17, 28, 150000, '2024-04-15 16:25:40', NULL, NULL, 'Cipete Selatan');
INSERT INTO `shipping_subdistricts` VALUES (18, 28, 150000, '2024-04-15 16:25:40', NULL, NULL, 'Gandaria Selatan');
INSERT INTO `shipping_subdistricts` VALUES (19, 28, 150000, '2024-04-15 16:25:40', NULL, NULL, 'Cilandak Barat');
INSERT INTO `shipping_subdistricts` VALUES (20, 28, 100000, '2024-04-15 16:25:40', NULL, NULL, 'Lebak Bulus');
INSERT INTO `shipping_subdistricts` VALUES (21, 28, 150000, '2024-04-15 16:25:40', NULL, NULL, 'Pondok Labu');
INSERT INTO `shipping_subdistricts` VALUES (22, 35, 150000, '2024-04-15 16:27:27', NULL, NULL, 'Cengkareng Barat');
INSERT INTO `shipping_subdistricts` VALUES (23, 35, 150000, '2024-04-15 16:27:27', NULL, NULL, 'Cengkareng Timur');
INSERT INTO `shipping_subdistricts` VALUES (24, 35, 100000, '2024-04-15 16:27:27', NULL, NULL, 'Duri Kosambi');
INSERT INTO `shipping_subdistricts` VALUES (25, 35, 200000, '2024-04-15 16:27:27', NULL, NULL, 'Kapuk');
INSERT INTO `shipping_subdistricts` VALUES (26, 35, 150000, '2024-04-15 16:27:27', NULL, NULL, 'Kedaung Kaliangke');
INSERT INTO `shipping_subdistricts` VALUES (27, 35, 150000, '2024-04-15 16:27:27', NULL, NULL, 'Rawa Buaya');
INSERT INTO `shipping_subdistricts` VALUES (28, 37, 150000, '2024-04-15 16:29:20', NULL, NULL, 'Pegadungan');
INSERT INTO `shipping_subdistricts` VALUES (29, 37, 150000, '2024-04-15 16:29:20', NULL, NULL, 'Kalideres');
INSERT INTO `shipping_subdistricts` VALUES (30, 37, 200000, '2024-04-15 16:29:20', NULL, NULL, 'Kamal');
INSERT INTO `shipping_subdistricts` VALUES (31, 37, 100000, '2024-04-15 16:29:20', NULL, NULL, 'Semanan');
INSERT INTO `shipping_subdistricts` VALUES (32, 37, 200000, '2024-04-15 16:29:20', NULL, NULL, 'Tegal Alur');
INSERT INTO `shipping_subdistricts` VALUES (33, 39, 75000, '2024-04-15 16:31:16', NULL, NULL, 'Srengseng');
INSERT INTO `shipping_subdistricts` VALUES (34, 39, 100000, '2024-04-15 16:31:16', NULL, NULL, 'Kembangan Barat');
INSERT INTO `shipping_subdistricts` VALUES (35, 39, 100000, '2024-04-15 16:31:16', NULL, NULL, 'Kembangan Timur');
INSERT INTO `shipping_subdistricts` VALUES (36, 39, 75000, '2024-04-15 16:31:16', NULL, NULL, 'Meruya Utara');
INSERT INTO `shipping_subdistricts` VALUES (37, 39, 75000, '2024-04-15 16:31:16', NULL, NULL, 'Meruya Selatan');

-- ----------------------------
-- Table structure for shippings
-- ----------------------------
DROP TABLE IF EXISTS `shippings`;
CREATE TABLE `shippings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price_discount_percentage` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of shippings
-- ----------------------------
INSERT INTO `shippings` VALUES (1, 'Diambil di Gudang', 1, '2024-03-27 16:15:23', NULL, NULL);
INSERT INTO `shippings` VALUES (2, 'Dikirim', NULL, '2024-03-27 16:15:23', NULL, NULL);

-- ----------------------------
-- Table structure for thickness_types
-- ----------------------------
DROP TABLE IF EXISTS `thickness_types`;
CREATE TABLE `thickness_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `thick` decimal(4, 2) NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `thickness_types_product_variant_id_foreign`(`product_variant_id` ASC) USING BTREE,
  CONSTRAINT `thickness_types_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of thickness_types
-- ----------------------------
INSERT INTO `thickness_types` VALUES (1, 0.20, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (2, 0.25, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (3, 0.30, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (4, 0.35, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (5, 0.40, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (6, 0.45, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);
INSERT INTO `thickness_types` VALUES (7, 0.50, 1, '2024-08-19 02:26:30', '2024-08-19 02:26:30', NULL);

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_roles
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for variant_item_types
-- ----------------------------
DROP TABLE IF EXISTS `variant_item_types`;
CREATE TABLE `variant_item_types`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of variant_item_types
-- ----------------------------
INSERT INTO `variant_item_types` VALUES (1, 'Ukuran', NULL, NULL, NULL);
INSERT INTO `variant_item_types` VALUES (2, 'Tebal', NULL, NULL, NULL);
INSERT INTO `variant_item_types` VALUES (3, 'gelombang', '2024-08-19 16:48:43', NULL, NULL);
INSERT INTO `variant_item_types` VALUES (4, 'panjang', '2024-08-23 08:22:29', NULL, NULL);
INSERT INTO `variant_item_types` VALUES (5, 'lebar', '2024-08-23 09:55:57', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
