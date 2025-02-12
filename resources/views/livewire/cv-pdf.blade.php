<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $fullName }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            font-size: 26px;
            color: #222;
            margin-bottom: 15px;
        }
        .contact-info, .section p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 30px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            margin-bottom: 10px;
            color: #444;
        }
        .education, .experience {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            align-items: center;
        }
        .education span, .experience span {
            flex: 1;
            color: #333;
        }
        .education .degree, .experience .position {
            font-weight: bold;
        }
        .skills ul {
            display: flex;
            flex-wrap: wrap;
        }
        .skills ul li {
            margin-right: 10px;
            margin-bottom: 10px;
            background-color: #e8f5e9;
            color: #4CAF50;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .photo {
            text-align: center;
            margin-bottom: 20px;
        }
        .photo img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #4CAF50;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Photo -->
        @if($photo)
        <div class="photo">
            <img src="{{ $photo }}" alt="Profile Photo">
        </div>
        @endif

        <!-- Full Name -->
        <h1>{{ $fullName }}</h1>

        <!-- Contact Information -->
        <div class="contact-info">
            <p><strong>Email:</strong> {{ $email }} | <strong>Phone:</strong> {{ $phone }}</p>
            <p><strong>Address:</strong> {{ $address }}</p>
        </div>

        <!-- Additional Personal Details -->
        <div class="section">
            <h2>Personal Details</h2>
            <p><strong>Date of Birth:</strong> {{ $dateOfBirth }}</p>
            <p><strong>Gender:</strong> {{ $gender }}</p>
            <p><strong>Occupation:</strong> {{ $occupation }}</p>
        </div>

        <!-- Identity Details -->
        <div class="section">
            <h2>Identity Details</h2>
            <p><strong>ID Type:</strong> {{ $idType }}</p>
            <p><strong>ID Number:</strong> {{ $idNumber }}</p>
            <p><strong>Issue Authority:</strong> {{ $issueAuthority }}</p>
            <p><strong>Issue Date:</strong> {{ $issueDate }}</p>
            <p><strong>Issue State:</strong> {{ $issueState }}</p>
            <p><strong>Expiry Date:</strong> {{ $expiryDate }}</p>
        </div>

        <!-- Summary -->
        <div class="section">
            <h2>Summary</h2>
            <p>{{ $summary }}</p>
        </div>

        <!-- Education Section -->
        <div class="section">
            <h2>Education</h2>
            <ul>
                @foreach($education as $edu)
                <li class="education">
                    <span class="degree">{{ $edu['degree'] }}</span>
                    <span class="institution">{{ $edu['institution'] }}</span>
                    <span class="year">({{ $edu['startYear'] }} - {{ $edu['endYear'] }})</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Work Experience Section -->
        <div class="section">
            <h2>Work Experience</h2>
            <ul>
                @foreach($experience as $exp)
                <li class="experience">
                    <span class="position">{{ $exp['position'] }}</span>
                    <span class="company">{{ $exp['company'] }}</span>
                    <span class="years">({{ $exp['startYear'] }} - {{ $exp['endYear'] }})</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Skills Section -->
        <div class="section skills">
            <h2>Skills</h2>
            <ul>
                @foreach($skills as $skill)
                <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
