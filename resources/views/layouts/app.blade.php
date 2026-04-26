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
            background: white;
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

        body.dark-mode {
            background: #121212 !important;
            color: #ffffff;
            }

            body.dark-mode .card {
                background: #1e1e1e;
                color: #ffffff;
            }

            body.dark-mode .table {
                color: #ffffff;
            }

            body.dark-mode .footer {
                background: #1e1e1e;
                color: #ffffff;
            }

            body.dark-mode .dropdown-menu {
                background: #1e1e1e;
                color: #ffffff;
            }

            body.dark-mode .dropdown-item {
                color: #ffffff;
            }

            body.dark-mode .dropdown-item:hover {
                background: #333333;
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
                            <a class="nav-link {{ request()->routeIs('student.leaderboard') ? 'active' : '' }}" 
                               href="{{ route('student.leaderboard') }}">
                                <i class="fas fa-chart-bar me-1"></i>Leader dashboard
                            </a>
                        </li>
                        @isset($student)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.qrcode', $student->user_id) }}">
                                <i class="fas fa-qrcode me-1"></i>QR Code
                            </a>
                        </li>
                        @endisset
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('student.analytics') ? 'active' : '' }}" 
                               href="{{ route('student.analytics') }}">
                                <i class="fas fa-chart-bar me-1"></i>Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('results.checker') ? 'active' : '' }}" 
                               href="{{ route('results.checker') }}">
                                <i class="fas fa-chart-bar me-1"></i>My Results
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " 
                               href="#" id="resultsDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-credit-card me-1"></i>Payment
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.school.fees') }}">
                                        <i class="fas fa-upload me-2"></i>Add Payment
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.fees.history') }}">
                                        <i class="fas fa-clock me-2"></i>Payment History
                                    </a>
                                </li>
                            </ul>
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
                                    <a class="dropdown-item" href="{{ route('teacher.exams.create') }}">
                                        <i class="fas fa-plus me-2"></i>Create New Exam
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('results.create') }}">
                                        <i class="fas fa-plus me-2"></i>Add Exam Score
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
                                    <a class="dropdown-item" href="{{ route('teacher.ai.generator') }}">
                                        <i class="fas fa-robot me-2"></i>AI Question Generator
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
                                <i class="fas fa-book me-1"></i>Attendance
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('attendance.scan') }}">
                                        <i class="fas fa-list me-2"></i>Take Attendance
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('attendance.dashboard') }}">
                                        <i class="fas fa-plus me-2"></i>Attendance Dashboard
                                    </a>
                                </li>
                                <!-- Correct: If this is general menu/sidebar -->
                                 <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('students.face.list') }}">
                                        <i class="fas fa-user-check me-1"></i>
                                        Student Face Registration
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('attendance.face.scan') }}">
                                        <i class="fas fa-camera me-1"></i> Face Attendance Scan
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
                                    <a class="dropdown-item" href="{{ route('school.teachers') }}">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Teachers
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.teacher.create') }}">
                                        <i class="fas fa-plus me-2"></i>Add Teacher
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.teacher-subjects.index') }}">
                                        <i class="fas fa-plus me-2"></i>Teacher/Subjects
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.teacher-subjects.create') }}">
                                        <i class="fas fa-plus me-2"></i>Assign Subjects to Teacher
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('school.students.face.list') }}">
                                        <i class="fas fa-user-check me-1"></i>
                                        Student Face Registration
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('school.attendance.face.scan') }}">
                                        <i class="fas fa-camera me-1"></i> Face Attendance Scan
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.students') }}">
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
                                    <a class="dropdown-item" href="{{ route('classes.create') }}">
                                        <i class="fas fa-layer-group me-2"></i>Add Class
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="schoolDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-money-bill-wave me-1"></i>Payment
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('bulk.payment') }}">
                                        <i class="fas fa-credit-card me-2"></i>Bulk Payment
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('bulk.payment.history') }}">
                                        <i class="fas fa-hand-holding-usd me-2"></i>Payment History
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.finance.dashboard') }}">
                                        <i class="fas fa-chart-pie me-2"></i>Financial History
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.fees') }}">
                                        <i class="fas fa-credit-card  me-2"></i>Add School Fees
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.fees.payments') }}">
                                        <i class="fas fa-hand-holding-usd me-2"></i>School Fees Payments
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="schoolDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-chart-simple me-1"></i>Mnage Results
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.results.manage') }}">
                                        <i class="fas fa-chart-simple me-2"></i>Release Results
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.promotion') }}">
                                        <i class="fas fa-crown me-2"></i>Pomote Students
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.books') }}">
                                        <i class="fas fa-book-reader  me-2"></i>School Books
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('school.results.remarks') }}">
                                        <i class="fas fa-marker  me-2"></i>Result Remarks
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(auth()->user()->role == 'referrer')

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                            href="#"
                            id="referrerDropdown"
                            role="button"
                            data-bs-toggle="dropdown">

                                <i class="fas fa-hand-holding-dollar me-1"></i>Referrer
                            </a>

                            <ul class="dropdown-menu">

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.dashboard') }}">
                                        <i class="fas fa-gauge-high me-2"></i>Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.dashboard') }}">
                                        <i class="fas fa-wallet me-2"></i>Wallet
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.dashboard') }}">
                                        <i class="fas fa-users me-2"></i>My Referrals
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.withdraw') }}">
                                        <i class="fas fa-money-bill-transfer me-2"></i>Withdraw Funds
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.withdraw.history') }}">
                                        <i class="fas fa-clock-rotate-left me-2"></i>
                                        Withdrawal History
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.analytics') }}">
                                        <i class="fas fa-chart-line me-2"></i>
                                        Analytics
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('referrer.settings') }}">
                                        <i class="fas fa-cog me-2"></i>
                                        Settings
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        <!-- Admin Links (if needed) -->
                        @if(auth()->user()->role == 'admin')
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
                                    <a class="dropdown-item" href="{{ route('admin.ai.generator') }}">
                                        <i class="fas fa-robot me-2"></i>AI Question Generator
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
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog me-1"></i>Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users') }}">
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
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('admin.announcements') }}">
                                        <i class="fas fa-bullhorn me-2"></i>
                                        Announcements
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('admin.settings') }}">
                                        <i class="fas fa-cog me-2"></i>
                                        Settings
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-headset me-2"></i>Support
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.support') }}">
                                        <i class="fas fa-ticket-alt me-2"></i>Tickets
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                            href="#"
                            id="referrerDropdown"
                            role="button"
                            data-bs-toggle="dropdown">

                                <i class="fas fa-hand-holding-dollar me-1"></i>Referrer
                            </a>

                            <ul class="dropdown-menu">

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('dashboard') }}">
                                        <i class="fas fa-gauge-high me-2"></i>Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('admin.withdrawals') }}">
                                        <i class="fas fa-money-bill-transfer me-2"></i>Withdrawals
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admin.withdraw.history') }}">
                                        <i class="fas fa-clock-rotate-left me-2"></i>
                                        Withdrawal History
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('admin.analytics') }}">
                                        <i class="fas fa-chart-line me-2"></i>
                                        Analytics
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
                            @php
                            $notifications = DB::table('activity_logs')
                                ->where('user_id', auth()->id())
                                ->latest()
                                ->take(5)
                                ->get();

                            $unreadCount = DB::table('activity_logs')
                                ->where('user_id', auth()->id())
                                ->where('is_read', 0)
                                ->count();
                        @endphp

                        <li class="nav-item dropdown me-2">

                            <a class="nav-link position-relative"
                            href="#"
                            id="notificationsDropdown"
                            role="button"
                            data-bs-toggle="dropdown">

                                <i class="fas fa-bell"></i>

                                @if($unreadCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size:0.6rem;">
                                        {{ $unreadCount }}
                                    </span>
                                @endif

                            </a>

                            <div class="dropdown-menu dropdown-menu-end p-0"
                                style="width:320px;">

                                <div class="dropdown-header d-flex justify-content-between align-items-center">

                                    <span>Notifications</span>

                                    <small>
                                        <a href="{{ route('notifications.read') }}">
                                            Mark all as read
                                        </a>
                                    </small>

                                </div>

                                <div class="dropdown-divider m-0"></div>

                                @forelse($notifications as $note)

                                    <div class="dropdown-item-text py-2 px-3">

                                        <small class="d-block">
                                            <p style="background-color:green; color:white; 
                                                    border-radius:5px; text-align:center"> 
                                                {{ $note->activity }} 
                                            </p>
                                        </small>

                                        <small class="text-success">
                                            {{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}
                                        </small>

                                    </div>

                                @empty

                                    <div class="dropdown-item-text text-center py-3 text-muted">
                                        No notifications
                                    </div>

                                @endforelse

                                <div class="dropdown-divider m-0"></div>

                                <div class="text-center py-2">
                                    <a href="{{ route('referrer.activity') }}"
                                    class="small text-decoration-none">
                                        View all
                                    </a>
                                </div>

                            </div>

                            <li class="nav-item me-2">

                                <button class="btn btn-sm btn-outline-light"
                                        onclick="toggleTheme()"
                                        id="themeBtn">

                                    <i class="fas fa-moon"></i>

                                </button>

                            </li>

                        </li>
                        </li>

                        <!-- User Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                @if(Auth::user()->profile_photo)

                                    <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo) }}"
                                        width="34"
                                        height="34"
                                        class="rounded-circle me-2"
                                        style="object-fit:cover;">

                                @else

                                    <i class="fas fa-user-circle fa-lg me-1"></i>

                                @endif
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
                                @php
                                $role = auth()->user()->role;
                                $profileRoute = match($role) {
                                    'student'   => 'student.profile',
                                    'admin'   => 'admin.profile',
                                    'school'   => 'school.profile',
                                    'referrer'  => 'referrer.profile',
                                    default     => 'dashboard'
                                };

                                $passwordRoute = match($role) {
                                    'student'   => 'student.password',
                                    'admin'   => 'admin.password',
                                    'school'   => 'school.password',
                                    'referrer'  => 'referrer.password',
                                    default     => 'dashboard'
                                };

                                $activityRoute = match($role) {
                                    'student'   => 'student.activity',
                                    'referrer'  => 'referrer.activity',
                                    'admin'   => 'admin.activity',
                                    'school'   => 'school.activity',
                                    default     => 'dashboard'
                                };
                            @endphp

                            <li>
                                <a class="dropdown-item" href="{{ route($profileRoute) }}">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route($passwordRoute) }}">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route($activityRoute) }}">
                                    <i class="fas fa-clock me-2"></i>Activity Log
                                </a>
                            </li>
                                    @if(auth()->user()->studentDetail)
                                    @if(auth()->user()->studentDetail->email_sub == 1)

                                        <a href="{{ route('student.email.disable') }}"
                                        class="btn btn-success">
                                        <i class="fas fa-toggle-on"></i> OFF Attendance Notification
                                        </a>

                                    @else

                                        <a href="{{ route('student.email.activate') }}"
                                        class="btn btn-secondary">
                                        <i class="fas fa-toggle-off"></i> ON Attendance Notification 
                                        </a>

                                    @endif
                                @endif
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function toggleTheme()
        {
            document.body.classList.toggle('dark-mode');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                document.getElementById('themeBtn').innerHTML =
                    '<i class="fas fa-sun"></i>';
            } else {
                localStorage.setItem('theme', 'light');
                document.getElementById('themeBtn').innerHTML =
                    '<i class="fas fa-moon"></i>';
            }
        }

        window.onload = function () {

            let savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');

                document.getElementById('themeBtn').innerHTML =
                    '<i class="fas fa-sun"></i>';
            }
        };
    </script>
    
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