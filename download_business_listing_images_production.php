<?php
/**
 * PHP Script to Download Business Listing Images for Production
 *
 * This script downloads free, unbranded images from Unsplash for all business listings
 * Images are stored in storage/app/public/business-listings/ directory
 *
 * Usage: php download_business_listing_images_production.php
 *
 * Make sure you have write permissions to the storage/app/public/business-listings directory
 */

// Directory where images will be saved (Laravel storage)
$storageDir = __DIR__ . '/storage/app/public/business-listings';

// Create directory if it doesn't exist
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "Created directory: $storageDir\n";
}

// Array of business listing images with their Unsplash URLs
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

echo "========================================\n";
echo "Downloading Business Listing Images\n";
echo "========================================\n\n";

$successCount = 0;
$failCount = 0;

foreach ($images as $filename => $url) {
    $filepath = $storageDir . '/' . $filename;

    echo "Downloading $filename... ";

    // Use file_get_contents with context for better error handling
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
            // Verify it's a valid image
            $imageInfo = @getimagesize($filepath);
            if ($imageInfo !== false) {
                echo "✓ Success (" . number_format(strlen($imageData) / 1024, 2) . " KB)\n";
                $successCount++;
            } else {
                echo "✗ Failed (invalid image)\n";
                @unlink($filepath);
                $failCount++;
            }
        } else {
            echo "✗ Failed (cannot write file)\n";
            $failCount++;
        }
    } else {
        echo "✗ Failed (download error)\n";
        $failCount++;
    }
}

echo "\n========================================\n";
echo "Download Summary:\n";
echo "  Successful: $successCount\n";
echo "  Failed: $failCount\n";
echo "========================================\n\n";

// Set proper permissions
if (is_dir($storageDir)) {
    echo "Setting file permissions...\n";
    $files = glob($storageDir . '/*.jpg');
    foreach ($files as $file) {
        chmod($file, 0644);
        // Try to set ownership to www-data if it exists
        if (function_exists('posix_getpwnam') && posix_getpwnam('www-data')) {
            chown($file, 'www-data');
            chgrp($file, 'www-data');
        }
    }
    echo "Permissions set.\n\n";
}

// Display file sizes
echo "Downloaded images:\n";
$files = glob($storageDir . '/*.jpg');
foreach ($files as $file) {
    $size = filesize($file);
    $sizeFormatted = number_format($size / 1024, 2) . ' KB';
    echo "  " . basename($file) . " - $sizeFormatted\n";
}

echo "\n";
echo "All images downloaded to: $storageDir\n";
echo "\n";
echo "IMPORTANT: Make sure the storage symlink exists:\n";
echo "  Run: php artisan storage:link\n";
echo "\n";
echo "Note: All images are from Unsplash and are free for commercial use\n";
