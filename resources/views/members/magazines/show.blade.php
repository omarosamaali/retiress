<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>{{ __('app.magazine_details_page_title') }}</title>
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
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">
        <link rel="favicon" href="{{ asset('assets/img/Group.png') }}" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <style>
        .member-image {
            width: 141px;
            height: 171px;
            margin-bottom: 6px;
            border: 1px solid black;
            padding: 2px;

        }

    </style>
</head>

<body>
    <x-guest-header></x-guest-header>
    <div id="in-cont" class="main-content">
        <section style="padding-top: 50px !important; background: unset ! important;" class="magazine-section">
            <h4 style="text-align: center; font-size: 27px; font-weight: bold;">منبر الخبراء</h4>
            <div class="container">
                @if($magazines)
                <div class="magazine-card" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="magazine-image">
                                @if($magazines->main_image)
                                <img src="{{ asset('storage/' . $magazines->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($magazines->title_ar ?? 'صورة المجلة') : ($magazines->title_en ?? 'Magazine Image') }}">
                                @else
                                <img src="{{ asset('images/default-magazine.jpg') }}" alt="صورة المجلة الافتراضية">
                                @endif
                            </div>
                        </div>
                        <div style="margin-top: 30px">
                            <img style="width: 80px; height: 80px; border-radius: 50%;" src="{{ asset('storage/' . $magazines->image) }}" alt="">
                            <span style="margin-right: 8px">{{ $magazines->name }}</span>
                        </div>
                        <div class="col-md-6 magazine-info">
                            <h2 class="magazine-title">
                                <div style="color: #800000;" >
                                    {{ app()->getLocale() == 'ar' ? $magazines->title_ar : $magazines->title_en }}
                                </div>
                            </h2>
                            {{-- <div class="member-details">
                                <h4>بيانات العضو</h4>
                                @if($magazines->member->personal_photo_path != null)
                                <img src="{{ asset('storage/' . $magazines->member->personal_photo_path) }}" class="member-image" alt="">
                                @endif
                                <h4> {{ $magazines->member->full_name }}</h4>
                                <h4 style="font-weight: normal; font-size: 15px;"> {{ $magazines->member->emirate }}</h4>
                                @php
                                $previousExperiences = $magazines->member->previous_experience;
                                $firstExperience = $previousExperiences[0] ?? null;
                                @endphp
                                @if ($firstExperience)
                                <p style="font-weight: bold;">
                                    <strong> </strong> {{ $firstExperience['employer'] }}<br>
                                    <strong></strong> {{ $firstExperience['job_title'] }}
                                </p>
                                @endif
                            </div> --}}
                            <hr>

                            <p class="magazine-description">
                                {{ app()->getLocale() == 'ar' ? $magazines->description_ar : $magazines->description_en }}
                            </p>
                            @if($magazines->sub_image)
                            @php
                            $subImages = json_decode($magazines->sub_image, true);
                            @endphp
                            @if(is_array($subImages) && count($subImages) > 0)
                            <div class="sub-images-gallery">
                                <h5>مزيد من الصور</h5>
                                <div class="gallery-grid">
                                    @foreach($subImages as $subImage)
                                    <div class="gallery-item">
                                        <img src="{{ asset('storage/' . $subImage) }}" alt="صورة من المعرض" 
                                        onclick="openImage('{{ asset('storage/' . $subImage) }}')">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center w-100">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <p class="mb-0">المجلة غير موجودة</p>
                    </div>
                </div>
                @endif
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function openImage(imageUrl) {
                        Swal.fire({
                            imageUrl: imageUrl,
                            imageWidth: 600,
                            imageAlt: 'صورة من المعرض',
                            showCloseButton: true,
                            showConfirmButton: false,
                            background: '#fff',
                            customClass: {
                                image: 'img-fluid'
                            }
                        });
                    }
                </script>
            </div>
        </section>
        <style>
            /* General Styling */
            body {
                font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background-color: #f5f6fa;
                color: #333;
                line-height: 1.6;
            }

            .main-content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .inn-title {
                text-align: center;
                padding: 50px 0 20px;
                background: linear-gradient(135deg, #007bff, #00c4ff);
                color: white;
                border-radius: 10px;
                margin-bottom: 30px;
            }

            .inn-title h2 {
                font-size: 2rem;
                margin: 0;
            }

            .inn-title h2 a {
                color: #fff;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .inn-title h2 a:hover {
                color: #e0e0e0;
            }

            /* Magazine Section */
            .magazine-section {
                padding: 40px 0;
            }

            .container {
                max-width: 1140px;
                margin: 0 auto;
            }

            .magazine-card {
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 30px;
                transition: transform 0.3s ease;
            }

            .magazine-card:hover {
                transform: translateY(-5px);
            }

            .magazine-image img {
                width: 100%;
                height: 350px;
                object-fit: cover;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .magazine-image img:hover {
                transform: scale(1.03);
            }

            .magazine-info {
                padding: 20px;
            }

            .magazine-title a {
                font-size: 1.8rem;
                color: #007bff;
                text-decoration: none;
                font-weight: 700;
                transition: color 0.3s ease;
            }

            .magazine-title a:hover {
                color: #0056b3;
            }

            .member-details h4 {
                font-size: 1.2rem;
                color: #444;
                margin-bottom: 10px;
            }

            .member-details p {
                font-size: 1rem;
                color: #666;
            }

            .meta-info {
                font-size: 0.9rem;
                color: #777;
                margin: 20px 0;
            }

            .meta-info i {
                margin-right: 8px;
                color: #007bff;
            }

            .badge {
                padding: 6px 12px;
                border-radius: 12px;
                font-size: 0.85rem;
                font-weight: 500;
            }

            .badge-success {
                background-color: #28a745;
                color: white;
            }

            .badge-secondary {
                background-color: #6c757d;
                color: white;
            }

            .magazine-description {
                font-size: 1.3rem;
                color: #2c2b2b;
                line-height: 46px !important;
                margin-top: 20px;
            }

            /* Gallery */
            .sub-images-gallery {
                margin-top: 30px;
            }

            .sub-images-gallery h5 {
                font-size: 1.3rem;
                color: #333;
                margin-bottom: 20px;
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
            }

            .gallery-item img {
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .gallery-item img:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            /* Modal Styling */
            .modal-content {
                border-radius: 10px;
                overflow: hidden;
            }

            .modal-body img {
                width: 100%;
                height: auto;
                border-radius: 8px;
            }

            .modal-footer .btn-secondary {
                background-color: #6c757d;
                border: none;
                border-radius: 8px;
                padding: 8px 16px;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .magazine-card {
                    padding: 20px;
                }

                .magazine-image img {
                    height: 250px;
                }

                .magazine-title a {
                    font-size: 1.5rem;
                }

                .gallery-grid {
                    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                }
            }

        </style>

        <script>
            function openImageModal(imageSrc) {
                document.getElementById('modalImage').src = imageSrc;
                var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            }

        </script>

        <x-footer-section></x-footer-section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
        <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
