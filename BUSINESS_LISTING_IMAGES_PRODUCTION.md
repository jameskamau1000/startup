# Business Listing Images - Production Installation Guide

## Problem
Business listing images are not showing on production. The images need to be downloaded and stored in the correct location.

## Solution

### Step 1: Download Images

Run the PHP script to download all business listing images:

```bash
cd /var/www/html/startup
php download_business_listing_images_production.php
```

This will download 34 images (listing_1.jpg through listing_34.jpg) to `storage/app/public/business-listings/`

### Step 2: Create Storage Symlink

Laravel uses a symlink to make storage files accessible via the web. Create it if it doesn't exist:

```bash
cd /var/www/html/startup
php artisan storage:link
```

This creates a symlink from `public/storage` to `storage/app/public`, making images accessible via URLs like `/storage/business-listings/listing_1.jpg`

### Step 3: Verify Database Paths

The database should have paths like `business-listings/listing_1.jpg` (without the leading slash). Verify:

```sql
SELECT id, title, main_image FROM business_listings LIMIT 5;
```

If paths are incorrect, update them:

```sql
UPDATE business_listings SET main_image = CONCAT('business-listings/', main_image) WHERE main_image LIKE 'listing_%' AND main_image NOT LIKE 'business-listings/%';
```

### Step 4: Set Permissions

Ensure proper permissions:

```bash
chmod -R 755 storage/app/public/business-listings
chown -R www-data:www-data storage/app/public/business-listings
```

### Step 5: Clear Cache

Clear Laravel caches:

```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

## Troubleshooting

### Images still not showing?

1. **Check if symlink exists:**
   ```bash
   ls -la public/storage
   ```
   Should show a symlink to `../storage/app/public`

2. **Check file permissions:**
   ```bash
   ls -la storage/app/public/business-listings/
   ```
   Files should be readable (644) and owned by www-data

3. **Check image paths in database:**
   ```sql
   SELECT id, main_image FROM business_listings WHERE main_image IS NOT NULL LIMIT 5;
   ```
   Paths should be like `business-listings/listing_1.jpg`

4. **Test direct access:**
   Visit: `https://yourdomain.com/storage/business-listings/listing_1.jpg`
   Should show the image directly

5. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

## Alternative: Manual Download

If the script doesn't work, you can manually download images:

1. Visit each Unsplash URL from the script
2. Save images as `listing_1.jpg`, `listing_2.jpg`, etc.
3. Upload to `storage/app/public/business-listings/` via FTP/SFTP
4. Set permissions: `chmod 644` and `chown www-data:www-data`

## Notes

- All images are from Unsplash and are free for commercial use
- Images are 1200x800px for optimal display
- The script downloads 34 images for all sample business listings
