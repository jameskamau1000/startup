<?php
/**
 * Comprehensive Fix Script for Business Listing Images on Production
 * 
 * This script:
 * 1. Downloads missing images
 * 2. Creates storage symlink
 * 3. Verifies and fixes database paths
 * 4. Sets proper permissions
 * 
 * Usage: php fix_marketplace_images_production.php
 */

echo "========================================\n";
echo "Fixing Business Listing Images\n";
echo "========================================\n\n";

// Step 1: Create storage directory structure
$storageDir = __DIR__ . '/storage/app/public/business-listings';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "✓ Created storage directory: $storageDir\n";
} else {
    echo "✓ Storage directory exists\n";
}

// Step 2: Download images
echo "\nDownloading images...\n";
$images = [
    'listing_1.jpg' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200&h=800&fit=crop',
    'listing_2.jpg' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=1200&h=800&fit=crop',
    'listing_3.jpg' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=800&fit=crop',
    'listing_4.jpg' => 'https://images.unsplash.com/photo-1556740758-90de374c12ad?w=1200&h=800&fit=crop',
    'listing_5.jpg' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&h=800&fit=crop',
    'listing_6.jpg' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=1200&h=800&fit=crop',
    'listing_7.jpg' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1200&h=800&fit=crop',
    'listing_8.jpg' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1200&h=800&fit=crop',
    'listing_9.jpg' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200&h=800&fit=crop',
    'listing_10.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=800&fit=crop',
    'listing_11.jpg' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&h=800&fit=crop',
    'listing_12.jpg' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=1200&h=800&fit=crop',
    'listing_13.jpg' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=1200&h=800&fit=crop',
    'listing_14.jpg' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=1200&h=800&fit=crop',
    'listing_15.jpg' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&h=800&fit=crop',
    'listing_16.jpg' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1200&h=800&fit=crop',
    'listing_17.jpg' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&h=800&fit=crop',
    'listing_18.jpg' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1200&h=800&fit=crop',
    'listing_19.jpg' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=1200&h=800&fit=crop',
    'listing_20.jpg' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&h=800&fit=crop',
    'listing_21.jpg' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&h=800&fit=crop',
    'listing_22.jpg' => 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=1200&h=800&fit=crop',
    'listing_23.jpg' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=1200&h=800&fit=crop',
    'listing_24.jpg' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=1200&h=800&fit=crop',
    'listing_25.jpg' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=1200&h=800&fit=crop',
    'listing_26.jpg' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1200&h=800&fit=crop',
    'listing_27.jpg' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&h=800&fit=crop',
    'listing_28.jpg' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&h=800&fit=crop',
    'listing_29.jpg' => 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=1200&h=800&fit=crop',
    'listing_30.jpg' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1200&h=800&fit=crop',
    'listing_31.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=800&fit=crop',
    'listing_32.jpg' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200&h=800&fit=crop',
    'listing_33.jpg' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&h=800&fit=crop',
    'listing_34.jpg' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=1200&h=800&fit=crop',
];

$successCount = 0;
$failCount = 0;

foreach ($images as $filename => $url) {
    $filepath = $storageDir . '/' . $filename;
    
    // Skip if already exists
    if (file_exists($filepath)) {
        echo "  ✓ $filename (already exists)\n";
        $successCount++;
        continue;
    }
    
    echo "  Downloading $filename... ";
    
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: Mozilla/5.0 (compatible; Fundme Image Downloader)',
                'Accept: image/*'
            ],
            'timeout' => 30
        ]
    ]);
    
    $imageData = @file_get_contents($url, false, $context);
    
    if ($imageData !== false && strlen($imageData) > 0) {
        if (file_put_contents($filepath, $imageData) !== false) {
            $imageInfo = @getimagesize($filepath);
            if ($imageInfo !== false) {
                echo "✓\n";
                $successCount++;
            } else {
                echo "✗ (invalid)\n";
                @unlink($filepath);
                $failCount++;
            }
        } else {
            echo "✗ (write failed)\n";
            $failCount++;
        }
    } else {
        echo "✗ (download failed)\n";
        $failCount++;
    }
}

echo "\nDownloaded: $successCount, Failed: $failCount\n";

// Step 3: Create storage symlink
echo "\nCreating storage symlink...\n";
$publicStorage = __DIR__ . '/public/storage';
$storageAppPublic = __DIR__ . '/storage/app/public';

if (file_exists($publicStorage)) {
    if (is_link($publicStorage)) {
        echo "✓ Storage symlink already exists\n";
    } else {
        echo "⚠ Warning: public/storage exists but is not a symlink\n";
        echo "  Please remove it manually and run: php artisan storage:link\n";
    }
} else {
    // Try to create symlink
    if (symlink($storageAppPublic, $publicStorage)) {
        echo "✓ Created storage symlink: public/storage -> storage/app/public\n";
    } else {
        echo "✗ Failed to create symlink. Please run: php artisan storage:link\n";
    }
}

// Step 4: Set permissions
echo "\nSetting permissions...\n";
if (is_dir($storageDir)) {
    $files = glob($storageDir . '/*.jpg');
    foreach ($files as $file) {
        chmod($file, 0644);
    }
    chmod($storageDir, 0755);
    echo "✓ Permissions set\n";
}

// Step 5: Generate SQL to fix database paths
echo "\n========================================\n";
echo "Database Path Fix SQL\n";
echo "========================================\n";
echo "Run this SQL to ensure image paths are correct:\n\n";
echo "UPDATE business_listings \n";
echo "SET main_image = CONCAT('business-listings/', SUBSTRING_INDEX(main_image, '/', -1))\n";
echo "WHERE main_image IS NOT NULL \n";
echo "  AND main_image NOT LIKE 'business-listings/%'\n";
echo "  AND main_image LIKE 'listing_%';\n\n";
echo "Or if paths are already correct, verify with:\n\n";
echo "SELECT id, title, main_image FROM business_listings WHERE main_image IS NOT NULL LIMIT 5;\n\n";

echo "========================================\n";
echo "Verification Steps\n";
echo "========================================\n";
echo "1. Check if images exist:\n";
echo "   ls -la storage/app/public/business-listings/ | head -5\n\n";
echo "2. Check if symlink exists:\n";
echo "   ls -la public/storage\n\n";
echo "3. Test image URL:\n";
echo "   Visit: https://yourdomain.com/storage/business-listings/listing_1.jpg\n\n";
echo "4. Clear Laravel cache:\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n";
echo "   php artisan cache:clear\n\n";

echo "Done!\n";
