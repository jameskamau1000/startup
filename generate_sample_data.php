<?php
/**
 * Generate Sample Data SQL File
 * Creates realistic sample data for both crowdfunding campaigns and B2B marketplace
 */

$sql = "-- ============================================\n";
$sql .= "-- Sample Data for Crowdfunding and B2B Marketplace\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- ============================================\n\n";

// First, create sample users
$sql .= "-- Sample Users\n";
$sql .= "INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `avatar`, `status`, `role`, `countries_id`, `created_at`, `updated_at`) VALUES\n";

$users = [];
$userIds = [];
$passwordHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

for ($i = 2; $i <= 9; $i++) {
    $name = ['Sarah Kimani', 'James Ochieng', 'Amina Hassan', 'David Mwangi', 'Grace Wanjiku', 'Peter Kipchoge', 'Mary Njeri', 'John Kamau'][$i-2];
    $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
    $username = strtolower(str_replace(' ', '', $name));
    $users[] = [
        'id' => $i,
        'name' => $name,
        'email' => $email,
        'username' => $username
    ];
    $userIds[] = $i;
    $sql .= "($i, '$name', '$email', '$username', '$passwordHash', 'default.jpg', 'active', 'normal', 'KE', NOW(), NOW())";
    if ($i < 9) $sql .= ",\n";
    else $sql .= ";\n\n";
}

// Sample campaigns data
$campaignsData = [
    [1, 'AI-Powered Healthcare App for Rural Communities', 'Developing an innovative mobile application that uses artificial intelligence to provide healthcare consultations and medication reminders for rural communities in Kenya. The app will connect patients with qualified doctors via video calls and provide access to affordable healthcare services.', 2500000, 'Nairobi, Kenya', 1, 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=600&fit=crop'],
    [2, 'E-Learning Platform for Primary Schools', 'Creating a comprehensive e-learning platform specifically designed for primary school students in Kenya. The platform will include interactive lessons, quizzes, and progress tracking to improve educational outcomes in underserved areas.', 1800000, 'Mombasa, Kenya', 1, 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop'],
    [3, 'Online Marketplace for Local Artisans', 'Building an e-commerce platform to connect local artisans and craftspeople with customers across Africa. The platform will help preserve traditional crafts while providing income opportunities for talented artisans.', 1500000, 'Kisumu, Kenya', 2, 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop'],
    [4, 'Sustainable Fashion Brand Launch', 'Launching an eco-friendly fashion brand that uses locally sourced materials and traditional African designs. The brand will create employment opportunities while promoting sustainable fashion practices.', 2000000, 'Nairobi, Kenya', 2, 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop'],
    [5, 'Organic Farm Expansion Project', 'Expanding our organic farm to increase production of fresh vegetables and fruits. The project will create 50 new jobs and provide healthy, locally-grown produce to communities across Kenya.', 3200000, 'Nakuru, Kenya', 3, 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop'],
    [6, 'Community Restaurant for Healthy Meals', 'Opening a community-focused restaurant that serves nutritious, affordable meals using locally sourced ingredients. The restaurant will also provide cooking classes and nutrition education.', 1200000, 'Eldoret, Kenya', 3, 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=600&fit=crop'],
    [7, 'Solar Panel Manufacturing Facility', 'Establishing a solar panel manufacturing facility to produce affordable renewable energy solutions for homes and businesses. This will help reduce energy costs and promote sustainable development.', 5000000, 'Thika, Kenya', 4, 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop'],
    [8, 'Recycling Plant for Plastic Waste', 'Building a recycling plant to process plastic waste and create new products. This initiative will help reduce environmental pollution while creating employment opportunities.', 4500000, 'Nairobi, Kenya', 4, 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop'],
    [9, 'Legal Aid Clinic for Low-Income Families', 'Establishing a legal aid clinic to provide free legal services to low-income families. The clinic will help people access justice and understand their legal rights.', 800000, 'Nairobi, Kenya', 5, 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop'],
    [10, 'Accounting Services for Small Businesses', 'Creating a professional accounting firm to help small businesses manage their finances, file taxes, and grow their operations. We will provide affordable services tailored to local businesses.', 1000000, 'Mombasa, Kenya', 5, 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop'],
    [11, 'Affordable Housing Development', 'Building affordable housing units for low and middle-income families. The project will provide quality homes with modern amenities at accessible prices.', 15000000, 'Nairobi, Kenya', 6, 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop'],
    [12, 'Green Building Construction Company', 'Starting a construction company focused on eco-friendly building practices. We will use sustainable materials and energy-efficient designs to create environmentally responsible structures.', 8000000, 'Kisumu, Kenya', 6, 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=800&h=600&fit=crop'],
    [13, 'Mobile Health Clinic for Rural Areas', 'Launching a mobile health clinic that travels to rural communities providing free medical check-ups, vaccinations, and health education. The clinic will help improve healthcare access in underserved areas.', 3500000, 'Narok, Kenya', 7, 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop'],
    [14, 'Mental Health Support Center', 'Establishing a mental health support center offering counseling, therapy, and support groups. The center will help reduce stigma around mental health and provide accessible care.', 2200000, 'Nairobi, Kenya', 7, 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&h=600&fit=crop'],
    [15, 'Vocational Training Center', 'Creating a vocational training center to teach practical skills like carpentry, plumbing, electrical work, and computer skills. The center will help youth gain employable skills.', 2800000, 'Nakuru, Kenya', 8, 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop'],
    [16, 'Digital Skills Training Program', 'Launching a comprehensive digital skills training program for youth and adults. The program will teach coding, digital marketing, graphic design, and other in-demand tech skills.', 1900000, 'Mombasa, Kenya', 8, 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=600&fit=crop'],
    [17, 'Microfinance Platform for Small Businesses', 'Developing a digital microfinance platform that provides quick, affordable loans to small businesses and entrepreneurs. The platform will use innovative credit scoring to serve underserved markets.', 4000000, 'Nairobi, Kenya', 9, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'],
    [18, 'Mobile Payment Solution for Farmers', 'Creating a mobile payment solution specifically designed for farmers to receive payments, access credit, and manage their finances. The solution will help improve financial inclusion in rural areas.', 2600000, 'Eldoret, Kenya', 9, 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop'],
    [19, 'Electric Vehicle Fleet for Public Transport', 'Launching an electric vehicle fleet for public transportation to reduce carbon emissions and provide affordable, eco-friendly transport options. The fleet will include buses and vans.', 12000000, 'Nairobi, Kenya', 10, 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop'],
    [20, 'Last-Mile Delivery Service', 'Starting a last-mile delivery service using motorcycles and bicycles for fast, affordable delivery in urban areas. The service will help small businesses reach customers efficiently.', 1500000, 'Mombasa, Kenya', 10, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop'],
    [21, 'Digital Marketing Agency for SMEs', 'Establishing a digital marketing agency to help small and medium enterprises grow their online presence. We will provide social media management, SEO, and digital advertising services.', 1100000, 'Nairobi, Kenya', 11, 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'],
    [22, 'Content Creation Studio', 'Creating a professional content creation studio for video production, photography, and graphic design. The studio will serve businesses, creators, and organizations.', 2400000, 'Kisumu, Kenya', 11, 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop'],
    [23, 'Solar Power Installation Service', 'Starting a solar power installation service to help homes and businesses transition to renewable energy. We will provide affordable solar solutions with financing options.', 3000000, 'Nakuru, Kenya', 12, 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop'],
    [24, 'Biogas Production from Organic Waste', 'Establishing a biogas production facility that converts organic waste into clean cooking gas. This will help reduce deforestation and provide affordable energy to communities.', 3800000, 'Eldoret, Kenya', 12, 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop'],
    [25, 'Modern Poultry Farm Expansion', 'Expanding our modern poultry farm to increase egg and meat production. The expansion will create jobs and provide affordable protein to local communities.', 4200000, 'Kiambu, Kenya', 13, 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop'],
    [26, 'Dairy Processing Plant', 'Building a dairy processing plant to produce milk, yogurt, and cheese from local farmers. The plant will help farmers get better prices and provide quality dairy products.', 5500000, 'Narok, Kenya', 13, 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop'],
    [27, 'Eco-Tourism Lodge Development', 'Developing an eco-tourism lodge that promotes sustainable tourism while preserving local culture and environment. The lodge will create employment and support local communities.', 18000000, 'Maasai Mara, Kenya', 14, 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop'],
    [28, 'Cultural Experience Tour Company', 'Starting a tour company that offers authentic cultural experiences, connecting tourists with local communities. The company will promote cultural preservation and create income opportunities.', 1600000, 'Lamu, Kenya', 14, 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop'],
    [29, 'African Music Production Studio', 'Establishing a professional music production studio to support local artists and promote African music. The studio will provide recording, mixing, and mastering services.', 3200000, 'Nairobi, Kenya', 15, 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop'],
    [30, 'Online Streaming Platform for African Content', 'Creating an online streaming platform dedicated to African movies, TV shows, and documentaries. The platform will showcase local talent and stories.', 6000000, 'Nairobi, Kenya', 15, 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=800&h=600&fit=crop'],
    [31, 'Business Consulting Firm for Startups', 'Establishing a consulting firm to help startups and small businesses with strategy, operations, and growth. We will provide affordable consulting services tailored to local markets.', 900000, 'Nairobi, Kenya', 16, 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop'],
    [32, 'HR Consulting Services', 'Creating an HR consulting firm to help businesses with recruitment, training, and human resource management. We will help companies build strong teams and improve workplace culture.', 1300000, 'Mombasa, Kenya', 16, 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop'],
    [33, 'Sustainable Fashion Brand', 'Launching a sustainable fashion brand that uses eco-friendly materials and ethical production practices. The brand will create beautiful, affordable clothing while protecting the environment.', 2100000, 'Nairobi, Kenya', 17, 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop'],
    [34, 'African Print Clothing Line', 'Creating a clothing line that celebrates African prints and designs. The line will include modern, stylish pieces that incorporate traditional African patterns and fabrics.', 1700000, 'Kisumu, Kenya', 17, 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=800&h=600&fit=crop'],
];

$sql .= "-- Sample Crowdfunding Campaigns\n";
$sql .= "INSERT INTO `campaigns` (`id`, `user_id`, `title`, `description`, `goal`, `location`, `categories_id`, `status`, `token_id`, `small_image`, `large_image`, `featured`, `finalized`, `date`) VALUES\n";

$campaignImageUrls = [];
foreach ($campaignsData as $idx => $camp) {
    $id = $camp[0];
    $title = addslashes($camp[1]);
    $desc = addslashes($camp[2]);
    $goal = $camp[3];
    $location = addslashes($camp[4]);
    $catId = $camp[5];
    $imageUrl = $camp[6];
    $userId = $userIds[($idx) % count($userIds)];
    $token = bin2hex(random_bytes(16));
    $smallImg = "campaign_$id.jpg";
    $largeImg = "campaign_$id.jpg";
    $featured = ($idx < 6) ? "'1'" : "'0'";
    $finalized = "'0'";
    
    $campaignImageUrls[] = ['url' => $imageUrl, 'file' => $smallImg];
    
    $sql .= "($id, $userId, '$title', '$desc', $goal, '$location', $catId, 'active', '$token', '$smallImg', '$largeImg', $featured, $finalized, NOW())";
    if ($idx < count($campaignsData) - 1) $sql .= ",\n";
    else $sql .= ";\n\n";
}

// Sample business listings
$listingsData = [
    [1, 'Established SaaS Platform for Small Businesses', 'Profitable SaaS platform serving 5,000+ small businesses across East Africa. Features include inventory management, accounting, and customer relationship management. Strong recurring revenue model with 95% customer retention rate.', 'Profitable SaaS platform with 5,000+ active users and strong recurring revenue.', 'Technology & Software', 'established', 'Nairobi, Kenya', 45000000, 12000000, 4800000, 5, 25, 'B2B', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop'],
    [2, 'Mobile App Development Company', 'Well-established mobile app development company with portfolio of 50+ successful apps. Team of 15 developers specializing in iOS and Android. Strong client relationships and proven track record.', 'Mobile app development company with 50+ successful apps and 15-person team.', 'Technology & Software', 'established', 'Mombasa, Kenya', 28000000, 8500000, 3200000, 4, 15, 'B2B', 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=600&fit=crop'],
    [3, 'Online Fashion Retail Store', 'Successful online fashion retail store with 20,000+ active customers. Strong social media presence and brand recognition. Inventory includes clothing, accessories, and footwear. Established supply chain and logistics.', 'Online fashion store with 20,000+ customers and strong brand presence.', 'E-commerce & Retail', 'established', 'Nairobi, Kenya', 35000000, 15000000, 5500000, 6, 18, 'B2C', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop'],
    [4, 'Electronics Retail Chain', 'Chain of 3 electronics retail stores in prime locations. Selling smartphones, laptops, accessories, and home appliances. Established supplier relationships and loyal customer base.', 'Electronics retail chain with 3 stores and strong supplier relationships.', 'E-commerce & Retail', 'established', 'Kisumu, Kenya', 42000000, 18000000, 6500000, 8, 35, 'B2C', 'https://images.unsplash.com/photo-1556740758-90de374c12ad?w=800&h=600&fit=crop'],
    [5, 'Popular Restaurant Chain', 'Well-known restaurant chain with 4 locations serving authentic African cuisine. Strong brand reputation, loyal customer base, and consistent profitability. Prime locations with high foot traffic.', 'Restaurant chain with 4 locations and strong brand reputation.', 'Food & Beverage', 'established', 'Nairobi, Kenya', 55000000, 22000000, 8800000, 10, 60, 'B2C', 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop'],
    [6, 'Coffee Roasting and Distribution Business', 'Established coffee roasting business supplying premium coffee to cafes, restaurants, and retail stores. Direct relationships with local coffee farmers. Strong brand and growing market demand.', 'Coffee roasting business with direct farmer relationships and growing demand.', 'Food & Beverage', 'established', 'Nakuru, Kenya', 32000000, 12000000, 4800000, 7, 22, 'B2B & B2C', 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=800&h=600&fit=crop'],
    [7, 'Plastic Manufacturing Plant', 'Modern plastic manufacturing facility producing packaging materials, containers, and household items. State-of-the-art equipment, established customer base, and strong market position.', 'Plastic manufacturing plant with modern equipment and established customers.', 'Manufacturing & Production', 'established', 'Thika, Kenya', 85000000, 35000000, 14000000, 12, 85, 'B2B', 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop'],
    [8, 'Textile Manufacturing Company', 'Textile manufacturing company producing fabrics for local and export markets. Modern production facilities, skilled workforce, and established distribution network. Strong growth potential.', 'Textile manufacturing with modern facilities and export capabilities.', 'Manufacturing & Production', 'established', 'Eldoret, Kenya', 68000000, 28000000, 11200000, 9, 70, 'B2B', 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop'],
    [9, 'Accounting and Tax Services Firm', 'Established accounting firm serving 500+ clients including small businesses and individuals. Services include bookkeeping, tax preparation, financial consulting, and audit services. Strong reputation and recurring revenue.', 'Accounting firm with 500+ clients and strong recurring revenue.', 'Professional Services', 'established', 'Nairobi, Kenya', 25000000, 9500000, 3800000, 8, 20, 'B2B', 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop'],
    [10, 'Legal Services Practice', 'Well-established law firm specializing in corporate law, commercial transactions, and business advisory. Team of 12 experienced lawyers serving corporate clients and high-net-worth individuals.', 'Law firm with 12 lawyers specializing in corporate and commercial law.', 'Professional Services', 'established', 'Mombasa, Kenya', 38000000, 15000000, 6000000, 11, 12, 'B2B', 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop'],
    [11, 'Real Estate Development Company', 'Established real estate development company with portfolio of residential and commercial projects. Strong track record, experienced team, and valuable land assets. Multiple projects in pipeline.', 'Real estate developer with strong portfolio and valuable land assets.', 'Real Estate & Construction', 'established', 'Nairobi, Kenya', 120000000, 45000000, 18000000, 15, 45, 'B2C', 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&h=600&fit=crop'],
    [12, 'Construction Materials Supply Business', 'Wholesale supplier of construction materials including cement, steel, timber, and hardware. Established relationships with major construction companies. Strong cash flow and inventory management.', 'Construction materials supplier with established contractor relationships.', 'Real Estate & Construction', 'established', 'Nakuru, Kenya', 48000000, 20000000, 8000000, 10, 30, 'B2B', 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=800&h=600&fit=crop'],
    [13, 'Private Medical Clinic', 'Well-equipped private medical clinic offering general practice, specialist consultations, and diagnostic services. Modern facilities, experienced medical staff, and strong patient base. Prime location.', 'Private medical clinic with modern facilities and experienced staff.', 'Healthcare & Medical Business', 'established', 'Nairobi, Kenya', 65000000, 25000000, 10000000, 12, 28, 'B2C', 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop'],
    [14, 'Pharmacy Chain', 'Chain of 5 pharmacies in strategic locations. Well-stocked inventory, licensed operations, and loyal customer base. Strong relationships with pharmaceutical suppliers and insurance companies.', 'Pharmacy chain with 5 locations and strong supplier relationships.', 'Healthcare & Medical Business', 'established', 'Mombasa, Kenya', 72000000, 28000000, 11200000, 14, 40, 'B2C', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800&h=600&fit=crop'],
    [15, 'Private School Network', 'Network of 3 private schools offering quality education from primary to secondary level. Strong academic performance, experienced teachers, and modern facilities. Established reputation.', 'Private school network with 3 schools and strong academic reputation.', 'Education & Training Business', 'established', 'Nairobi, Kenya', 95000000, 38000000, 15200000, 16, 120, 'B2C', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop'],
    [16, 'Professional Training Institute', 'Vocational training institute offering courses in IT, business, hospitality, and technical skills. Accredited programs, experienced instructors, and strong job placement record.', 'Vocational training institute with accredited programs and strong placement record.', 'Education & Training Business', 'established', 'Kisumu, Kenya', 42000000, 16000000, 6400000, 9, 35, 'B2C', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop'],
    [17, 'Microfinance Institution', 'Licensed microfinance institution serving small businesses and individuals. Strong loan portfolio, low default rates, and profitable operations. Growing customer base and expansion opportunities.', 'Microfinance institution with strong portfolio and profitable operations.', 'Finance & Fintech', 'established', 'Nairobi, Kenya', 150000000, 60000000, 24000000, 18, 65, 'B2C', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop'],
    [18, 'Payment Processing Platform', 'Established payment processing platform serving merchants and businesses. Integrated with major banks and mobile money providers. Strong transaction volume and recurring revenue model.', 'Payment processing platform with strong transaction volume and bank integrations.', 'Finance & Fintech', 'established', 'Nairobi, Kenya', 180000000, 72000000, 28800000, 7, 55, 'B2B', 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop'],
    [19, 'Logistics and Freight Company', 'Established logistics company providing freight, warehousing, and distribution services. Fleet of 25 vehicles, warehouse facilities, and established client relationships. Strong market position.', 'Logistics company with 25-vehicle fleet and warehouse facilities.', 'Transportation & Logistics', 'established', 'Nairobi, Kenya', 88000000, 35000000, 14000000, 11, 75, 'B2B', 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=800&h=600&fit=crop'],
    [20, 'Taxi and Ride-Hailing Service', 'Established taxi and ride-hailing service with fleet of 50 vehicles and mobile app. Strong brand recognition, loyal customer base, and profitable operations. Expansion opportunities available.', 'Ride-hailing service with 50-vehicle fleet and mobile app.', 'Transportation & Logistics', 'established', 'Mombasa, Kenya', 55000000, 22000000, 8800000, 6, 45, 'B2C', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop'],
    [21, 'Full-Service Marketing Agency', 'Comprehensive marketing agency offering digital marketing, branding, advertising, and PR services. Portfolio of 200+ successful campaigns, strong client relationships, and creative team.', 'Marketing agency with 200+ campaigns and comprehensive service offerings.', 'Marketing & Advertising', 'established', 'Nairobi, Kenya', 32000000, 12000000, 4800000, 8, 28, 'B2B', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop'],
    [22, 'Digital Advertising Platform', 'Digital advertising platform connecting advertisers with publishers. Proprietary technology, strong advertiser base, and growing revenue. Scalable business model with expansion potential.', 'Digital advertising platform with proprietary technology and growing revenue.', 'Marketing & Advertising', 'early', 'Nairobi, Kenya', 25000000, 8500000, 3200000, 3, 18, 'B2B', 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop'],
    [23, 'Solar Energy Installation Company', 'Established solar energy company providing installation, maintenance, and consulting services. Strong track record, experienced team, and growing market demand. Multiple commercial and residential projects.', 'Solar energy company with strong track record and growing demand.', 'Energy & Utilities', 'established', 'Nakuru, Kenya', 45000000, 18000000, 7200000, 7, 32, 'B2B & B2C', 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=800&h=600&fit=crop'],
    [24, 'Water Purification and Distribution', 'Water purification and distribution business serving residential and commercial customers. Modern filtration systems, established customer base, and recurring revenue model.', 'Water purification business with modern systems and recurring revenue.', 'Energy & Utilities', 'established', 'Eldoret, Kenya', 38000000, 15000000, 6000000, 9, 25, 'B2C', 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop'],
    [25, 'Large-Scale Commercial Farm', 'Commercial farm producing maize, wheat, and vegetables on 500 acres. Modern irrigation systems, mechanized equipment, and established market channels. Strong profitability and growth potential.', 'Commercial farm on 500 acres with modern equipment and established markets.', 'Agriculture & Farming Business', 'established', 'Narok, Kenya', 120000000, 48000000, 19200000, 20, 95, 'B2B', 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800&h=600&fit=crop'],
    [26, 'Dairy Farm and Processing', 'Integrated dairy operation with 200 dairy cows, processing facility, and distribution network. Producing milk, yogurt, and cheese. Strong brand and market presence.', 'Integrated dairy operation with 200 cows and processing facility.', 'Agriculture & Farming Business', 'established', 'Kiambu, Kenya', 75000000, 30000000, 12000000, 15, 50, 'B2B & B2C', 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800&h=600&fit=crop'],
    [27, 'Boutique Hotel Chain', 'Chain of 3 boutique hotels in prime tourist locations. Unique design, excellent service, and strong online presence. High occupancy rates and loyal customer base.', 'Boutique hotel chain with 3 properties and strong online presence.', 'Hospitality & Tourism Business', 'established', 'Maasai Mara, Kenya', 180000000, 72000000, 28800000, 12, 85, 'B2C', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop'],
    [28, 'Safari Tour Operator', 'Established safari tour operator offering wildlife tours, cultural experiences, and adventure activities. Strong relationships with lodges, experienced guides, and excellent customer reviews.', 'Safari tour operator with strong lodge relationships and excellent reviews.', 'Hospitality & Tourism Business', 'established', 'Nairobi, Kenya', 42000000, 16000000, 6400000, 10, 30, 'B2C', 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop'],
    [29, 'Music Production and Record Label', 'Established music production studio and record label with roster of successful artists. State-of-the-art recording facilities, experienced producers, and strong industry connections.', 'Music production studio and record label with successful artist roster.', 'Media & Entertainment Business', 'established', 'Nairobi, Kenya', 35000000, 14000000, 5600000, 8, 22, 'B2B', 'https://images.unsplash.com/photo-1493612276216-ee3925520721?w=800&h=600&fit=crop'],
    [30, 'Event Management and Production Company', 'Full-service event management company organizing concerts, corporate events, and festivals. Strong vendor relationships, experienced team, and excellent reputation in the industry.', 'Event management company with strong vendor relationships and industry reputation.', 'Media & Entertainment Business', 'established', 'Mombasa, Kenya', 28000000, 11000000, 4400000, 6, 20, 'B2B', 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=800&h=600&fit=crop'],
    [31, 'Management Consulting Firm', 'Established management consulting firm serving SMEs and corporations. Services include strategy, operations, HR, and financial consulting. Strong client portfolio and experienced consultants.', 'Management consulting firm with strong client portfolio and experienced team.', 'Consulting & Advisory', 'established', 'Nairobi, Kenya', 38000000, 15000000, 6000000, 10, 25, 'B2B', 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop'],
    [32, 'IT Consulting and Solutions Provider', 'IT consulting firm providing technology solutions, system integration, and IT support services. Strong technical expertise, established client base, and recurring revenue from support contracts.', 'IT consulting firm with strong technical expertise and recurring revenue.', 'Consulting & Advisory', 'established', 'Nairobi, Kenya', 32000000, 12500000, 5000000, 7, 18, 'B2B', 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=600&fit=crop'],
    [33, 'Fashion Design and Manufacturing', 'Fashion design company creating contemporary African-inspired clothing. Design studio, manufacturing facility, and retail outlets. Strong brand identity and growing customer base.', 'Fashion design company with manufacturing facility and retail outlets.', 'Fashion & Apparel Business', 'established', 'Nairobi, Kenya', 45000000, 18000000, 7200000, 9, 40, 'B2C', 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=600&fit=crop'],
    [34, 'Footwear Manufacturing and Retail', 'Footwear manufacturing company producing quality shoes and sandals. Manufacturing facility, retail stores, and wholesale distribution. Established brand and strong market presence.', 'Footwear manufacturer with retail stores and wholesale distribution.', 'Fashion & Apparel Business', 'established', 'Kisumu, Kenya', 38000000, 15000000, 6000000, 11, 35, 'B2B & B2C', 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=800&h=600&fit=crop'],
];

$sql .= "-- Sample Business Listings\n";
$sql .= "INSERT INTO `business_listings` (`id`, `user_id`, `title`, `slug`, `description`, `short_description`, `industry`, `stage`, `location`, `asking_price`, `annual_revenue`, `annual_profit`, `years_in_business`, `employees`, `business_type`, `main_image`, `status`, `featured`, `verified`, `created_at`, `updated_at`) VALUES\n";

$listingImageUrls = [];
foreach ($listingsData as $idx => $listing) {
    $id = $listing[0];
    $title = addslashes($listing[1]);
    $slug = strtolower(str_replace([' ', '&', ','], ['-', 'and', ''], $title)) . '-' . $id;
    $desc = addslashes($listing[2]);
    $shortDesc = addslashes($listing[3]);
    $industry = addslashes($listing[4]);
    $stage = $listing[5];
    $location = addslashes($listing[6]);
    $askingPrice = $listing[7];
    $annualRevenue = $listing[8];
    $annualProfit = $listing[9];
    $years = $listing[10];
    $employees = $listing[11];
    $businessType = $listing[12];
    $imageUrl = $listing[13];
    $userId = $userIds[($idx) % count($userIds)];
    $mainImage = "listing_$id.jpg";
    $featured = ($idx < 6) ? 1 : 0;
    $verified = ($idx < 12) ? 1 : 0;
    
    $listingImageUrls[] = ['url' => $imageUrl, 'file' => $mainImage];
    
    $sql .= "($id, $userId, '$title', '$slug', '$desc', '$shortDesc', '$industry', '$stage', '$location', $askingPrice, $annualRevenue, $annualProfit, $years, $employees, '$businessType', '$mainImage', 'active', $featured, $verified, NOW(), NOW())";
    if ($idx < count($listingsData) - 1) $sql .= ",\n";
    else $sql .= ";\n\n";
}

// Sample buyers
$sql .= "-- Sample Buyers/Investors\n";
$sql .= "INSERT INTO `buyers` (`id`, `user_id`, `type`, `investment_criteria`, `min_investment`, `max_investment`, `verification_status`, `created_at`, `updated_at`) VALUES\n";
for ($i = 0; $i < 4; $i++) {
    $userId = $userIds[$i];
    $type = ['investor', 'buyer', 'both', 'investor'][$i];
    $minInv = [5000000, 10000000, 8000000, 12000000][$i];
    $maxInv = [50000000, 100000000, 80000000, 150000000][$i];
    $verified = ($i < 2) ? 'verified' : 'pending';
    $sql .= "($i+1, $userId, '$type', 'Looking for profitable businesses with growth potential', $minInv, $maxInv, '$verified', NOW(), NOW())";
    if ($i < 3) $sql .= ",\n";
    else $sql .= ";\n\n";
}

// Sample donations for campaigns
$sql .= "-- Sample Donations (for campaigns)\n";
$sql .= "INSERT INTO `donations` (`id`, `campaigns_id`, `user_id`, `donation`, `approved`, `date`) VALUES\n";
$donationAmounts = [50000, 100000, 25000, 75000, 150000, 50000, 200000, 100000, 50000, 125000];
$donationIdx = 0;
for ($campId = 1; $campId <= 10; $campId++) {
    for ($d = 0; $d < 3; $d++) {
        $donorId = $userIds[($donationIdx) % count($userIds)];
        $amount = $donationAmounts[$donationIdx % count($donationAmounts)];
        $donationIdx++;
        $sql .= "($donationIdx, $campId, $donorId, $amount, '1', NOW())";
        if ($campId < 10 || $d < 2) $sql .= ",\n";
        else $sql .= ";\n\n";
    }
}

// Write SQL file
file_put_contents(__DIR__ . '/database/sample_data.sql', $sql);

// Create image download script
$imageScript = "#!/bin/bash\n";
$imageScript .= "# Download images for campaigns and listings\n\n";
$imageScript .= "mkdir -p public/campaigns/small public/campaigns/large public/business-listings\n\n";

$imageScript .= "echo 'Downloading campaign images...'\n";
foreach ($campaignImageUrls as $img) {
    $imageScript .= "wget -q '{$img['url']}' -O public/campaigns/small/{$img['file']} && cp public/campaigns/small/{$img['file']} public/campaigns/large/{$img['file']} && echo 'Downloaded {$img['file']}'\n";
}

$imageScript .= "\necho 'Downloading business listing images...'\n";
foreach ($listingImageUrls as $img) {
    $imageScript .= "wget -q '{$img['url']}' -O public/business-listings/{$img['file']} && echo 'Downloaded {$img['file']}'\n";
}

$imageScript .= "\necho 'Setting permissions...'\n";
$imageScript .= "chmod 644 public/campaigns/small/*.jpg public/campaigns/large/*.jpg public/business-listings/*.jpg 2>/dev/null\n";
$imageScript .= "chown www-data:www-data public/campaigns/small/*.jpg public/campaigns/large/*.jpg public/business-listings/*.jpg 2>/dev/null || true\n";
$imageScript .= "\necho 'Done!'\n";

file_put_contents(__DIR__ . '/download_sample_images.sh', $imageScript);
chmod(__DIR__ . '/download_sample_images.sh', 0755);

echo "Sample data SQL file created: database/sample_data.sql\n";
echo "Image download script created: download_sample_images.sh\n";
echo "Total campaigns: " . count($campaignsData) . "\n";
echo "Total business listings: " . count($listingsData) . "\n";
echo "Total users: " . count($users) . "\n";
echo "\nNext steps:\n";
echo "1. Run: ./download_sample_images.sh\n";
echo "2. Import SQL: mysql -u root -p fundme < database/sample_data.sql\n";
