<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-us h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group textarea:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .submit-button {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .submit-button button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button button:hover {
            background-color: #3730a3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="contact-us">
            <h2>{{ __('Contact Us') }}</h2>
            <div class="form">
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus />
                        <div class="error-message">{{ $errors->first('name') }}</div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')" required />
                        <div class="error-message">{{ $errors->first('email') }}</div>
                    </div>

                    <!-- Subject -->
                    <div class="form-group">
                        <label for="subject">{{ __('Subject') }}</label>
                        <input id="subject" type="text" name="subject" :value="old('subject')" required />
                        <div class="error-message">{{ $errors->first('subject') }}</div>
                    </div>

                    <!-- Message -->
                    <div class="form-group">
                        <label for="message">{{ __('Message') }}</label>
                        <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                        <div class="error-message">{{ $errors->first('message') }}</div>
                    </div>

                    <div class="submit-button">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Message') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
