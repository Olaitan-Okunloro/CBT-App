<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AcademiCore') }} - School Management System Platform</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
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

        /* Navbar Styles */
        .navbar {
            background: purple;
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: purple;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link {
            color: purple;
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
            color: #6f42c1 !important;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            color: white;
            z-index: 2;
            position: relative;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease;
        }

        .hero-title span {
            color: #ffd700;
            display: block;
            font-size: 5rem;
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
            color: #6f42c1;
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
            color: #6f42c1;
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

        /* Floating Elements */
        .floating-shape {
            position: absolute;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .shape2 {
            width: 200px;
            height: 200px;
            bottom: 50px;
            left: -50px;
            animation-delay: 2s;
        }

        .shape3 {
            width: 150px;
            height: 150px;
            bottom: 200px;
            right: 50px;
            animation-delay: 4s;
        }

        /* Feature Cards */
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
            color: #666;
            font-size: 1.1rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(111,66,193,0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(111,66,193,0.15);
            border-color: #6f42c1;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #333;
        }

        .feature-card p {
            color: #666;
            margin-bottom: 0;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #6f42c1;
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
            color: #6f42c1;
        }

        /* Footer */
        .footer {
            background: white;
            padding: 50px 0 20px;
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #6f42c1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6f42c1;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #6f42c1;
            color: white;
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
            color: #666;
        }

        /* Animations */
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
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-title span {
                font-size: 3rem;
            }
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            .hero-buttons {
                flex-direction: column;
            }
            .btn-get-started, .btn-learn-more {
                width: 100%;
                text-align: center;
            }
            .cta-section h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>AcademiCore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How It Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link btn-login" href="{{ url('/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn-login" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn-register" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Register
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
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
                        Master Your Exams with
                        <span>CBT Pro</span>
                    </h1>
                    <p class="hero-description">
                        The ultimate Computer Based Test platform for students, teachers, and institutions. 
                        Practice, assess, and excel in your academic journey.
                    </p>
                    
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">10,000+</span>
                            <span class="stat-label">Active Students</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Practice Exams</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Subjects</span>
                        </div>
                    </div>
                    
                    <div class="hero-buttons">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-get-started">
                                <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-get-started">
                                <i class="fas fa-user-plus me-2"></i>Get Started Free
                            </a>
                            <a href="#features" class="btn-learn-more">
                                <i class="fas fa-play-circle me-2"></i>Learn More
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Illustration or Image Here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose CBT Pro?</h2>
                <p>Everything you need to succeed in your exams</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp">
                        <div class="feature-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3>Real Exam Experience</h3>
                        <p>Practice with actual exam interface, timer, and question patterns</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Instant Results</h3>
                        <p>Get immediate feedback and detailed performance analytics</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>Comprehensive Subjects</h3>
                        <p>UTME, WAEC, NECO, GCE, and Post-UTME practice tests</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Teacher Dashboard</h3>
                        <p>Create exams, track student progress, and manage questions</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 0.8s">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Live Chat</h3>
                        <p>Real-time communication between students and teachers</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp" style="animation-delay: 1s">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Secure Platform</h3>
                        <p>Safe and reliable testing environment with anti-cheat measures</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="features-section" style="background: #f8f9fa;">
        <div class="container">
            <div class="section-title">
                <h2>How It Works</h2>
                <p>Get started in three simple steps</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon" style="background: #ffd700; color: #6f42c1;">
                            <span>1</span>
                        </div>
                        <h3>Create Account</h3>
                        <p>Sign up as a student or teacher and complete your profile</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon" style="background: #ffd700; color: #6f42c1;">
                            <span>2</span>
                        </div>
                        <h3>Choose Your Exam</h3>
                        <p>Select exam type and year, or create your own practice tests</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon" style="background: #ffd700; color: #6f42c1;">
                            <span>3</span>
                        </div>
                        <h3>Start Learning</h3>
                        <p>Take exams, track progress, and improve your scores</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Simple, Transparent Pricing</h2>
                <p>Choose the plan that works best for you</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <h3>Student Plan</h3>
                        <div class="display-4 fw-bold text-primary mb-3">₦5,000</div>
                        <p class="text-muted">per year</p>
                        <hr>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access to all practice exams</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Performance analytics</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Chat with teachers</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>24/7 Support</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-get-started w-100 mt-3">Get Started</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center" style="transform: scale(1.05); border: 2px solid #6f42c1;">
                        <div class="badge bg-warning text-dark position-absolute top-0 start-50 translate-middle">POPULAR</div>
                        <h3>Teacher Plan</h3>
                        <div class="display-4 fw-bold text-primary mb-3">₦15,000</div>
                        <p class="text-muted">per year</p>
                        <hr>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Create unlimited exams</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Question bank management</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Student progress tracking</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Export results</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-get-started w-100 mt-3">Become a Teacher</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Excel in Your Exams?</h2>
            <p>Join thousands of students already using CBT Pro to achieve their goals</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-cta">
                    <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-cta">
                    <i class="fas fa-user-plus me-2"></i>Create Free Account
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>CBT Pro</h5>
                    <p class="text-muted">Empowering students to achieve academic excellence through innovative computer-based testing solutions.</p>
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
                        <li><i class="fas fa-envelope me-2"></i> support@cbtpro.com</li>
                        <li><i class="fas fa-phone me-2"></i> +234 800 000 0000</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Lagos, Nigeria</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} CBT Pro. All rights reserved. Designed for academic excellence.</p>
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