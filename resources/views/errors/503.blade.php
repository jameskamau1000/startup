<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Under Maintenance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            padding: 20px;
        }
        
        .maintenance-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .maintenance-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: white;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2d3748;
            font-weight: 700;
        }
        
        .subtitle {
            font-size: 18px;
            color: #718096;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .message {
            background: #f7fafc;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
            text-align: left;
        }
        
        .message p {
            color: #4a5568;
            line-height: 1.8;
            margin-bottom: 10px;
        }
        
        .message p:last-child {
            margin-bottom: 0;
        }
        
        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            background: #48bb78;
            border-radius: 50%;
            margin-right: 8px;
            animation: blink 2s infinite;
        }
        
        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .footer-text {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
            color: #a0aec0;
            font-size: 14px;
        }
        
        @media (max-width: 640px) {
            .maintenance-container {
                padding: 40px 30px;
            }
            
            h1 {
                font-size: 28px;
            }
            
            .subtitle {
                font-size: 16px;
            }
            
            .maintenance-icon {
                width: 100px;
                height: 100px;
                font-size: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">🔧</div>
        <h1>Site Under Maintenance</h1>
        <p class="subtitle">
            We're currently performing some updates to improve your experience. 
            We'll be back online shortly.
        </p>
        
        <div class="message">
            <p><span class="status-indicator"></span><strong>What's happening?</strong></p>
            <p>Our technical team is working to resolve the issue and restore full functionality. This may include:</p>
            <p>• Database maintenance and optimization</p>
            <p>• System updates and security patches</p>
            <p>• Performance improvements</p>
            <p>• Configuration updates</p>
        </div>
        
        <div class="footer-text">
            <p>Thank you for your patience.</p>
            <p>Please check back in a few moments.</p>
        </div>
    </div>
</body>
</html>
