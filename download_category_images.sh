#!/bin/bash

# Script to Download Category Images for Fundme Business Crowdfunding Platform
# This script downloads free, unbranded images from Unsplash for all business categories
# Usage: ./download_category_images.sh

set -e

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Directory where images will be saved
IMAGE_DIR="public/img-category"

# Check if directory exists, create if not
if [ ! -d "$IMAGE_DIR" ]; then
    echo -e "${YELLOW}Creating directory: $IMAGE_DIR${NC}"
    mkdir -p "$IMAGE_DIR"
fi

# Check if wget is installed
if ! command -v wget &> /dev/null; then
    echo -e "${RED}Error: wget is not installed. Installing...${NC}"
    apt-get update -qq && apt-get install -y wget
fi

echo -e "${GREEN}Starting download of category images...${NC}"
echo ""

# Array of category images with their Unsplash URLs
declare -A images=(
    ["technology-software.jpg"]="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop"
    ["ecommerce-retail.jpg"]="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop"
    ["food-beverage.jpg"]="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop"
    ["manufacturing-production.jpg"]="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop"
    ["professional-services.jpg"]="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop"
    ["real-estate-construction.jpg"]="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop"
    ["healthcare-medical-business.jpg"]="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop"
    ["education-training-business.jpg"]="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop"
    ["finance-fintech.jpg"]="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop"
    ["transportation-logistics.jpg"]="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop"
    ["marketing-advertising.jpg"]="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop"
    ["energy-utilities.jpg"]="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop"
    ["agriculture-farming-business.jpg"]="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop"
    ["hospitality-tourism-business.jpg"]="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop"
    ["media-entertainment-business.jpg"]="https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop"
    ["consulting-advisory.jpg"]="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop"
    ["fashion-apparel-business.jpg"]="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop"
)

# Download each image
success_count=0
fail_count=0

for filename in "${!images[@]}"; do
    url="${images[$filename]}"
    filepath="$IMAGE_DIR/$filename"
    
    echo -n "Downloading $filename... "
    
    if wget -q "$url" -O "$filepath" 2>/dev/null; then
        # Verify the file was downloaded and is not empty
        if [ -s "$filepath" ]; then
            echo -e "${GREEN}✓ Success${NC}"
            ((success_count++))
        else
            echo -e "${RED}✗ Failed (empty file)${NC}"
            rm -f "$filepath"
            ((fail_count++))
        fi
    else
        echo -e "${RED}✗ Failed${NC}"
        ((fail_count++))
    fi
done

echo ""
echo -e "${GREEN}========================================${NC}"
echo -e "Download Summary:"
echo -e "  ${GREEN}Successful: $success_count${NC}"
echo -e "  ${RED}Failed: $fail_count${NC}"
echo -e "${GREEN}========================================${NC}"

# Set proper permissions
if [ -d "$IMAGE_DIR" ]; then
    echo ""
    echo "Setting file permissions..."
    chmod 644 "$IMAGE_DIR"/*.jpg 2>/dev/null || true
    
    # Try to set ownership to www-data if it exists
    if id "www-data" &>/dev/null; then
        chown www-data:www-data "$IMAGE_DIR"/*.jpg 2>/dev/null || true
        echo "Permissions set to www-data:www-data"
    else
        echo "www-data user not found, skipping ownership change"
    fi
fi

# Display file sizes
echo ""
echo "Downloaded images:"
ls -lh "$IMAGE_DIR"/*.jpg 2>/dev/null | awk '{print "  " $9 " - " $5}'

echo ""
echo -e "${GREEN}All images downloaded to: $IMAGE_DIR${NC}"
echo ""
echo "Next steps:"
echo "1. Run the SQL update file: update_category_images.sql"
echo "2. Verify images are displaying correctly on the categories page"
echo ""
echo -e "${YELLOW}Note: All images are from Unsplash and are free for commercial use${NC}"
