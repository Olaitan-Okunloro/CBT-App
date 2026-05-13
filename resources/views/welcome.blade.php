<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AcademiCore') }} - Complete School Management & Learning Platform</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* ===== Global Styles ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: black;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        /* ===== Navbar Styles ===== */
        .navbar {
            background: hsl(300, 100%, 25%) !important;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: hsl(300, 100%, 20%) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: white !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            color: #ffd700;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1.2rem !important;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.2);
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-login {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white !important;
            margin-right: 0.5rem;
        }

        .btn-register {
            background: white;
            color: hsl(300, 100%, 25%) !important;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* ===== Hero Section ===== */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            background: black;
        }

        .hero-content {
            color: white;
            z-index: 2;
            position: relative;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease;
        }

        .hero-title span {
            color: #ffd700;
            display: block;
            font-size: 4rem;
        }

        .hero-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffd700;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .btn-get-started {
            background: #ffd700;
            color: hsl(300, 100%, 25%);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-get-started:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,215,0,0.3);
            color: hsl(300, 100%, 25%);
        }

        .btn-learn-more {
            background: transparent;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-learn-more:hover {
            border-color: white;
            color: white;
            transform: translateY(-3px);
        }

        /* ===== Floating Shapes ===== */
        .floating-shape {
            position: absolute;
            background: rgba(128, 0, 128, 0.15);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape1 { width: 300px; height: 300px; top: -100px; right: -100px; animation-delay: 0s; }
        .shape2 { width: 200px; height: 200px; bottom: 50px; left: -50px; animation-delay: 2s; }
        .shape3 { width: 150px; height: 150px; bottom: 200px; right: 50px; animation-delay: 4s; }

        /* ===== Features Section ===== */
        .features-section {
            padding: 80px 0;
            background: white;
            position: relative;
            z-index: 2;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 1rem;
        }

        .section-title p {
            color: hsl(300, 100%, 25%);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .feature-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(128, 0, 128, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(128, 0, 128, 0.15);
            border-color: hsl(300, 100%, 25%);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: hsl(300, 100%, 25%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: hsl(300, 100%, 25%);
        }

        .feature-card p {
            color: #666;
            margin-bottom: 0;
        }

        /* How It Works Section */
        #how-it-works .feature-icon {
            background: #ffd700;
        }

        #how-it-works .feature-icon span {
            color: hsl(300, 100%, 25%);
            font-size: 2rem;
            font-weight: 800;
        }

        #how-it-works .feature-card h3 {
            color: #333;
        }

        /* ===== Pricing Section ===== */
        .pricing-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(128, 0, 128, 0.2);
            position: relative;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(128, 0, 128, 0.15);
            border-color: hsl(300, 100%, 25%);
        }

        .pricing-card h3 {
            font-weight: 700;
            color: hsl(300, 100%, 25%);
            margin-bottom: 1rem;
        }

        .pricing-card .price {
            font-size: 3rem;
            font-weight: 800;
            color: hsl(300, 100%, 25%);
            margin-bottom: 0.5rem;
        }

        .pricing-card .price small {
            font-size: 1rem;
            font-weight: 400;
        }

        .popular-badge {
            background: #ffd700;
            color: hsl(300, 100%, 25%);
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }

        /* ===== CTA Section ===== */
        .cta-section {
            padding: 100px 0;
            background: hsl(300, 100%, 25%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
        }

        .btn-cta {
            background: #ffd700;
            color: hsl(300, 100%, 25%);
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,215,0,0.4);
            color: hsl(300, 100%, 25%);
        }

        /* ===== Footer ===== */
        .footer {
            background: #1a1a2e;
            padding: 50px 0 20px;
            color: white;
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #ffd700;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #ffd700;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #ffd700;
            color: hsl(300, 100%, 25%);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
        }

        /* ===== Animations ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .hero-title span { font-size: 2.5rem; }
            .hero-stats { flex-direction: column; gap: 1rem; }
            .hero-buttons { flex-direction: column; }
            .btn-get-started, .btn-learn-more { width: 100%; text-align: center; }
            .cta-section h2 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>{{ config('app.name', 'AcademiCore') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link btn-login" href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link btn-login" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link btn-register" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>Register</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="floating-shape shape1"></div>
        <div class="floating-shape shape2"></div>
        <div class="floating-shape shape3"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1 class="hero-title">
                        Complete Education Ecosystem
                        <span>Manage | Learn | Excel</span>
                    </h1>
                    <p class="hero-description">
                        AcademiCore is an all-in-one platform combining <strong>School Management System</strong>, 
                        <strong>Computer-Based Testing (CBT)</strong>, and an interactive <strong>Learning Management System</strong>. 
                        Streamline administration, conduct exams, and enhance learning—all in one place.
                    </p>
                    
                    <div class="hero-stats">
                        @php
                            $totalUsers = \App\Models\User::count() ?? 0;
                            $totalExams = \App\Models\Exam::count() ?? 0;
                            $totalSchools = \App\Models\School::count() ?? 0;
                        @endphp
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($totalUsers) }}+</span>
                            <span class="stat-label">Active Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($totalExams) }}+</span>
                            <span class="stat-label">Practice Exams</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($totalSchools) }}+</span>
                            <span class="stat-label">Registered Schools</span>
                        </div>
                    </div>
                    
                    <div class="hero-buttons">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-get-started"><i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn-get-started"><i class="fas fa-user-plus me-2"></i>Get Started Free</a>
                            <a href="#features" class="btn-learn-more"><i class="fas fa-play-circle me-2"></i>Learn More</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <i class="fas fa-chalkboard-user fa-8x text-warning opacity-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Everything You Need in One Platform</h2>
                <p>School Management | CBT | Learning Management System</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp">
                        <div class="feature-icon"><i class="fas fa-building"></i></div>
                        <h3>School Management</h3>
                        <p>Complete administrative tools: student records, teacher management, class allocation, fee tracking, attendance, and report generation.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="feature-icon"><i class="fas fa-laptop-code"></i></div>
                        <h3>Computer-Based Testing</h3>
                        <p>Create, schedule, and conduct exams with real-time proctoring, instant results, and detailed performance analytics.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                        <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Learning Management</h3>
                        <p>Interactive lessons, video content, assignments, practice questions, and progress tracking for students.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                        <div class="feature-icon"><i class="fas fa-users-viewfinder"></i></div>
                        <h3>Role-Based Dashboards</h3>
                        <p>Tailored experiences for students, teachers, school admins, and system administrators.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.8s">
                        <div class="feature-icon"><i class="fas fa-robot"></i></div>
                        <h3>AI Question Generator</h3>
                        <p>Generate unlimited exam questions using AI. Save time and maintain quality assessment standards.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 1s">
                        <div class="feature-icon"><i class="fas fa-comments"></i></div>
                        <h3>Real-time Communication</h3>
                        <p>Built-in chat system for seamless communication between students, teachers, and parents.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="features-section" style="background: #f8f9fa;">
        <div class="container">
            <div class="section-title">
                <h2>How AcademiCore Works</h2>
                <p>Simple steps to transform your educational institution</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><span>1</span></div>
                        <h3>Register Your Institution</h3>
                        <p>Sign up as a school, teacher, or individual student and set up your profile.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><span>2</span></div>
                        <h3>Manage & Learn</h3>
                        <p>Schools manage students/teachers; Teachers create exams; Students learn and practice.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon"><span>3</span></div>
                        <h3>Track & Excel</h3>
                        <p>Monitor performance with analytics, generate reports, and celebrate achievements.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Flexible Pricing Plans</h2>
                <p>Choose the plan that fits your needs</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="pricing-card">
                        <h3>Student Plan</h3>
                        <div class="price">₦5,000 <small>/year</small></div>
                        <hr>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Access all practice exams</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Performance analytics</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Chat with teachers</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>24/7 Support</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-get-started w-100 mt-3" style="display: inline-block; text-align: center;">Get Started</a>
                    </div>
                </div>
                
                <div class="col-md-4 position-relative">
                    <div class="popular-badge">POPULAR</div>
                    <div class="pricing-card" style="border: 2px solid hsl(300, 100%, 25%);">
                        <h3>School Plan</h3>
                        <div class="price">Contact Us</div>
                        <hr>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Unlimited students & teachers</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Full school management suite</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Dedicated support</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: hsl(300, 100%, 25%);"></i>Custom branding</li>
                        </ul>
                        <a href="#contact" class="btn-get-started w-100 mt-3" style="display: inline-block; text-align: center;">Contact Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Transform Your Institution?</h2>
            <p>Join hundreds of schools and thousands of students already using AcademiCore</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-cta"><i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-cta"><i class="fas fa-user-plus me-2"></i>Create Free Account</a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>{{ config('app.name', 'AcademiCore') }}</h5>
                    <p class="text-white-50">A comprehensive platform for school management, computer-based testing, and digital learning.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Resources</h5>
                    <ul class="footer-links">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Us</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope me-2"></i> support@academicore.com</li>
                        <li><i class="fas fa-phone me-2"></i> +234 800 000 0000</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Lagos, Nigeria</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'AcademiCore') }}. All rights reserved. <br>Empowering Education Through Technology</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top - 70
            }, 500);
        });
    </script>
</body>
</html>