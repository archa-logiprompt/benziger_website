<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="message">
            <p>Dear {{ $mailData['name'] }},</p>
            <p>Thank you for submitting your journal, titled "{{ $mailData['title'] }}". We appreciate the time and
                effort you have invested in your research, and it has been carefully reviewed by our editorial team and
                external reviewers.</p>

            <p><strong>Reason for Rejection:</strong><br>
                {{ $mailData['reason'] }}
            </p>

            <p>We encourage you to revise your journal based on the feedback provided and address the reasons stated
                above. Once these corrections are made, you are welcome to resubmit your journal for further review.
                Our team will be happy to consider your revised submission.</p>

            <p>Thank you for your understanding and commitment to academic excellence.</p>

        </div>

    </div>
</body>

</html>
