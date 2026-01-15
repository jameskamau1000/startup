<?php
/**
 * Fix Marketplace Image Paths
 * 
 * This script:
 * 1. Moves images from public/business-listings/ to storage/app/public/business-listings/
 * 2. Updates database paths to include 'business-listings/' prefix
 * 3. Creates storage symlink if needed
 * 
 * Usage: php fix_marketplace_image_paths.php
 */

echo "========================================\n";
echo "Fixing Marketplace Image Paths\n";
echo "========================================\n\n";

// Step 1: Move images from public to storage
$publicDir = __DIR__ . '/public/business-listings';
$storageDir = __DIR__ . '/storage/app/public/business-listings';

echo "Step 1: Moving images to storage...\n";

// Create storage directory if it doesn't exist
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "✓ Created storage directory\n";
}

// Move images from public to storage
if (is_dir($publicDir)) {
    $files = glob($publicDir . '/*.jpg');
    $movedCount = 0;
    
    foreach ($files as $file) {
        $filename = basename($file);
        $dest = $storageDir . '/' . $filename;
        
        if (file_exists($dest)) {
            echo "  ⚠ $filename already exists in storage, skipping\n";
        } else {
            if (rename($file, $dest)) {
                echo "  ✓ Moved $filename to storage\n";
                $movedCount++;
            } else {
                echo "  ✗ Failed to move $filename\n";
            }
        }
    }
    
    echo "✓ Moved $movedCount images\n";
    
    // Remove empty public directory
    if (count(glob($publicDir . '/*')) == 0) {
        rmdir($publicDir);
        echo "✓ Removed empty public/business-listings directory\n";
    }
} else {
    echo "⚠ public/business-listings directory not found\n";
}

// Step 2: Create storage symlink
echo "\nStep 2: Creating storage symlink...\n";
$publicStorage = __DIR__ . '/public/storage';
$storageAppPublic = __DIR__ . '/storage/app/public';

if (file_exists($publicStorage)) {
    if (is_link($publicStorage)) {
        $target = readlink($publicStorage);
        if ($target == '../storage/app/public' || $target == $storageAppPublic) {
            echo "✓ Storage symlink already exists and is correct\n";
        } else {
            echo "⚠ Storage symlink exists but points to wrong location\n";
            echo "  Please run: php artisan storage:link\n";
        }
    } else {
        echo "⚠ public/storage exists but is not a symlink\n";
        echo "  Please remove it and run: php artisan storage:link\n";
    }
} else {
    if (symlink('../storage/app/public', $publicStorage)) {
        echo "✓ Created storage symlink\n";
    } else {
        echo "✗ Failed to create symlink. Please run: php artisan storage:link\n";
    }
}

// Step 3: Generate SQL to fix database paths
echo "\nStep 3: Database Path Fix\n";
echo "========================================\n";
echo "Run this SQL to fix database paths:\n\n";

echo "-- Fix paths that are missing the 'business-listings/' prefix\n";
echo "UPDATE business_listings \n";
echo "SET main_image = CONCAT('business-listings/', main_image)\n";
echo "WHERE main_image IS NOT NULL \n";
echo "  AND main_image NOT LIKE 'business-listings/%'\n";
echo "  AND main_image LIKE 'listing_%';\n\n";

echo "-- Verify the fix\n";
echo "SELECT id, title, main_image FROM business_listings WHERE main_image IS NOT NULL LIMIT 5;\n\n";

echo "Paths should be: business-listings/listing_1.jpg\n";
echo "NOT: listing_1.jpg or /business-listings/listing_1.jpg\n\n";

// Step 4: Set permissions
echo "Step 4: Setting permissions...\n";
if (is_dir($storageDir)) {
    $files = glob($storageDir . '/*.jpg');
    foreach ($files as $file) {
        chmod($file, 0644);
    }
    chmod($storageDir, 0755);
    echo "✓ Permissions set\n";
}

echo "\n========================================\n";
echo "Next Steps:\n";
echo "========================================\n";
echo "1. Run the SQL above to fix database paths\n";
echo "2. Clear Laravel cache:\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n";
echo "   php artisan cache:clear\n";
echo "3. Test image URL:\n";
echo "   https://yourdomain.com/storage/business-listings/listing_1.jpg\n";
echo "\nDone!\n";
