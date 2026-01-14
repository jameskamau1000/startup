-- SQL Update File to Add Images to Business Categories
-- Generated for Fundme Business Crowdfunding Platform
-- Date: 2025-01-14

-- ============================================
-- UPDATE CATEGORY IMAGES
-- ============================================

-- Category 1: Technology & Software
UPDATE `categories` SET 
`image` = 'img-category/technology-software.jpg'
WHERE `id` = 1 AND `slug` = 'technology-software';

-- Category 2: E-commerce & Retail
UPDATE `categories` SET 
`image` = 'img-category/ecommerce-retail.jpg'
WHERE `id` = 2 AND `slug` = 'ecommerce-retail';

-- Category 3: Food & Beverage
UPDATE `categories` SET 
`image` = 'img-category/food-beverage.jpg'
WHERE `id` = 3 AND `slug` = 'food-beverage';

-- Category 4: Manufacturing & Production
UPDATE `categories` SET 
`image` = 'img-category/manufacturing-production.jpg'
WHERE `id` = 4 AND `slug` = 'manufacturing-production';

-- Category 5: Professional Services
UPDATE `categories` SET 
`image` = 'img-category/professional-services.jpg'
WHERE `id` = 5 AND `slug` = 'professional-services';

-- Category 6: Real Estate & Construction
UPDATE `categories` SET 
`image` = 'img-category/real-estate-construction.jpg'
WHERE `id` = 6 AND `slug` = 'real-estate-construction';

-- Category 7: Healthcare & Medical Business
UPDATE `categories` SET 
`image` = 'img-category/healthcare-medical-business.jpg'
WHERE `id` = 7 AND `slug` = 'healthcare-medical-business';

-- Category 8: Education & Training Business
UPDATE `categories` SET 
`image` = 'img-category/education-training-business.jpg'
WHERE `id` = 8 AND `slug` = 'education-training-business';

-- Category 9: Finance & Fintech
UPDATE `categories` SET 
`image` = 'img-category/finance-fintech.jpg'
WHERE `id` = 9 AND `slug` = 'finance-fintech';

-- Category 10: Transportation & Logistics
UPDATE `categories` SET 
`image` = 'img-category/transportation-logistics.jpg'
WHERE `id` = 10 AND `slug` = 'transportation-logistics';

-- Category 11: Marketing & Advertising
UPDATE `categories` SET 
`image` = 'img-category/marketing-advertising.jpg'
WHERE `id` = 11 AND `slug` = 'marketing-advertising';

-- Category 12: Energy & Utilities
UPDATE `categories` SET 
`image` = 'img-category/energy-utilities.jpg'
WHERE `id` = 12 AND `slug` = 'energy-utilities';

-- Category 13: Agriculture & Farming Business
UPDATE `categories` SET 
`image` = 'img-category/agriculture-farming-business.jpg'
WHERE `id` = 13 AND `slug` = 'agriculture-farming-business';

-- Category 14: Hospitality & Tourism Business
UPDATE `categories` SET 
`image` = 'img-category/hospitality-tourism-business.jpg'
WHERE `id` = 14 AND `slug` = 'hospitality-tourism-business';

-- Category 15: Media & Entertainment Business
UPDATE `categories` SET 
`image` = 'img-category/media-entertainment-business.jpg'
WHERE `id` = 15 AND `slug` = 'media-entertainment-business';

-- Category 16: Consulting & Advisory
UPDATE `categories` SET 
`image` = 'img-category/consulting-advisory.jpg'
WHERE `id` = 16 AND `slug` = 'consulting-advisory';

-- Category 17: Fashion & Apparel Business
UPDATE `categories` SET 
`image` = 'img-category/fashion-apparel-business.jpg'
WHERE `id` = 17 AND `slug` = 'fashion-apparel-business';

-- ============================================
-- END OF UPDATES
-- ============================================
-- 
-- To apply these updates to your production database:
-- 1. First, upload all the category images to: public/img-category/
-- 2. Backup your database first
-- 3. Run this SQL file: mysql -u username -p database_name < update_category_images.sql
-- 4. Verify the category images in your admin panel
--
-- Note: All images are from Unsplash (unsplash.com) and are free for commercial use
-- with no attribution required (though attribution is appreciated).
--