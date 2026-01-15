<?php
/**
 * Production Script to Download Category Images
 * 
 * This script downloads all category images from Unsplash and sets them up for production use.
 * 
 * Usage: php download_images_production.php
 * 
 * Requirements:
 * - PHP with curl or allow_url_fopen enabled
 * - Write permissions to public/img-category directory
 */

// Set execution time limit for large downloads
set_time_limit(300);

// Directory where images will be saved
$imageDir = __DIR__ . '/public/img-category';

// Create directory if it doesn't exist
if (!is_dir($imageDir)) {
    if (!mkdir($imageDir, 0755, true)) {
        die("ERROR: Cannot create directory: $imageDir\n");
    }
    echo "✓ Created directory: $imageDir\n";
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
echo "Category Images Download Script\n";
echo "========================================\n\n";

$successCount = 0;
$failCount = 0;
$skipCount = 0;

// Function to download image using curl (preferred)
function downloadWithCurl($url, $filepath) {
    $ch = curl_init($url);
    $fp = fopen($filepath, 'wb');
    
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Fundme Image Downloader)');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    fclose($fp);
    
    if ($result && $httpCode == 200 && filesize($filepath) > 0) {
        return true;
    }
    
    @unlink($filepath);
    return false;
}

// Function to download image using file_get_contents (fallback)
function downloadWithFileGetContents($url, $filepath) {
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: Mozilla/5.0 (compatible; Fundme Image Downloader)',
                'Accept: image/*'
            ],
            'timeout' => 30,
            'follow_location' => 1
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ]);
    
    $imageData = @file_get_contents($url, false, $context);
    
    if ($imageData !== false && strlen($imageData) > 0) {
        if (file_put_contents($filepath, $imageData) !== false) {
            return true;
        }
    }
    
    return false;
}

// Check if curl is available
$useCurl = function_exists('curl_init');

foreach ($images as $filename => $url) {
    $filepath = $imageDir . '/' . $filename;
    
    // Skip if file already exists and is valid
    if (file_exists($filepath)) {
        $imageInfo = @getimagesize($filepath);
        if ($imageInfo !== false && filesize($filepath) > 1000) {
            echo "⏭  Skipping $filename (already exists)\n";
            $skipCount++;
            continue;
        } else {
            // Remove invalid file
            @unlink($filepath);
        }
    }
    
    echo "Downloading $filename... ";
    
    // Try to download
    $success = false;
    if ($useCurl) {
        $success = downloadWithCurl($url, $filepath);
    } else {
        $success = downloadWithFileGetContents($url, $filepath);
    }
    
    if ($success) {
        // Verify it's a valid image
        $imageInfo = @getimagesize($filepath);
        if ($imageInfo !== false) {
            $size = filesize($filepath);
            $sizeFormatted = number_format($size / 1024, 2) . ' KB';
            echo "✓ Success ($sizeFormatted)\n";
            $successCount++;
        } else {
            echo "✗ Failed (invalid image)\n";
            @unlink($filepath);
            $failCount++;
        }
    } else {
        echo "✗ Failed (download error)\n";
        $failCount++;
    }
}

echo "\n========================================\n";
echo "Download Summary:\n";
echo "  ✓ Successful: $successCount\n";
echo "  ⏭  Skipped (already exists): $skipCount\n";
echo "  ✗ Failed: $failCount\n";
echo "========================================\n\n";

// Set proper permissions
if (is_dir($imageDir)) {
    echo "Setting file permissions...\n";
    $files = glob($imageDir . '/*.jpg');
    $permissionSet = 0;
    
    foreach ($files as $file) {
        if (chmod($file, 0644)) {
            $permissionSet++;
        }
        
        // Try to set ownership to www-data if it exists
        if (function_exists('posix_getpwnam')) {
            $wwwData = @posix_getpwnam('www-data');
            if ($wwwData) {
                @chown($file, 'www-data');
                @chgrp($file, 'www-data');
            }
        }
    }
    
    echo "✓ Permissions set for $permissionSet files\n\n";
}

// Display file list
echo "Downloaded images:\n";
$files = glob($imageDir . '/*.jpg');
if (count($files) > 0) {
    foreach ($files as $file) {
        $size = filesize($file);
        $sizeFormatted = number_format($size / 1024, 2) . ' KB';
        echo "  " . basename($file) . " - $sizeFormatted\n";
    }
} else {
    echo "  No images found!\n";
}

echo "\n";
echo "========================================\n";
echo "Next Steps:\n";
echo "========================================\n";
echo "1. Verify images are in: $imageDir\n";
echo "2. Update database with: mysql -u username -p database < update_category_images.sql\n";
echo "3. Clear Laravel caches:\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n";
echo "   php artisan cache:clear\n";
echo "4. Test images on the categories page\n";
echo "\n";
echo "Total images: " . count($files) . " / " . count($images) . "\n";
echo "\n";

if ($failCount > 0) {
    echo "⚠️  Warning: Some images failed to download. Please check your internet connection and try again.\n";
    exit(1);
} else {
    echo "✓ All images downloaded successfully!\n";
    exit(0);
}
