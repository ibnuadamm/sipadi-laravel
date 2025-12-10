<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPADI</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #1a9b7e 0%, #0d6b56 100%);
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            background: white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
        }

        /* Left side - Image */
        .login-image {
            flex: 0 0 50%;
            background: linear-gradient(135deg, rgba(26, 155, 126, 0.5) 0%, rgba(13, 107, 86, 0.5) 100%);
            background-image: url('/image/login_bg.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 155, 126, 0.4) 0%, rgba(13, 107, 86, 0.4) 100%);
            z-index: 1;
        }

        /* Curved divider */
        .login-image::after {
            content: '';
            position: absolute;
            right: -120px;
            /* geser lebih ke kanan agar lengkungannya besar */
            top: 0;
            width: 200px;
            /* ukuran lebih lebar agar curve terlihat penuh */
            height: 100%;
            /* full tinggi */
            background: white;
            border-radius: 90px 0 0 90px;
            /* radius besar supaya mulus */
            z-index: 3;
        }


        /* Right side - Form */
        .login-form-wrapper {
            flex: 0 0 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            position: relative;
            z-index: 2;
            background: white;
        }

        .login-form-container {
            width: 100%;
            max-width: 380px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .login-header p {
            color: #999;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            margin-bottom: 12px;
            color: #333;
            font-weight: 500;
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-group input:hover {
            border-color: #1a9b7e;
            box-shadow: 0 2px 8px rgba(26, 155, 126, 0.1);
        }

        .form-group input:focus {
            outline: none;
            border-color: #1a9b7e;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(26, 155, 126, 0.1);
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            width: 100%;
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            font-size: 20px;
            padding: 5px;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .toggle-password:hover {
            color: #1a9b7e;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1a9b7e 0%, #0d6b56 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 155, 126, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-danger {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 14px;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form {
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-image {
                flex: 0 0 40%;
            }

            .login-image::after {
                display: none;
            }

            .login-form-wrapper {
                flex: 0 0 60%;
            }
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-image {
                flex: 0 0 35%;
                min-height: 250px;
            }

            .login-form-wrapper {
                flex: 0 0 65%;
                padding: 40px 30px;
            }

            .login-header h1 {
                font-size: 28px;
            }

            .login-form-container {
                max-width: 100%;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>

    <div class="login-container">
        <div class="login-wrapper">
            <!-- Left side - Image -->
            <div class="login-image"></div>

            <!-- Right side - Form -->
            <div class="login-form-wrapper">
                <div class="login-form-container">
                    <div class="login-header">
                        <h1>Welcome Farmers!</h1>
                        <p>Login ke akun untuk melanjutkan</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-container">
                                <input type="password" id="passwordInput" name="password" class="form-control" required>
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            Log In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('passwordInput');
            const togglePassword = document.getElementById('togglePassword');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    </script>

</body>

</html>