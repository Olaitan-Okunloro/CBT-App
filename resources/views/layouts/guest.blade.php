<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'AcademiCore'))</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: black;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Shapes */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            animation: float 6s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Floating particles */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 45px 40px;
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
        }

        /* Logo/Brand Section */
        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo .icon-wrapper {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6f42c1, #8a5cf6);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            box-shadow: 0 10px 20px -5px rgba(111, 66, 193, 0.4);
        }

        .brand-logo .icon-wrapper i {
            font-size: 32px;
            color: white;
        }

        .brand-logo h3 {
            font-weight: 800;
            font-size: 28px;
            background: linear-gradient(135deg, #6f42c1, #8a5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 5px;
        }

        .brand-logo p {
            color: #6c757d;
            font-size: 13px;
            letter-spacing: 1px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: #1a1a2e;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 8px;
            color: #2d3436;
            display: block;
        }

        .input-group {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-right: none;
            color: #6f42c1;
            border-radius: 12px 0 0 12px;
        }

        .form-control, .form-select {
            height: 48px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 10px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
        }

        .input-group .form-control {
            border-radius: 0 12px 12px 0;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #6f42c1 0%, #8a5cf6 100%);
            border: none;
            height: 48px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.4);
        }

        /* Checkbox Styles */
        .form-check-input:checked {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Auth Footer */
        .auth-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .auth-footer p {
            margin-bottom: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .auth-footer a {
            color: #6f42c1;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: #8a5cf6;
            text-decoration: underline;
        }

        /* Divider */
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #adb5bd;
            font-size: 0.8rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.85rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .auth-card {
                padding: 30px 25px;
            }
            
            .brand-logo h3 {
                font-size: 24px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Animated Particles -->
    <div id="particles-container"></div>

    <div class="auth-card animate__animated animate__fadeInUp">
        <!-- Brand Logo -->
        <div class="brand-logo">
            <div class="icon-wrapper">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>AcademiCore</h3>
            <p>Next Generation Education</p>
        </div>

        <div class="auth-header">
            <h2>@yield('auth-title', 'Welcome Back')</h2>
            <p>@yield('auth-subtitle', 'Please sign in to continue')</p>
        </div>

        @yield('auth-content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Toastr Configuration
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Create floating particles
            function createParticles() {
                const container = document.getElementById('particles-container');
                if (!container) return;
                
                for (let i = 0; i < 30; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    const size = Math.random() * 6 + 2;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDuration = Math.random() * 10 + 8 + 's';
                    particle.style.animationDelay = Math.random() * 5 + 's';
                    container.appendChild(particle);
                }
            }

            createParticles();
        });
    </script>
    
    <!-- Include Toastr notifications -->
    @include('partials.toastr')
    
    @stack('scripts')
</body>
</html>