-- ============================================
-- B2B Marketplace Database Migrations
-- ============================================
-- This SQL file contains all database tables for the B2B Marketplace feature
-- Generated: 2025-01-15
-- Database: MySQL/MariaDB
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================
-- Table: business_listings
-- Description: Main business listings table
-- ============================================

CREATE TABLE IF NOT EXISTS `business_listings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Seller user ID',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_description` text DEFAULT NULL,
  `industry` varchar(255) NOT NULL COMMENT 'Technology, Retail, Hospitality, etc.',
  `stage` varchar(255) NOT NULL COMMENT 'early, pre-revenue, established',
  `location` varchar(255) NOT NULL COMMENT 'City, Country',
  `asking_price` decimal(15,2) NOT NULL,
  `annual_revenue` decimal(15,2) DEFAULT NULL,
  `annual_profit` decimal(15,2) DEFAULT NULL,
  `years_in_business` int(11) DEFAULT NULL,
  `employees` int(11) DEFAULT NULL,
  `business_type` varchar(255) DEFAULT NULL COMMENT 'B2C, B2B, B2C & B2B',
  `key_metrics` text DEFAULT NULL COMMENT 'JSON format',
  `financial_summary` text DEFAULT NULL,
  `growth_potential` text DEFAULT NULL,
  `reason_for_sale` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `gallery_images` json DEFAULT NULL,
  `status` enum('draft','pending','active','sold','inactive') NOT NULL DEFAULT 'pending',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `inquiries` int(11) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_listings_slug_unique` (`slug`),
  KEY `business_listings_user_id_foreign` (`user_id`),
  KEY `business_listings_approved_by_foreign` (`approved_by`),
  KEY `business_listings_status_featured_index` (`status`,`featured`),
  KEY `business_listings_industry_stage_location_index` (`industry`,`stage`,`location`),
  CONSTRAINT `business_listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_listings_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: buyers
-- Description: Buyer/Investor profiles
-- ============================================

CREATE TABLE IF NOT EXISTS `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('buyer','investor','both') NOT NULL DEFAULT 'buyer',
  `investment_criteria` text DEFAULT NULL,
  `min_investment` decimal(15,2) DEFAULT NULL,
  `max_investment` decimal(15,2) DEFAULT NULL,
  `preferred_industries` json DEFAULT NULL,
  `preferred_stages` json DEFAULT NULL,
  `preferred_locations` json DEFAULT NULL,
  `investment_goals` text DEFAULT NULL,
  `typical_deal_size_min` int(11) DEFAULT NULL,
  `typical_deal_size_max` int(11) DEFAULT NULL,
  `verification_status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `verification_documents` text DEFAULT NULL COMMENT 'JSON format',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `buyers_user_id_unique` (`user_id`),
  CONSTRAINT `buyers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: business_messages
-- Description: Secure messaging system between buyers and sellers
-- ============================================

CREATE TABLE IF NOT EXISTS `business_messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_listing_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Buyer/Investor user ID',
  `receiver_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Seller user ID',
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_messages_business_listing_id_foreign` (`business_listing_id`),
  KEY `business_messages_sender_id_foreign` (`sender_id`),
  KEY `business_messages_receiver_id_foreign` (`receiver_id`),
  KEY `business_messages_business_listing_id_sender_id_receiver_id_index` (`business_listing_id`,`sender_id`,`receiver_id`),
  CONSTRAINT `business_messages_business_listing_id_foreign` FOREIGN KEY (`business_listing_id`) REFERENCES `business_listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: business_valuations
-- Description: Business valuation system
-- ============================================

CREATE TABLE IF NOT EXISTS `business_valuations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_listing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Who requested the valuation',
  `estimated_value` decimal(15,2) NOT NULL,
  `min_value` decimal(15,2) DEFAULT NULL,
  `max_value` decimal(15,2) DEFAULT NULL,
  `valuation_method` text DEFAULT NULL COMMENT 'Revenue multiple, Asset-based, etc.',
  `valuation_report` text DEFAULT NULL COMMENT 'Detailed report',
  `valuation_factors` json DEFAULT NULL COMMENT 'Key factors considered',
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `valued_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Expert who did valuation',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_valuations_business_listing_id_foreign` (`business_listing_id`),
  KEY `business_valuations_user_id_foreign` (`user_id`),
  KEY `business_valuations_valued_by_foreign` (`valued_by`),
  CONSTRAINT `business_valuations_business_listing_id_foreign` FOREIGN KEY (`business_listing_id`) REFERENCES `business_listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_valuations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_valuations_valued_by_foreign` FOREIGN KEY (`valued_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: investment_opportunities
-- Description: Investment opportunities for businesses seeking capital
-- ============================================

CREATE TABLE IF NOT EXISTS `investment_opportunities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_listing_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `min_investment` decimal(15,2) NOT NULL,
  `max_investment` decimal(15,2) DEFAULT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `current_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `investors_count` int(11) NOT NULL DEFAULT 0,
  `expected_roi` decimal(5,2) DEFAULT NULL COMMENT 'Percentage',
  `investment_duration` int(11) DEFAULT NULL COMMENT 'Months',
  `investment_type` enum('equity','debt','hybrid') NOT NULL DEFAULT 'equity',
  `use_of_funds` text DEFAULT NULL,
  `exit_strategy` text DEFAULT NULL,
  `status` enum('draft','open','closed','funded') NOT NULL DEFAULT 'draft',
  `closing_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `investment_opportunities_business_listing_id_foreign` (`business_listing_id`),
  KEY `investment_opportunities_status_investment_type_index` (`status`,`investment_type`),
  CONSTRAINT `investment_opportunities_business_listing_id_foreign` FOREIGN KEY (`business_listing_id`) REFERENCES `business_listings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: investments
-- Description: Individual investments made by investors
-- ============================================

CREATE TABLE IF NOT EXISTS `investments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `investment_opportunity_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','approved','rejected','completed') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `investments_investment_opportunity_id_foreign` (`investment_opportunity_id`),
  KEY `investments_investor_id_foreign` (`investor_id`),
  KEY `investments_investment_opportunity_id_status_index` (`investment_opportunity_id`,`status`),
  CONSTRAINT `investments_investment_opportunity_id_foreign` FOREIGN KEY (`investment_opportunity_id`) REFERENCES `investment_opportunities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `investments_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Table: business_inquiries
-- Description: Buyer inquiries for business listings
-- ============================================

CREATE TABLE IF NOT EXISTS `business_inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_listing_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','responded','closed') NOT NULL DEFAULT 'pending',
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_inquiries_business_listing_id_buyer_id_unique` (`business_listing_id`,`buyer_id`),
  KEY `business_inquiries_buyer_id_foreign` (`buyer_id`),
  KEY `business_inquiries_business_listing_id_status_index` (`business_listing_id`,`status`),
  CONSTRAINT `business_inquiries_business_listing_id_foreign` FOREIGN KEY (`business_listing_id`) REFERENCES `business_listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `business_inquiries_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- End of B2B Marketplace Migrations
-- ============================================
-- 
-- Usage Instructions:
-- 1. Make sure the 'users' table exists before running this script
-- 2. Run this SQL file on your database:
--    mysql -u username -p database_name < b2b_marketplace_migrations.sql
-- 3. Or import via phpMyAdmin or your preferred database tool
-- 
-- Note: This script uses IF NOT EXISTS to prevent errors if tables already exist
-- ============================================
