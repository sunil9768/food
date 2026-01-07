<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Desi Delights</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF6B35; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .credentials { background: white; padding: 15px; border-left: 4px solid #FF6B35; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍛 Welcome to Desi Delights!</h1>
        </div>
        
        <div class="content">
            <h2>Hello {{ $customerName }}!</h2>
            
            <p>Thank you for placing your order with Desi Delights! We've created an account for you to track your orders and make future purchases easier.</p>
            
            <div class="credentials">
                <h3>Your Login Details:</h3>
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>
            
            <p>You can use these credentials to:</p>
            <ul>
                <li>Track your current order</li>
                <li>View order history</li>
                <li>Update your profile</li>
                <li>Place future orders faster</li>
            </ul>
            
            <p>We recommend changing your password after your first login for security.</p>
            
            <p>Your delicious food is being prepared and will be delivered soon!</p>
        </div>
        
        <div class="footer">
            <p>Thank you for choosing Desi Delights!</p>
            <p>📞 +91 98765 43210 | 📧 orders@desidelights.com</p>
        </div>
    </div>
</body>
</html>