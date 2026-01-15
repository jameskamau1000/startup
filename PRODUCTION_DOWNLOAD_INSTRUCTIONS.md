# Download Category Images on Production

## Quick Start

Run this single command on your production server:

```bash
php download_images_production.php
```

That's it! The script will:
- ✅ Create the `public/img-category` directory if needed
- ✅ Download all 17 category images from Unsplash
- ✅ Set proper file permissions (644)
- ✅ Set ownership to www-data (if available)
- ✅ Skip images that already exist
- ✅ Verify each image is valid before saving

## What the Script Does

1. **Downloads Images**: Fetches 17 business category images from Unsplash
2. **Validates Images**: Ensures each downloaded file is a valid image
3. **Sets Permissions**: Makes images readable by the web server
4. **Skips Existing**: Won't re-download images that already exist
5. **Error Handling**: Reports any failures clearly

## After Running the Script

### Step 1: Update Database
```bash
mysql -u your_username -p your_database < update_category_images.sql
```

### Step 2: Clear Laravel Caches
```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

### Step 3: Verify
- Check images exist: `ls -la public/img-category/*.jpg`
- Visit your categories page to see images
- Check browser console for any 404 errors

## Troubleshooting

### Issue: "Cannot create directory"
**Solution:** Check write permissions:
```bash
chmod 755 public
mkdir -p public/img-category
chmod 755 public/img-category
```

### Issue: "Download failed"
**Solution:** 
- Check internet connection
- Verify PHP has curl or allow_url_fopen enabled
- Check firewall isn't blocking Unsplash

### Issue: "Permission denied"
**Solution:**
```bash
chmod 644 public/img-category/*.jpg
chown www-data:www-data public/img-category/*.jpg
```

### Issue: Images still not showing
**Solution:**
1. Verify images exist: `ls -la public/img-category/`
2. Check database has paths: `SELECT image FROM categories;`
3. Verify APP_URL in `.env` is correct
4. Clear all caches

## Alternative: Use Bash Script

If PHP script doesn't work, use the bash version:

```bash
chmod +x download_category_images.sh
./download_category_images.sh
```

## Manual Download (Last Resort)

If scripts fail, manually download images:

```bash
cd public/img-category

# Download each image individually
wget "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop" -O technology-software.jpg
wget "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop" -O ecommerce-retail.jpg
# ... (see download_category_images.sh for all URLs)

# Set permissions
chmod 644 *.jpg
chown www-data:www-data *.jpg
```

## Files Included

- `download_images_production.php` - **Recommended** - Production-ready PHP script
- `download_category_images.sh` - Bash alternative
- `download_category_images.php` - Original PHP script
- `update_category_images.sql` - Database update file

## Support

If images still don't work after following these steps:
1. Run diagnostic: `php diagnose_image_issues.php`
2. Check logs: `tail -f storage/logs/laravel.log`
3. Verify .env configuration
4. Test image URLs directly in browser
