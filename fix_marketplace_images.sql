-- Fix Business Listing Image Paths
-- Run this SQL to update database paths to include 'business-listings/' prefix

-- Fix paths that are missing the 'business-listings/' prefix
UPDATE business_listings 
SET main_image = CONCAT('business-listings/', main_image)
WHERE main_image IS NOT NULL 
  AND main_image NOT LIKE 'business-listings/%'
  AND main_image LIKE 'listing_%';

-- Also fix paths that might have leading slash
UPDATE business_listings 
SET main_image = REPLACE(main_image, '/business-listings/', 'business-listings/')
WHERE main_image LIKE '/business-listings/%';

-- Verify the fix
SELECT id, title, main_image FROM business_listings WHERE main_image IS NOT NULL LIMIT 10;

-- Expected result: main_image should be like 'business-listings/listing_1.jpg'
-- NOT: 'listing_1.jpg' or '/business-listings/listing_1.jpg'
