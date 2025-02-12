<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement Document</title>
    <style>
        /* CSS Variables for easy theming */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #4CAF50;
            --text-color: #555;
            --heading-color: #2c3e50;
            --background-color: #fff;
            --border-color: #4CAF50;
            --signature-line-color: #000;
            --font-family: 'DejaVu Sans', sans-serif;
        }

        /* General Styles */
        body {
            font-family: var(--font-family);
            color: var(--text-color);
            margin: 40px;
            line-height: 1.6;
            background-color: var(--background-color);
        }

        header, footer, section {
            margin-bottom: 25px;
        }

        h1, h2, h3, h4, p {
            margin: 0;
        }

        h1 {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        h3 {
            font-size: 1.125rem;
            color: var(--primary-color);
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        h4 {
            font-size: 1rem;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        p {
            font-size: 0.875rem;
            color: var(--text-color);
            margin: 5px 0;
        }

        ol {
            margin: 10px 0;
            padding-left: 20px;
            font-size: 0.875rem;
            color: var(--text-color);
        }

        /* Header Styles */
        .header {
            text-align: center;
        }

        /* Signature Styles */
        .signature {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .signature-box {
            border: 2px solid var(--secondary-color);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            flex: 1 1 45%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .signature-box p {
            margin: 10px 0;
        }

        .signature-line {
            border-bottom: 2px solid var(--signature-line-color);
            margin: 20px auto;
            width: 80%;
        }

        .name, .date {
            font-size: 0.875rem;
            color: var(--primary-color);
        }

        /* Footer Styles */
        .footer {
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-color);
            margin-top: 30px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .signature {
                flex-direction: column;
                gap: 10px;
            }

            .signature-box {
                flex: 1 1 100%;
            }
        }

        /* Print Styles */
        @media print {
            body {
                margin: 20mm;
            }

            .header, .footer {
                text-align: left;
            }

            .signature {
                flex-direction: row;
            }

            .signature-box {
                border: none;
                padding: 0;
                margin-top: 40px;
            }

            .signature-line {
                width: 60%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1>Agreement Document</h1>
    </header>

    <!-- Content -->
    <main class="content">
        <!-- Parties Section -->
        <section>
            <h2>Parties</h2>
            <div>
                <h3>Party A</h3>
                @if($partyA['full_name']) <p><strong>Full Name:</strong> {{ $partyA['full_name'] }}</p> @endif
                @if($partyA['address']) <p><strong>Address:</strong> {{ $partyA['address'] }}</p> @endif
                @if($partyA['date_of_birth']) <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($partyA['date_of_birth'])->format('F j, Y') }}</p> @endif
                @if($partyA['email']) <p><strong>Email:</strong> {{ $partyA['email'] }}</p> @endif
                @if($partyA['mobile']) <p><strong>Mobile Number:</strong> {{ $partyA['mobile'] }}</p> @endif
                @if($partyA['gender']) <p><strong>Gender:</strong> {{ $partyA['gender'] }}</p> @endif
                @if($partyA['occupation']) <p><strong>Occupation:</strong> {{ $partyA['occupation'] }}</p> @endif
                @if($partyA['id_type']) <p><strong>ID Type:</strong> {{ $partyA['id_type'] }}</p> @endif
                @if($partyA['id_number']) <p><strong>ID Number:</strong> {{ $partyA['id_number'] }}</p> @endif
            </div>
            <div>
                <h3>Party B</h3>
                @if($partyB['full_name']) <p><strong>Full Name:</strong> {{ $partyB['full_name'] }}</p> @endif
                @if($partyB['address']) <p><strong>Address:</strong> {{ $partyB['address'] }}</p> @endif
                @if($partyB['date_of_birth']) <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($partyB['date_of_birth'])->format('F j, Y') }}</p> @endif
                @if($partyB['email']) <p><strong>Email:</strong> {{ $partyB['email'] }}</p> @endif
                @if($partyB['mobile']) <p><strong>Mobile Number:</strong> {{ $partyB['mobile'] }}</p> @endif
                @if($partyB['gender']) <p><strong>Gender:</strong> {{ $partyB['gender'] }}</p> @endif
                @if($partyB['occupation']) <p><strong>Occupation:</strong> {{ $partyB['occupation'] }}</p> @endif
                @if($partyB['id_type']) <p><strong>ID Type:</strong> {{ $partyB['id_type'] }}</p> @endif
                @if($partyB['id_number']) <p><strong>ID Number:</strong> {{ $partyB['id_number'] }}</p> @endif
            </div>
        </section>

        <!-- Agreement Details Section -->
        <section>
            <h2>Agreement Details</h2>
            @if($agreementType) <p><strong>Type:</strong> {{ $agreementType }}</p> @endif
            @if($agreementDate) <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($agreementDate)->format('F j, Y') }}</p> @endif
        </section>

        <!-- Custom Clauses Section -->
        <section>
            <h2>Custom Clauses</h2>
            @foreach($customClauses as $clause)
                @if($clause['title'] || $clause['content'])
                    <div class="clause">
                        @if($clause['title']) <h4>{{ $clause['title'] }}</h4> @endif
                        @if($clause['content']) <p>{{ $clause['content'] }}</p> @endif
                    </div>
                @endif
            @endforeach
        </section>

        <!-- Standard Terms Section -->
        <section>
            <h2>Standard Terms</h2>
            <ol>
                @foreach($standardTerms as $term)
                    @if(trim($term) !== '')
                        <li>{{ $term }}</li>
                    @endif
                @endforeach
            </ol>
        </section>

        <!-- Signatures Section -->
        <section class="signature">
            <div class="signature-box">
                <p>Party A Signature</p>
                <div class="signature-line"></div>
                <p class="name">Full Name: ________________</p>
                <p class="date">Date: ________________</p>
            </div>
            <div class="signature-box">
                <p>Party B Signature</p>
                <div class="signature-line"></div>
                <p class="name">Full Name: ________________</p>
                <p class="date">Date: ________________</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>Generated on {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
    </footer>
</body>
</html>
