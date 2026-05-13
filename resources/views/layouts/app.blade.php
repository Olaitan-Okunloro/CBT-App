<!-- resources/views/layouts/app.blade.php -->
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
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    @stack('styles')
    
    <style>
        body {
            background: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Purple Navbar */
        /* .navbar-purple {
            background: #6f42c1 !important;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.3);
        } */

        .navbar-purple {

            /* background: rgba(111, 66, 193, 0.92) !important; */
            background: hsl(300, 100%, 25%) !important;

            backdrop-filter: blur(10px);

            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.3);

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            z-index: 1050;
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

        /* .navbar-purple .dropdown-item:hover {
            background: linear-gradient(135deg, #6f42c1 0%, #8a5cf6 100%);
            color: white;
        } */
        
        .navbar-purple .dropdown-item i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {

            min-height: calc(100vh - 160px);

            padding: 100px 0 20px 0;
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

        /* 🔥 HARD FIX FOR SELECT IN DARK MODE */
        body.dark-mode {
            background: #121212 !important;
        }

        /* ✅ Apply text color ONLY where needed */
        body.dark-mode .card,
        body.dark-mode .table,
        body.dark-mode .footer,
        body.dark-mode .navbar,
        body.dark-mode .dropdown-menu,
        body.dark-mode .dropdown-item {
            color: #ffffff;
        }

        /* 🔥 Ensure form elements are always readable */
        body.dark-mode select,
        body.dark-mode input,
        body.dark-mode textarea {
            background-color: #ffffff !important;
            color: #000000 !important;
        }


        @media (max-width: 768px) {

            .main-content {

                padding-top: 120px;
            }

            .navbar-purple .navbar-brand {

                font-size: 1.2rem;
            }
        }

        .navbar .dropdown-menu {

            margin-top: 12px;
        }
</style>
</head>
<body>
    
    <!-- Navigation with purple class -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-purple">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-graduation-cap me-2"></i>AcademiCore
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav me-auto">
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>

                    <!-- Support Center (All Users except admin) -->
                    @if(auth()->user()->role != 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-headset me-1"></i>Support
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('support.index') }}"><i class="fas fa-ticket-alt me-2"></i>My Tickets</a></li>
                            <li><a class="dropdown-item" href="{{ route('support.create') }}"><i class="fas fa-plus-circle me-2"></i>Create Ticket</a></li>
                            @if(auth()->user()->role == 'admin')
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.support') }}"><i class="fas fa-inbox me-2"></i>Support Inbox</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <!-- ==================== STUDENT LINKS ==================== -->
                    @php $isExternal = auth()->user()->exam_type === 'EXTERNAL'; @endphp

                    @if(auth()->user()->role == 'student')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-diagram-project me-1"></i>Activity
                        </a>

                        <ul class="dropdown-menu">
                            @if(!$isExternal)
                            <li>
                                <a class="dropdown-item" href="{{ route('student.exams.available') }}">
                                    <i class="fas fa-book-open me-2"></i>Available Exams
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="{{ route('results.checker') }}">
                                    <i class="fas fa-chart-bar me-2"></i>My Results
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('student.practice.dashboard') }}">
                                    <i class="fas fa-chart-line me-2"></i>Practice Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.analytics') }}">
                                    <i class="fas fa-chart-line me-2"></i>Analytics
                                </a>
                            </li>
                            
                            @if($isExternal)
                            <li>
                                <a class="dropdown-item" href="{{ route('student.practice.page') }}">
                                    <i class="fas fa-chart-line me-2"></i>Start Practice
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('student.saved.questions') }}">
                                    <i class="fas fa-box-archive me-2"></i>Archive
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('student.weak.topics') }}">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Weak Topics
                                </a>
                            </li>

                            {{-- 🚫 HIDE FOR EXTERNAL --}}
                            @if(!$isExternal)

                            <li>
                                <a class="dropdown-item" href="{{ route('student.leaderboard') }}">
                                    <i class="fas fa-trophy me-2"></i>Leaders
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('student.email.activate') }}">
                                    <i class="fas fa-envelope me-2"></i>Subscribe
                                </a>
                            </li>

                            @isset($student)
                            <li>
                                <a class="dropdown-item" href="{{ route('student.qrcode', $student->user_id) }}">
                                    <i class="fas fa-qrcode me-2"></i>QR Code
                                </a>
                            </li>
                            @endisset

                            <!-- <li>
                                <a class="dropdown-item" href="{{ route('student.school.fees') }}">
                                    <i class="fas fa-credit-card me-2"></i>Payment
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('student.fees.history') }}">
                                    <i class="fas fa-clock me-2"></i>Payment History
                                </a>
                            </li> -->

                            @endif

                        </ul>
                    </li>
                    @if($isExternal)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('external.class.select') ? 'active' : '' }}" href="{{ route('external.class.select') }}">
                            <i class="fas fa-plus me-1"></i>Select Class
                        </a>
                    </li>
                    @endif

                    {{-- 🚫 HIDE FULL PAYMENT TAB --}}
                    @if(!$isExternal)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-credit-card me-1"></i>Payment
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="{{ route('student.school.fees') }}">Add Payment</a></li>
                            <li><a class="dropdown-item" href="{{ route('student.fees.history') }}">History</a></li> -->
                            <li>
                                <a class="dropdown-item" href="{{ route('student.school.fees') }}">
                                    <i class="fas fa-credit-card me-2"></i>Payment
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

                    @endif

                    <!-- ==================== TEACHER LINKS ==================== -->
                    @if(auth()->user()->role == 'teacher')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="examsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-file-alt me-1"></i>Exams
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-list me-2"></i>All Exams</a></li>
                            <li><a class="dropdown-item" href="{{ route('teacher.exams.create') }}"><i class="fas fa-plus me-2"></i>Create New Exam</a></li>
                            <li><a class="dropdown-item" href="{{ route('results.create') }}"><i class="fas fa-plus me-2"></i>Add Exam Score</a></li>
                            <li><a class="dropdown-item" href="{{ route('teacher.exam.paper') }}"><i class="fas fa-clipboard-question me-2"></i>Exam Questions</a></li>
                            <li><a class="dropdown-item" href="{{ route('teacher.answer.sheet') }}"><i class="fas fa-clipboard-check me-2"></i>Answer Sheet</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="questionsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-question-circle me-1"></i>Questions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('teacher.questions.create') }}"><i class="fas fa-plus me-2"></i>Create Question</a></li>
                            <li><a class="dropdown-item" href="{{ route('teacher.ai.generator') }}"><i class="fas fa-robot me-2"></i>AI Question Generator</a></li>
                            <li><a class="dropdown-item" href="{{ route('teacher.questions') }}"><i class="fas fa-database me-2"></i>Question Bank</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="attendanceDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-check me-1"></i>Attendance
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('teacher.students') }}"><i class="fas fa-users me-2"></i>My Students</a></li>
                            <li><a class="dropdown-item" href="{{ route('attendance.scan') }}"><i class="fas fa-qrcode me-2"></i>Take Attendance</a></li>
                            <li><a class="dropdown-item" href="{{ route('attendance.dashboard') }}"><i class="fas fa-chart-line me-2"></i>Attendance Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('students.face.list') }}"><i class="fas fa-user-check me-2"></i>Student Face Registration</a></li>
                            <li><a class="dropdown-item" href="{{ route('attendance.face.scan') }}"><i class="fas fa-camera me-2"></i>Face Attendance Scan</a></li>
                            <li><a class="dropdown-item" href="{{ route('notifications.create') }}"><i class="fas fa-paper-plane me-2"></i>Send Notifications</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- ==================== SCHOOL LINKS ==================== -->
                    @if(auth()->user()->role == 'school')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="schoolDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-school me-1"></i>School
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('school.teachers') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Teachers</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.teacher.create') }}"><i class="fas fa-plus me-2"></i>Add Teacher</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.teacher-subjects.index') }}"><i class="fas fa-book me-2"></i>Teacher/Subjects</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('school.students') }}"><i class="fas fa-user-graduate me-2"></i>Students</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.student.create') }}"><i class="fas fa-plus me-2"></i>Add Student</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.students.face.list') }}"><i class="fas fa-chart-line me-2"></i>Face Registration</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('classes.index') }}"><i class="fas fa-plus me-2"></i>Classes</a></li>
                            <li><a class="dropdown-item" href="{{ route('classes.create') }}"><i class="fas fa-plus me-2"></i>Add Class</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.students.import') }}"><i class="fas fa-upload me-2"></i>Upload Students</a></li>
                            <!-- <li><a class="dropdown-item" href="{{ route('school.attendance.face.scan') }}"><i class="fas fa-chart-line me-2"></i>Scan Face</a></li> -->
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="schoolPaymentDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-money-bill-wave me-1"></i>Payment
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('bulk.payment') }}"><i class="fas fa-credit-card me-2"></i>Bulk Payment</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.fees') }}"><i class="fas fa-credit-card me-2"></i>Add School Fees</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.fees.payments') }}"><i class="fas fa-hand-holding-usd me-2"></i>School Fees Payments</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.finance.dashboard') }}"><i class="fas fa-chart-line me-2"></i>Financial Analytics</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="manageResultsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-simple me-1"></i>Manage Results
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('school.results.manage') }}"><i class="fas fa-chart-simple me-2"></i>Release Results</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.results.remarks') }}"><i class="fas fa-chart-simple me-2"></i>Results Remarks</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.promotion') }}"><i class="fas fa-crown me-2"></i>Promote Students</a></li>
                            <li><a class="dropdown-item" href="{{ route('school.questions') }}"><i class="fas fa-plus me-2"></i>Questions</a></li>
                            <li><a class="dropdown-item" href="{{ route('notifications.create') }}"><i class="fas fa-paper-plane me-2"></i>Send Notifications</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- ==================== REFERRER ==================== -->
                    @if(auth()->user()->role == 'referrer')
                    <li class="nav-item dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="schoolPaymentDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-money-bill-wave me-1"></i>Payment
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('referrer.withdraw') }}"><i class="fas fa-credit-card me-2"></i>Withdraw Earning</a></li>
                            <li><a class="dropdown-item" href="{{ route('referrer.withdraw.history') }}"><i class="fas fa-credit-card me-2"></i>Withdrawal History</a></li>
                            <li><a class="dropdown-item" href="{{ route('referrer.analytics') }}"><i class="fas fa-chart-line me-2"></i>Analytics</a></li>
                            <li><a class="dropdown-item" href="{{ route('referrer.settings') }}"><i class="fas fa-gear me-2"></i>Settings</a></li>
                        </ul>
                    </li>

                    @endif

                    <!-- ==================== ADMIN LINKS ==================== -->
                    @if(auth()->user()->role == 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i>Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fas fa-users me-2"></i>Manage Users</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.announcements') }}"><i class="fas fa-bullhorn me-2"></i>Announcements</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminQuestionsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-question-circle me-1"></i>Questions
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.ai.generator') }}">
                                    <i class="fas fa-robot me-2"></i>AI Question Generator
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.qb') }}">
                                    <i class="fas fa-database me-2"></i>Question Bank
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.subject.topic.record') }}">
                                    <i class="fas fa-database me-2"></i>Subjects Record
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.topics.bulk-upload') }}">
                                    <i class="fas fa-upload me-1"></i>Bulk Upload Topics
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminQuestionsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-question-circle me-1"></i>Payment
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.withdrawals') }}">
                                    <i class="fas fa-money-bill-wave me-2"></i>Withdrawal
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.withdraw.history') }}">
                                    <i class="fas fa-money-bill-wave me-2"></i>Withdrawal History
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.subject.topic.record') }}">
                                    <i class="fas fa-database me-2"></i>Subjects Record
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.topics.bulk-upload') }}">
                                    <i class="fas fa-upload me-1"></i>Bulk Upload Topics
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>

                 @if(!$isExternal)
                    <a class="nav-link text-white" href="{{ route('notifications.index') }}">
                        <i class="fas fa-bell me-1"></i>
                        
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="badge bg-danger">{{ $unreadCount }}</span>
                        @endif
                    </a>
                @endif

                <!-- ==================== RIGHT SIDE USER MENU ==================== -->
                <ul class="navbar-nav ms-auto">
                    
                    @php
                        $notifications = DB::table('activity_logs')->where('user_id', auth()->id())->latest()->take(5)->get();
                        $unreadCount = DB::table('activity_logs')->where('user_id', auth()->id())->where('is_read', 0)->count();
                    @endphp

                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">{{ $unreadCount }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0" style="width:320px;">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <span>Notifications</span>
                                <small><a href="{{ route('notifications.read') }}">Mark all as read</a></small>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            @forelse($notifications as $note)
                                <div class="dropdown-item-text py-2 px-3">
                                    <small class="d-block"><span style="background-color:green; color:white; border-radius:5px; padding:2px 8px; display:inline-block;">{{ $note->activity }}</span></small>
                                    <small class="text-success">{{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</small>
                                </div>
                            @empty
                                <div class="dropdown-item-text text-center py-3 text-muted">No notifications</div>
                            @endforelse
                            <div class="dropdown-divider m-0"></div>
                            <div class="text-center py-2"><a href="{{ route('referrer.activity') }}" class="small text-decoration-none">View all</a></div>
                        </div>
                    </li>

                    <button class="btn btn-sm btn-outline-light" onclick="toggleTheme()" id="themeBtn">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo) }}" width="34" height="34" class="rounded-circle me-2" style="object-fit:cover;">
                            @else
                                <i class="fas fa-user-circle fa-lg me-1"></i>
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                            @if(auth()->user()->role == 'teacher')
                                <span class="badge bg-light text-dark ms-2" style="font-size: 0.6rem;">Teacher</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><div class="dropdown-header"><strong>{{ Auth::user()->name }}</strong><br><small class="text-muted">{{ Auth::user()->email }}</small></div></li>
                            <li><hr class="dropdown-divider"></li>
                            @php
                                $role = auth()->user()->role;
                                $profileRoute = match($role) { 'student' => 'student.profile', 'admin' => 'admin.profile', 'teacher' => 'teacher.profile', 'school' => 'school.profile', 'referrer' => 'referrer.profile', default => 'dashboard' };
                                $passwordRoute = match($role) { 'student' => 'student.password', 'admin' => 'admin.password', 'teacher' => 'teacher.password', 'school' => 'school.password', 'referrer' => 'referrer.password', default => 'dashboard' };
                                $activityRoute = match($role) { 'student' => 'student.activity', 'referrer' => 'referrer.activity', 'admin' => 'admin.activity', 'teacher' => 'teacher.activity', 'school' => 'school.activity', default => 'dashboard' };
                            @endphp
                            <li><a class="dropdown-item" href="{{ route($profileRoute) }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route($passwordRoute) }}"><i class="fas fa-key me-2"></i>Change Password</a></li>
                            <li><a class="dropdown-item" href="{{ route($activityRoute) }}"><i class="fas fa-clock me-2"></i>Activity Log</a></li>
                            @if(!$isExternal)
                                @if(auth()->user()->studentDetail)
                                    @if(auth()->user()->studentDetail->email_sub == 1)
                                        <li><a class="dropdown-item" href="{{ route('student.email.disable') }}"><i class="fas fa-toggle-on me-2"></i>OFF Attendance Notification</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('student.email.activate') }}"><i class="fas fa-toggle-off me-2"></i>ON Attendance Notification</a></li>
                                    @endif
                                @endif
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
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
                        &copy; {{ date('Y') }} AcademiCore. All rights reserved.
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

    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <!-- Add this in your app.blade.php before the closing body tag -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check for announcements in localStorage
        const shownAnnouncements = JSON.parse(localStorage.getItem('shown_announcements') || '{}');
        const today = new Date().toDateString();
        
        @if(isset($announcements) && $announcements->count())
            @foreach($announcements as $announcement)
                // Check if this announcement has been shown today
                if (!shownAnnouncements['{{ $announcement->id }}'] || shownAnnouncements['{{ $announcement->id }}'] !== today) {
                    setTimeout(function() {
                        showAnnouncementModal({
                            id: {{ $announcement->id }},
                            title: '{{ addslashes($announcement->title) }}',
                            message: '{{ addslashes($announcement->message) }}',
                            date: '{{ $announcement->created_at->diffForHumans() }}'
                        });
                    }, 1000); // Show after 1 second
                }
            @endforeach
        @endif
    });
    
    function showAnnouncementModal(data) {
        Swal.fire({
            title: '<i class="fas fa-bullhorn me-2" style="color: #6f42c1;"></i> ' + data.title,
            html: `
                <div class="text-center mb-3">
                    <i class="fas fa-volume-up fa-3x" style="color: #6f42c1;"></i>
                </div>
                <div class="alert alert-info">
                    <p class="mb-0">${data.message}</p>
                </div>
                <small class="text-muted">Posted: ${data.date}</small>
            `,
            icon: 'info',
            confirmButtonColor: '#6f42c1',
            confirmButtonText: '<i class="fas fa-check me-2"></i>Got it!',
            showCloseButton: true,
            allowOutsideClick: true,
            backdrop: true,
            customClass: {
                popup: 'announcement-modal',
                title: 'announcement-title'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Mark as shown today
                const shown = JSON.parse(localStorage.getItem('shown_announcements') || '{}');
                shown[data.id] = new Date().toDateString();
                localStorage.setItem('shown_announcements', JSON.stringify(shown));
            }
        });
    }
    
    // Optional: Clear stored announcements daily
    function clearOldAnnouncements() {
        const shown = JSON.parse(localStorage.getItem('shown_announcements') || '{}');
        const today = new Date().toDateString();
        let changed = false;
        
        Object.keys(shown).forEach(key => {
            if (shown[key] !== today) {
                delete shown[key];
                changed = true;
            }
        });
        
        if (changed) {
            localStorage.setItem('shown_announcements', JSON.stringify(shown));
        }
    }
    clearOldAnnouncements();
</script>

<style>
    .announcement-modal {
        border-radius: 15px;
        animation: fadeInUp 0.5s ease;
    }
    
    .announcement-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #6f42c1;
    }
    
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
</style>
@endpush
</body>
</html>
@stack('scripts')