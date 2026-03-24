<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'CBT App'))</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Custom CSS -->
    @stack('styles')
    
    <style>
        body {
            background: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Purple Navbar */
        .navbar-purple {
            background: purple;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }
        
        .navbar-purple .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-purple .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
        }
        
        .navbar-purple .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .navbar-purple .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        
        .navbar-purple .dropdown-item {
            transition: all 0.3s ease;
        }
        
        .navbar-purple .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .main-content {
            min-height: calc(100vh - 160px);
            padding: 20px 0;
        }
        
        .footer {
            background: white;
            padding: 20px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <!-- Navigation with purple class -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-purple">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>CBT Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- In the navbar, update the conditional section -->
            
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <ul class="navbar-nav ms-auto">
                        @if(auth()->user()->role == 'student')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.exams.available') }}">
                                <i class="fas fa-book-open me-1"></i>Available Exams
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.results') }}">
                                <i class="fas fa-chart-bar me-1"></i>My Results
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- <li><a class="dropdown-item" href="{{ route('teacher.questions.create') }}">
                                <i class="fas fa-plus me-2"></i>Create Question
</li>    </a> -->
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0 text-muted">
                &copy; {{ date('Y') }} CBT Pro. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- Toastr Configuration -->
    <script>
        $(document).ready(function() {
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
        });
    </script>
    
    <!-- Include Toastr notifications -->
    @include('partials.toastr')
    
    @stack('scripts')
</body>
</html>