#!/bin/bash

# Production Deployment Script for Category Images
# This script ensures all category images are properly set up on production

set -e

GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Category Images Production Deployment${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""

# Step 1: Download images
echo -e "${YELLOW}Step 1: Downloading category images...${NC}"
if [ -f "download_category_images.sh" ]; then
    chmod +x download_category_images.sh
    ./download_category_images.sh
else
    echo -e "${RED}Error: download_category_images.sh not found${NC}"
    exit 1
fi

# Step 2: Verify images exist
echo ""
echo -e "${YELLOW}Step 2: Verifying images...${NC}"
IMAGE_COUNT=$(ls -1 public/img-category/*.jpg 2>/dev/null | wc -l)
if [ "$IMAGE_COUNT" -lt 17 ]; then
    echo -e "${RED}Warning: Only $IMAGE_COUNT images found. Expected at least 17.${NC}"
else
    echo -e "${GREEN}✓ Found $IMAGE_COUNT images${NC}"
fi

# Step 3: Set permissions
echo ""
echo -e "${YELLOW}Step 3: Setting file permissions...${NC}"
chmod 644 public/img-category/*.jpg 2>/dev/null || true
if id "www-data" &>/dev/null; then
    chown www-data:www-data public/img-category/*.jpg 2>/dev/null || true
    echo -e "${GREEN}✓ Permissions set${NC}"
else
    echo -e "${YELLOW}Warning: www-data user not found${NC}"
fi

# Step 4: Update database
echo ""
echo -e "${YELLOW}Step 4: Updating database...${NC}"
if [ -f "update_category_images.sql" ]; then
    read -p "Enter MySQL username: " DB_USER
    read -sp "Enter MySQL password: " DB_PASS
    echo ""
    read -p "Enter database name: " DB_NAME
    
    if mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < update_category_images.sql 2>/dev/null; then
        echo -e "${GREEN}✓ Database updated${NC}"
    else
        echo -e "${RED}Error: Database update failed${NC}"
        exit 1
    fi
else
    echo -e "${RED}Error: update_category_images.sql not found${NC}"
    exit 1
fi

# Step 5: Clear Laravel caches
echo ""
echo -e "${YELLOW}Step 5: Clearing Laravel caches...${NC}"
php artisan config:clear 2>/dev/null && echo -e "${GREEN}✓ Config cache cleared${NC}" || echo -e "${YELLOW}Warning: Could not clear config cache${NC}"
php artisan view:clear 2>/dev/null && echo -e "${GREEN}✓ View cache cleared${NC}" || echo -e "${YELLOW}Warning: Could not clear view cache${NC}"
php artisan cache:clear 2>/dev/null && echo -e "${GREEN}✓ Application cache cleared${NC}" || echo -e "${YELLOW}Warning: Could not clear application cache${NC}"

# Step 6: Verify setup
echo ""
echo -e "${YELLOW}Step 6: Verifying setup...${NC}"
echo "Checking image URLs..."
php artisan tinker --execute="
\$cat = App\Models\Categories::find(1);
if (\$cat) {
    \$url = asset('public/'.(\$cat->image == '' ? 'img-category/default.jpg' : \$cat->image));
    echo 'Sample URL: ' . \$url . PHP_EOL;
    \$path = public_path(\$cat->image == '' ? 'img-category/default.jpg' : \$cat->image);
    echo 'File exists: ' . (file_exists(\$path) ? 'YES' : 'NO') . PHP_EOL;
} else {
    echo 'Error: Category not found' . PHP_EOL;
}
" 2>/dev/null || echo -e "${YELLOW}Warning: Could not verify via tinker${NC}"

echo ""
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Deployment Complete!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo "Next steps:"
echo "1. Verify APP_URL in .env is set to your production domain"
echo "2. Test image URLs in browser"
echo "3. Check categories page for images"
echo ""
