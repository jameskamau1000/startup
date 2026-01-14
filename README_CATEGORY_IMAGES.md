# Category Images Download Guide

This guide explains how to download category images for the Fundme Business Crowdfunding Platform on your production server.

## Quick Start

### Option 1: Automated Script (Recommended)

1. **Upload the script to your server:**
   ```bash
   # Upload download_category_images.sh to your project root
   ```

2. **Make it executable:**
   ```bash
   chmod +x download_category_images.sh
   ```

3. **Run the script:**
   ```bash
   cd /path/to/your/project
   ./download_category_images.sh
   ```

4. **Update the database:**
   ```bash
   mysql -u username -p database_name < update_category_images.sql
   ```

### Option 2: Manual Download

If you prefer to download images manually or the script doesn't work:

1. **Create the directory:**
   ```bash
   mkdir -p public/img-category
   ```

2. **Download each image using wget:**
   ```bash
   cd public/img-category
   
   wget "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop" -O technology-software.jpg
   wget "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop" -O ecommerce-retail.jpg
   wget "https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop" -O food-beverage.jpg
   wget "https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop" -O manufacturing-production.jpg
   wget "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop" -O professional-services.jpg
   wget "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop" -O real-estate-construction.jpg
   wget "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop" -O healthcare-medical-business.jpg
   wget "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop" -O education-training-business.jpg
   wget "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop" -O finance-fintech.jpg
   wget "https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop" -O transportation-logistics.jpg
   wget "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop" -O marketing-advertising.jpg
   wget "https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop" -O energy-utilities.jpg
   wget "https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop" -O agriculture-farming-business.jpg
   wget "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop" -O hospitality-tourism-business.jpg
   wget "https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop" -O media-entertainment-business.jpg
   wget "https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop" -O consulting-advisory.jpg
   wget "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop" -O fashion-apparel-business.jpg
   ```

3. **Set permissions:**
   ```bash
   chmod 644 public/img-category/*.jpg
   chown www-data:www-data public/img-category/*.jpg
   ```

4. **Update the database:**
   ```bash
   mysql -u username -p database_name < update_category_images.sql
   ```

## Image List

All images are downloaded from Unsplash (unsplash.com) and are free for commercial use with no watermarks:

1. `technology-software.jpg` - Technology & Software
2. `ecommerce-retail.jpg` - E-commerce & Retail
3. `food-beverage.jpg` - Food & Beverage
4. `manufacturing-production.jpg` - Manufacturing & Production
5. `professional-services.jpg` - Professional Services
6. `real-estate-construction.jpg` - Real Estate & Construction
7. `healthcare-medical-business.jpg` - Healthcare & Medical Business
8. `education-training-business.jpg` - Education & Training Business
9. `finance-fintech.jpg` - Finance & Fintech
10. `transportation-logistics.jpg` - Transportation & Logistics
11. `marketing-advertising.jpg` - Marketing & Advertising
12. `energy-utilities.jpg` - Energy & Utilities
13. `agriculture-farming-business.jpg` - Agriculture & Farming Business
14. `hospitality-tourism-business.jpg` - Hospitality & Tourism Business
15. `media-entertainment-business.jpg` - Media & Entertainment Business
16. `consulting-advisory.jpg` - Consulting & Advisory
17. `fashion-apparel-business.jpg` - Fashion & Apparel Business

## Requirements

- `wget` command-line tool (usually pre-installed on Linux servers)
- Write permissions to `public/img-category/` directory
- MySQL access to update the database

## Troubleshooting

### Script fails to download images

1. Check internet connectivity:
   ```bash
   ping -c 3 images.unsplash.com
   ```

2. Check if wget is installed:
   ```bash
   which wget
   ```

3. Try downloading manually with verbose output:
   ```bash
   wget -v "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop" -O test.jpg
   ```

### Images not displaying after database update

1. Verify image paths in database:
   ```sql
   SELECT id, name, image FROM categories WHERE image != '';
   ```

2. Check file permissions:
   ```bash
   ls -la public/img-category/
   ```

3. Verify images exist:
   ```bash
   ls -lh public/img-category/*.jpg
   ```

### Permission errors

If you get permission errors, run:
```bash
sudo chown -R www-data:www-data public/img-category/
sudo chmod -R 644 public/img-category/*.jpg
```

## License

All images are from Unsplash and are licensed under the [Unsplash License](https://unsplash.com/license), which allows:
- Free for commercial and non-commercial use
- No permission needed (though attribution is appreciated)
- No watermark or branding

## Support

If you encounter any issues, check:
1. Server logs for errors
2. File permissions
3. Database connection
4. Image file integrity
