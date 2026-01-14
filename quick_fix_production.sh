#!/bin/bash
# Quick fix script for production image issues

echo "Quick Fix for Category Images on Production"
echo "==========================================="
echo ""

# Check if images exist
if [ ! -d "public/img-category" ]; then
    echo "Creating directory..."
    mkdir -p public/img-category
fi

IMAGE_COUNT=$(ls -1 public/img-category/*.jpg 2>/dev/null | wc -l)
echo "Current images: $IMAGE_COUNT"

if [ "$IMAGE_COUNT" -lt 17 ]; then
    echo ""
    echo "Images missing! Downloading..."
    if [ -f "download_category_images.sh" ]; then
        chmod +x download_category_images.sh
        ./download_category_images.sh
    elif [ -f "download_category_images.php" ]; then
        php download_category_images.php
    else
        echo "ERROR: Download scripts not found!"
        exit 1
    fi
fi

echo ""
echo "Setting permissions..."
chmod 644 public/img-category/*.jpg 2>/dev/null
chown www-data:www-data public/img-category/*.jpg 2>/dev/null || true

echo ""
echo "Clearing caches..."
php artisan config:clear 2>/dev/null
php artisan view:clear 2>/dev/null
php artisan cache:clear 2>/dev/null

echo ""
echo "Done! Check your categories page."
echo ""
echo "If still not working, verify:"
echo "1. Database has image paths: SELECT image FROM categories;"
echo "2. APP_URL in .env is correct"
echo "3. Images are accessible: curl https://yourdomain.com/public/img-category/technology-software.jpg"
