# Quick Fix for Category Images on Production

## Most Common Issue: Images Not Downloaded

**If images are not showing, the #1 reason is that images haven't been downloaded on production.**

### Quick Fix (5 minutes):

```bash
# 1. Navigate to project directory
cd /path/to/your/project

# 2. Download images
chmod +x download_category_images.sh
./download_category_images.sh

# 3. Update database
mysql -u username -p database_name < update_category_images.sql

# 4. Set permissions
chmod 644 public/img-category/*.jpg
chown www-data:www-data public/img-category/*.jpg

# 5. Clear caches
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

## Verify Images Are Working

### Check 1: Images Exist
```bash
ls -la public/img-category/*.jpg
# Should show 17+ image files
```

### Check 2: Database Has Paths
```sql
SELECT id, name, image FROM categories WHERE image != '';
-- Should show: img-category/technology-software.jpg
```

### Check 3: APP_URL is Correct
```bash
grep APP_URL .env
# Should be: APP_URL=https://yourdomain.com (NOT localhost)
```

### Check 4: Test Image URL
Visit in browser:
```
https://yourdomain.com/public/img-category/technology-software.jpg
```

Should show the image, not 404.

## Common Production Issues

### Issue: Images show as broken/generic icons

**Solution:**
1. Images not downloaded → Run `./download_category_images.sh`
2. Database not updated → Run `update_category_images.sql`
3. Wrong APP_URL → Update `.env` with production domain
4. Cache not cleared → Run `php artisan config:clear && php artisan view:clear`

### Issue: 404 errors for images

**Solution:**
1. Check if images exist: `ls -la public/img-category/`
2. Check file permissions: `chmod 644 public/img-category/*.jpg`
3. Check Apache/Nginx can access the directory
4. Verify DocumentRoot includes `public/` directory

### Issue: Wrong image paths in database

**Solution:**
```sql
-- Check current paths
SELECT id, name, image FROM categories;

-- If paths are wrong, run:
-- update_category_images.sql
```

## Automated Deployment

Use the deployment script:
```bash
chmod +x deploy_category_images_production.sh
./deploy_category_images_production.sh
```

This will:
- Download all images
- Set permissions
- Update database
- Clear caches
- Verify setup

## Manual Image Download (if script fails)

```bash
cd public/img-category

wget "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop" -O technology-software.jpg
wget "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop" -O ecommerce-retail.jpg
wget "https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop" -O food-beverage.jpg
wget "https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop" -O manufacturing-production.jpg
wget "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop" -O professional-services.jpg
wget "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop" -O real-estate-construction.jpg
wget "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop" -O healthcare-medical-business.jpg
wget "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop" -O education-training-business.jpg
wget "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop" -O finance-fintech.jpg
wget "https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop" -O transportation-logistics.jpg
wget "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop" -O marketing-advertising.jpg
wget "https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop" -O energy-utilities.jpg
wget "https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop" -O agriculture-farming-business.jpg
wget "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop" -O hospitality-tourism-business.jpg
wget "https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop" -O media-entertainment-business.jpg
wget "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop" -O consulting-advisory.jpg
wget "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop" -O fashion-apparel-business.jpg
```

## Still Not Working?

1. **Check browser console** for 404 errors
2. **Check server logs** for access errors
3. **Verify .env** has correct APP_URL
4. **Test direct image access** in browser
5. **Check file permissions** and ownership
6. **Verify database** has correct image paths
