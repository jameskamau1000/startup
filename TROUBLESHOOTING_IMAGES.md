# Troubleshooting Category Images on Production

## Common Issues and Solutions

### Issue 1: Images Not Displaying

**Symptoms:** Category images show as broken or generic icons

**Possible Causes:**

1. **Images Not Downloaded on Production**
   - Solution: Run the download script on production
   ```bash
   ./download_category_images.sh
   # OR
   php download_category_images.php
   ```

2. **Wrong Image Paths in Database**
   - Check: `SELECT id, name, image FROM categories WHERE image != '';`
   - Should show: `img-category/technology-software.jpg`
   - Fix: Run `update_category_images.sql`

3. **APP_URL Not Set Correctly**
   - Check: `.env` file has `APP_URL=https://yourdomain.com` (not localhost)
   - Fix: Update `.env` and run `php artisan config:clear`

4. **Public Directory Structure**
   - Images should be in: `public/img-category/`
   - Verify: `ls -la public/img-category/*.jpg`

5. **File Permissions**
   - Images should be readable by web server
   - Fix: `chmod 644 public/img-category/*.jpg`
   - Fix: `chown www-data:www-data public/img-category/*.jpg`

### Issue 2: Images Show Wrong Path

**Check the Generated URL:**
```php
// In Laravel Tinker
$cat = App\Models\Categories::find(1);
echo asset('public/'.($cat->image == '' ? 'img-category/default.jpg' : $cat->image));
```

**Expected Output:**
- `https://yourdomain.com/public/img-category/technology-software.jpg`

**If wrong, check:**
1. `.env` file `APP_URL` setting
2. Run `php artisan config:clear`
3. Check view cache: `php artisan view:clear`

### Issue 3: 404 Errors for Images

**Check Apache/Nginx Configuration:**
- Ensure `public/` directory is accessible
- Check if mod_rewrite is enabled
- Verify DocumentRoot points to correct location

**Test Image Access:**
```bash
# Test if image is accessible
curl -I https://yourdomain.com/public/img-category/technology-software.jpg
```

**Should return:** `HTTP/1.1 200 OK`

### Issue 4: Images Downloaded But Not Showing

**Verify:**
1. Images exist: `ls -la public/img-category/*.jpg`
2. Database has paths: `SELECT image FROM categories WHERE id=1;`
3. View is correct: Check `resources/views/includes/categories-listing.blade.php`
4. Cache cleared: `php artisan view:clear && php artisan config:clear`

### Quick Fix Checklist

```bash
# 1. Download images
./download_category_images.sh

# 2. Update database
mysql -u username -p database_name < update_category_images.sql

# 3. Set permissions
chmod 644 public/img-category/*.jpg
chown www-data:www-data public/img-category/*.jpg

# 4. Clear caches
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# 5. Verify APP_URL in .env
# Should be: APP_URL=https://yourdomain.com (not localhost)

# 6. Test image URL
php artisan tinker
>>> $cat = App\Models\Categories::find(1);
>>> echo asset('public/'.($cat->image == '' ? 'img-category/default.jpg' : $cat->image));
```

### Production Deployment Steps

1. **Pull latest code:**
   ```bash
   git pull origin main
   ```

2. **Download images:**
   ```bash
   chmod +x download_category_images.sh
   ./download_category_images.sh
   ```

3. **Update database:**
   ```bash
   mysql -u username -p database_name < update_category_images.sql
   ```

4. **Set permissions:**
   ```bash
   chmod 644 public/img-category/*.jpg
   chown www-data:www-data public/img-category/*.jpg
   ```

5. **Clear caches:**
   ```bash
   php artisan config:clear
   php artisan view:clear
   php artisan cache:clear
   ```

6. **Verify:**
   - Check database: `SELECT id, name, image FROM categories;`
   - Check files: `ls -la public/img-category/`
   - Test URL in browser: `https://yourdomain.com/public/img-category/technology-software.jpg`

### Debugging Commands

```bash
# Check if images exist
ls -la public/img-category/*.jpg

# Check database paths
mysql -u username -p database_name -e "SELECT id, name, image FROM categories;"

# Test image URL generation
php artisan tinker --execute="echo asset('public/img-category/technology-software.jpg');"

# Check file permissions
ls -la public/img-category/

# Test image accessibility
curl -I https://yourdomain.com/public/img-category/technology-software.jpg
```

### Common Production Issues

1. **Different DocumentRoot:** If production uses different structure, adjust paths
2. **CDN/Cloud Storage:** If using CDN, update `ASSET_URL` in `.env`
3. **Symlinks:** Ensure symlinks are created correctly
4. **.htaccess:** Ensure rewrite rules allow image access
