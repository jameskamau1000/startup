# Sample Data for Crowdfunding and B2B Marketplace

## Overview

This package includes comprehensive sample data for both the crowdfunding platform and B2B marketplace, complete with realistic content and unbranded images.

## What's Included

### Sample Data
- **8 Sample Users** - Realistic Kenyan names and profiles
- **34 Crowdfunding Campaigns** - Covering all 17 business categories
- **34 Business Listings** - For B2B marketplace across all categories
- **4 Buyers/Investors** - With investment criteria and preferences
- **30 Sample Donations** - For crowdfunding campaigns
- **68 Images** - Unbranded images from Unsplash (34 for campaigns, 34 for listings)

### Files Created
- `database/sample_data.sql` - Complete SQL file with all sample data
- `download_sample_images.sh` - Script to download images (already executed)
- `generate_sample_data.php` - Script to regenerate data if needed

## Installation

### Step 1: Import Sample Data

```bash
mysql -u root -p fundme < database/sample_data.sql
```

Or if using a different database name:
```bash
mysql -u root -p your_database < database/sample_data.sql
```

### Step 2: Verify Images

Images have already been downloaded to:
- `public/campaigns/small/` - Campaign thumbnails (34 images)
- `public/campaigns/large/` - Campaign full images (34 images)
- `public/business-listings/` - Business listing images (34 images)

If images are missing, run:
```bash
./download_sample_images.sh
```

### Step 3: Set Permissions

```bash
chmod 644 public/campaigns/small/*.jpg
chmod 644 public/campaigns/large/*.jpg
chmod 644 public/business-listings/*.jpg
chown www-data:www-data public/campaigns/small/*.jpg
chown www-data:www-data public/campaigns/large/*.jpg
chown www-data:www-data public/business-listings/*.jpg
```

### Step 4: Clear Caches

```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

## Sample Data Details

### Crowdfunding Campaigns (34 total)

**Featured Campaigns (6):**
1. AI-Powered Healthcare App for Rural Communities - KES 2,500,000
2. E-Learning Platform for Primary Schools - KES 1,800,000
3. Online Marketplace for Local Artisans - KES 1,500,000
4. Sustainable Fashion Brand Launch - KES 2,000,000
5. Organic Farm Expansion Project - KES 3,200,000
6. Community Restaurant for Healthy Meals - KES 1,200,000

**All Categories Covered:**
- Technology & Software (2 campaigns)
- E-commerce & Retail (2 campaigns)
- Food & Beverage (2 campaigns)
- Manufacturing & Production (2 campaigns)
- Professional Services (2 campaigns)
- Real Estate & Construction (2 campaigns)
- Healthcare & Medical (2 campaigns)
- Education & Training (2 campaigns)
- Finance & Fintech (2 campaigns)
- Transportation & Logistics (2 campaigns)
- Marketing & Advertising (2 campaigns)
- Energy & Utilities (2 campaigns)
- Agriculture & Farming (2 campaigns)
- Hospitality & Tourism (2 campaigns)
- Media & Entertainment (2 campaigns)
- Consulting & Advisory (2 campaigns)
- Fashion & Apparel (2 campaigns)

### B2B Marketplace Listings (34 total)

**Featured Listings (6):**
1. Established SaaS Platform - KES 45,000,000
2. Mobile App Development Company - KES 28,000,000
3. Online Fashion Retail Store - KES 35,000,000
4. Electronics Retail Chain - KES 42,000,000
5. Popular Restaurant Chain - KES 55,000,000
6. Coffee Roasting Business - KES 32,000,000

**Business Stages:**
- **Established** (30 listings) - Profitable, proven businesses
- **Early** (4 listings) - Growing businesses with potential

**Price Range:**
- Minimum: KES 25,000,000
- Maximum: KES 180,000,000
- Average: KES 55,000,000

**All Industries Covered:**
- Technology & Software
- E-commerce & Retail
- Food & Beverage
- Manufacturing & Production
- Professional Services
- Real Estate & Construction
- Healthcare & Medical
- Education & Training
- Finance & Fintech
- Transportation & Logistics
- Marketing & Advertising
- Energy & Utilities
- Agriculture & Farming
- Hospitality & Tourism
- Media & Entertainment
- Consulting & Advisory
- Fashion & Apparel

### Sample Users

All users have password: `password`

1. Sarah Kimani - sarah.kimani@example.com
2. James Ochieng - james.ochieng@example.com
3. Amina Hassan - amina.hassan@example.com
4. David Mwangi - david.mwangi@example.com
5. Grace Wanjiku - grace.wanjiku@example.com
6. Peter Kipchoge - peter.kipchoge@example.com
7. Mary Njeri - mary.njeri@example.com
8. John Kamau - john.kamau@example.com

### Sample Buyers/Investors

1. **Investor** - Min: KES 5M, Max: KES 50M (Verified)
2. **Buyer** - Min: KES 10M, Max: KES 100M (Verified)
3. **Both** - Min: KES 8M, Max: KES 80M (Pending)
4. **Investor** - Min: KES 12M, Max: KES 150M (Pending)

## Verification

After importing, verify the data:

```sql
-- Check campaigns
SELECT COUNT(*) as total_campaigns FROM campaigns;
-- Should show: 34

-- Check business listings
SELECT COUNT(*) as total_listings FROM business_listings;
-- Should show: 34

-- Check users
SELECT COUNT(*) as total_users FROM users;
-- Should show: 9 (1 admin + 8 sample users)

-- Check buyers
SELECT COUNT(*) as total_buyers FROM buyers;
-- Should show: 4

-- Check donations
SELECT COUNT(*) as total_donations FROM donations;
-- Should show: 30
```

## Image Verification

```bash
# Check campaign images
ls -la public/campaigns/small/*.jpg | wc -l
# Should show: 34

ls -la public/campaigns/large/*.jpg | wc -l
# Should show: 34

# Check listing images
ls -la public/business-listings/*.jpg | wc -l
# Should show: 34
```

## Features Demonstrated

### Crowdfunding
- ✅ Campaigns across all categories
- ✅ Featured campaigns
- ✅ Sample donations
- ✅ Realistic descriptions and goals
- ✅ Images for all campaigns

### B2B Marketplace
- ✅ Business listings across all industries
- ✅ Featured and verified listings
- ✅ Realistic financial data (revenue, profit, asking price)
- ✅ Different business stages
- ✅ Various business types (B2B, B2C, B2B & B2C)
- ✅ Images for all listings

## Notes

- All images are from Unsplash (free, unbranded, no watermarks)
- All data is realistic and suitable for demonstration
- Financial figures are in Kenyan Shillings (KES)
- All businesses are located in Kenya
- Sample users can log in with password: `password`

## Troubleshooting

### Images Not Showing
1. Check file permissions: `ls -la public/campaigns/small/`
2. Verify images exist: `ls public/campaigns/small/*.jpg`
3. Clear Laravel caches: `php artisan cache:clear`
4. Check APP_URL in `.env`

### Data Not Importing
1. Verify database name is correct
2. Check if tables exist: `SHOW TABLES;`
3. Ensure foreign key constraints are satisfied
4. Check MySQL error logs

### Missing Images
Re-download images:
```bash
./download_sample_images.sh
```

## Regenerating Data

If you need to regenerate the sample data:

```bash
php generate_sample_data.php
```

This will create a new `sample_data.sql` file with fresh data.
