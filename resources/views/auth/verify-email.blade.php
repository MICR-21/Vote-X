<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .message {
            margin-bottom: 20px;
            font-size: 17px;
            color: #666;
        }

        .status {
            margin-bottom: 20px;
            font-size: 14px;
            color: #4caf50;
            font-weight: 500;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }

        .primary-button,
        .logout-button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .primary-button {
            background-color: #007bff;
            color: #fff;
        }

        .primary-button:hover {
            background-color: #0056b3;
        }

        .logout-button {
            background-color: transparent;
            color: #666;
            text-decoration: underline;
        }

        .logout-button:hover {
            color: #333;
        }

        @media (max-width: 400px) {
            .container {
                width: 90%;
            }

            .actions {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="status">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="actions">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="primary-button">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
{{--     </div>
</body>
</html> --}}
