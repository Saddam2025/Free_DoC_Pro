<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
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
        }

        h1 {
            font-size: 1.8em;
            color: #444;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 1rem;
            color: #555;
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .message-box {
            background-color: #f5f5f5;
            padding: 15px;
            border-left: 4px solid #4CAF50;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 0.95rem;
            line-height: 1.5;
            white-space: pre-wrap; /* Preserves formatting in the message text */
        }

        footer {
            margin-top: 30px;
            font-size: 0.875rem;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Email Header -->
        <h1>New Contact Form Submission</h1>

        <!-- Submission Details -->
        <p><span class="label">Name:</span> {{ $formData['name'] }}</p>
        <p><span class="label">Email:</span> <a href="mailto:{{ $formData['email'] }}" style="color: #4CAF50;">{{ $formData['email'] }}</a></p>
        <p><span class="label">Message:</span></p>
        <div class="message-box">
            {{ $formData['message'] }}
        </div>

        <!-- Footer -->
        <footer>
            <p>© {{ date('Y') }} Doc Pro. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
