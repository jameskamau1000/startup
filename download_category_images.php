<?php
/**
 * PHP Script to Download Category Images for Fundme Business Crowdfunding Platform
 * 
 * This script downloads free, unbranded images from Unsplash for all business categories
 * 
 * Usage: php download_category_images.php
 * 
 * Make sure you have write permissions to the public/img-category directory
 */

// Directory where images will be saved
$imageDir = __DIR__ . '/public/img-category';

// Create directory if it doesn't exist
if (!is_dir($imageDir)) {
    mkdir($imageDir, 0755, true);
    echo "Created directory: $imageDir\n";
}

// Array of category images with their Unsplash URLs
$images = [
    'technology-software.jpg' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop',
    'ecommerce-retail.jpg' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop',
    'food-beverage.jpg' => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop',
    'manufacturing-production.jpg' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop',
    'professional-services.jpg' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop',
    'real-estate-construction.jpg' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop',
    'healthcare-medical-business.jpg' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop',
    'education-training-business.jpg' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop',
    'finance-fintech.jpg' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
    'transportation-logistics.jpg' => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop',
    'marketing-advertising.jpg' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop',
    'energy-utilities.jpg' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop',
    'agriculture-farming-business.jpg' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop',
    'hospitality-tourism-business.jpg' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop',
    'media-entertainment-business.jpg' => 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop',
    'consulting-advisory.jpg' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
    'fashion-apparel-business.jpg' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop',
];

echo "========================================\n";
echo "Downloading Category Images\n";
echo "========================================\n\n";

$successCount = 0;
$failCount = 0;

foreach ($images as $filename => $url) {
    $filepath = $imageDir . '/' . $filename;
    
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
if (is_dir($imageDir)) {
    echo "Setting file permissions...\n";
    $files = glob($imageDir . '/*.jpg');
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
$files = glob($imageDir . '/*.jpg');
foreach ($files as $file) {
    $size = filesize($file);
    $sizeFormatted = number_format($size / 1024, 2) . ' KB';
    echo "  " . basename($file) . " - $sizeFormatted\n";
}

echo "\n";
echo "All images downloaded to: $imageDir\n";
echo "\n";
echo "Next steps:\n";
echo "1. Run the SQL update file: update_category_images.sql\n";
echo "2. Verify images are displaying correctly on the categories page\n";
echo "\n";
echo "Note: All images are from Unsplash and are free for commercial use\n";
