<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Doc Pro</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
            width: 150px;
            height: auto;
        }

        h1 {
            font-size: 1.8em;
            color: #444;
            margin-bottom: 15px;
        }

        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .cta-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .cta-button:hover {
            background-color: #45a049;
        }

        footer {
            margin-top: 20px;
            font-size: 0.875rem;
            color: #888;
        }

        footer a {
            color: #888;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
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

            .cta-button {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <img src="https://freedocumentmaker.com/images/Logo.png" alt="Doc Pro Logo">
        </div>

        <!-- Welcome Message -->
        <h1>Welcome to Doc Pro, {{ $user->name ?? 'Valued User' }}!</h1>
        <p>Thank you for signing up with Doc Pro. You can now start generating professional documents like invoices, CVs, receipts, and more.</p>
        <p>Get started by <a href="{{ url('/') }}">logging into your account</a> and exploring all the features Doc Pro has to offer.</p>
        <p>If you have any questions or need help, feel free to reach out to us at <a href="mailto:support@docpro.com">support@docpro.com</a>.</p>

        <!-- Call to Action -->
        <p>
            <a href="{{ url('/') }}" class="cta-button">Start Creating Documents</a>
        </p>

        <!-- Footer -->
        <footer>
            <p>© {{ date('Y') }} Doc Pro. All rights reserved.</p>
            <p><a href="{{ url('/terms') }}">Terms of Service</a> | <a href="{{ url('/privacy') }}">Privacy Policy</a></p>
        </footer>
    </div>
</body>
</html>
