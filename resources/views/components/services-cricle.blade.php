{{-- استخدام مباشر في Blade بدون Component Class --}}

@php
// حساب الإحصائيات
$totalServices = $services->count();
$activeServices = $services->where('status', 1)->count();
$paidServices = $services->where('is_payed', 0)->count(); // 0 = مدفوع
$freeServices = $services->where('is_payed', 1)->count(); // 1 = مجاني

// خدمات هذا الشهر والشهر الماضي
$thisMonthServices = $services->filter(function ($service) {
return \Carbon\Carbon::parse($service->created_at)->isCurrentMonth();
})->count();

$lastMonthServices = $services->filter(function ($service) {
return \Carbon\Carbon::parse($service->created_at)->isLastMonth();
})->count();

// حساب النسب المئوية
$targetServices = 50; // الهدف المحدد
$totalPercentage = $targetServices > 0 ? round(($totalServices / $targetServices) * 100) : 0;
$activePercentage = $totalServices > 0 ? round(($activeServices / $totalServices) * 100) : 0;
$paidPercentage = $totalServices > 0 ? round(($paidServices / $totalServices) * 100) : 0;

// حساب نسبة النمو
if ($lastMonthServices > 0) {
$growthPercentage = round((($thisMonthServices - $lastMonthServices) / $lastMonthServices) * 100);
} else {
$growthPercentage = $thisMonthServices > 0 ? 100 : 0;
}

// تحديد كلاس ومؤشر النمو
if ($growthPercentage > 0) {
$growthIndicatorClass = 'growth-positive';
$growthIcon = '↗';
} elseif ($growthPercentage < 0) { $growthIndicatorClass='growth-negative' ; $growthIcon='↘' ; } else { $growthIndicatorClass='growth-neutral' ; $growthIcon='→' ; } @endphp <style>
    .page-header {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-header h1 {
    /* color: ل; */
    font-size: 2rem;
    font-weight: 700;
    }

    .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
    }

    .progress-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    }

    .progress-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .progress-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .progress-circle {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 0 auto 20px;
    }

    .progress-circle svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
    }

    .progress-circle-bg {
    fill: none;
    stroke: #e9ecef;
    stroke-width: 8;
    }

    .progress-circle-fill {
    fill: none;
    stroke-width: 8;
    stroke-linecap: round;
    transition: stroke-dashoffset 2s ease-in-out;
    }

    .progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    }

    .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    }

    .card-subtitle {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 15px;
    }

    .card-stats {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
    }

    .stat-item {
    text-align: center;
    flex: 1;
    }

    .stat-value {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    }

    .stat-label {
    font-size: 0.8rem;
    color: #666;
    margin-top: 5px;
    }

    .growth-indicator {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 12px;
    margin-top: 10px;
    }

    .growth-positive {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
    }

    .growth-negative {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    }

    .growth-neutral {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
    }

    /* Colors for different progress circles */
    .services-total .progress-circle-fill {
    stroke: #667eea;
    }

    .services-active .progress-circle-fill {
    stroke: #28a745;
    }

    .services-paid .progress-circle-fill {
    stroke: #ffc107;
    }

    .services-growth .progress-circle-fill {
    stroke: #17a2b8;
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

    .progress-card {
    animation: fadeInUp 0.6s ease forwards;
    }

    .progress-card:nth-child(2) {
    animation-delay: 0.1s;
    }

    .progress-card:nth-child(3) {
    animation-delay: 0.2s;
    }

    .progress-card:nth-child(4) {
    animation-delay: 0.3s;
    }
    </style>

    <div class="dashboard-container">
        <div class="page-header">
            <h1>📊 إحصائيات الخدمات</h1>
        </div>

        <div class="stats-grid">
            <!-- إجمالي الخدمات -->
            <div class="progress-card services-total">
                <div class="progress-circle">
                    <svg>
                        <circle class="progress-circle-bg" cx="60" cy="60" r="52"></circle>
                        <circle class="progress-circle-fill" cx="60" cy="60" r="52" stroke-dasharray="327" stroke-dashoffset="327" data-progress="{{ $totalPercentage }}"></circle>
                    </svg>
                    <div class="progress-text">{{ $totalPercentage }}%</div>
                </div>
                <h3 class="card-title">إجمالي الخدمات</h3>
                <p class="card-subtitle">من الهدف المحدد</p>
                <div class="card-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalServices }}</div>
                        <div class="stat-label">خدمة حالية</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $targetServices }}</div>
                        <div class="stat-label">الهدف</div>
                    </div>
                </div>
                <div class="growth-indicator {{ $growthIndicatorClass }}">
                    {{ $growthIcon }}
                    @if($growthPercentage >= 0) +@endif{{ $growthPercentage }}% من الشهر الماضي
                </div>
            </div>

            <!-- الخدمات النشطة -->
            <div class="progress-card services-active">
                <div class="progress-circle">
                    <svg>
                        <circle class="progress-circle-bg" cx="60" cy="60" r="52"></circle>
                        <circle class="progress-circle-fill" cx="60" cy="60" r="52" stroke-dasharray="327" stroke-dashoffset="327" data-progress="{{ $activePercentage }}"></circle>
                    </svg>
                    <div class="progress-text">{{ $activePercentage }}%</div>
                </div>
                <h3 class="card-title">الخدمات النشطة</h3>
                <p class="card-subtitle">من إجمالي الخدمات</p>
                <div class="card-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $activeServices }}</div>
                        <div class="stat-label">نشطة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $totalServices - $activeServices }}</div>
                        <div class="stat-label">غير نشطة</div>
                    </div>
                </div>
                <div class="growth-indicator growth-positive">
                    ↗ معدل التفعيل العالي
                </div>
            </div>

            <!-- الخدمات المدفوعة -->
            <div class="progress-card services-paid">
                <div class="progress-circle">
                    <svg>
                        <circle class="progress-circle-bg" cx="60" cy="60" r="52"></circle>
                        <circle class="progress-circle-fill" cx="60" cy="60" r="52" stroke-dasharray="327" stroke-dashoffset="327" data-progress="{{ $paidPercentage }}"></circle>
                    </svg>
                    <div class="progress-text">{{ $paidPercentage }}%</div>
                </div>
                <h3 class="card-title">الخدمات المدفوعة</h3>
                <p class="card-subtitle">مقابل المجانية</p>
                <div class="card-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $paidServices }}</div>
                        <div class="stat-label">مدفوعة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $freeServices }}</div>
                        <div class="stat-label">مجانية</div>
                    </div>
                </div>
                <div class="growth-indicator growth-positive">
                    ↗ توزيع متوازن
                </div>
            </div>

            <!-- معدل النمو الشهري -->
            <div class="progress-card services-growth">
                <div class="progress-circle">
                    <svg>
                        <circle class="progress-circle-bg" cx="60" cy="60" r="52"></circle>
                        <circle class="progress-circle-fill" cx="60" cy="60" r="52" stroke-dasharray="327" stroke-dashoffset="327" data-progress="{{ min(abs($growthPercentage), 100) }}"></circle>
                    </svg>
                    <div class="progress-text">{{ abs($growthPercentage) }}%</div>
                </div>
                <h3 class="card-title">معدل النمو الشهري</h3>
                <p class="card-subtitle">مقارنة بالشهر السابق</p>
                <div class="card-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ $thisMonthServices }}</div>
                        <div class="stat-label">هذا الشهر</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">{{ $lastMonthServices }}</div>
                        <div class="stat-label">الشهر الماضي</div>
                    </div>
                </div>
                <div class="growth-indicator {{ $growthIndicatorClass }}">
                    {{ $growthIcon }}
                    @if($growthPercentage >= 0) +@endif{{ $growthPercentage }}% نمو شهري
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation for progress circles
        function animateProgressCircles() {
            const circles = document.querySelectorAll('.progress-circle-fill');

            circles.forEach(circle => {
                const progress = parseInt(circle.getAttribute('data-progress'));
                const circumference = 327; // 2 * PI * radius (52)
                const offset = circumference - (progress / 100) * circumference;

                // Start from full offset (empty circle)
                circle.style.strokeDashoffset = circumference;

                // Animate to target offset
                setTimeout(() => {
                    circle.style.strokeDashoffset = offset;
                }, 500);
            });
        }

        // Run animation when page loads
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(animateProgressCircles, 300);
        });

        // Add some interactivity
        document.querySelectorAll('.progress-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-5px) scale(1)';
            });
        });

    </script>
