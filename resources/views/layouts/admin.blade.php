<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم الإدارة')</title>
    <link rel="icon" href="{{ asset('assets/img/Group.png') }}" type="image/x-icon">
    <link rel="favicon" href="{{ asset('assets/img/Group.png') }}" type="image/x-icon">
    <!-- Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">

    <style>
        :root {
            --primary: #212529;
            --hover-primary: #4d4d4d;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        * {
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            background: white;
            padding: 20px 0;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar .logo {
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            padding: 0 20px;
            width: 200px;
            margin: 0 auto;
        }

        .sidebar .nav-link {
            color: var(--primary);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 0;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .sidebar .nav-link:hover {
            background-color: #ffffff1a;
            color: var(--hover-primary);
            transform: translateX(-5px);
        }

        .sidebar .nav-link.active {
            background-color: #ffffff33;
            color: white;
        }

        .sidebar .nav-link i {
            margin-left: 10px;
            width: 20px;
        }

        .dropdown-menu {
            background: #fffffff2;
            border: none;
            box-shadow: 0 4px 6px #0000001a;
            margin-right: 20px;
            border-radius: 8px;
        }

        .dropdown-item {
            color: #333;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            transform: translateX(-3px);
        }

        .main-content {
            margin-right: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 15px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px #0000001a;
            margin-bottom: 30px;
        }

        .content-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 4px #0000001a;
        }

        .btn-primary {
            background: #212529;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px #00000033;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px #0000001a;
        }

        .table thead th {
            background: #212529;
            color: white;
            border: none;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 12px;
            padding: 6px 12px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .btn-group .btn {
            margin: 0 2px;
            border-radius: 4px;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }
        }

        .btn-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }

        .edit-btn {
            background: #212529;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .update-btn {
            background: #212529;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

    </style>

    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('assets/img/Group.png') }}" class="" style="width: 100px;" alt="">
        </div>

        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
                الرئيسية
            </a>

            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>
                المستخدمين
            </a>


            {{-- قائمة الجمعية --}}
            @can('isAdmin')
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-book"></i>
                    عن الجمعية
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.membership.index') }}">
                            <i class="fas fa-users"></i>
                            إدخال بيانات العضوية
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.manageMembership.index') }}">
                            <i class="fas fa-info-circle"></i> العضوية
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.about-us.index') }}">
                            <i class="fas fa-info-circle"></i> من نحن
                        </a>
                    </li>
                               

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.member.index') }}">
                            <i class="fas fa-users"></i> الأعضاء
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.committee.index') }}">
                            <i class="fas fa-users"></i> اللجان
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.council.index') }}">
                            <i class="fas fa-users"></i> المجالس
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.event.index') }}">
                            <i class="fas fa-newspaper"></i> البرامج والفعاليات
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.services.index') }}">
                            <i class="fas fa-users"></i>
                            الخدمات
                        </a>
                    </li>

                </ul>
            </div>
            @endcan

            @can('isAdmin')
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-book"></i>
                    المركز الإعلامي
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.news.index') }}">
                            <i class="fas fa-newspaper"></i> أخبار الجمعية
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.magazines.index') }}">
                            <i class="fas fa-newspaper"></i> إنجازات الخبرات
                        </a>
                    </li>
                </ul>
            </div>
            @endcan


            {{-- قائمة الإعدادات --}}
            @can('isAdmin')
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                    الإعدادات
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-globe"></i>
                            اعدادات التواصل
                        </a>
                    </li>
                    <li>
                        {{-- 3. الباقات --}}
                        <a class="dropdown-item" href="{{ route('admin.packages.index') }}">
                            <i class="fas fa-box-open"></i> الباقات
                        </a>
                    </li>
                    <li>
                        {{-- 4. الخطط --}}
                        <a class="dropdown-item" href="{{ route('admin.plans.index') }}">
                            <i class="fas fa-clipboard-list"></i> الخطط
                        </a>
                    </li>
                    <li>
                        {{-- 4. الخطط --}}
                        <a class="dropdown-item" href="{{ route('sliders.index') }}">
                            <i class="fas fa-sliders-h"></i> إدارة السلايدر
                        </a>
                    </li>

                    {{-- <li>
                        <a class="dropdown-item" href="{{ route('admin.about-us.index') }}">
                    <i class="fas fa-info-circle"></i> معلومات عنا
                    </a>
                    </li> --}}
                    <li>
                        {{-- 11. الأسئلة الشائعة --}}
                        <a class="dropdown-item" href="{{ route('admin.faqs.index') }}">
                            <i class="fas fa-question-circle"></i> الأسئلة الشائعة
                        </a>
                    </li>
                    <li>
                        {{-- 12. البنرات --}}
                        <a class="dropdown-item" href="{{ route('admin.banners.index') }}">
                            <i class="fas fa-image"></i> البنرات
                        </a>
                    </li>
                </ul>
            </div>
            @endcan

            <a class="nav-link" href="{{ route('admin.chat') }}">
                <i class="fas fa-message"></i>
                المراسلات
            </a>

            <a class="nav-link" href="{{ route('admin.contact-messages') }}">
                <i class="fas fa-message"></i>
                الرسائل
            </a>

            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                تسجيل الخروج
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0" style="font-weight: 700; color: #212529;">@yield('page-title', 'لوحة التحكم')</h4>
                <div>
                    <span style="font-weight: 700; color: #212529;">مرحباً، {{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card">
            @yield('content')
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
