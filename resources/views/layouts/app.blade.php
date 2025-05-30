<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AmmangCoffe - @yield('title')</title>
    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@600;700&family=Fira+Mono:wght@400;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        html, body {
            width: 100%;
            min-height: 100vh;
            padding: 0;
            margin: 0;
            overflow: hidden !important;
            background: linear-gradient(120deg, #f8fafc 0%, #e0f2fe 90%, #bae6fd 100%);
            font-family: 'Fira Sans', Arial, sans-serif;
            transition: background 0.3s ease;
        }
        
        /* Dark mode styles */
        [data-theme="dark"] html,
        [data-theme="dark"] body {
            background: linear-gradient(120deg, #0f1419 0%, #1a202c 90%, #2d3748 100%);
        }
        
        .bg-bubble {
            position: absolute;
            z-index: 0;
            pointer-events: none;
            opacity: 0.12;
            filter: blur(1.5px);
            transition: all 0.8s ease;
            animation: float 6s ease-in-out infinite;
        }
        
        [data-theme="dark"] .bg-bubble {
            opacity: 0.08;
            filter: blur(2px);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-15px) rotate(2deg); }
            50% { transform: translateY(-25px) rotate(-1deg); }
            75% { transform: translateY(-10px) rotate(1deg); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.12; }
            50% { transform: scale(1.05); opacity: 0.18; }
        }
        
        @keyframes drift {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            25% { transform: translateX(10px) translateY(-8px); }
            50% { transform: translateX(-5px) translateY(-15px); }
            75% { transform: translateX(-8px) translateY(-5px); }
        }
        
        .bg-bubble.b1 {
            width: 450px; 
            height: 450px;
            background: radial-gradient(ellipse at 35% 65%, #bae6fd 40%, #e0f2fe 70%, rgba(255,255,255,0.3) 100%);
            top: -120px; 
            left: -130px;
            animation: float 8s ease-in-out infinite, pulse 4s ease-in-out infinite;
            border-radius: 45% 55% 60% 40%;
        }
        
        [data-theme="dark"] .bg-bubble.b1 {
            background: radial-gradient(ellipse at 35% 65%, #4a5568 40%, #2d3748 70%, rgba(26,32,44,0.8) 100%);
        }
        
        .bg-bubble.b2 {
            width: 350px; 
            height: 350px;
            background: radial-gradient(ellipse at 65% 35%, #0ea5e9 50%, #38bdf8 75%, rgba(255,255,255,0.2) 100%);
            bottom: -130px; 
            right: -90px;
            animation: drift 10s ease-in-out infinite, pulse 6s ease-in-out infinite reverse;
            border-radius: 60% 40% 45% 55%;
        }
        
        [data-theme="dark"] .bg-bubble.b2 {
            background: radial-gradient(ellipse at 65% 35%, #2b6cb0 50%, #3182ce 75%, rgba(26,32,44,0.6) 100%);
        }
        
        .bg-bubble.b3 {
            width: 220px; 
            height: 220px;
            background: radial-gradient(ellipse at 50% 50%, #38bdf8 60%, #67e8f9 80%, rgba(255,255,255,0.1) 100%);
            top: 45%; 
            right: 15px;
            animation: float 7s ease-in-out infinite reverse, drift 5s ease-in-out infinite;
            border-radius: 50% 50% 40% 60%;
        }
        
        [data-theme="dark"] .bg-bubble.b3 {
            background: radial-gradient(ellipse at 50% 50%, #3182ce 60%, #2c5282 80%, rgba(45,55,72,0.7) 100%);
        }
        
        .bg-bubble.b4 {
            width: 160px; 
            height: 160px;
            background: radial-gradient(circle at 30% 70%, #06b6d4 70%, #22d3ee 90%, rgba(255,255,255,0.15) 100%);
            top: 15%; 
            left: 70%;
            animation: pulse 9s ease-in-out infinite, float 6s ease-in-out infinite;
            border-radius: 40% 60% 55% 45%;
        }
        
        [data-theme="dark"] .bg-bubble.b4 {
            background: radial-gradient(circle at 30% 70%, #0891b2 70%, #0e7490 90%, rgba(45,55,72,0.5) 100%);
        }
        
        .bg-bubble.b5 {
            width: 280px; 
            height: 280px;
            background: radial-gradient(ellipse at 80% 20%, #7dd3fc 55%, #bae6fd 80%, rgba(255,255,255,0.1) 100%);
            bottom: 20%; 
            left: 10%;
            animation: drift 12s ease-in-out infinite reverse, pulse 8s ease-in-out infinite;
            border-radius: 55% 45% 50% 50%;
        }
        
        [data-theme="dark"] .bg-bubble.b5 {
            background: radial-gradient(ellipse at 80% 20%, #4a5568 55%, #2d3748 80%, rgba(26,32,44,0.4) 100%);
        }
        
        /* Hover effect untuk interaktivitas */
        body:hover .bg-bubble {
            opacity: 0.20;
            filter: blur(1px);
            animation-duration: 4s;
        }
        
        [data-theme="dark"] body:hover .bg-bubble {
            opacity: 0.12;
            filter: blur(1.5px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .bg-bubble.b1 { width: 300px; height: 300px; top: -80px; left: -80px; }
            .bg-bubble.b2 { width: 250px; height: 250px; bottom: -80px; right: -60px; }
            .bg-bubble.b3 { width: 150px; height: 150px; }
            .bg-bubble.b4 { width: 120px; height: 120px; }
            .bg-bubble.b5 { width: 200px; height: 200px; }
        }
        .navbar {
            background: linear-gradient(87deg, #0d6efd 80%, #43c6ac 100%) !important;
            box-shadow: 0 6px 28px rgba(0, 56, 128, 0.10);
            border-bottom: 2px solid #bae6fd44;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            border-bottom-right-radius: 2rem;
            border-bottom-left-radius: 2rem;
        }
        
        [data-theme="dark"] .navbar {
            background: linear-gradient(87deg, #2d3748 80%, #4a5568 100%) !important;
            box-shadow: 0 6px 28px rgba(0, 0, 0, 0.30);
            border-bottom: 2px solid #4a556844;
            border-bottom-right-radius: 2rem;
            border-bottom-left-radius: 2rem;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.45rem;
            letter-spacing: .07em;
            color: #fff !important;
            font-family: 'Fira Mono', monospace;
            text-shadow: 0 1px 6px #2069c566;
            display: flex;
            align-items: center;
            gap: .3rem;
            padding-right: 3rem;
            
            
        }
        .navbar-brand .bi {
            font-size: 1.35em;
            color: #43c6ac;
            padding-left: 5rem;
            text-shadow: 0 0 15px rgba(67, 198, 172, 0.6);
            animation: iconGlow 3s ease-in-out infinite alternate;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 2px 8px rgba(67, 198, 172, 0.3));
        }
        
        [data-theme="dark"] .navbar-brand .bi {
            color: #68d391;
            padding-left: 5rem;
            text-shadow: 0 0 20px rgba(104, 211, 145, 0.7);
            filter: drop-shadow(0 2px 10px rgba(104, 211, 145, 0.4));
        }
        
        @keyframes iconGlow {
            0% {
            text-shadow: 0 0 15px rgba(67, 198, 172, 0.6);
            transform: scale(1);
            }
            100% {
            text-shadow: 0 0 25px rgba(67, 198, 172, 0.9);
            transform: scale(1.05);
            }
        }
        
        [data-theme="dark"] .navbar-brand .bi {
            animation: iconGlowDark 3s ease-in-out infinite alternate;
        }
        
        @keyframes iconGlowDark {
            0% {
            text-shadow: 0 0 20px rgba(104, 211, 145, 0.7);
            transform: scale(1);
            }
            100% {
            text-shadow: 0 0 30px rgba(104, 211, 145, 1);
            transform: scale(1.05);
            }
        }
        
        .navbar-brand:hover .bi {
            transform: scale(1.1) rotate(5deg);
            text-shadow: 0 0 30px rgba(67, 198, 172, 1);
        }
        
        [data-theme="dark"] .navbar-brand:hover .bi {
            text-shadow: 0 0 35px rgba(104, 211, 145, 1);
        }
        
        .navbar-nav .nav-link {
            color: #e0f2fe !important;
            font-weight: 600;
            letter-spacing: .03em;
            border-bottom: 2px solid transparent;
            transition: color 0.12s, border 0.15s, background 0.14s;
            padding: 0.5rem 1.1rem 0.3rem 1.1rem;
            border-radius: .55rem .55rem 0 0;
        }
        
        [data-theme="dark"] .navbar-nav .nav-link {
            color: #cbd5e0 !important;
        }
        
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: #fff !important;
            border-bottom: 3px solid #fff;
            background: linear-gradient(90deg, #0d6efd44 65%, #43c6ac33 100%);
            box-shadow: 0 2px 12px 0 #43c6ac22;
        }
        
        [data-theme="dark"] .navbar-nav .nav-link.active,
        [data-theme="dark"] .navbar-nav .nav-link:hover {
            background: linear-gradient(90deg, #4a556844 65%, #68d39133 100%);
            box-shadow: 0 2px 12px 0 #68d39122;
        }
        
        .navbar .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 1.2rem;
            box-shadow: 0 20px 60px rgba(13, 110, 253, 0.15), 
                   0 8px 32px rgba(0,0,0,0.08),
                   inset 0 1px 0 rgba(255,255,255,0.8);
            border: 1px solid rgba(186, 230, 253, 0.6);
            margin-top: 15px;
            padding: 0.8rem 0;
            min-width: 220px;
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .navbar .dropdown-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #43c6ac, transparent);
            opacity: 0.6;
        }
        
        .navbar .dropdown-menu.show {
            transform: translateY(0);
            opacity: 1;
            animation: dropdownSlide 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes dropdownSlide {
            0% {
            transform: translateY(-20px) scale(0.95);
            opacity: 0;
            }
            100% {
            transform: translateY(0) scale(1);
            opacity: 1;
            }
        }
        
        [data-theme="dark"] .navbar .dropdown-menu {
            background: rgba(45, 55, 72, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(74, 85, 104, 0.6);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.40),
                   0 8px 32px rgba(0,0,0,0.25),
                   inset 0 1px 0 rgba(255,255,255,0.1);
        }
        
        [data-theme="dark"] .navbar .dropdown-menu::before {
            background: linear-gradient(90deg, transparent, #68d391, transparent);
        }
        
        .dropdown-item {
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.02em;
            padding: 0.75rem 1.5rem;
            margin: 0.2rem 0.5rem;
            border-radius: 0.8rem;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            overflow: hidden;
            border: 1px solid transparent;
        }
        
        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(67, 198, 172, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .dropdown-item:hover::before {
            left: 100%;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #43c6ac 0%, #0ea5e9 100%);
            color: #fff !important;
            transform: translateX(5px) scale(1.02);
            box-shadow: 0 8px 25px rgba(67, 198, 172, 0.3),
                   0 3px 12px rgba(14, 165, 233, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dropdown-item i {
            font-size: 1.1em;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover i {
            transform: scale(1.2) rotate(5deg);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        [data-theme="dark"] .dropdown-item {
            color: #cbd5e0;
        }
        
        [data-theme="dark"] .dropdown-item::before {
            background: linear-gradient(90deg, transparent, rgba(104, 211, 145, 0.1), transparent);
        }
        
        [data-theme="dark"] .dropdown-item:hover {
            background: linear-gradient(135deg, #68d391 0%, #4299e1 100%);
            color: #1a202c !important;
            box-shadow: 0 8px 25px rgba(104, 211, 145, 0.3),
                   0 3px 12px rgba(66, 153, 225, 0.2);
        }
        
        .dropdown-item:active {
            transform: translateX(5px) scale(0.98);
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
        }
        
        [data-theme="dark"] .dropdown-item:active {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: #fff !important;
        }
        
        /* Ripple effect */
        .dropdown-item {
            position: relative;
            overflow: hidden;
        }
        
        .dropdown-item::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }
        
        .dropdown-item:active::after {
            width: 300px;
            height: 300px;
        }
        
        /* Enhanced dropdown arrow */
        .dropdown-toggle::after {
            transition: transform 0.3s ease;
        }
        
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
        
        /* Smooth dropdown animation */
        .dropdown-menu {
            animation-fill-mode: both;
        }
        
        .dropdown-menu[data-bs-popper] {
            margin-top: 15px !important;
        }
        
        .avatar-circle {
            background: linear-gradient(120deg, #fff 80%, #bae6fd 100%);
            color: #0d6efd;
            border-radius: 50%;
            width: 37px;
            height: 37px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.18rem;
            border: 2px solid #e0f2fe;
            margin-right: 6px;
            box-shadow: 0 1px 5px #bae6fd44;
            transition: background 0.3s ease, border 0.3s ease;
           
        }
        
        [data-theme="dark"] .avatar-circle {
            background: linear-gradient(120deg, #4a5568 80%, #2d3748 100%);
            color: #68d391;
            border: 2px solid #4a5568;
            box-shadow: 0 1px 5px #4a556844;
        }
        
        main.container {
            background: rgba(255,255,255, 0.96);
            border-radius: 1.2rem;
            box-shadow: 0 8px 38px rgba(33,150,243,0.13), 0 1.5px 7px #bae6fd55;
            margin-top: 36px;
            margin-bottom: 36px;
            padding: 2.2rem 1.2rem;
            position: relative;
            z-index: 20;
            min-height: 70vh;
            width: 150vw;
            max-width: 60vw;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        
        [data-theme="dark"] main.container {
            background: rgba(45, 55, 72, 0.96);
            box-shadow: 0 8px 38px rgba(0,0,0,0.30), 0 1.5px 7px #1a202c55;
            color: #e2e8f0;
        }
        
        /* Dark mode toggle button */
        .theme-toggle {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        
        }
        
        .theme-toggle:hover {
            background: rgba(255,255,255,0.3);
            transform: scale(1.05);
        }
        
        @media (max-width: 1150px) {
            main.container { max-width: 96vw; }
        }
        @media (max-width: 767px) {
            .navbar-brand { font-size: 1.05rem; }
            main.container { border-radius: .8rem; padding: 1.1rem .2rem; margin-top: 16px; margin-bottom: 14px;}
        }
        @media (max-width: 430px) {
            main.container { padding: 0.7rem 0.1rem; }
        }
        
        /* Scrollbar modern */
        ::-webkit-scrollbar {
            width: 7px;
            background: #f1f6fa;
        }
        ::-webkit-scrollbar-thumb {
            background: #bae6fd;
            border-radius: 11px;
        }
        
        [data-theme="dark"] ::-webkit-scrollbar {
            background: #2d3748;
        }
        [data-theme="dark"] ::-webkit-scrollbar-thumb {
            background: #4a5568;
        }
    </style>
</head>
<body>
    <div class="bg-bubble b1"></div>
    <div class="bg-bubble b2"></div>
    <div class="bg-bubble b3"></div>
    <div class="bg-bubble b4"></div>
    <div class="bg-bubble b5"></div>
    <!-- Navbar Top -->
    <nav class="navbar navbar-expand-lg shadow-sm position-relative" style="z-index: 100;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-1" href="{{ route('dashboard') }}">
                <i class="bi bi-cup-hot-fill"></i> AmmangCoffe
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="topNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pos') ? 'active' : '' }}" href="{{ route('pos') }}">
                            <i class="bi bi-cash-coin me-1"></i> POS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-menu-button-wide me-1"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cashiers.*') ? 'active' : '' }}" href="{{ route('cashiers.index') }}">
                            <i class="bi bi-person-badge me-1"></i> Kasir
                        </a>
                    </li>
                </ul>

                <!-- Theme Toggle & User Dropdown -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item d-flex align-items-center">
                        <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                            <i class="bi bi-moon-fill" id="themeIcon"></i>
                        </button>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="avatar-circle me-1">
                                @if(Auth::check())
                                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                                @else
                                    <i class="bi bi-person"></i>
                                @endif
                            </span>
                            <span class="d-none d-md-inline text-white fw-semibold">{{ Auth::user()->name ?? 'Kasir' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const html = document.documentElement;

        // Load saved theme or default to light
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun-fill';
            } else {
                themeIcon.className = 'bi bi-moon-fill';
            }
        }
    </script>
    @stack('scripts')
</body>
</html>