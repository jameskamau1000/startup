-- SQL Update File to Replace Lorem Ipsum Text with Relevant Content
-- Generated for Fundme Crowdfunding Platform
-- Date: 2025-01-14

-- ============================================
-- 1. UPDATE ADMIN_SETTINGS - Description
-- ============================================
UPDATE `admin_settings` SET 
`description` = 'Fundme is a powerful crowdfunding platform that connects passionate creators with generous supporters. Start your fundraising campaign today and turn your dreams into reality. Join thousands of successful campaigns and make a difference in the world.'
WHERE `id` = 1;

-- ============================================
-- 2. UPDATE PAGES - Terms of Service
-- ============================================
UPDATE `pages` SET 
`content` = '<h2>Terms of Service</h2>

<p>Welcome to Fundme, a crowdfunding platform that enables individuals and organizations to raise funds for their projects, causes, and campaigns. By using our platform, you agree to comply with and be bound by the following terms and conditions.</p>

<h3>1. Platform Usage</h3>
<p>Fundme provides a platform for users to create fundraising campaigns and for supporters to make donations. We are not responsible for the content of campaigns or the fulfillment of campaign promises by campaign creators.</p>

<h3>2. Campaign Creator Responsibilities</h3>
<p>Campaign creators are solely responsible for:</p>
<ul>
<li>Accurately representing their campaign and intended use of funds</li>
<li>Fulfilling any rewards or promises made to supporters</li>
<li>Complying with all applicable laws and regulations</li>
<li>Providing updates on campaign progress</li>
</ul>

<h3>3. Supporter Responsibilities</h3>
<p>Supporters acknowledge that:</p>
<ul>
<li>Donations are generally non-refundable</li>
<li>Fundme does not guarantee campaign success or fulfillment</li>
<li>They should review campaign details before contributing</li>
</ul>

<h3>4. Fees and Payments</h3>
<p>Fundme charges platform fees on successful donations. Payment processing fees may also apply. All fees are clearly disclosed before donation completion.</p>

<h3>5. Prohibited Activities</h3>
<p>Users may not use the platform for illegal activities, fraud, or to violate any laws. Prohibited campaigns include those promoting hate speech, illegal activities, or personal financial gain without a clear project purpose.</p>

<h3>6. Intellectual Property</h3>
<p>Users retain ownership of content they post but grant Fundme a license to use, display, and distribute such content on the platform.</p>

<h3>7. Limitation of Liability</h3>
<p>Fundme is provided "as is" without warranties. We are not liable for any damages arising from use of the platform, including campaign failures or disputes between users.</p>

<h3>8. Changes to Terms</h3>
<p>We reserve the right to modify these terms at any time. Continued use of the platform constitutes acceptance of modified terms.</p>

<p><strong>Last Updated:</strong> January 2025</p>'
WHERE `id` = 2 AND `title` = 'Terms';

-- ============================================
-- 3. UPDATE PAGES - Privacy Policy
-- ============================================
UPDATE `pages` SET 
`content` = '<h2>Privacy Policy</h2>

<p>At Fundme, we are committed to protecting your privacy and personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our crowdfunding platform.</p>

<h3>1. Information We Collect</h3>
<p>We collect information that you provide directly to us, including:</p>
<ul>
<li>Account information (name, email address, password)</li>
<li>Profile information and campaign details</li>
<li>Payment information (processed securely through third-party providers)</li>
<li>Communication records and support requests</li>
</ul>

<h3>2. How We Use Your Information</h3>
<p>We use collected information to:</p>
<ul>
<li>Provide, maintain, and improve our services</li>
<li>Process transactions and send related information</li>
<li>Send technical notices, updates, and support messages</li>
<li>Respond to your comments and questions</li>
<li>Monitor and analyze trends and usage</li>
</ul>

<h3>3. Information Sharing</h3>
<p>We do not sell your personal information. We may share information:</p>
<ul>
<li>With payment processors to complete transactions</li>
<li>When required by law or to protect rights and safety</li>
<li>With your consent or at your direction</li>
</ul>

<h3>4. Data Security</h3>
<p>We implement appropriate security measures to protect your personal information. However, no method of transmission over the internet is 100% secure.</p>

<h3>5. Your Rights</h3>
<p>You have the right to:</p>
<ul>
<li>Access and update your personal information</li>
<li>Delete your account and associated data</li>
<li>Opt-out of certain communications</li>
</ul>

<h3>6. Cookies and Tracking</h3>
<p>We use cookies and similar technologies to track activity and hold certain information to improve user experience.</p>

<h3>7. Children\'s Privacy</h3>
<p>Our platform is not intended for users under 18 years of age. We do not knowingly collect personal information from children.</p>

<p><strong>Last Updated:</strong> January 2025</p>'
WHERE `id` = 3 AND `title` = 'Privacy';

-- ============================================
-- 4. UPDATE PAGES - About Us
-- ============================================
UPDATE `pages` SET 
`content` = '<h2>About Fundme</h2>

<p>Fundme is a leading crowdfunding platform dedicated to helping individuals, entrepreneurs, and organizations bring their ideas to life. Since our launch, we have facilitated thousands of successful campaigns, connecting passionate creators with supportive communities worldwide.</p>

<h3>Our Mission</h3>
<p>Our mission is to democratize fundraising and make it accessible to everyone. We believe that great ideas deserve support, regardless of background or location. Whether you\'re launching a creative project, supporting a cause, or starting a business, Fundme provides the tools and community to make it happen.</p>

<h3>What We Offer</h3>
<ul>
<li><strong>Easy Campaign Creation:</strong> Simple, intuitive tools to create and manage your fundraising campaign</li>
<li><strong>Multiple Payment Options:</strong> Support for various payment gateways to make donating easy</li>
<li><strong>Reward System:</strong> Enable campaign creators to offer rewards to their supporters</li>
<li><strong>Transparent Process:</strong> Clear fee structure and real-time campaign tracking</li>
<li><strong>Community Support:</strong> Access to a global community of supporters and creators</li>
</ul>

<h3>Why Choose Fundme?</h3>
<p>We understand that every campaign is unique. That\'s why we provide flexible tools and features that adapt to your needs. Our platform is designed to be user-friendly while offering powerful features for serious fundraisers.</p>

<p>Join thousands of successful campaigns and become part of a community that believes in turning dreams into reality. Start your campaign today or support a cause you care about!</p>

<h3>Contact Us</h3>
<p>Have questions? We\'re here to help. Reach out to our support team through the contact form or email us directly.</p>'
WHERE `id` = 5 AND `title` = 'About us';

-- ============================================
-- 5. UPDATE PAGES - Support
-- ============================================
UPDATE `pages` SET 
`content` = '<h2>Support & Help Center</h2>

<p>Welcome to the Fundme Support Center. We\'re here to help you succeed with your fundraising campaign or assist with any questions you may have.</p>

<h3>Getting Started</h3>
<p><strong>New to Fundme?</strong> Here\'s how to get started:</p>
<ol>
<li>Create an account by clicking "Register" in the top navigation</li>
<li>Verify your email address</li>
<li>Click "Create Campaign" to start your fundraising journey</li>
<li>Fill in your campaign details, set your goal, and add images</li>
<li>Submit your campaign for review (if required)</li>
<li>Share your campaign with friends, family, and social media</li>
</ol>

<h3>Frequently Asked Questions</h3>

<h4>How do I create a campaign?</h4>
<p>After logging in, click "Create Campaign" in the navigation menu. Fill out all required fields including title, description, funding goal, and campaign image. Once submitted, your campaign will be reviewed and published.</p>

<h4>What fees does Fundme charge?</h4>
<p>Fundme charges a platform fee on successful donations. Payment processing fees may also apply depending on your chosen payment gateway. All fees are clearly displayed before you complete your donation.</p>

<h4>How do I receive funds from my campaign?</h4>
<p>Once your campaign ends successfully, you can request a withdrawal from your dashboard. Funds are typically processed within 5-7 business days after approval.</p>

<h4>Can I edit my campaign after it\'s published?</h4>
<p>Yes, you can edit your campaign details, updates, and rewards from your dashboard at any time while your campaign is active.</p>

<h4>What happens if my campaign doesn\'t reach its goal?</h4>
<p>This depends on your campaign type. Some campaigns allow you to keep funds even if the goal isn\'t reached, while others may require reaching the full goal.</p>

<h3>Contact Support</h3>
<p>Need additional help? Our support team is available to assist you:</p>
<ul>
<li><strong>Email:</strong> support@fundme.com</li>
<li><strong>Response Time:</strong> We typically respond within 24-48 hours</li>
<li><strong>Business Hours:</strong> Monday-Friday, 9 AM - 6 PM (Your Timezone)</li>
</ul>

<h3>Resources</h3>
<ul>
<li><a href="/blog">Campaign Tips & Best Practices</a></li>
<li><a href="/p/how-it-works">How It Works Guide</a></li>
<li><a href="/p/terms-of-service">Terms of Service</a></li>
<li><a href="/p/privacy">Privacy Policy</a></li>
</ul>'
WHERE `id` = 7 AND `title` = 'Support';

-- ============================================
-- 6. UPDATE PAGES - How It Works
-- ============================================
UPDATE `pages` SET 
`content` = '<h2>How Fundme Works</h2>

<p>Fundme makes fundraising simple and accessible. Whether you\'re a creator looking to fund a project or a supporter wanting to make a difference, here\'s how our platform works:</p>

<h3>For Campaign Creators</h3>

<h4>Step 1: Create Your Campaign</h4>
<p>Sign up for a free account and click "Create Campaign." Tell your story, set your funding goal, and add compelling images or videos. Be specific about what you\'re raising funds for and how the money will be used.</p>

<h4>Step 2: Set Up Rewards (Optional)</h4>
<p>Create reward tiers to thank your supporters. Rewards can range from thank-you messages to exclusive products or experiences. This incentivizes larger donations and builds community around your campaign.</p>

<h4>Step 3: Launch and Share</h4>
<p>Once your campaign is approved and published, share it widely on social media, email, and through your personal network. The more people who see your campaign, the better your chances of success.</p>

<h4>Step 4: Engage Your Supporters</h4>
<p>Keep your supporters updated with regular campaign updates. Share progress, milestones, and behind-the-scenes content. Engagement builds trust and encourages more donations.</p>

<h4>Step 5: Receive Funds</h4>
<p>When your campaign ends successfully, request a withdrawal from your dashboard. Funds are transferred to your account after processing, typically within 5-7 business days.</p>

<h3>For Supporters</h3>

<h4>Step 1: Browse Campaigns</h4>
<p>Explore campaigns by category, popularity, or search for specific projects. Read campaign descriptions, view updates, and check creator profiles to find causes you want to support.</p>

<h4>Step 2: Choose Your Donation</h4>
<p>Select a donation amount or choose a reward tier if available. Review the campaign details and understand what your contribution will help achieve.</p>

<h4>Step 3: Make Your Donation</h4>
<p>Complete your donation using our secure payment system. We support multiple payment methods including credit cards, PayPal, and bank transfers.</p>

<h4>Step 4: Stay Connected</h4>
<p>Follow campaigns you\'ve supported to receive updates on their progress. See how your contribution is making a difference!</p>

<h3>Campaign Types</h3>
<ul>
<li><strong>All-or-Nothing:</strong> Campaign must reach its goal to receive funds</li>
<li><strong>Flexible Funding:</strong> Campaign receives funds regardless of goal achievement</li>
<li><strong>Ongoing:</strong> Continuous fundraising with no end date</li>
</ul>

<h3>Safety & Trust</h3>
<p>We take platform security seriously. All campaigns are reviewed before publication, and we have systems in place to detect and prevent fraudulent activity. However, supporters should always review campaign details carefully before contributing.</p>

<h3>Ready to Get Started?</h3>
<p>Whether you\'re ready to launch your campaign or support a cause you believe in, <a href="/register">create your account</a> today and join our community of creators and supporters!</p>'
WHERE `id` = 8 AND `title` = 'How it works';

-- ============================================
-- END OF UPDATES
-- ============================================
-- 
-- To apply these updates to your production database:
-- 1. Backup your database first
-- 2. Review the content above to ensure it matches your needs
-- 3. Run this SQL file: mysql -u username -p database_name < update_lorem_ipsum.sql
-- 4. Verify the updates in your admin panel
--