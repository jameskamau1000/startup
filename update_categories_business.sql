-- SQL Update File to Replace All Categories with Business-Related Categories
-- Generated for Fundme Business Crowdfunding Platform
-- Date: 2025-01-14

-- ============================================
-- UPDATE ALL EXISTING CATEGORIES TO BUSINESS CATEGORIES
-- ============================================

-- Category 1: Technology & Software
UPDATE `categories` SET 
`name` = 'Technology & Software',
`slug` = 'technology-software',
`mode` = 'on'
WHERE `id` = 1;

-- Category 2: E-commerce & Retail
UPDATE `categories` SET 
`name` = 'E-commerce & Retail',
`slug` = 'ecommerce-retail',
`mode` = 'on'
WHERE `id` = 2;

-- Category 3: Food & Beverage
UPDATE `categories` SET 
`name` = 'Food & Beverage',
`slug` = 'food-beverage',
`mode` = 'on'
WHERE `id` = 3;

-- Category 4: Manufacturing & Production
UPDATE `categories` SET 
`name` = 'Manufacturing & Production',
`slug` = 'manufacturing-production',
`mode` = 'on'
WHERE `id` = 4;

-- Category 5: Professional Services
UPDATE `categories` SET 
`name` = 'Professional Services',
`slug` = 'professional-services',
`mode` = 'on'
WHERE `id` = 5;

-- Category 6: Real Estate & Construction
UPDATE `categories` SET 
`name` = 'Real Estate & Construction',
`slug` = 'real-estate-construction',
`mode` = 'on'
WHERE `id` = 6;

-- Category 7: Healthcare & Medical Business
UPDATE `categories` SET 
`name` = 'Healthcare & Medical Business',
`slug` = 'healthcare-medical-business',
`mode` = 'on'
WHERE `id` = 7;

-- Category 8: Education & Training Business
UPDATE `categories` SET 
`name` = 'Education & Training Business',
`slug` = 'education-training-business',
`mode` = 'on'
WHERE `id` = 8;

-- Category 9: Finance & Fintech
UPDATE `categories` SET 
`name` = 'Finance & Fintech',
`slug` = 'finance-fintech',
`mode` = 'on'
WHERE `id` = 9;

-- Category 10: Transportation & Logistics
UPDATE `categories` SET 
`name` = 'Transportation & Logistics',
`slug` = 'transportation-logistics',
`mode` = 'on'
WHERE `id` = 10;

-- Category 11: Marketing & Advertising
UPDATE `categories` SET 
`name` = 'Marketing & Advertising',
`slug` = 'marketing-advertising',
`mode` = 'on'
WHERE `id` = 11;

-- Category 12: Energy & Utilities
UPDATE `categories` SET 
`name` = 'Energy & Utilities',
`slug` = 'energy-utilities',
`mode` = 'on'
WHERE `id` = 12;

-- Category 13: Agriculture & Farming Business
UPDATE `categories` SET 
`name` = 'Agriculture & Farming Business',
`slug` = 'agriculture-farming-business',
`mode` = 'on'
WHERE `id` = 13;

-- Category 14: Hospitality & Tourism Business
UPDATE `categories` SET 
`name` = 'Hospitality & Tourism Business',
`slug` = 'hospitality-tourism-business',
`mode` = 'on'
WHERE `id` = 14;

-- Category 15: Media & Entertainment Business
UPDATE `categories` SET 
`name` = 'Media & Entertainment Business',
`slug` = 'media-entertainment-business',
`mode` = 'on'
WHERE `id` = 15;

-- Category 16: Consulting & Advisory
UPDATE `categories` SET 
`name` = 'Consulting & Advisory',
`slug` = 'consulting-advisory',
`mode` = 'on'
WHERE `id` = 16;

-- Category 17: Fashion & Apparel Business
UPDATE `categories` SET 
`name` = 'Fashion & Apparel Business',
`slug` = 'fashion-apparel-business',
`mode` = 'on'
WHERE `id` = 17;

-- ============================================
-- OPTIONAL: ADD MORE BUSINESS CATEGORIES
-- ============================================
-- If you want to add additional business categories, uncomment and modify:

/*
INSERT INTO `categories` (`name`, `slug`, `mode`, `date`) VALUES
('Legal Services', 'legal-services', 'on', NOW()),
('Beauty & Personal Care Business', 'beauty-personal-care-business', 'on', NOW()),
('Sports & Fitness Business', 'sports-fitness-business', 'on', NOW()),
('Automotive Business', 'automotive-business', 'on', NOW()),
('Telecommunications', 'telecommunications', 'on', NOW()),
('Supply Chain & Distribution', 'supply-chain-distribution', 'on', NOW()),
('Renewable Energy', 'renewable-energy', 'on', NOW()),
('Biotechnology', 'biotechnology', 'on', NOW()),
('Aerospace & Defense', 'aerospace-defense', 'on', NOW()),
('Chemical & Materials', 'chemical-materials', 'on', NOW());
*/

-- ============================================
-- END OF UPDATES
-- ============================================
-- 
-- To apply these updates to your production database:
-- 1. Backup your database first: mysqldump -u username -p database_name > backup.sql
-- 2. Review the category updates above
-- 3. Run this SQL file: mysql -u username -p database_name < update_categories_business.sql
-- 4. Verify the categories in your admin panel
--
-- Note: Existing campaigns will keep their current category associations.
-- You may want to review and update campaign categories in the admin panel
-- to ensure they're assigned to appropriate business categories.
--