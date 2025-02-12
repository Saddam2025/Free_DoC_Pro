<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card - {{ $name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
        }

        .business-card {
            width: 90%;
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .business-card img {
            max-width: 80px;
            margin-bottom: 15px;
        }

        .business-card h1 {
            font-size: 22px;
            color: #4CAF50;
            margin: 5px 0;
            font-weight: bold;
        }

        .business-card h3 {
            font-size: 16px;
            color: #333;
            margin: 5px 0;
        }

        .business-card p {
            font-size: 14px;
            color: #777;
            margin: 5px 0;
            text-align: center;
        }

        .contact-info {
            margin-top: 15px;
            width: 100%;
            text-align: center;
        }

        .contact-info p {
            margin: 8px 0;
            font-size: 14px;
        }

        .contact-info a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }

        .divider {
            width: 100%;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="business-card">
        <!-- Company Logo -->
        @if($logo)
            <img src="{{ $logo }}" alt="Company Logo">
        @endif
        
        <!-- User Information -->
        <h1>{{ $name }}</h1>
        <h3>{{ $jobTitle }}</h3>
        <p>{{ $companyName }}</p>
        
        <!-- Divider -->
        <div class="divider"></div>

        <!-- Contact Information -->
        <div class="contact-info">
            <p>Email: <a href="mailto:{{ $email }}">{{ $email }}</a></p>
            <p>Phone: {{ $phone }}</p>
            <p>Website: <a href="http://{{ $website }}" target="_blank">{{ $website }}</a></p>
            <p>Address: {{ $address }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
