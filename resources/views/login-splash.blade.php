<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .splash-container {
            text-align: center;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .logo {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="splash-container">
        <div class="logo">
            <img src="{{ asset('../../../register-form/images/pap1.png') }}" alt="Logo" width="90">
        </div>
        <div class="spinner"></div>
        <p>Logging in...</p>
    </div>

    <script>
        // Redirect to the landing page after a delay
        setTimeout(function() {
            window.location.href = "{{ route('dashboard') }}";  // Make sure this route exists in your routes/web.php
        }, 2000);  // 3 seconds delay
    </script>
</body>
</html>
