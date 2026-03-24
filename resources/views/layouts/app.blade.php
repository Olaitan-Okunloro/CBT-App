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
            background: #6f42c1 !important;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.3);
        }
        
        .navbar-purple .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-purple .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 5px;
        }
        
        .navbar-purple .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .navbar-purple .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }
        
        .navbar-purple .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            padding: 0.5rem 0;
        }
        
        .navbar-purple .dropdown-item {
            padding: 0.7rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .navbar-purple .dropdown-item:hover {
            background: linear-gradient(135deg, #6f42c1 0%, #8a5cf6 100%);
            color: white;
        }
        
        .navbar-purple .dropdown-item i {
            width: 20px;
            margin-right: 10px;
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
        
        /* Card styles */
        .stat-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        /* Badge styles */
        .badge-teacher {
            background: linear-gradient(135deg, #6f42c1 0%, #8a5cf6 100%);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
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

            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <ul class="navbar-nav me-auto">
                        <!-- Dashboard Link (Common for all) -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                               href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                            </a>
                        </li>

                        <!-- Student Links -->
                        @if(auth()->user()->role == 'student')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.exams.available') ? 'active' : '' }}" 
                               href="{{ route('student.exams.available') }}">
                                <i class="fas fa-book-open me-1"></i>Available Exams
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.results') ? 'active' : '' }}" 
                               href="{{ route('student.results') }}">
                                <i class="fas fa-chart-bar me-1"></i>My Results
                            </a>
                        </li>
                        @endif

                        <!-- Teacher Links -->
                        @if(auth()->user()->role == 'teacher')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('teacher.exams.*') ? 'active' : '' }}" 
                               href="#" id="examsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-file-alt me-1"></i>Exams
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list me-2"></i>All Exams
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-plus me-2"></i>Create New Exam
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-calendar me-2"></i>Scheduled Exams
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-check-circle me-2"></i>Completed Exams
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" 
                               href="#" id="questionsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-question-circle me-1"></i>Questions
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('teacher.questions.create') }}">
                                        <i class="fas fa-plus me-2"></i>Create Question
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-database me-2"></i>Question Bank
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-file-import me-2"></i>Import Questions
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-tags me-2"></i>Categories
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" 
                               href="#" id="subjectsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-book me-1"></i>Subjects
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-list me-2"></i>All Subjects
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-plus me-2"></i>Add Subject
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-sitemap me-2"></i>Topics
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " 
                               href="#" id="resultsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-chart-line me-1"></i>Results
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-list me-2"></i>All Results
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-chart-pie me-2"></i>Analytics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-download me-2"></i>Export Results
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " 
                               href="">
                                <i class="fas fa-users me-1"></i>Students
                            </a>
                        </li>
                        @endif

                        <!-- In your app.blade.php navbar section, ensure school links are present -->
                        @if(auth()->user()->role == 'school')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="schoolDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-school me-1"></i>School
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Teachers
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.teacher.create') }}">
                                        <i class="fas fa-plus me-2"></i>Add Teacher
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-graduate me-2"></i>Students
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.student.create') }}">
                                        <i class="fas fa-plus me-2"></i>Add Student
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.students.import') }}">
                                        <i class="fas fa-upload me-2"></i>Upload Students (Excel)
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.students.download') }}">
                                       <i class="fas fa-download me-2"></i>Download Login Credentials
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-layer-group me-2"></i>Classes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chart-bar me-2"></i>Reports
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Settings
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <!-- Admin Links (if needed) -->
                        @if(auth()->user()->role == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog me-1"></i>Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-users me-2"></i>Manage Users
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-credit-card me-2"></i>Payments
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chart-bar me-2"></i>Reports
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <!-- User Menu (Right side) -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Notifications -->
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    3
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                                <div class="dropdown-header d-flex justify-content-between align-items-center">
                                    <span>Notifications</span>
                                    <small><a href="#">Mark all as read</a></small>
                                </div>
                                <div class="dropdown-item-text">
                                    <small class="text-muted">New student registered</small>
                                </div>
                                <div class="dropdown-item-text">
                                    <small class="text-muted">Exam "Mathematics Test" completed</small>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="text-center">
                                    <a href="#" class="text-decoration-none small">View all</a>
                                </div>
                            </div>
                        </li>

                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle fa-lg me-1"></i>
                                <span>{{ Auth::user()->name }}</span>
                                @if(auth()->user()->role == 'teacher')
                                    <span class="badge bg-light text-dark ms-2" style="font-size: 0.6rem;">Teacher</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <div class="dropdown-header">
                                        <strong>{{ Auth::user()->name }}</strong><br>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-clock me-2"></i>Activity Log
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Header (if needed) -->
    @hasSection('page-header')
    <div class="bg-white border-bottom">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">@yield('page-header')</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted">
                        &copy; {{ date('Y') }} CBT Pro. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-muted">
                        <small>Version 1.0.0</small>
                    </p>
                </div>
            </div>
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