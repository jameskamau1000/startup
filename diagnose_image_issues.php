<?php
/**
 * Diagnostic Script for Category Image Issues on Production
 * Run this script to identify why images are not showing
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

echo "========================================\n";
echo "Category Images Diagnostic Tool\n";
echo "========================================\n\n";

$issues = [];
$warnings = [];
$success = [];

// Check 1: Images directory exists
echo "1. Checking images directory...\n";
$imgDir = public_path('img-category');
if (!is_dir($imgDir)) {
    $issues[] = "Directory 'public/img-category' does not exist";
    echo "   ❌ Directory missing\n";
} else {
    echo "   ✓ Directory exists\n";
}

// Check 2: Images exist
echo "\n2. Checking image files...\n";
$imageFiles = glob($imgDir . '/*.jpg');
$imageCount = count($imageFiles);
echo "   Found: $imageCount images\n";

if ($imageCount < 17) {
    $warnings[] = "Only $imageCount images found. Expected at least 17.";
    echo "   ⚠️  Missing images\n";
} else {
    echo "   ✓ All images present\n";
}

// Check 3: File permissions
echo "\n3. Checking file permissions...\n";
if ($imageCount > 0) {
    $sampleFile = $imageFiles[0];
    $perms = substr(sprintf('%o', fileperms($sampleFile)), -4);
    echo "   Sample file permissions: $perms\n";
    
    if (!is_readable($sampleFile)) {
        $issues[] = "Image files are not readable";
        echo "   ❌ Files not readable\n";
    } else {
        echo "   ✓ Files are readable\n";
    }
} else {
    $warnings[] = "Cannot check permissions - no images found";
}

// Check 4: Database connection
echo "\n4. Checking database...\n";
try {
    $categories = App\Models\Categories::all();
    echo "   ✓ Database connection OK\n";
    echo "   Found: " . $categories->count() . " categories\n";
    
    // Check 5: Database image paths
    echo "\n5. Checking database image paths...\n";
    $categoriesWithImages = 0;
    $categoriesWithoutImages = 0;
    
    foreach ($categories as $cat) {
        if (!empty($cat->image)) {
            $categoriesWithImages++;
            $fullPath = public_path($cat->image);
            if (!file_exists($fullPath)) {
                $warnings[] = "Category '{$cat->name}' has image path '{$cat->image}' but file doesn't exist";
                echo "   ⚠️  Category '{$cat->name}': File missing for path '{$cat->image}'\n";
            }
        } else {
            $categoriesWithoutImages++;
        }
    }
    
    echo "   Categories with images: $categoriesWithImages\n";
    echo "   Categories without images: $categoriesWithoutImages\n";
    
    if ($categoriesWithImages == 0) {
        $issues[] = "No categories have image paths in database. Run update_category_images.sql";
        echo "   ❌ No image paths in database\n";
    }
    
} catch (Exception $e) {
    $issues[] = "Database error: " . $e->getMessage();
    echo "   ❌ Database error: " . $e->getMessage() . "\n";
}

// Check 6: APP_URL configuration
echo "\n6. Checking APP_URL configuration...\n";
$appUrl = config('app.url');
echo "   APP_URL: $appUrl\n";

if (strpos($appUrl, 'localhost') !== false || strpos($appUrl, '127.0.0.1') !== false) {
    $warnings[] = "APP_URL is set to localhost. Update .env with production domain.";
    echo "   ⚠️  APP_URL is localhost (should be production domain)\n";
} else {
    echo "   ✓ APP_URL looks correct\n";
}

// Check 7: Test URL generation
echo "\n7. Testing URL generation...\n";
try {
    $testCat = App\Models\Categories::where('image', '!=', '')->first();
    if ($testCat) {
        $testUrl = asset('public/'.($testCat->image == '' ? 'img-category/default.jpg' : $testCat->image));
        echo "   Sample URL: $testUrl\n";
        
        if (strpos($testUrl, 'localhost') !== false) {
            $warnings[] = "Generated URLs contain localhost. Check APP_URL in .env";
            echo "   ⚠️  URL contains localhost\n";
        } else {
            echo "   ✓ URL generation OK\n";
        }
    } else {
        $warnings[] = "Cannot test URL generation - no categories with images";
    }
} catch (Exception $e) {
    $warnings[] = "Error testing URL: " . $e->getMessage();
}

// Check 8: Laravel caches
echo "\n8. Checking Laravel caches...\n";
$configCache = file_exists(base_path('bootstrap/cache/config.php'));
$viewCache = count(glob(storage_path('framework/views/*.php'))) > 0;

if ($configCache) {
    echo "   ⚠️  Config cache exists (may need clearing)\n";
    $warnings[] = "Config cache exists. Run: php artisan config:clear";
} else {
    echo "   ✓ No config cache\n";
}

if ($viewCache) {
    echo "   ⚠️  View cache exists (may need clearing)\n";
    $warnings[] = "View cache exists. Run: php artisan view:clear";
} else {
    echo "   ✓ No view cache\n";
}

// Summary
echo "\n========================================\n";
echo "SUMMARY\n";
echo "========================================\n\n";

if (empty($issues) && empty($warnings)) {
    echo "✅ All checks passed! Images should be working.\n\n";
    echo "If images still don't show, check:\n";
    echo "1. Browser console for 404 errors\n";
    echo "2. Server logs for access errors\n";
    echo "3. Apache/Nginx configuration\n";
} else {
    if (!empty($issues)) {
        echo "❌ CRITICAL ISSUES:\n";
        foreach ($issues as $issue) {
            echo "   - $issue\n";
        }
        echo "\n";
    }
    
    if (!empty($warnings)) {
        echo "⚠️  WARNINGS:\n";
        foreach ($warnings as $warning) {
            echo "   - $warning\n";
        }
        echo "\n";
    }
    
    echo "RECOMMENDED FIXES:\n";
    echo "1. Run: ./quick_fix_production.sh\n";
    echo "2. Or manually:\n";
    echo "   - Download images: ./download_category_images.sh\n";
    echo "   - Update database: mysql -u user -p db < update_category_images.sql\n";
    echo "   - Set permissions: chmod 644 public/img-category/*.jpg\n";
    echo "   - Clear caches: php artisan config:clear && php artisan view:clear\n";
    echo "   - Update .env: APP_URL=https://yourdomain.com\n";
}

echo "\n";
