<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>الأسئلة الشائعة</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            direction: rtl;
        }

        .floating-clouds {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(230, 230, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-radius: 50px;
            opacity: 0.8;
            animation: float-cloud linear infinite;
            will-change: transform;
            filter: blur(1px);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .cloud:before {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.4), rgba(240, 240, 255, 0.3), rgba(255, 255, 255, 0.2));
            border-radius: 60px;
            filter: blur(2px);
        }

        .cloud:after {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(250, 250, 255, 0.1), rgba(255, 255, 255, 0.3));
            border-radius: 40px;
            filter: blur(1.5px);
        }

        .cloud1 {
            width: 120px;
            height: 60px;
            top: 10%;
            animation-duration: 25s;
            animation-delay: 0s;
        }

        .cloud1:before {
            width: 80px;
            height: 80px;
            top: -40px;
            left: 20px;
        }

        .cloud1:after {
            width: 100px;
            height: 60px;
            top: -25px;
            left: 50px;
        }

        .cloud2 {
            width: 90px;
            height: 45px;
            top: 25%;
            animation-duration: 30s;
            animation-delay: -8s;
        }

        .cloud2:before {
            width: 60px;
            height: 60px;
            top: -30px;
            left: 15px;
        }

        .cloud2:after {
            width: 75px;
            height: 45px;
            top: -15px;
            left: 35px;
        }

        .cloud3 {
            width: 150px;
            height: 75px;
            top: 45%;
            animation-duration: 35s;
            animation-delay: -15s;
        }

        .cloud3:before {
            width: 100px;
            height: 100px;
            top: -50px;
            left: 25px;
        }

        .cloud3:after {
            width: 125px;
            height: 75px;
            top: -30px;
            left: 60px;
        }

        .cloud4 {
            width: 110px;
            height: 55px;
            top: 65%;
            animation-duration: 28s;
            animation-delay: -22s;
        }

        .cloud4:before {
            width: 70px;
            height: 70px;
            top: -35px;
            left: 18px;
        }

        .cloud4:after {
            width: 90px;
            height: 55px;
            top: -20px;
            left: 45px;
        }

        .cloud5 {
            width: 130px;
            height: 65px;
            top: 80%;
            animation-duration: 32s;
            animation-delay: -30s;
        }

        .cloud5:before {
            width: 85px;
            height: 85px;
            top: -42px;
            left: 22px;
        }

        .cloud5:after {
            width: 105px;
            height: 65px;
            top: -25px;
            left: 55px;
        }

        @keyframes float-cloud {
            0% {
                transform: translateX(-200px) translateY(0px);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateX(calc(100vw + 200px)) translateY(-10px);
                opacity: 0;
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .faq-section {
            padding: 60px 0;
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #FFD700, #FFA500);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            margin-bottom: 3rem;
            font-weight: 300;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .faq-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .faq-question {
            padding: 25px 30px;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .faq-question::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .faq-question:hover::before {
            opacity: 1;
        }

        .faq-question .icon {
            font-size: 1.5rem;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: #FFD700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .faq-item.active .faq-question .icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.98);
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-answer-content {
            padding: 30px;
            color: #444;
            font-size: 1.1rem;
            line-height: 1.8;
            border-top: 3px solid #FFD700;
            position: relative;
        }

        .faq-answer-content::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50px;
            height: 3px;
            /* background: linear-gradient(90deg, #667eea, #764ba2); */
        }

        .no-faqs {
            text-align: center;
            padding: 60px 30px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            color: #666;
            font-size: 1.3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .no-faqs i {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 20px;
            display: block;
        }

        @media (max-width: 768px) {
            .floating-clouds {
                width: 100vw;
                height: 100vh;
            }

            .cloud1,
            .cloud2,
            .cloud3,
            .cloud4,
            .cloud5 {
                transform: scale(0.7);
            }

            .section-title {
                font-size: 2.2rem;
            }

            .faq-question {
                padding: 20px;
                font-size: 1.1rem;
            }

            .faq-answer-content {
                padding: 25px 20px;
                font-size: 1rem;
            }

            .container {
                padding: 0 15px;
            }
        }

        @media (max-width: 480px) {
            .section-title {
                font-size: 1.8rem;
            }

            .faq-question {
                padding: 15px;
                font-size: 1rem;
            }

            .faq-answer-content {
                padding: 20px 15px;
                font-size: 0.95rem;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
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

        .faq-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .faq-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .faq-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .faq-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .faq-item:nth-child(5) {
            animation-delay: 0.5s;
        }

        .faq-item:nth-child(n+6) {
            animation-delay: 0.6s;
        }

        .swiper-slide {
            background: #cfa046c7 !important;
        }

    </style>
</head>

<body ng-app="myApp">
    <x-guest-header></x-guest-header>

    <div class="floating-clouds">
        <div class="cloud cloud1"></div>
        <div class="cloud cloud2"></div>
        <div class="cloud cloud3"></div>
        <div class="cloud cloud4"></div>
        <div class="cloud cloud5"></div>
    </div>

    <section style="background: unset !important;" class="faq-section py-5">
        <div class="container">
            <div class="faq-container">
                <div id="faq-list">
                    @if($faqs->isEmpty())
                    <div class="no-faqs">
                        <i class="fas fa-question-circle"></i>
                        لا توجد أسئلة شائعة حاليًا.
                    </div>
                    @else
                    @foreach($faqs as $index => $faq)
                    <div class="faq-item loading" style="animation-delay: {{ ($index * 0.1) + 0.1 }}s;">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>{{ $faq->question_ar }}</span>
                            <i class="fas fa-chevron-down icon"></i>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                {{ $faq->answer_ar }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <x-footer-section></x-footer-section>

    <script>
        // Toggle FAQ function
        function toggleFaq(element) {
            const faqItem = element.closest('.faq-item');
            const isActive = faqItem.classList.contains('active');

            // Close all other FAQ items with smooth animation
            document.querySelectorAll('.faq-item.active').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                }
            });

            // Toggle current FAQ item
            if (isActive) {
                faqItem.classList.remove('active');
            } else {
                faqItem.classList.add('active');
            }
        }

        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('loaded');
                }, index * 100);
            });

            // Add keyboard accessibility
            document.querySelectorAll('.faq-question').forEach(question => {
                question.setAttribute('tabindex', '0');
                question.setAttribute('role', 'button');
                question.setAttribute('aria-expanded', 'false');

                question.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        toggleFaq(this);
                        // Update aria-expanded
                        const isExpanded = this.closest('.faq-item').classList.contains('active');
                        this.setAttribute('aria-expanded', isExpanded);
                    }
                });

                // Update aria-expanded on click
                question.addEventListener('click', function() {
                    setTimeout(() => {
                        const isExpanded = this.closest('.faq-item').classList.contains('active');
                        this.setAttribute('aria-expanded', isExpanded);
                    }, 100);
                });
            });

            // Add search functionality (optional enhancement)
            createSearchBox();
        });

        // Optional: Add search functionality
        function createSearchBox() {
            const faqContainer = document.querySelector('.faq-container');
            const searchHTML = `
                <div class="search-box" style="margin-bottom: 2rem; text-align: center;">
                    <input type="text" id="faq-search" placeholder="ابحث في الأسئلة..." 
                                style="padding: 12px 20px; font-size: 1rem; border: none; border-radius: 25px; 
                                        width: 100%; max-width: 400px; background: rgba(255,255,255,0.9);
                                        backdrop-filter: blur(10px); box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                </div>
            `;

            faqContainer.insertAdjacentHTML('afterbegin', searchHTML);

            // Search functionality
            document.getElementById('faq-search').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const faqItems = document.querySelectorAll('.faq-item');

                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer-content').textContent.toLowerCase();

                    if (question.includes(searchTerm) || answer.includes(searchTerm) || searchTerm === '') {
                        item.style.display = 'block';
                        item.style.animation = 'fadeInUp 0.3s ease forwards';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show "no results" message if needed
                const visibleItems = document.querySelectorAll('.faq-item[style*="block"]').length;
                let noResultsMsg = document.querySelector('.no-results');

                if (visibleItems === 0 && searchTerm !== '') {
                    if (!noResultsMsg) {
                        noResultsMsg = document.createElement('div');
                        noResultsMsg.className = 'no-results';
                        noResultsMsg.innerHTML = `
                            <div style="text-align: center; padding: 40px; color: rgba(255,255,255,0.8); font-size: 1.1rem;">
                                <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.6;"></i>
                                <p>لم يتم العثور على نتائج لـ "<strong>${e.target.value}</strong>"</p>
                                <p style="font-size: 0.9rem; margin-top: 10px;">جرب كلمات مفتاحية مختلفة</p>
                            </div>
                        `;
                        faqContainer.appendChild(noResultsMsg);
                    }
                } else if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            });
        }

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add loading effect for better UX
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Optional: Auto-expand first FAQ on large screens
        if (window.innerWidth > 768) {
            setTimeout(() => {
                const firstFaq = document.querySelector('.faq-item .faq-question');
                if (firstFaq) {
                    // Uncomment next line if you want first FAQ to be open by default
                    // toggleFaq(firstFaq);
                }
            }, 1000);
        }

    </script>
</body>

</html>
