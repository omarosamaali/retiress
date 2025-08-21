<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأسئلة الشائعة - جمعية الإمارات للمتقاعدين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="rgba(255,255,255,.1)"/><stop offset="100%" stop-color="rgba(255,255,255,0)"/></radialGradient></defs><rect width="11" height="11" fill="url(%23a)" rx="2" ry="2" transform="translate(0 0)"/><rect width="11" height="11" fill="url(%23a)" rx="2" ry="2" transform="translate(20 10)"/><rect width="11" height="11" fill="url(%23a)" rx="2" ry="2" transform="translate(40 0)"/><rect width="11" height="11" fill="url(%23a)" rx="2" ry="2" transform="translate(60 10)"/><rect width="11" height="11" fill="url(%23a)" rx="2" ry="2" transform="translate(80 0)"/></svg>');
            animation: float 20s linear infinite;
            opacity: 0.1;
        }

        @keyframes float {
            0% {
                transform: translateX(-100px);
            }

            100% {
                transform: translateX(100px);
            }
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .faq-container {
            padding: 80px 0;
        }

        .search-box {
            background: white;
            border-radius: 50px;
            padding: 15px 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
            display: flex;
            align-items: center;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            padding: 10px 15px;
            font-size: 16px;
            font-family: 'Cairo', Arial, sans-serif;
        }

        .search-box i {
            color: #667eea;
            font-size: 20px;
            margin-left: 15px;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .faq-category {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .faq-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
        }

        .category-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .category-header i {
            font-size: 2rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .faq-item {
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            padding: 20px 25px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            transition: all 0.3s ease;
            position: relative;
        }

        .faq-question:hover {
            background-color: #f8f9ff;
            color: #667eea;
        }

        .faq-question .toggle-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0 25px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            background: #f8f9ff;
        }

        .faq-answer.active {
            padding: 20px 25px;
            max-height: 200px;
        }

        .faq-answer p {
            color: #666;
            line-height: 1.8;
            font-size: 1rem;
        }

        .faq-item.active .toggle-icon {
            transform: rotate(180deg);
        }

        .contact-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-top: 60px;
        }

        .contact-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .contact-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            background: white;
            color: #667eea;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .contact-btn i {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .faq-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .search-box {
                margin: 0 20px 30px;
            }

            .contact-section h2 {
                font-size: 2rem;
            }

            .faq-question {
                padding: 15px 20px;
                font-size: 1rem;
            }

            .faq-answer.active {
                padding: 15px 20px;
            }
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-results i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .no-results h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-question-circle"></i> الأسئلة الشائعة</h1>
            <p class="subtitle">جمعية الإمارات للمتقاعدين - نجيب على جميع استفساراتكم</p>
        </div>
    </header>

    <div class="faq-container">
        <div class="container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="ابحث في الأسئلة الشائعة..." onkeyup="searchFAQ()">
            </div>

            <div class="faq-grid" id="faqGrid">
                <!-- العضوية والتسجيل -->
                <div class="faq-category" data-category="membership">
                    <div class="category-header">
                        <i class="fas fa-user-plus"></i>
                        <h2>العضوية والتسجيل</h2>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>كيف يمكنني التسجيل في الجمعية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>يمكنك التسجيل في الجمعية من خلال ملء استمارة العضوية وتقديم المستندات المطلوبة مثل إثبات التقاعد وصورة من الهوية الإماراتية. يمكنك زيارة مقر الجمعية أو التقديم إلكترونياً من خلال موقعنا الرسمي.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>ما هي شروط العضوية في الجمعية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>يجب أن يكون المتقدم مواطن إماراتي متقاعد، وأن يكون حاصلاً على معاش تقاعدي من إحدى الجهات الحكومية في دولة الإمارات العربية المتحدة، مع تقديم المستندات اللازمة للإثبات.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>هل هناك رسوم عضوية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>نعم، هناك رسوم عضوية سنوية رمزية تُستخدم لتغطية تكاليف الأنشطة والخدمات المقدمة للأعضاء. يمكنك الاستفسار عن قيمة الرسوم من خلال الاتصال بنا.</p>
                        </div>
                    </div>
                </div>

                <!-- الخدمات والمزايا -->
                <div class="faq-category" data-category="services">
                    <div class="category-header">
                        <i class="fas fa-hands-helping"></i>
                        <h2>الخدمات والمزايا</h2>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>ما هي الخدمات التي تقدمها الجمعية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>نقدم خدمات متنوعة تشمل الرعاية الصحية، والأنشطة الثقافية والاجتماعية، والرحلات الترفيهية، والاستشارات القانونية، وورش العمل التدريبية، بالإضافة إلى الخدمات المالية والتأمينية.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>هل يمكنني الاستفادة من الخدمات الصحية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>نعم، نوفر برامج رعاية صحية شاملة تشمل الفحوصات الدورية، والاستشارات الطبية، والعلاج الطبيعي، وبرامج الصحة النفسية، بالإضافة إلى خصومات على الخدمات الطبية في المراكز المتعاقدة معنا.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>كيف يمكنني حجز موعد للاستشارة؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>يمكنك حجز موعد للاستشارة من خلال الاتصال بالجمعية أو عبر الموقع الإلكتروني أو التطبيق الذكي. كما يمكنك زيارة مقر الجمعية مباشرة خلال ساعات العمل الرسمية.</p>
                        </div>
                    </div>
                </div>

                <!-- الأنشطة والفعاليات -->
                <div class="faq-category" data-category="activities">
                    <div class="category-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h2>الأنشطة والفعاليات</h2>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>ما أنواع الأنشطة التي تنظمها الجمعية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>ننظم أنشطة متنوعة تشمل الرحلات السياحية، والفعاليات الثقافية، وورش العمل التدريبية، والمحاضرات التوعوية، والأنشطة الرياضية، والمناسبات الاجتماعية، والمعارض والمؤتمرات.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>كيف يمكنني التسجيل في الأنشطة؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>يمكنك التسجيل في الأنشطة من خلال الموقع الإلكتروني للجمعية، أو التطبيق الذكي، أو الاتصال المباشر بالجمعية، أو زيارة مقر الجمعية. سنقوم بإرسال تأكيد التسجيل وتفاصيل النشاط عبر البريد الإلكتروني أو الرسائل النصية.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>هل الأنشطة مجانية للأعضاء؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>معظم الأنشطة مجانية للأعضاء، وبعض الأنشطة الخاصة قد تتطلب رسوم رمزية لتغطية التكاليف. نحرص على إتاحة الأنشطة لجميع الأعضاء بأسعار مدعومة.</p>
                        </div>
                    </div>
                </div>

                <!-- التواصل والدعم -->
                <div class="faq-category" data-category="contact">
                    <div class="category-header">
                        <i class="fas fa-headset"></i>
                        <h2>التواصل والدعم</h2>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>ما هي أوقات عمل الجمعية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>نعمل من الأحد إلى الخميس من الساعة 8:00 صباحاً حتى 4:00 عصراً. يمكنك التواصل معنا عبر الهاتف أو البريد الإلكتروني في أي وقت، وسنرد على استفساراتك في أقرب وقت ممكن.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>كيف يمكنني تقديم شكوى أو اقتراح؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>يمكنك تقديم الشكاوى والاقتراحات من خلال نموذج التواصل على موقعنا، أو عبر البريد الإلكتروني، أو الاتصال المباشر، أو زيارة مقر الجمعية. نحرص على الرد على جميع الشكاوى والاقتراحات خلال 48 ساعة.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>هل يمكنني تحديث بياناتي الشخصية؟</span>
                            <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="faq-answer">
                            <p>نعم، يمكنك تحديث بياناتك الشخصية من خلال تسجيل الدخول إلى حسابك على الموقع الإلكتروني، أو التواصل مع قسم العضوية، أو زيارة مقر الجمعية مع إحضار المستندات المطلوبة للتحديث.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="no-results" id="noResults" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>لم نعثر على أي نتائج</h3>
                <p>جرب استخدام كلمات مختلفة أو تصفح الأقسام أعلاه</p>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <h2>لم تجد إجابة لسؤالك؟</h2>
            <p>فريق خدمة العملاء متاح لمساعدتك في أي استفسار</p>
            <a href="#" class="contact-btn">
                <i class="fas fa-phone"></i>
                تواصل معنا
            </a>
        </div>
    </div>

    <script>
        function toggleFAQ(element) {
            const faqItem = element.parentNode;
            const answer = faqItem.querySelector('.faq-answer');
            const isActive = faqItem.classList.contains('active');

            // Close all other FAQ items
            document.querySelectorAll('.faq-item.active').forEach(item => {
                if (item !== faqItem) {
                    item.classList.remove('active');
                    item.querySelector('.faq-answer').classList.remove('active');
                }
            });

            // Toggle current item
            if (isActive) {
                faqItem.classList.remove('active');
                answer.classList.remove('active');
            } else {
                faqItem.classList.add('active');
                answer.classList.add('active');
            }
        }

        function searchFAQ() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categories = document.querySelectorAll('.faq-category');
            const noResults = document.getElementById('noResults');
            let hasResults = false;

            categories.forEach(category => {
                let categoryHasResults = false;
                const questions = category.querySelectorAll('.faq-item');

                questions.forEach(question => {
                    const questionText = question.querySelector('.faq-question span').textContent.toLowerCase();
                    const answerText = question.querySelector('.faq-answer p').textContent.toLowerCase();

                    if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        question.style.display = 'block';
                        categoryHasResults = true;
                        hasResults = true;
                    } else {
                        question.style.display = 'none';
                    }
                });

                if (categoryHasResults || searchTerm === '') {
                    category.style.display = 'block';
                } else {
                    category.style.display = 'none';
                }
            });

            if (hasResults || searchTerm === '') {
                noResults.style.display = 'none';
            } else {
                noResults.style.display = 'block';
            }
        }

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.id === 'searchInput') {
                searchFAQ();
            }
        });

        // Add smooth scrolling for better UX
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                setTimeout(() => {
                    if (this.parentNode.classList.contains('active')) {
                        this.scrollIntoView({
                            behavior: 'smooth'
                            , block: 'center'
                        });
                    }
                }, 300);
            });
        });

    </script>
</body>
</html>
