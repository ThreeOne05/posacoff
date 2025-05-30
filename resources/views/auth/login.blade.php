<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@600;700&family=Fira+Mono:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1087e7 0%, #19c7c5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fira Sans', 'Segoe UI', Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }
        .login-glass {
            background: rgba(255,255,255,0.92);
            border-radius: 1.4rem;
            box-shadow: 0 8px 48px 0 rgba(16,87,191,0.13);
            padding: 2.8rem 2.2rem 2.2rem 2.2rem;
            width: 370px;
            animation: loginFadeIn 0.9s cubic-bezier(.26,1.36,.48,.99);
            position: relative;
            z-index: 10;
        }
        @keyframes loginFadeIn {
            0% {transform: scale(0.92) translateY(40px); opacity: 0;}
            100% {transform: none; opacity: 1;}
        }
        .login-brand {
            font-size: 2.3rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            color: #1087e7;
            text-align: center;
            font-family: 'Fira Mono', monospace;
            margin-bottom: .1rem;
        }
        .login-icon {
            font-size: 2.9rem;
            color: #19c7c5;
            margin-bottom: 0.2rem;
            display: block;
            text-align: center;
        }
        .login-title {
            text-align: center;
            font-size: 1.23rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 2.1rem;
            letter-spacing: 0.03em;
        }
        .form-label {
            font-weight: 600;
            color: #0b63b4;
            font-size: 1.01rem;
            letter-spacing: 0.01em;
        }
        .form-control {
            border-radius: .75rem;
            padding: .8rem 1.1rem;
            font-size: 1.05rem;
            border: 1.5px solid #c6e3f6;
            background: #fafdff;
            margin-bottom: .2rem;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #19c7c5;
            box-shadow: 0 0 0 2px #b5f2f1;
            background: #fafdff;
        }
        .btn-primary {
            background: linear-gradient(90deg, #19c7c5 20%, #1087e7 100%);
            border: none;
            font-weight: 700;
            font-size: 1.18rem;
            padding: .7rem 0;
            border-radius: .9rem;
            box-shadow: 0 4px 18px 0 rgba(16,135,231,0.11);
            letter-spacing: 0.01em;
            transition: background .18s, box-shadow .18s;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, #1087e7 10%, #19c7c5 100%);
            box-shadow: 0 8px 24px 0 rgba(16,135,231,0.17);
        }
        .alert {
            border-radius: .7rem;
            font-size: 0.98rem;
            padding: .7rem 1rem;
        }
        .login-footer {
            text-align: center;
            color: #7dbcf6;
            margin-top: 2.2rem;
            font-size: .98rem;
            font-family: 'Fira Mono', monospace;
            letter-spacing: .02em;
            user-select: none;
        }
        /* Decorative background shapes */
        .login-bg-shape {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
            opacity: 0.12;
            filter: blur(2px);
            pointer-events: none;
            transition: opacity 0.5s;
        }
        .login-bg-shape.shape1 {
            width: 420px; height: 420px; top: -80px; left: -120px;
            background: linear-gradient(70deg, #fff 0%, #19c7c5 80%);
        }
        .login-bg-shape.shape2 {
            width: 310px; height: 310px; bottom: -110px; right: -90px;
            background: linear-gradient(120deg, #1087e7 0%, #fff 90%);
        }
        .login-bg-shape.shape3 {
            width: 200px; height: 200px; top: 40%; right: 20px;
            background: linear-gradient(120deg, #19c7c5 10%, #fff 80%);
        }
        @media (max-width: 430px) {
            .login-glass { width: 99vw; padding: 1.4rem .6rem 1.2rem .6rem;}
            .login-brand { font-size: 1.4rem;}
        }
    </style>
</head>
<body>
    <div class="login-bg-shape shape1"></div>
    <div class="login-bg-shape shape2"></div>
    <div class="login-bg-shape shape3"></div>
    <div class="login-glass">
        <span class="login-icon"><i class="bi bi-cash-coin"></i></span>
        <div class="login-brand">AmmangPOS</div>
        <div class="login-title">Login Kasir</div>

        @if($errors->any())
            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-1"></i> {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><i class="bi bi-person-circle me-1"></i> Email</label>
                <input type="email" id="email" name="email" class="form-control shadow-none" required autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label"><i class="bi bi-lock-fill me-1"></i> Password</label>
                <input type="password" id="password" name="password" class="form-control shadow-none" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right me-1"></i> Login</button>
        </form>
        <div class="login-footer mt-4">
            &copy; {{ now()->year }} AmmangPOS &middot; All Rights Reserved
        </div>
    </div>
</body>
</html>