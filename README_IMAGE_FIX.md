# Category Images Not Working on Production - Quick Fix Guide

## Most Likely Issue

**90% of the time, images aren't showing because they haven't been downloaded on production.**

## Quick Fix (2 minutes)

```bash
# Run the quick fix script
./quick_fix_production.sh
```

This will:
- Download missing images
- Set correct permissions
- Clear Laravel caches

## Manual Fix

If the script doesn't work, follow these steps:

### Step 1: Download Images
```bash
chmod +x download_category_images.sh
./download_category_images.sh
```

Or use PHP:
```bash
php download_category_images.php
```

### Step 2: Update Database
```bash
mysql -u your_username -p your_database < update_category_images.sql
```

### Step 3: Set Permissions
```bash
chmod 644 public/img-category/*.jpg
chown www-data:www-data public/img-category/*.jpg
```

### Step 4: Clear Caches
```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

### Step 5: Verify APP_URL
Edit `.env` and ensure:
```
APP_URL=https://yourdomain.com
```
(Not `http://localhost`)

## Diagnose the Problem

Run the diagnostic script to identify the exact issue:

```bash
php diagnose_image_issues.php
```

This will check:
- ✅ Images directory exists
- ✅ Image files are present
- ✅ File permissions are correct
- ✅ Database has image paths
- ✅ APP_URL is configured correctly
- ✅ URL generation works
- ✅ Laravel caches

## Common Issues & Solutions

### Issue: Images show as broken icons
**Solution:** Images not downloaded → Run `./download_category_images.sh`

### Issue: 404 errors for images
**Solution:** 
1. Check images exist: `ls -la public/img-category/`
2. Check database: `SELECT image FROM categories WHERE id=1;`
3. Verify APP_URL in `.env`

### Issue: Wrong image paths in database
**Solution:** Run `update_category_images.sql`

### Issue: Images work locally but not on production
**Solution:**
1. Download images on production
2. Update database on production
3. Set correct APP_URL in production `.env`
4. Clear caches on production

## Files Included

- `quick_fix_production.sh` - Automated fix script
- `diagnose_image_issues.php` - Diagnostic tool
- `download_category_images.sh` - Download images (bash)
- `download_category_images.php` - Download images (PHP)
- `update_category_images.sql` - Database update
- `deploy_category_images_production.sh` - Full deployment script

## Still Not Working?

1. **Check browser console** - Look for 404 errors
2. **Check server logs** - Look for access denied errors
3. **Test direct image access** - Visit `https://yourdomain.com/public/img-category/technology-software.jpg`
4. **Verify file permissions** - `ls -la public/img-category/`
5. **Check database paths** - `SELECT id, name, image FROM categories;`

## Production Deployment Checklist

- [ ] Images downloaded (`./download_category_images.sh`)
- [ ] Database updated (`update_category_images.sql`)
- [ ] Permissions set (`chmod 644 public/img-category/*.jpg`)
- [ ] APP_URL correct in `.env`
- [ ] Caches cleared (`php artisan config:clear && php artisan view:clear`)
- [ ] Tested image URLs in browser
- [ ] Verified categories page shows images
