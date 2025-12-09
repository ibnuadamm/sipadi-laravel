<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIPADI</title>

   <style>
    body {
        background-image: url('/image/login-bg.jpg');
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        position: relative;
        overflow: hidden;
        z-index: 0;
    }

    /* Bulatan buram bergerak di background */
    .blur-circle-1 {
        position: fixed;
        top: -100px;
        left: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(98, 129, 65, 0.8), transparent);
        border-radius: 50%;
        filter: blur(60px);
        animation: float 10s infinite ease-in-out;
        z-index: 2;
        pointer-events: none;
    }

    .blur-circle-2 {
        position: fixed;
        bottom: -50px;
        right: -50px;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(37, 95, 56, 0.7), transparent);
        border-radius: 50%;
        filter: blur(50px);
        animation: float-reverse 15s infinite ease-in-out;
        z-index: 2;
        pointer-events: none;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(50px, -50px); }
    }

    @keyframes float-reverse {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-50px, 50px); }
    }

    .d-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 10;
    }

    .card {
        background-color: rgba(98, 129, 65, 0.3) !important;
        backdrop-filter: blur(7px) !important;
        border: none !important;
        width: 450px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 50px !important;
        border-radius: 60px 0px 60px 0px !important;
        box-shadow:10px 40px 70px rgba(0, 0, 0, 0.9) !important;  
    }

    .card-body {
        color: white !important;
        padding: 0 !important;
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }

    h3 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: white;
    }

    label {
        color: #e0e0e0;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        width: 100%;
    }

    .mb-3 {
        margin-bottom: 20px;
        width: 100%;
    }

    .password-container {
        position: relative;
        width: 100%;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        font-size: 18px;
        padding: 5px;
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        color: #333;
        transform: translateY(-50%) scale(1.15);
    }

    .form-control {
        background-color: white !important;
        transition: all 0.3s ease;
        border: none !important;
        width: 100%;
        padding: 10px 12px;
        font-size: 14px;
        border-radius: 6px;
    }

    .form-control:hover {
        background-color: rgba(255, 255, 255, 0.91) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
        transform: scale(1.01);
    }

    .form-control:focus {
        background-color: white !important;
        outline: none !important;
        box-shadow: 0 0 12px rgba(37, 95, 56, 0.25) !important;
        border: none !important;
    }

    .btn-primary {
        background-color: rgb(37, 95, 56) !important;
        border: none !important;
        width: 100%;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .btn-primary:hover {
        background-color: rgba(30, 79, 46, 1) !important;
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(37, 95, 56, 0.3) !important;
    }

    .btn-primary:focus {
        box-shadow: 0 0 15px rgba(37, 95, 56, 0.4) !important;
        outline: none !important;
    }

    .btn-primary:active {
        background-color: rgb(37, 95, 56) !important;
        box-shadow: none !important;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.2);
        border: 1px solid rgba(220, 53, 69, 0.5);
        color: #ffcccc;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        width: 100%;
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
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

<div class="blur-circle-1"></div>
<div class="blur-circle-2"></div>

<script>
    // Toggle password visibility
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

<div class="d-flex" style="min-height: 100vh;">
    <div class="card">
        <div class="card-body">

            <h3>Login SIPADI</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <div class="password-container">
                        <input type="password" name="password" class="form-control" id="passwordInput" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>