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
            background-color: #f0fdf4;
            color: #0e6939;
            transform: translateX(-5px);
        }

        .sidebar .nav-link.active {
            background-color: #0e6939;
            color: white !important;
            border-radius: 8px;
            margin: 4px 12px;
            padding: 10px 14px;
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

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.15); opacity: .85; }
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

        /* Admin alert toasts */
        #admin-toast-stack {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            pointer-events: none;
        }
        .admin-toast {
            pointer-events: all;
            min-width: 320px;
            max-width: 420px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 14px 18px 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-right: 5px solid #b68a35;
            opacity: 0;
            transform: translateY(-18px);
            transition: opacity .35s ease, transform .35s ease;
            font-family: 'Cairo', sans-serif;
        }
        .admin-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
        .admin-toast.hide {
            opacity: 0;
            transform: translateY(-18px);
        }
        .admin-toast.toast-blue  { border-right-color: #0284c7; }
        .admin-toast.toast-green { border-right-color: #16a34a; }
        .admin-toast.toast-red   { border-right-color: #dc2626; }
        .admin-toast__icon {
            font-size: 1.3rem;
            margin-top: 1px;
            flex-shrink: 0;
            color: #b68a35;
        }
        .admin-toast.toast-blue  .admin-toast__icon { color: #0284c7; }
        .admin-toast.toast-green .admin-toast__icon { color: #16a34a; }
        .admin-toast.toast-red   .admin-toast__icon { color: #dc2626; }
        .admin-toast__body { flex: 1; }
        .admin-toast__title {
            font-weight: 700;
            font-size: .88rem;
            color: #1e293b;
            margin-bottom: 2px;
        }
        .admin-toast__msg {
            font-size: .81rem;
            color: #475569;
            line-height: 1.45;
        }
        .admin-toast__close {
            background: none;
            border: none;
            font-size: 1rem;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .admin-toast__close:hover { color: #475569; }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Admin alert toasts container -->
    <div id="admin-toast-stack"></div>

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
            <a class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}" href="{{ route('admin.transactions.index') }}">
                <i class="fas fa-list-check"></i>
                المعاملات
            </a>
            @if(Auth::user()->role == 'مدير')
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>
                المستخدمين
            </a>
            @endif

            {{-- قائمة الجمعية - للمدير والمشرف فقط --}}
            @if(in_array(Auth::user()->role, ['مدير', 'مشرف']))
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
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
                            <i class="fas fa-newspaper"></i> الإعلانات
                        </a>
                    </li>
                </ul>
            </div>
            @elseif(Auth::user()->role === 'مدخل بيانات')
            {{-- مدخل بيانات: الإعلانات فقط --}}
            <a class="nav-link {{ request()->routeIs('admin.event.*') ? 'active' : '' }}" href="{{ route('admin.event.index') }}">
                <i class="fas fa-bullhorn"></i>
                الإعلانات والفعاليات
            </a>
            @endif

            {{-- المركز الإعلامي - للمدير والمشرف ومدخل البيانات --}}
            @if(in_array(Auth::user()->role, ['مدير', 'مشرف', 'مدخل بيانات']))
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-book"></i>
                    المركز الإعلامي
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.news.index') }}">
                            <i class="fas fa-newspaper"></i> أخبار الجمعية
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.magazines.index') }}">
                            <i class="fas fa-newspaper"></i> منبر الخبراء
                        </a>
                        @if(Auth::user()->role !== 'مدخل بيانات')
                        <a class="dropdown-item" href="{{ route('admin.feature.index') }}">
                            <i class="fas fa-newspaper"></i> مميزات العضوية
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
            @endif


            {{-- قائمة الإعدادات --}}
            @can('isAdmin')
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
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


            @if(Auth::user()->canAccessAdminPanel())
            <a class="nav-link" href="{{ route('admin.member-notifications.create') }}">
                <i class="fas fa-bell"></i>
                إشعار فوري للأعضاء
            </a>
            @endif

            <a class="nav-link {{ request()->routeIs('admin.contact-messages*') ? 'active' : '' }}"
               href="{{ route('admin.contact-messages') }}"
               style="display:flex;align-items:center;justify-content:space-between;">
                <span>
                    <i class="fas fa-message"></i>
                    الرسائل
                </span>
                @if(!empty($adminUnreadMessages) && $adminUnreadMessages > 0)
                <span style="background:#dc2626;color:#fff;border-radius:50px;padding:1px 8px;font-size:.72rem;font-weight:700;min-width:20px;text-align:center;animation:pulse-badge 1.5s infinite;">
                    {{ $adminUnreadMessages }}
                </span>
                @endif
            </a>

            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

    @php
        use App\Models\Transaction;
        use App\Models\MemberApplication;
        $since = now()->subHours(24);

        $pendingSubscriptions = Transaction::with(['user','event'])
            ->where('status', 'pending')
            ->where('created_at', '>=', $since)
            ->latest()
            ->get();

        $pendingMemberships = MemberApplication::with('user')
            ->where('status', '0')
            ->where('created_at', '>=', $since)
            ->latest()
            ->get();

        $adminToasts = collect();

        foreach ($pendingSubscriptions as $tr) {
            $userName  = $tr->user?->name_ar ?? $tr->user?->name ?? 'عضو';
            $eventName = $tr->event?->title_ar ?? $tr->event?->title_en ?? 'إعلان';
            $adminToasts->push([
                'id'    => 'sub_' . $tr->id,
                'type'  => 'blue',
                'icon'  => 'fa-solid fa-calendar-check',
                'title' => 'طلب اشتراك جديد',
                'msg'   => $userName . ' سجّل في "' . $eventName . '"',
            ]);
        }

        foreach ($pendingMemberships as $app) {
            $userName = $app->user?->name_ar ?? $app->user?->name ?? 'مستخدم';
            $adminToasts->push([
                'id'    => 'mem_' . $app->id,
                'type'  => 'green',
                'icon'  => 'fa-solid fa-id-card',
                'title' => 'طلب عضوية جديد',
                'msg'   => $userName . ' قدّم طلب عضوية جديدة',
            ]);
        }
    @endphp

    <script>
    (function () {
        var toasts = @json($adminToasts->values());
        if (!toasts.length) return;

        var stack   = document.getElementById('admin-toast-stack');
        var DELAY   = 600;   // ms between each toast appearing
        var LIFE    = 6000;  // ms before auto-hide
        var SS_KEY  = 'admin_toasts_seen';

        var seen = JSON.parse(sessionStorage.getItem(SS_KEY) || '[]');
        var unseen = toasts.filter(function(t){ return seen.indexOf(t.id) === -1; });
        if (!unseen.length) return;

        function makeToast(item) {
            var el = document.createElement('div');
            el.className = 'admin-toast toast-' + item.type;
            el.dataset.id = item.id;
            el.innerHTML =
                '<i class="' + item.icon + ' admin-toast__icon"></i>' +
                '<div class="admin-toast__body">' +
                    '<div class="admin-toast__title">' + item.title + '</div>' +
                    '<div class="admin-toast__msg">' + item.msg + '</div>' +
                '</div>' +
                '<button class="admin-toast__close" aria-label="إغلاق"><i class="fa-solid fa-xmark"></i></button>';
            return el;
        }

        function dismissToast(el) {
            el.classList.remove('show');
            el.classList.add('hide');
            setTimeout(function(){ if (el.parentNode) el.parentNode.removeChild(el); }, 380);
        }

        unseen.forEach(function(item, idx) {
            setTimeout(function() {
                var el = makeToast(item);
                stack.appendChild(el);
                requestAnimationFrame(function(){
                    requestAnimationFrame(function(){ el.classList.add('show'); });
                });

                // mark seen
                seen.push(item.id);
                sessionStorage.setItem(SS_KEY, JSON.stringify(seen));

                // close button
                el.querySelector('.admin-toast__close').addEventListener('click', function(){
                    dismissToast(el);
                });

                // auto-hide
                setTimeout(function(){ if (el.parentNode) dismissToast(el); }, LIFE);
            }, idx * DELAY);
        });
    })();
    </script>
</body>

</html>