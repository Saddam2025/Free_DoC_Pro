<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px; /* Adjust as needed */
            height: auto;
        }

        h1 {
            font-size: 1.8em;
            color: #444;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .signature {
            margin-top: 20px;
            font-style: italic;
            color: #666;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #999;
        }

        .footer a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
            }

            p {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <img src="https://freedocumentmaker.com/images/Logo.png" alt="Free Document Maker Logo">
        </div>

        <!-- Main Content -->
        <h1>Hi {{ $userName }},</h1>
        <p>Thank you for contacting us! We have successfully received your message and one of our team members will get back to you shortly.</p>
        <p>If you have any additional questions or concerns, feel free to reply directly to this email or visit our <a href="https://freedocumentmaker.com/faq" style="color: #007BFF; text-decoration: none;">FAQ page</a> for quick answers.</p>

        <!-- Signature -->
        <p class="signature">Best regards,<br>The Free Document Maker Team</p>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Free Document Maker. All rights reserved. <a href="https://freedocumentmaker.com" target="_blank">Visit Our Website</a>.</p>
        </div>
    </div>
</body>
</html>
