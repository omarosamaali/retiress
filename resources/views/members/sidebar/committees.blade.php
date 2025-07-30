<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title> {{ __('app.committees_councils_title') }}</title>
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
    <style>
        @font-face {
            font-family: 'FontAwesome';
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?v=4.7.0');
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            direction: rtl;
            letter-spacing: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        body {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        html {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        section {
            display: block;
        }

        section {
            word-break: break-word;
            position: relative;
        }

        .py-hp3 {
            padding-top: 0.5rem !important;
        }

        .py-hp3 {
            padding-bottom: 0.5rem !important;
        }

        *,
        :before,
        :after {
            box-sizing: border-box;
        }

        :selection {
            background: #b68a35;
            color: #FFF;
        }

        .container-rni {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-rni {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container-rni {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container-rni {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container-rni {
                max-width: 1200px;
            }
        }

        .container-rni {
            position: relative;
        }

        .bg-xf5 {
            background-color: #fff !important;
        }

        .shadow-t3k {
            box-shadow: 0 10px 40px 10px rgba(140, 152, 164, 0.175) !important;
        }

        .my-kck {
            margin-top: 3rem !important;
        }

        .my-kck {
            margin-bottom: 3rem !important;
        }

        .p-7p2 {
            padding: 1.5rem !important;
        }

        .shadow-t3k {
            transition-property: box-shadow, transform;
            -webkit-animation: __shadowPageLoadFix;
            animation: __shadowPageLoadFix;
            -webkit-animation-duration: 0.01s;
            animation-duration: 0.01s;
        }

        .col-x3d,
        .col-ze4 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-x3d {
            flex: 0 0 100%;
            max-width: 100%;
        }

        @media (min-width: 992px) {
            .col-ze4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .col-x3d,
        .col-ze4 {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .row-cwp {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        nav {
            display: block;
        }

        .col-cvg,
        .col-igy {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 576px) {
            .col-cvg {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 768px) {
            .col-igy {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .col-cvg,
        .col-igy {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-cvg,
        .col-5vc {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .col-5vc {
                flex: 0 0 75%;
                max-width: 75%;
            }
        }

        .my-mpv {
            margin-top: 1rem !important;
        }

        .my-mpv {
            margin-bottom: 1rem !important;
        }

        .col-cvg,
        .col-5vc {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .pagination-4q1 {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }

        .content-m53 {
            justify-content: center !important;
        }

        .position-1lp {
            position: relative !important;
        }

        .shadow-primary-sxe {
            box-shadow: 0 0 25px rgba(55, 125, 255, 0.1) !important;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a {
            outline: none !important;
        }

        .text-7zo {
            color: #2E2E2E !important;
        }

        .text-b1x {
            text-decoration: none !important;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        a.text-7zo:hover {
            color: #080808 !important;
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .my-7z8 {
            margin-top: 0.5rem !important;
        }

        .my-7z8 {
            margin-bottom: 0.5rem !important;
        }

        .fs--oox {
            font-size: 12px !important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        p {
            color: #1f1f1f;
        }

        .mb-yo9 {
            margin-bottom: 0.5rem !important;
        }

        .mt-1o5 {
            margin-top: 1rem !important;
        }

        .fs--6nj {
            font-size: 15px !important;
        }

        .jus-6kh {
            text-align: justify;
        }

        .text-jdt {
            text-align: left !important;
        }

        .block-osq {
            display: block !important;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h2 {
            font-size: 2.125rem;
        }

        h2,
        .qvtmx {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .qvtmx {
            font-size: 1.32812rem;
        }

        .font-weight-s3h {
            font-weight: 700 !important;
        }

        .ml-dcp {
            margin-left: 0.5rem !important;
        }

        .cvhcv {
            vertical-align: middle;
            display: inline-block;
        }

        .cvhcv:before {
            font-family: "Flaticon" !important;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            line-height: 1.5;
            text-decoration: inherit;
            text-rendering: optimizeLegibility;
            text-transform: none;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
        }

        .fi-slf:before {
            content: "\f108";
        }

        .mx-8rj {
            margin-right: 0.5rem !important;
        }

        .mx-8rj {
            margin-left: 0.5rem !important;
        }

        .fi-r6z:before {
            content: "\f15f";
        }

        .fa-vxc {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .fa-otp:before {
            content: "\f100";
        }

        .fa-p16:before {
            content: "\f0d6";
        }

        .btn-o2b {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.78rem 1rem;
            font-size: 1.0625rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, transform 0.25s ease-in-out;
        }

        .btn-link-6oj {
            font-weight: 400;
            color: #b28b46;
            text-decoration: none;
        }

        .btn-dex {
            padding: 0.46rem 1rem;
            font-size: 1.0625rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .mr-i7e {
            margin-right: 0.25rem !important;
        }

        .mb-xpg {
            margin-bottom: 0.25rem !important;
        }

        .btn-o2b:not(:disabled):not(.dis-zyj) {
            cursor: pointer;
        }

        .btn-o2b:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn-link-6oj:hover {
            color: unset;
            text-decoration: underline;
        }

        .tag-qdr {
            position: relative;
            display: inline-block;
            margin: 0 6px 3px 0;
        }

        .bor-kyc {
            border: 1px solid #dde4ea !important;
        }

        .warning-voa {
            border-color: #fad776 !important;
        }

        .mb-m36 {
            margin-bottom: 1rem !important;
        }

        .p-gd6 {
            padding: 1rem !important;
        }

        .text-m1o {
            text-align: center !important;
        }

        .bw--bik {
            border-width: 2px !important;
        }

        .border-6a9 {
            border-style: dashed !important;
            border-width: 1px;
        }

        .link-3e9 {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #6c757d;
            background-color: #fff;
            border: 1px solid #eef2f5;
        }

        .link-3e9:hover {
            z-index: 2;
            color: #002e84;
            text-decoration: none;
            background-color: #fbfcfc;
            border-color: #eef2f5;
        }

        .bg-primary-mxv {
            color: #00379d !important;
            background-color: #eaf1ff !important;
        }

        .item-93j.act-ycn .link-3e9 {
            z-index: 3;
            color: #b28b46;
            background-color: #eaf1ff;
            border-color: #eaf1ff;
        }

        figure {
            display: block;
        }

        figure {
            margin: 0 0 1rem;
        }

        .overflow-khm {
            overflow: hidden !important;
        }

        .m-38w {
            margin: 0 !important;
        }

        a>i {
            pointer-events: none;
        }

        .btn-o2b:not(.rounded-circle)>i {
            display: inline-block;
            margin-left: 10px;
        }

        .btn-dex:not(.rounded-circle) i.cvhcv {
            font-size: 13px;
        }

        .fi-dots-horizontal-5gg:before {
            content: "\f1d2";
        }

        .tag-qdr>span.vrkqv {
            border: 1px solid #e3e3e3;
            color: #666;
            display: inline-block;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 1px;
            padding: 8px 9px;
            text-transform: uppercase;
            float: left;
        }

        :active {
            outline: none !important;
        }

        .fa-ket:before {
            content: "\f054";
        }

        .fa-9ge:before {
            content: "\f141";
        }

        .fa-6i7:before {
            content: "\f053";
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .img-odq {
            max-width: 100%;
            height: auto;
        }

        .rou-m3b {
            border-radius: 0.25rem !important;
        }

        .tag-7vr:before {
            content: "\f155";
        }


        @keyframes __shadowPageLoadFix {
            0% {}

            100% {
                box-shadow: none;
                box-shadow: none;
            }

        }

        @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');

        @font-face {
            font-family: pro;
            src: url(https://uaeca.ae/wp-content/themes/uaeca/web_fonts/ar/Tajawal-Medium.ttf);
        }

        @font-face {
            font-family: pro;
            src: url(https://uaeca.ae/wp-content/themes/uaeca/web_fonts/arabic/Almarai-Regular.ttf);
        }

        @media all {
            body {
                font-family: 'Roboto';
                font-size: 14px;
                line-height: 1.143em;
                color: #777777;
                font-weight: 400;
                letter-spacing: -0.1px;
                direction: rtl;
            }
        }

        @media all {
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
            }

            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                line-height: 1.428571429;
                color: #333333;
                background-color: #fff;
            }

            body {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            body {
                font-family: "Roboto", sans-serif;
                font-size: 14px;
                line-height: 16px;
                font-weight: 400;
            }

            body {
                font-family: 'Roboto';
                color: #777777;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.143em;
            }

            body {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            html {
                font-family: sans-serif;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            html {
                font-size: 10px;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .list-vja {
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                grid-auto-rows: 210px;
                grid-gap: 30px;
            }

            @media (max-width: 767px) {
                .list-vja {
                    grid-template-columns: repeat(1, 1fr);
                }

                .list-vja .list-2nx {
                    position: relative;
                    -ms-grid-column: auto;
                    grid-column: auto / span 7 !important;
                    overflow: hidden;
                }
            }

            :before,
            :after {
                box-sizing: border-box;
            }

            a {
                background-color: transparent;
            }

            a {
                color: #337ab7;
                text-decoration: none;
            }

            a {
                color: #3c98ff;
                outline: none !important;
            }

            a {
                color: #222222;
            }

            a {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
            }

            a {
                color: #eb5a3c;
            }

            .list-vja .list-2nx {
                position: relative;
                -ms-grid-column-span: 5;
                -ms-grid-column: auto;
                grid-column: auto/span 5;
                overflow: hidden;
            }

            .list-vja .list-2nx:nth-child(6n + 1) {
                -ms-grid-column-span: 7;
                -ms-grid-column: auto;
                grid-column: auto/span 7;
                -ms-grid-row-span: 2;
                -ms-grid-row: auto;
                grid-row: auto/span 2;
            }

            a:not(.stm_projects_carousel__item):not(.stm_projects_card):not(.rev-btn) {
                transition: all 0.25s ease !important;
            }

            a:active,
            a:hover {
                outline: 0;
            }

            a:hover {
                color: #23527c;
                text-decoration: underline;
            }

            a:hover {
                color: #dac725;
            }

            a:hover {
                color: #eb5a3c;
            }

            span {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .list-vja .image-dvm {
                height: 100%;
            }

            .hqqhi {
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }

            .hqqhi {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .hqqhi {
                font-size: 14px;
            }

            .hqqhi {
                font-weight: bold;
                padding: 0;
                margin: 0 0 8px;
            }

            .hqqhi {
                margin: 0 0 12px;
            }

            .hqqhi {
                font-family: 'Roboto';
                color: #333333;
                font-weight: 900;
                letter-spacing: 0px;
            }

            .hqqhi {
                font-family: 'Roboto';
                color: #333333;
                font-size: 14px;
                font-weight: 900;
            }

            .list-vja .list-o16 {
                background: #b68a35 !important;
            }

            .list-vja .list-o16 {
                position: absolute;
                width: 40px;
                height: 70px;
                left: 30px;
                top: 0;
                background: #77b218;
                color: #fff;
                text-align: center;
                font-size: 11px;
                font-weight: bold;
                line-height: 1;
                text-transform: uppercase;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                -ms-flex-pack: center;
                justify-content: center;
                -ms-flex-align: center;
                align-items: center;
                z-index: 1;
            }

            .list-vja .list-2nx:first-child .list-o16 {
                left: 40px;
                width: 60px;
                height: 100px;
                font-size: 16px;
            }

            .sbc,
            .sbc_h:hover,
            .sbc_a:after,
            .sbc_a_h:hover:after,
            .sbc_b:before,
            .sbc_b_h:hover:before,
            h1:before,
            .h1:before,
            h2:before,
            .h2:before,
            h3:before,
            .h3:before,
            h4:before,
            .qhngb:before,
            h5:before,
            .hqqhi:before,
            h6:before,
            .h6:before,
            h1:after,
            .h1:after,
            h2:after,
            .h2:after,
            h3:after,
            .h3:after,
            h4:after,
            .qhngb:after,
            h5:after,
            .hqqhi:after,
            h6:after,
            .h6:after,
            .services_price_list_style_1.services_price_list_tabs ul li.active a,
            .stm_history_style_2 .stm_history__title::after,
            .stm_pagination_style_4 ul.page-numbers .page-numbers.current,
            .stm_pagination_style_4 ul.page-numbers .page-numbers:hover,
            .services_price_list_style_1 .services__tab_heading::after,
            .dropcaps_circle:before,
            .stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active,
            .stm_pricing-table_style_4 .stm_pricing-table__label,
            .stm_pagination_style_6 .owl-nav .owl-prev:hover,
            .stm_pagination_style_6 .owl-nav .owl-next:hover,
            .stm_pagination_style_7 .owl-dots .owl-dot:hover span,
            .stm_pagination_style_7 .owl-dots .owl-dot.active span,
            .stm_single_donation_style_1 .stm_single_donation__progress-bar span,
            .stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label,
            .stm_form_style_6 .stm_input_wrapper_checkbox.active::before,
            .stm_pagination_style_4 .tp-bullet.selected span,
            .stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active,
            .stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover,
            .stm_layout_store .stm-cart_style_1 .cart__quantity-badge,
            .woocommerce .stm_woo_products .owl-prev:hover,
            .woocommerce .stm_woo_products .owl-next:hover,
            .store_newsletter .mc4wp-form-fields .btn,
            .woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info,
            .woocommerce .special_offer_product__meta_box .special_offer_countdown_out,
            [type="submit"],
            .stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover,
            .stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover,
            .stm_shop_layout_store.woocommerce .button:hover,
            .stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_shop_layout_store .woocommerce .button:hover,
            .stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products::before,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover,
            .stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a::after,
            .stm-footer .footer-widgets aside.widget.widget_mc4wp_form_widget .btn:hover,
            .stm_posts_list_style_10 .stm_posts_list_single__category,
            .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
            .stm_posts_carousel_style_3 .stm_posts_carousel_single__category,
            .stm_layout_factory .btn_primary.btn_solid:hover,
            .stm_video_style_10 .stm_playb:hover,
            .stm_projects_carousel .owl-dots .owl-dot.active,
            .stm_iconbox_style_15.stm_iconbox:hover,
            .stm_testimonials_style_17 .image_dots .owl-dot.active,
            .stm_infobox_style_11 .stm_infobox__link a::after,
            .stm_projects_cards_style_5 .stm_projects_cards__filter li.active::after,
            .stm_testimonials_style_18 .image_dots .dots:hover::after,
            .stm_testimonials_style_18 .image_dots .dots.active::after,
            .stm_pricing-table_style_5 .stm_pricing-table__footer .btn,
            .stm_schedule_style_2 .event_lesson_tabs.active a,
            .stm_schedule_style_2 .event_lesson_info>li::before,
            .stm_schedule_style_2 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title_desc_wrap .event_lesson_info_full_description ul li::before,
            .stm_tabs_style_6 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active>a .vc_tta-title-text::before,
            .stm_infobox_style_13 .stm_infobox__button,
            .stm_tabs_style_6 .vc_tta-panel a,
            .stm_pricing-table_style_10 .btn:hover span,
            .stm_pricing-table_style_10:hover .stm_pricing-table__content ul li::before,
            .stm_layout_creativethree .btn_third.btn_solid:hover,
            .stm_layout_creativethree .btn.btn_primary.btn_solid,
            .stm_post_style_26 .stm_loop__grid .list-zkk .read-more i,
            .stm_post_style_26 .stm_loop__list .list-zkk .read-more i,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__addr .__icon,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__date .__icon,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn:hover,
            .btn_secondary.btn_solid,
            .btn_secondary.btn_outline:hover,
            .btn_secondary.btn_outline .btn__icon::after,
            .stm_slider_style_3.stm_slider .stm_slide__button a,
            .stm_slider_style_4 .stm_slide__button a {
                background-color: rgb(218, 199, 37) !important;
            }

            h1:before,
            h2:before,
            h3:before,
            h4:before,
            h5:before,
            h6:before,
            h1:after,
            h2:after,
            h3:after,
            h4:after,
            h5:after,
            h6:after,
            .h2:before,
            .h3:before,
            .qhngb:before,
            .hqqhi:before,
            .h6:before,
            .h2:after,
            .h3:after,
            .qhngb:after,
            .hqqhi:after {
                width: 45px !important;
                height: 5px !important;
            }

            .sbc_b:before,
            .sbc_b_h:hover:before,
            h1:before,
            .h1:before,
            h2:before,
            .h2:before,
            h3:before,
            .h3:before,
            h4:before,
            .qhngb:before,
            h5:before,
            .hqqhi:before,
            h6:before,
            .h6:before {
                background: #b68a35 !important;
            }

            .stm_headings_line h5::before,
            .stm_headings_line .hqqhi::before {
                margin-bottom: 30px;
            }

            .stm_headings_line.stm_headings_line_top h1::before,
            .stm_headings_line.stm_headings_line_top .h1::before,
            .stm_headings_line.stm_headings_line_top h2::before,
            .stm_headings_line.stm_headings_line_top .h2::before,
            .stm_headings_line.stm_headings_line_top h3::before,
            .stm_headings_line.stm_headings_line_top .h3::before,
            .stm_headings_line.stm_headings_line_top h4::before,
            .stm_headings_line.stm_headings_line_top .qhngb::before,
            .stm_headings_line.stm_headings_line_top h5::before,
            .stm_headings_line.stm_headings_line_top .hqqhi::before,
            .stm_headings_line.stm_headings_line_top h6::before,
            .stm_headings_line.stm_headings_line_top .h6::before {
                content: "";
                display: block;
                width: 46px;
                height: 5px;
                margin: 0 0 21px;
            }

            .stm_headings_line.stm_headings_line_top .hqqhi::before,
            .stm_headings_line.stm_headings_line_top h2::before {
                content: "";
                display: none !important;
            }

            .sbc,
            .sbc_h:hover,
            .sbc_a::after,
            .sbc_a_h:hover::after,
            .sbc_b::before,
            .sbc_b_h:hover::before,
            h1::before,
            .h1::before,
            h2::before,
            .h2::before,
            h3::before,
            .h3::before,
            h4::before,
            .qhngb::before,
            h5::before,
            .hqqhi::before,
            h6::before,
            .h6::before,
            h1::after,
            .h1::after,
            h2::after,
            .h2::after,
            h3::after,
            .h3::after,
            h4::after,
            .qhngb::after,
            h5::after,
            .hqqhi::after,
            h6::after,
            .h6::after,
            .services_price_list_style_1.services_price_list_tabs ul li.active a,
            .stm_history_style_2 .stm_history__title::after,
            .stm_pagination_style_4 ul.page-numbers .page-numbers.current,
            .stm_pagination_style_4 ul.page-numbers .page-numbers:hover,
            .services_price_list_style_1 .services__tab_heading::after,
            .dropcaps_circle::before,
            .stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active,
            .stm_pricing-table_style_4 .stm_pricing-table__label,
            .stm_pagination_style_6 .owl-nav .owl-prev:hover,
            .stm_pagination_style_6 .owl-nav .owl-next:hover,
            .stm_pagination_style_7 .owl-dots .owl-dot:hover span,
            .stm_pagination_style_7 .owl-dots .owl-dot.active span,
            .stm_single_donation_style_1 .stm_single_donation__progress-bar span,
            .stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label,
            .stm_form_style_6 .stm_input_wrapper_checkbox.active::before,
            .stm_pagination_style_4 .tp-bullet.selected span,
            .stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active,
            .stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover,
            .stm_layout_store .stm-cart_style_1 .cart__quantity-badge,
            .woocommerce .stm_woo_products .owl-prev:hover,
            .woocommerce .stm_woo_products .owl-next:hover,
            .store_newsletter .mc4wp-form-fields .btn,
            .woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info,
            .woocommerce .special_offer_product__meta_box .special_offer_countdown_out,
            .stm_form_style_10 [type="submit"],
            .stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover,
            .stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover,
            .stm_shop_layout_store.woocommerce .button:hover,
            .stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_shop_layout_store .woocommerce .button:hover,
            .stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products::before,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover,
            .stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a::after,
            .stm-footer .footer-widgets aside.widget.widget_mc4wp_form_widget .btn:hover,
            .stm_posts_list_style_10 .stm_posts_list_single__category,
            .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
            .stm_posts_carousel_style_3 .stm_posts_carousel_single__category,
            .stm_layout_factory .btn_primary.btn_solid:hover,
            .stm_video_style_10 .stm_playb:hover,
            .stm_projects_carousel .owl-dots .owl-dot.active,
            .stm_iconbox_style_15.stm_iconbox:hover,
            .stm_testimonials_style_17 .image_dots .owl-dot.active,
            .stm_infobox_style_11 .stm_infobox__link a::after,
            .stm_projects_cards_style_5 .stm_projects_cards__filter li.active::after,
            .stm_testimonials_style_18 .image_dots .dots:hover::after,
            .stm_testimonials_style_18 .image_dots .dots.active::after,
            .stm_pricing-table_style_5 .stm_pricing-table__footer .btn,
            .stm_schedule_style_2 .event_lesson_tabs.active a,
            .stm_schedule_style_2 .event_lesson_info>li::before,
            .stm_schedule_style_2 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title_desc_wrap .event_lesson_info_full_description ul li::before,
            .stm_tabs_style_6 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active>a .vc_tta-title-text::before,
            .stm_infobox_style_13 .stm_infobox__button,
            .stm_tabs_style_6 .vc_tta-panel a,
            .stm_pricing-table_style_10 .btn:hover span,
            .stm_pricing-table_style_10:hover .stm_pricing-table__content ul li::before,
            .stm_layout_creativethree .btn_third.btn_solid:hover,
            .stm_layout_creativethree .btn.btn_primary.btn_solid,
            .stm_post_style_26 .stm_loop__grid .list-zkk .read-more i,
            .stm_post_style_26 .stm_loop__list .list-zkk .read-more i,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__addr .__icon,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__date .__icon,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn:hover,
            .btn_secondary.btn_solid,
            .btn_secondary.btn_outline:hover,
            .btn_secondary.btn_outline .btn__icon::after,
            .stm_slider_style_3.stm_slider .stm_slide__button a,
            .stm_slider_style_4 .stm_slide__button a {
                background-color: rgb(218, 199, 37) !important;
            }

            .list-vja .list-zkk {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                padding: 20px 30px 26px;
                min-height: 210px;
                background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8));
                color: #fff;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                -ms-flex-pack: end;
                justify-content: flex-end;
            }

            .list-vja .list-2nx:first-child .list-zkk {
                padding: 20px 40px 36px;
            }

            img {
                border: 0;
            }

            img {
                vertical-align: middle;
            }

            img {
                max-width: 100%;
                height: auto;
                transform: translateZ(0);
            }

            .list-l88 .image-dvm img {
                transition: all 0.25s ease !important;
            }

            .list-vja .image-dvm img {
                object-fit: cover;
                display: block;
                height: 100%;
                width: 100%;
            }

            .list-vja .list-2nx:hover .image-dvm img {
                transform: scale(1.1);
            }

            .list-o16 span {
                color: #fff !important;
            }

            .list-vja .list-m72 {
                font-size: 25px;
            }

            .list-vja .list-2nx:first-child .list-m72 {
                font-size: 36px;
            }

            .qhngb {
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }

            .qhngb {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .qhngb {
                font-size: 18px;
            }

            .qhngb {
                font-weight: bold;
                padding: 0;
                margin: 0 0 8px;
            }

            .qhngb {
                margin-bottom: 20px;
            }

            .qhngb {
                font-family: 'Roboto';
                color: #333333;
                font-weight: 900;
                letter-spacing: 0px;
            }

            .qhngb {
                font-family: 'Roboto';
                color: #333333;
                font-size: 16px;
                font-weight: 900;
            }

            .qhngb {
                font-family: "Cairo", sans-serif !important;
                ;
            }

            .list-vja .title-n5f {
                color: #fff;
            }

            .list-vja .title-n5f {
                text-transform: uppercase;
                margin-bottom: 0;
                font-size: 20px;
                line-height: 26px;
            }

            .list-vja .list-2nx:first-child .title-n5f {
                font-size: 24px;
                line-height: 30px;
            }

            .stm_headings_line h4::before,
            .stm_headings_line .qhngb::before {
                margin-bottom: 15px;
            }

            .list-vja .list-mzq {
                display: none;
                margin-top: 10px;
            }
        }

        @media (min-width: 1024px) {
            .list-vja .list-2nx:nth-child(6n + 1) .list-mzq {
                display: block;
            }
        }

        @media all {
            p {
                margin: 0 0 10px;
            }

            p {
                line-height: 22px;
                margin: 0 0 15px;
            }

            p {
                margin-bottom: 15px;
                line-height: 22px;
            }

            p {
                font-size: 15px;
                line-height: 21px !important;
            }

            p {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .list-vja .list-mzq p {
                line-height: 17px !important;
                color: #fff !important;
                margin: 0;
            }

            .list-vja .list-mzq p {
                line-height: 22px;
                margin: 0;
            }
        }

        @font-face {
            font-family: 'FontAwesome';
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?v=4.7.0');
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            direction: rtl;
            letter-spacing: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        body {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        html {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        section {
            display: block;
        }

        section {
            word-break: break-word;
            position: relative;
        }

        *,
        :before,
        :after {
            box-sizing: border-box;
        }

        :selection {
            background: #b68a35;
            color: #FFF;
        }

        .container-e3z {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-e3z {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container-e3z {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container-e3z {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container-e3z {
                max-width: 1200px;
            }
        }

        .container-e3z {
            position: relative;
        }

        .row-sy7 {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-rdf,
        .col-sgn,
        .col-w5q {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 576px) {
            .col-rdf {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 768px) {
            .col-sgn {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }
        }

        @media (min-width: 992px) {
            .col-w5q {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .col-rdf,
        .col-sgn,
        .col-w5q {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        [data-aos="fade-left"] {
            transform: translate3d(100px, 0, 0);
        }

        [data-aos^="fade"][data-aos^="fade"] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        body[data-aos-duration="700"] [data-aos] {
            transition-duration: .7s;
        }

        body[data-aos-easing="ease-in-out-sine"] [data-aos] {
            transition-timing-function: cubic-bezier(.445, .05, .55, .95);
        }

        [data-aos^="fade"][data-aos^="fade"].aos-wai {
            opacity: 1;
            transform: translateZ(0);
        }

        .col-rdf,
        .col-hj5,
        .col-bpd {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .col-hj5 {
                flex: 0 0 66.66667%;
                max-width: 66.66667%;
            }
        }

        @media (min-width: 992px) {
            .col-bpd {
                flex: 0 0 75%;
                max-width: 75%;
            }
        }

        .col-rdf,
        .col-hj5,
        .col-bpd {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        [data-aos="fade-right"] {
            transform: translate3d(-100px, 0, 0);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h1 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1 {
            font-size: 2.65625rem;
        }

        .font-weight-5zk {
            font-weight: 700 !important;
        }

        .text-jli {
            color: #fff !important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        p {
            color: #1f1f1f;
        }

        .mt-hh3 {
            margin-top: 1rem !important;
        }

        .fs--k6k {
            font-size: 14px !important;
        }

        .jus-bww {
            text-align: justify;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a {
            outline: none !important;
        }

        .btn-dwo {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.78rem 1rem;
            font-size: 1.0625rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, transform 0.25s ease-in-out;
        }

        .btn-3hf {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }

        .mt-xhi {
            margin-top: 0.5rem !important;
        }

        .btn-dwo:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        .btn-dwo:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn-3hf:hover {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
        }

        .btn-3hf:not(.btn-noshadow):hover,
        .btn-3hf:not(.btn-noshadow):not(.btn-soft):active {
            box-shadow: 0 4px 11px rgba(248, 249, 250, 0.35);
        }

        .mb-tjg {
            margin-bottom: 0.5rem !important;
        }

        .container-wxt {
            list-style: none;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
            padding: 0;
            position: relative;
            z-index: 1;
        }

        .container-mtv {
            touch-action: pan-y;
        }

        .block-qlo {
            display: block;
            width: 100%;
        }

        .mt-pot {
            margin-top: 1.5rem !important;
        }

        @media (min-width: 768px) {
            .hidden-md-nf1 {
                display: none !important;
            }
        }

        a>i {
            pointer-events: none;
        }

        .fa-b5o {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .btn-dwo:not(.rounded-circle)>i {
            display: inline-block;
            margin-left: 10px;
        }

        .fa-mo2:before {
            content: "\f100";
        }

        .hid-eor {
            display: none;
        }

        .wrapper-m84 {
            box-sizing: content-box;
            display: flex;
            height: 100%;
            position: relative;
            transition-property: transform;
            width: 100%;
            z-index: 1;
        }

        .wrapper-m84 {
            transform: translateZ(0);
        }

        .container-wxt .swiper-paf {
            left: 0;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 0;
            z-index: -1000;
        }

        .slide-mpo {
            flex-shrink: 0;
            height: 100%;
            position: relative;
            transition-property: transform;
            width: 100%;
        }

        .bg-7x8 {
            background-color: #fff !important;
        }

        .h-fqy {
            height: 100% !important;
        }

        .p-gq9 {
            padding: 0.25rem !important;
        }

        .position-yet {
            position: absolute !important;
        }

        .mt-obv {
            margin-top: 3rem !important;
        }

        .top-oh5 {
            top: 0 !important;
        }

        .end-apc {
            left: 0 !important;
            right: auto !important;
        }

        .z-index-ql7 {
            z-index: 3 !important;
        }

        .text-zyz {
            text-align: left !important;
        }

        .block-i34 {
            display: block !important;
        }

        .text-7cc {
            text-decoration: none !important;
        }

        figure {
            display: block;
        }

        figure {
            margin: 0 0 1rem;
        }

        .overflow-pbq {
            overflow: hidden !important;
        }

        .m-3ox {
            margin: 0 !important;
        }

        .text-8fp {
            text-align: center !important;
        }

        .w-ye6 {
            width: 100% !important;
        }

        .px-gp5 {
            padding-right: 1rem !important;
        }

        .pb-zrl {
            padding-bottom: 1rem !important;
        }

        .px-gp5 {
            padding-left: 1rem !important;
        }

        .text-bd8 {
            text-align: right !important;
        }

        .pt-do4 {
            padding-top: 4.5rem !important;
        }

        .bottom-b3w {
            bottom: 0 !important;
        }

        .left-6kv {
            left: 0 !important;
            right: auto;
        }

        .z-index-z4y {
            z-index: 5 !important;
        }

        .bg_-lll {
            background: rgb(0, 0, 0);
            background: -moz-linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            background: -webkit-linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#000000", GradientType=1);
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .img-cth {
            max-width: 100%;
            height: auto;
            max-height: 344px;

        }

        h3 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h3 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h3 {
            font-size: 1.85938rem;
        }


        /* These were inline style tags. Uses id+class to override almost everything */
        #swi-52y.style-whUzr {
            transform: translate3d(1770px, 0px, 0px);
            transition-duration: 0ms;
        }

        #style-tBPcl.style-tBPcl {
            width: 280px;
            margin-left: 15px;
        }

        #style-LLsyn.style-LLsyn {
            width: 280px;
            margin-left: 15px;
        }

        #style-dXfYd.style-dXfYd {
            width: 280px;
            margin-left: 15px;
        }

        #style-VgiKx.style-VgiKx {
            width: 280px;
            margin-left: 15px;
        }

        #style-clG3h.style-clG3h {
            width: 280px;
            margin-left: 15px;
        }

        #style-mSypA.style-mSypA {
            width: 280px;
            margin-left: 15px;
        }

        #style-oextP.style-oextP {
            width: 280px;
            margin-left: 15px;
        }

        #style-o2o6G.style-o2o6G {
            width: 280px;
            margin-left: 15px;
        }

        #style-weY9m.style-weY9m {
            width: 280px;
            margin-left: 15px;
        }

        #style-39S1c.style-39S1c {
            width: 280px;
            margin-left: 15px;
        }

        #style-DOjtK.style-DOjtK {
            width: 280px;
            margin-left: 15px;
        }

        #style-Ar5Bh.style-Ar5Bh {
            width: 280px;
            margin-left: 15px;
        }

        #style-2EyZs.style-2EyZs {
            width: 280px;
            margin-left: 15px;
        }

        #style-dWvaR.style-dWvaR {
            width: 280px;
            margin-left: 15px;
        }

        #style-mJzve.style-mJzve {
            width: 280px;
            margin-left: 15px;
        }

        @font-face {
            font-family: 'FontAwesome';
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?v=4.7.0');
            src: url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff2?v=4.7.0') format('woff2'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.woff?v=4.7.0') format('woff'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype'), url('https://www.easd.ae/site/assets/fontawesome/fa4/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            direction: rtl;
            letter-spacing: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        body {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        html {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        section {
            display: block;
        }

        section {
            word-break: break-word;
            position: relative;
        }

        body:not(.layout-admin) section {
            margin-top: 0px;
        }


        *,
        :before,
        :after {
            box-sizing: border-box;
        }

        :selection {
            background: #b68a35;
            color: #FFF;
        }

        .container-jfa {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-jfa {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container-jfa {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container-jfa {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container-jfa {
                max-width: 1200px;
            }
        }

        .container-jfa {
            position: relative;
        }

        .row-xpi {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        @media (max-width: 992px) {
            .col-5vp {
                max-width: 100%;
            }
        }

        .col-sm-12,
        .col-md-4,
        .col-yvl {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 992px) {
            .col-yvl {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .col-sm-12,
        .col-md-4,
        .col-yvl {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        [data-aos^="fade"][data-aos^="fade"] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        body[data-aos-duration="700"] [data-aos] {
            transition-duration: .7s;
        }

        body[data-aos-easing="ease-in-out-sine"] [data-aos] {
            transition-timing-function: cubic-bezier(.445, .05, .55, .95);
        }

        [data-aos^="fade"][data-aos^="fade"].aos-yy6 {
            opacity: 1;
            transform: translateZ(0);
        }

        .py-3pd {
            padding-top: 1rem !important;
        }

        .py-3pd {
            padding-bottom: 1rem !important;
        }

        .text-z2s {
            color: #fff !important;
        }

        .overlay-xlg>* {
            z-index: 1;
            position: relative;
        }

        .p-az7 {
            padding: 0 !important;
        }

        .shadow-4kl {
            box-shadow: 0 0 25px rgba(140, 152, 164, 0.1) !important;
        }

        .overlay-xlg {
            transition: all .2s ease;
        }

        .overlay-xlg {
            position: relative;
        }

        .bg-gradient-linear-oko {
            background-color: #41247a !important;
            background-image: linear-gradient(163deg, #5d34af 0%, #5d34af 25%, #82009f 65%, #f7345e 100%) !important;
        }

        .shadow-3d-bjp:hover {
            box-shadow: 0 2.5rem 4rem rgba(22, 28, 45, 0.1) !important;
        }

        .col-5vp,
        .col-yvl {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-5vp {
            flex: 0 0 50%;
            max-width: 25%;
        }

        .border-4j7 {
            border-color: #f8f9fa !important;
        }

        .d-ztr {
            display: flex !important;
        }

        .p--6on {
            padding: 15px !important;
        }

        .bw--gp7 {
            border-width: 1px !important;
        }

        .bl-2a6 {
            border-left: 0 !important;
        }

        .br-6vh {
            border-right: 0 !important;
        }

        .bb-nhq {
            border-bottom: 0 !important;
        }

        .border-oi3 {
            border-style: dashed !important;
            border-width: 1px;
        }

        @media only screen and (min-width: 991px) {
            .b--0-jto {
                border: 0 !important;
            }
        }

        .col-5vp,
        .col-yvl {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        [data-aos][data-aos][data-aos-delay="350"] {
            transition-delay: 0;
        }

        [data-aos][data-aos][data-aos-delay="350"].aos-yy6 {
            transition-delay: .35s;
        }

        .overlay-light>*,
        .overlay-xlg>* {
            z-index: 1;
            position: relative;
        }

        [data-aos][data-aos][data-aos-delay="450"] {
            transition-delay: 0;
        }

        [data-aos][data-aos][data-aos-delay="450"].aos-yy6 {
            transition-delay: .45s;
        }

        .font-weight-9aw {
            font-weight: 700 !important;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a {
            outline: none !important;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        .btn:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn-light:hover {
            color: #212529;
            background-color: #e2e6ea;
            border-color: #dae0e5;
        }

        .btn-light:not(.btn-noshadow):hover,
        .btn-light:not(.btn-noshadow):not(.btn-soft):active {
            box-shadow: 0 4px 11px rgba(248, 249, 250, 0.35);
        }

        .bt-wo9 {
            border-top: 0 !important;
        }

        [data-aos][data-aos][data-aos-delay="250"] {
            transition-delay: 0;
        }

        [data-aos][data-aos][data-aos-delay="250"].aos-yy6 {
            transition-delay: .25s;
        }

        .my-z1s {
            margin-top: 0.5rem !important;
        }

        .my-z1s {
            margin-bottom: 0.5rem !important;
        }

        .pt--q2m {
            padding-top: 6px !important;
        }

        .pr--72b {
            padding-right: 20px !important;
        }

        .pl--3ni {
            padding-left: 10px !important;
        }

        .fs--iep {
            font-size: 40px !important;
        }

        .line-height-5w6 {
            line-height: 1 !important;
        }

        .text-8ry {
            text-decoration: none !important;
        }

        [data-aos][data-aos][data-aos-delay="150"] {
            transition-delay: 0;
        }

        [data-aos][data-aos][data-aos-delay="150"].aos-yy6 {
            transition-delay: .15s;
        }

        .pceis {
            vertical-align: middle;
            display: inline-block;
        }

        .pceis:before {
            font-family: "Flaticon" !important;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            line-height: 1.5;
            text-decoration: inherit;
            text-rendering: optimizeLegibility;
            text-transform: none;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
        }

        .fi-smartphone-939:before {
            content: "\f122";
        }

        .btn:not(.rounded-circle)>i {
            display: inline-block;
            margin-left: 10px;
        }

        .fa-angle-double-left:before {
            content: "\f100";
        }

        h2 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h2 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h2 {
            font-size: 2.125rem;
        }

        .mb-gc8 {
            margin-bottom: 0 !important;
        }

        .fs--8tt {
            font-size: 20px !important;
        }

        .lfkrr {
            direction: ltr !important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        p {
            color: #1f1f1f;
        }

        .m-13v {
            margin: 0 !important;
        }

        .opacity-qit {
            opacity: 0.7;
        }

        .text-z2s p {
            color: #fff;
        }

        .fi-9dw:before {
            content: "\f1a3";
        }

        .fi-n3n:before {
            content: "\f149";
        }

        .py-sp2 {
            padding-top: 1rem !important;
        }

        .py-sp2 {
            padding-bottom: 1rem !important;
        }

        .text-7nf {
            color: #fff !important;
        }

        .bg_-3kn {
            background: #000000 !important;
        }

        *,
        :before,
        :after {
            box-sizing: border-box;
        }

        .cle-6ew:after {
            display: block;
            clear: both;
            content: "";
        }

        :selection {
            background: #b68a35;
            color: #FFF;
        }

        .container-9zp {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-9zp {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container-9zp {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container-9zp {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container-9zp {
                max-width: 1200px;
            }
        }

        .font-weight-3ik {
            font-weight: 300 !important;
        }

        .container-9zp {
            position: relative;
        }

        .py-ac9 {
            padding-top: 0.5rem !important;
        }

        .py-ac9 {
            padding-bottom: 0.5rem !important;
        }

        .fs--hoe {
            font-size: 14px !important;
        }

        .float-8xn {
            float: right !important;
            margin-left: 10px;
        }

        .float-prj {
            float: left !important;
            margin-right: 10px;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a,
        :focus {
            outline: none !important;
        }

        #footer a {
            color: #121212;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        .text-7nf {
            /* color: #6366f1;
				text-decoration: none;
				font-weight: 600;
				font-size: 16px;
				padding: 12px 24px;
				background: rgba(255, 255, 255, 0.1);
				backdrop-filter: blur(10px);
				border-radius: 12px;
				border: 1px solid rgba(255, 255, 255, 0.2);
				transition: all 0.3s ease;
				display: inline-block;
				cursor: pointer; */
        }

        .text-7nf:hover {
            /* background: rgba(255, 255, 255, 0.2);
				transform: translateY(-2px);
				box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); */
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }

        .modal {
            background: rgb(0, 0, 0);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            color: white;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            transform: scale(0.7);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .modal-overlay.show .modal {
            transform: scale(1);
        }

        .modal::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            z-index: 1;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            /* background: rgba(255, 255, 255, 0.2); */
            transform: rotate(90deg);
        }

        .modal-content {
            position: relative;
            z-index: 1;
        }

        .kodo-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .modal h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .modal-info {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .contact-info {
            /* background: rgba(255, 255, 255, 0.1); */
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
            backdrop-filter: blur(10px);
        }

        .phone {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffd700;
        }

        .website {
            font-size: 18px;
            color: #87ceeb;
        }

        .website a {
            color: inherit;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .website a:hover {
            color: #ffd700;
        }

        .decorative-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-icon {
            position: absolute;
            animation: float 6s ease-in-out infinite;
            opacity: 0.3;
        }

        .floating-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-icon:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-icon:nth-child(3) {
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(5deg);
            }

            66% {
                transform: translateY(10px) rotate(-5deg);
            }
        }

        @media all {
            body {
                font-family: 'Roboto';
                font-size: 14px;
                line-height: 1.143em;
                color: #777777;
                font-weight: 400;
                letter-spacing: -0.1px;
                direction: rtl;
            }
        }

        @media all {
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
            }

            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                line-height: 1.428571429;
                color: #333333;
                background-color: #fff;
            }

            body {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            body {
                font-family: "Roboto", sans-serif;
                font-size: 14px;
                line-height: 16px;
                font-weight: 400;
            }

            body {
                font-family: 'Roboto';
                color: #777777;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.143em;
            }

            body {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            html {
                font-family: sans-serif;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            html {
                font-size: 10px;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .footer-35d {
                position: relative;
                padding: 50px 0 0;
                overflow: hidden;
            }

            .footer-35d {
                background-color: rgb(250, 250, 250);
            }

            .footer-35d {
                color: #000000;
            }

            .footer-35d {
                padding: 67px 0 0;
            }

            :before,
            :after {
                box-sizing: border-box;
            }

            .container-he4 {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        @media (min-width: 768px) {
            .container-he4 {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container-he4 {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container-he4 {
                width: 1170px;
            }
        }

        @media all {
            .footer-35d>.container-he4 {
                position: relative;
                z-index: 20;
            }

            .container-he4:before,
            .container-he4:after {
                display: table;
                content: " ";
            }

            .container-he4:after {
                clear: both;
            }

            .footer-35d {
                position: relative;
                padding: 50px 0 0;
                overflow: hidden;
            }

            .footer-35d .footer-9z1 {
                margin: 0 -15px;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                padding-bottom: 44px;
            }

            aside {
                display: block;
            }

            .wid-6bk {
                margin-bottom: 30px;
            }

            .wid-6bk {
                margin-bottom: 80px;
            }

            .footer-35d .footer-9z1 aside.wid-6bk {
                width: 25%;
                padding: 0 15px;
                margin-bottom: 24px;
            }
        }

        @media (min-width: 1025px) {
            .footer-35d .footer-9z1 aside.wid-6bk {
                width: 25%;
            }
        }

        @media all {
            .footer-35d .footer-9z1 aside:nth-child(1) {
                width: 20%;
            }

            .footer-35d .footer-9z1 aside:nth-child(2) {
                width: 20%;
            }

            .footer-35d .footer-9z1 aside:nth-child(3) {
                width: 30%;
            }

            .footer-35d .footer-9z1 aside:nth-child(4) {
                width: 30%;
            }

            .stm-l9a {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                -ms-flex-align: start;
                align-items: flex-start;
            }

            .stm-3wt {
                margin: 0 -15px;
            }

            .footer-qcc .stm-l9a {
                position: relative;
                z-index: 20;
            }

            .wid-6bk .title-opx {
                margin-bottom: 27px;
                text-transform: uppercase;
            }

            .wid-6bk .title-opx {
                margin-bottom: 13px;
            }

            .overlay-7bx {
                background-color: #000;
                display: none;
                height: 100%;
                left: 0;
                margin: 0;
                max-width: 100% !important;
                opacity: .7;
                position: fixed;
                top: 0;
                width: 100% !important;
                z-index: 100000;
            }

            .footer-9z1 .form-wtb {
                direction: rtl;
            }
        }

        #mai-fcd {
            border-radius: 0px;
            text-align: left;
        }

        #mai-fcd {
            width: 100%;
        }

        @media all {
            .text-7vl {
                text-align: right;
            }

            .sidebar-xcd {
                padding: 0 15px;
            }

            .stm-3wt>.sidebar-xcd {
                width: 25%;
            }

            .footer-qcc .sidebar-xcd {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                -ms-flex-pack: end;
                justify-content: flex-end;
            }

            .footer-qcc .sidebar-xcd {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                -ms-flex-pack: end;
                justify-content: space-between;
            }

            .stm-3wt.stm-a21>.sidebar-xcd {
                width: 50%;
            }

            .stm-3wt.stm-a21>.sidebar-xcd {
                width: 100%;
            }

            h4 {
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }

            h4 {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            h4 {
                font-size: 18px;
            }

            h4 {
                font-weight: bold;
                padding: 0;
                margin: 0 0 8px;
            }

            h4 {
                margin-bottom: 20px;
            }

            h4 {
                font-family: 'Roboto';
                color: #333333;
                font-weight: 900;
                letter-spacing: 0px;
            }

            h4 {
                font-family: 'Roboto';
                color: #333333;
                font-size: 16px;
                font-weight: 900;
            }

            h4 {
                font-family: "Cairo", sans-serif !important;
                ;
            }

            h4 {
                color: #000;
            }

            .footer-35d .footer-9z1 aside.wid-6bk .title-opx h4 {
                text-transform: uppercase;
            }

            .footer-35d .footer-9z1 aside.wid-6bk .title-opx h4 {
                color: #000000;
            }

            h1:before,
            h2:before,
            h3:before,
            h4:before,
            h5:before,
            h6:before,
            h1:after,
            h2:after,
            h3:after,
            h4:after,
            h5:after,
            h6:after,
            .h2:before,
            .h3:before,
            .h4:before,
            .h5:before,
            .h6:before,
            .h2:after,
            .h3:after,
            .h4:after,
            .h5:after {
                width: 45px !important;
                height: 5px !important;
            }

            .sbc_b:before,
            .sbc_b_h:hover:before,
            h1:before,
            .h1:before,
            h2:before,
            .h2:before,
            h3:before,
            .h3:before,
            h4:before,
            .h4:before,
            h5:before,
            .h5:before,
            h6:before,
            .h6:before {
                background: #992a26 !important;
            }

            .stm_headings_line h4::before,
            .stm_headings_line .h4::before {
                margin-bottom: 15px;
            }

            .stm_headings_line.stm_headings_line_top h1::before,
            .stm_headings_line.stm_headings_line_top .h1::before,
            .stm_headings_line.stm_headings_line_top h2::before,
            .stm_headings_line.stm_headings_line_top .h2::before,
            .stm_headings_line.stm_headings_line_top h3::before,
            .stm_headings_line.stm_headings_line_top .h3::before,
            .stm_headings_line.stm_headings_line_top h4::before,
            .stm_headings_line.stm_headings_line_top .h4::before,
            .stm_headings_line.stm_headings_line_top h5::before,
            .stm_headings_line.stm_headings_line_top .h5::before,
            .stm_headings_line.stm_headings_line_top h6::before,
            .stm_headings_line.stm_headings_line_top .h6::before {
                content: "";
                display: block;
                width: 46px;
                height: 5px;
                margin: 0 0 21px;
            }

            .sbc,
            .sbc_h:hover,
            .sbc_a::after,
            .sbc_a_h:hover::after,
            .sbc_b::before,
            .sbc_b_h:hover::before,
            h1::before,
            .h1::before,
            h2::before,
            .h2::before,
            h3::before,
            .h3::before,
            h4::before,
            .h4::before,
            h5::before,
            .h5::before,
            h6::before,
            .h6::before,
            h1::after,
            .h1::after,
            h2::after,
            .h2::after,
            h3::after,
            .h3::after,
            h4::after,
            .h4::after,
            h5::after,
            .h5::after,
            h6::after,
            .h6::after,
            .services_price_list_style_1.services_price_list_tabs ul li.active a,
            .stm_history_style_2 .stm_history__title::after,
            .stm_pagination_style_4 ul.page-numbers .page-numbers.current,
            .stm_pagination_style_4 ul.page-numbers .page-numbers:hover,
            .services_price_list_style_1 .services__tab_heading::after,
            .dropcaps_circle::before,
            .stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active,
            .stm_pricing-table_style_4 .stm_pricing-table__label,
            .stm_pagination_style_6 .owl-nav .owl-prev:hover,
            .stm_pagination_style_6 .owl-nav .owl-next:hover,
            .stm_pagination_style_7 .owl-dots .owl-dot:hover span,
            .stm_pagination_style_7 .owl-dots .owl-dot.active span,
            .stm_single_donation_style_1 .stm_single_donation__progress-bar span,
            .stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label,
            .stm_form_style_6 .stm_input_wrapper_checkbox.active::before,
            .stm_pagination_style_4 .tp-bullet.selected span,
            .stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active,
            .stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover,
            .stm_layout_store .stm-cart_style_1 .cart__quantity-badge,
            .woocommerce .stm_woo_products .owl-prev:hover,
            .woocommerce .stm_woo_products .owl-next:hover,
            .store_newsletter .mc4wp-form-fields .btn,
            .woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info,
            .woocommerce .special_offer_product__meta_box .special_offer_countdown_out,
            .stm_form_style_10 [type="submit"],
            .stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover,
            .stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover,
            .stm_shop_layout_store.woocommerce .button:hover,
            .stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_shop_layout_store .woocommerce .button:hover,
            .stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products::before,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover,
            .stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a::after,
            .footer-35d .footer-9z1 aside.wid-6bk.widget_mc4wp_form_widget .btn:hover,
            .stm_posts_list_style_10 .stm_posts_list_single__category,
            .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
            .stm_posts_carousel_style_3 .stm_posts_carousel_single__category,
            .stm_layout_factory .btn_primary.btn_solid:hover,
            .stm_video_style_10 .stm_playb:hover,
            .stm_projects_carousel .owl-dots .owl-dot.active,
            .stm_iconbox_style_15.stm_iconbox:hover,
            .stm_testimonials_style_17 .image_dots .owl-dot.active,
            .stm_infobox_style_11 .stm_infobox__link a::after,
            .stm_projects_cards_style_5 .stm_projects_cards__filter li.active::after,
            .stm_testimonials_style_18 .image_dots .dots:hover::after,
            .stm_testimonials_style_18 .image_dots .dots.active::after,
            .stm_pricing-table_style_5 .stm_pricing-table__footer .btn,
            .stm_schedule_style_2 .event_lesson_tabs.active a,
            .stm_schedule_style_2 .event_lesson_info>li::before,
            .stm_schedule_style_2 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title_desc_wrap .event_lesson_info_full_description ul li::before,
            .stm_tabs_style_6 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active>a .vc_tta-title-text::before,
            .stm_infobox_style_13 .stm_infobox__button,
            .stm_tabs_style_6 .vc_tta-panel a,
            .stm_pricing-table_style_10 .btn:hover span,
            .stm_pricing-table_style_10:hover .stm_pricing-table__content ul li::before,
            .stm_layout_creativethree .btn_third.btn_solid:hover,
            .stm_layout_creativethree .btn.btn_primary.btn_solid,
            .stm_post_style_26 .stm_loop__grid .stm_posts_list_single__body .read-more i,
            .stm_post_style_26 .stm_loop__list .stm_posts_list_single__body .read-more i,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__addr .__icon,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__date .__icon,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn:hover,
            .btn_secondary.btn_solid,
            .btn_secondary.btn_outline:hover,
            .btn_secondary.btn_outline .btn__icon::after,
            .stm_slider_style_3.stm_slider .stm_slide__button a,
            .stm_slider_style_4 .stm_slide__button a {
                background-color: rgb(218, 199, 37) !important;
            }

            ul {
                box-sizing: border-box;
            }

            ul {
                margin-top: 0;
                margin-bottom: 10px;
            }

            .wid-6bk ul {
                margin: 0;
                list-style: none;
                padding: 0;
            }

            .text-apb {
                display: -ms-flexbox;
                display: flex;
                margin-bottom: 21px;
            }

            .text-apb {
                margin-bottom: 4px;
            }

            .footer-9z1 .form-wtb form {
                padding: 0 !important;
            }
        }

        #mai-fcd form.form-wtb {
            padding: 20px;
        }

        @media all {
            .footer-qcc .sidebar-xcd>div {
                margin-left: 15px;
            }

            .footer-qcc .sidebar-xcd>div:first-child {
                margin-left: 0;
            }

            .stm-lsi {
                margin: 0 -8px;
            }

            .footer-qcc .stm-lsi {
                display: inline-block;
                vertical-align: top;
            }

            .stm-lsi:after {
                content: "";
                display: block;
                clear: both;
            }

            .wid-6bk ul li {
                position: relative;
                padding: 0 0 0 20px;
                margin: 0 0 10px 0;
            }

            .wid-6bk.footer-8vj ul li {
                padding: 0;
            }

            .wid-6bk ul li::before,
            .wid-6bk ol li::before {
                position: absolute;
                left: 0;
                top: 4px;
                display: inline-block;
                vertical-align: top;
                font: normal normal normal 14px/1 FontAwesome;
                font-size: 10px;
                transform: translate(0, 0);
                text-rendering: auto;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .wid-6bk ul li:last-child {
                margin-bottom: 0;
            }

            .text-imr {
                margin-right: 9px;
                font-size: 14px;
            }

            .fa-ij6 {
                display: inline-block;
                font: normal normal normal 14px/1 FontAwesome;
                font-size: inherit;
                text-rendering: auto;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .fa-ij6 {
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                display: inline-block;
                font-style: normal;
                font-variant: normal;
                text-rendering: auto;
                line-height: 1;
            }

            .fa-ij6 {
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
            }

            .fa-ij6 {
                font-family: 'Font Awesome 5 Pro';
                font-weight: 900;
            }

            .wid-jyj .fa-534 {
                font-size: 21px;
            }

            .text-apb .text-imr {
                display: block;
            }

            .text-apb .text-imr {
                min-width: 42px;
                margin-right: 0;
                opacity: 0.6;
            }

            .fa-534:before {
                content: "\f015";
            }

            span {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .text-o77 {
                font-size: 13px;
                line-height: 16px;
            }

            .text-apb .text-o77 {
                display: block;
                padding-top: 2px;
                padding-top: 6px;
                padding-right: 6px;
            }

            .wid-jyj .fa-nia {
                font-size: 20px;
            }

            .fa-nia:before {
                content: "\f098";
            }

            .wid-jyj .fa-g4o {
                font-size: 18px;
            }

            .fa-g4o:before {
                content: "\f1ac";
            }

            .wid-jyj .fa-p9o {
                font-size: 17px;
            }

            .fa-p9o:before {
                content: "\f0e0";
            }

            [class*=" stmicon-"] {
                font-family: 'stmicons' !important;
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            [class^="stmicon-"],
            [class*=" stmicon-"] {
                font-family: 'stmicons' !important;
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .icon-qto:before {
                content: "\ec4e";
            }

            input {
                color: inherit;
                font: inherit;
                margin: 0;
            }

            input {
                line-height: normal;
            }

            input {
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }

            label {
                display: inline-block;
                max-width: 100%;
                margin-bottom: 5px;
                font-weight: 700;
            }

            p {
                margin: 0 0 10px;
            }

            p {
                line-height: 22px;
                margin: 0 0 15px;
            }

            p {
                margin-bottom: 15px;
                line-height: 22px;
            }

            p {
                font-size: 15px;
                line-height: 21px !important;
            }

            p {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .form-wtb .form-e4y {
                max-width: 100%;
            }

            .footer-9z1 .form-wtb p {
                text-align: right !important;
            }

            .form-wtb .mai-b3r {
                max-width: 100%;
            }

            .form-wtb .mai-b3r {
                margin-bottom: 20px;
            }
        }

        #mai-fcd .mai-b3r {
            line-height: 20px;
            margin-bottom: 20px;
        }

        #mai-fcd .mai-b3r.las-b87 {
            margin-bottom: 0;
        }

        @media all {
            .message-2nj {
                clear: both;
            }

            .form-wtb .message-2nj {
                max-width: 100%;
            }
        }

        #mai-fcd .message-2nj {
            margin: 0;
            padding: 0 20px;
        }

        @media all {
            a {
                background-color: transparent;
            }

            a {
                color: #337ab7;
                text-decoration: none;
            }

            a {
                color: #3c98ff;
                outline: none !important;
            }

            a {
                color: #222222;
            }

            a {
                font-family: "Cairo", sans-serif !important;
                ;
                line-height: normal;
            }

            a {
                color: #eb5a3c;
            }

            .icon-fn7 {
                float: left;
                display: block;
                width: 30px;
                height: 30px;
                line-height: 30px;
                margin: 0 8px;
                text-align: center;
                color: #fff;
            }

            .icon-efa {
                border-radius: 50%;
            }

            .icon-474 {
                background-color: #fff;
            }

            .icon-474 {
                background-color: #992a26;
            }

            .icon-fn7 {
                margin: 0 12px;
            }

            .footer-35d a {
                color: #000000;
            }

            [class*="__icon"].icon-rvt {
                font-size: 17px;
            }

            a:not(.stm_projects_carousel__item):not(.stm_projects_card):not(.rev-btn) {
                transition: all 0.25s ease !important;
            }

            a:active,
            a:hover {
                outline: 0;
            }

            a:hover {
                color: #23527c;
                text-decoration: underline;
            }

            a:hover {
                color: #dac725;
            }

            a:hover {
                color: #eb5a3c;
            }

            .icon-efa:hover {
                color: #fff;
            }

            .mbc-lxn:hover {
                background-color: #dac725 !important;
            }

            .mbc-lxn:hover {
                background-color: #cc0910 !important;
            }

            .footer-35d a,
            .footer-35d .icon-fn7:hover {
                color: #000000;
            }

            .footer-35d a,
            .footer-35d .icon-fn7:hover,
            .footer-35d .footer-9z1 aside.wid-6bk .title-opx h4,
            .footer-35d {
                color: #000000;
            }

            .wid-6bk ul li a {
                text-decoration: none !important;
            }

            .footer-9z1 #men-er1 li a {
                color: #000 !important;
            }

            .footer-9z1 #men-54n li a {
                color: #000 !important;
            }

            .stm-qoa {
                opacity: 0.6;
            }

            .wid-jyj a {
                text-decoration: none !important;
            }

            a.stm-qoa {
                color: #000 !important;
                opacity: 1;
            }

            .stm-qoa:hover {
                opacity: 1;
            }

            input[type="email"] {
                width: 100%;
                font-size: 13px;
                color: #777777;
                background: #efefef;
                border: 3px solid #efefef;
                box-shadow: none !important;
                outline: none !important;
                padding: 12px 13px;
                height: 44px;
                transition: none;
                border-radius: 0;
                vertical-align: top;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            input[type="email"] {
                transition: all 0.25s ease !important;
            }

            input[type="email"] {
                padding: 0px 20px;
                line-height: 35px !important;
                margin-top: 13px;
            }

            .text-j65 {
                border: 0;
                clip: rect(1px, 1px, 1px, 1px);
                -webkit-clip-path: inset(50%);
                clip-path: inset(50%);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
                word-wrap: normal !important;
            }

            .form-wtb .text-xoe {
                max-width: 100%;
            }
        }

        .sticky {
            margin: auto;
            width: 100%;
        }

        #mai-fcd .text-xoe {
            display: block;
        }

        #mai-fcd .text-xoe {
            width: 100%;
        }

        @media all {
            input[type="submit"] {
                -webkit-appearance: button;
                cursor: pointer;
            }

            input[type="submit"] {
                transition: all 0.25s ease !important;
            }

            .form-wtb .mai-7wi {
                max-width: 100%;
            }

            .form-wtb .mai-7wi {
                white-space: normal;
                word-wrap: break-word;
            }

            input[type="submit"]:not(.btn) {
                text-decoration: none !important;
                border: none;
                color: #fff;
                font-size: 13px;
                padding: 10px 22px 10px;
                font-weight: 900;
                display: inline-block;
                box-shadow: none !important;
                outline: none !important;
                text-transform: uppercase;
            }

            input[type="submit"]:not(.btn) {
                background-color: #b68a35 !important;
            }

            .footer-9z1 .form-wtb .mai-7wi {
                background: #686868;
                width: 100%;
                border-radius: 3px;
            }

            .loading-t8z {
                display: none;
                text-align: center;
                width: 30px;
            }
        }

        #mai-fcd .loading-t8z {
            width: 30px;
            text-align: center;
            line-height: normal;
        }

        @media all {
            .eowpg {
                color: #333333 !important;
            }

            .stm-lsi a i {
                color: #adadad !important;
            }

            .fa-ij6.fa-y67 {
                font-family: 'Font Awesome 5 Brands';
                font-weight: 400;
            }
        }

        .icon-custom {
            background: #b68a35;
            width: 30px;
            height: 30px;
            text-align: center;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        @media (max-width: 767px) {
            #latest-news {
                flex-direction: column !important;
            }

            #latest-news .c-morebtn {
                display: none;
            }
        }

        @font-face {
            font-family: pro;
            src: url(https://uaeca.ae/wp-content/themes/uaeca/web_fonts/ar/Tajawal-Medium.ttf);
        }

        @font-face {
            font-family: pro;
            src: url(https://uaeca.ae/wp-content/themes/uaeca/web_fonts/arabic/Almarai-Regular.ttf);
        }

        @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');

        @media all {
            body {
                font-family: 'Roboto';
                font-size: 14px;
                line-height: 1.143em;
                color: #777777;
                font-weight: 400;
                letter-spacing: -0.1px;
                direction: rtl;
            }
        }

        @media all {
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
            }

            body {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                line-height: 1.428571429;
                color: #333333;
                background-color: #fff;
            }

            body {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            body {
                font-family: "Roboto", sans-serif;
                font-size: 14px;
                line-height: 16px;
                font-weight: 400;
            }

            body {
                font-family: 'Roboto';
                color: #777777;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.143em;
            }

            body {
                font-family: "cairo", sans-serif !important;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            html {
                font-family: sans-serif;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            html {
                font-size: 10px;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }

            .container-9l2 {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        .vc_-9ok {
            margin-top: 100px !important;
            margin-bottom: 50px !important;
            padding-top: 100px !important;
            padding-bottom: 80px !important;
            background-color: #fafafa !important;
        }

        @media all {
            .container-s5k {
                position: relative;
                z-index: 10;
            }

            :before,
            :after {
                box-sizing: border-box;
            }

            .container-9l2:before,
            .container-9l2:after {
                display: table;
                content: " ";
            }

            .container-9l2:after {
                clear: both;
            }

            .row-gtg {
                margin-left: -15px;
                margin-right: -15px;
            }

            .row-gtg {
                position: relative;
            }

            .row-gtg:after,
            .row-gtg:before {
                content: " ";
                display: table;
            }

            .row-gtg:after {
                clear: both;
            }

            .container-i1t {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        @media (min-width: 768px) {
            .container-i1t {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container-i1t {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container-i1t {
                width: 1170px;
            }
        }

        @media all {
            .container-i1t {
                max-width: 100%;
            }

            .container-i1t:before,
            .container-i1t:after {
                display: table;
                content: " ";
            }

            .container-i1t:after {
                clear: both;
            }

            .row-1yt {
                margin-right: -15px;
                margin-left: -15px;
            }

            .row-gtg>.container-i1t>.row-1yt {
                padding: 0;
            }

            .row-1yt:before,
            .row-1yt:after {
                display: table;
                content: " ";
            }

            .row-1yt:after {
                clear: both;
            }

            .container-sls {
                width: 100%;
            }

            .col-rrx {
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                box-sizing: border-box;
            }
        }

        @media (min-width: 768px) {
            .col-rrx {
                float: left;
            }

            .col-rrx {
                width: 100%;
            }
        }

        @media all {
            .container-sls {
                padding-left: 0;
                padding-right: 0;
            }

            .container-sls>.column-wcn {
                box-sizing: border-box;
                padding-left: 15px;
                padding-right: 15px;
                width: 100%;
            }

            .column-wcn:after,
            .column-wcn:before {
                content: " ";
                display: table;
            }

            .column-wcn:after {
                clear: both;
            }
        }

        .vc_-ppz {
            margin-bottom: 0px !important;
            padding-bottom: 0px !important;
        }

        @media all {
            .col-zbp {
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                box-sizing: border-box;
            }
        }

        @media (min-width: 768px) {
            .col-zbp {
                float: left;
            }

            .col-zbp {
                width: 50%;
            }
        }

        @media all {
            .content-zgb {
                margin-bottom: 35px;
            }

            .image-ksy.vc_-lpq {
                text-align: left;
            }

            .header-f37 {
                margin-bottom: 20px;
            }

            :where(figure) {
                margin: 0 0 1em;
            }

            figure {
                display: block;
            }

            figure {
                margin: 1em 40px;
            }

            figure {
                margin: 0;
            }

            .image-ksy .vc_-ao4 {
                display: inline-block;
                vertical-align: top;
                margin: 0;
                max-width: 100%;
            }

            .column-dx4 :last-child {
                margin-bottom: 0;
            }

            .image-ksy .wrapper-j81 {
                display: inline-block;
                vertical-align: top;
                max-width: 100%;
            }

            h1 {
                font-size: 2em;
                margin: 0.67em 0;
            }

            h1 {
                font-family: inherit;
                font-weight: 500;
                line-height: 1.1;
                color: inherit;
            }

            h1 {
                margin-top: 20px;
                margin-bottom: 10px;
            }

            h1 {
                font-size: 36px;
            }

            h1 {
                font-weight: bold;
                padding: 0;
                margin: 0 0 8px;
            }

            h1 {
                font-family: 'Roboto';
                color: #333333;
                font-weight: 900;
                letter-spacing: 0px;
            }

            h1 {
                font-family: 'Roboto';
                color: #333333;
                font-size: 52px;
                font-weight: 900;
            }

            h1 {
                font-family: "cairo", sans-serif !important;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            h1 {
                color: #000;
            }

            .sbc,
            .sbc_h:hover,
            .sbc_a:after,
            .sbc_a_h:hover:after,
            .sbc_b:before,
            .sbc_b_h:hover:before,
            h1:before,
            .h1:before,
            h2:before,
            .h2:before,
            h3:before,
            .h3:before,
            h4:before,
            .h4:before,
            h5:before,
            .h5:before,
            h6:before,
            .h6:before,
            h1:after,
            .h1:after,
            h2:after,
            .h2:after,
            h3:after,
            .h3:after,
            h4:after,
            .h4:after,
            h5:after,
            .h5:after,
            h6:after,
            .h6:after,
            .services_price_list_style_1.services_price_list_tabs ul li.active a,
            .stm_history_style_2 .stm_history__title::after,
            .stm_pagination_style_4 ul.page-numbers .page-numbers.current,
            .stm_pagination_style_4 ul.page-numbers .page-numbers:hover,
            .services_price_list_style_1 .services__tab_heading::after,
            .dropcaps_circle:before,
            .stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active,
            .stm_pricing-table_style_4 .stm_pricing-table__label,
            .stm_pagination_style_6 .owl-nav .owl-prev:hover,
            .stm_pagination_style_6 .owl-nav .owl-next:hover,
            .stm_pagination_style_7 .owl-dots .owl-dot:hover span,
            .stm_pagination_style_7 .owl-dots .owl-dot.active span,
            .stm_single_donation_style_1 .stm_single_donation__progress-bar span,
            .stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label,
            .stm_form_style_6 .stm_input_wrapper_checkbox.active::before,
            .stm_pagination_style_4 .tp-bullet.selected span,
            .stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active,
            .stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover,
            .stm_layout_store .stm-cart_style_1 .cart__quantity-badge,
            .woocommerce .stm_woo_products .owl-prev:hover,
            .woocommerce .stm_woo_products .owl-next:hover,
            .store_newsletter .mc4wp-form-fields .btn,
            .woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info,
            .woocommerce .special_offer_product__meta_box .special_offer_countdown_out,
            [type="submit"],
            .stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover,
            .stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover,
            .stm_shop_layout_store.woocommerce .button:hover,
            .stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_shop_layout_store .woocommerce .button:hover,
            .stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products::before,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover,
            .stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a::after,
            .stm-footer .footer-widgets aside.widget.widget_mc4wp_form_widget .btn:hover,
            .stm_posts_list_style_10 .stm_posts_list_single__category,
            .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
            .stm_posts_carousel_style_3 .stm_posts_carousel_single__category,
            .stm_layout_factory .btn_primary.btn_solid:hover,
            .stm_video_style_10 .stm_playb:hover,
            .stm_projects_carousel .owl-dots .owl-dot.active,
            .stm_iconbox_style_15.stm_iconbox:hover,
            .stm_testimonials_style_17 .image_dots .owl-dot.active,
            .stm_infobox_style_11 .stm_infobox__link a::after,
            .stm_projects_cards_style_5 .stm_projects_cards__filter li.active::after,
            .stm_testimonials_style_18 .image_dots .dots:hover::after,
            .stm_testimonials_style_18 .image_dots .dots.active::after,
            .stm_pricing-table_style_5 .stm_pricing-table__footer .btn,
            .stm_schedule_style_2 .event_lesson_tabs.active a,
            .stm_schedule_style_2 .event_lesson_info>li::before,
            .stm_schedule_style_2 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title_desc_wrap .event_lesson_info_full_description ul li::before,
            .stm_tabs_style_6 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active>a .vc_tta-title-text::before,
            .stm_infobox_style_13 .stm_infobox__button,
            .stm_tabs_style_6 .vc_tta-panel a,
            .stm_pricing-table_style_10 .btn:hover span,
            .stm_pricing-table_style_10:hover .stm_pricing-table__content ul li::before,
            .stm_layout_creativethree .btn_third.btn_solid:hover,
            .stm_layout_creativethree .btn.btn_primary.btn_solid,
            .stm_post_style_26 .stm_loop__grid .stm_posts_list_single__body .read-more i,
            .stm_post_style_26 .stm_loop__list .stm_posts_list_single__body .read-more i,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__addr .__icon,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__date .__icon,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn:hover,
            .btn_secondary.btn_solid,
            .btn_secondary.btn_outline:hover,
            .btn_secondary.btn_outline .btn__icon::after,
            .stm_slider_style_3.stm_slider .stm_slide__button a,
            .stm_slider_style_4 .stm_slide__button a {
                background-color: rgb(218, 199, 37) !important;
            }

            h1:before,
            h2:before,
            h3:before,
            h4:before,
            h5:before,
            h6:before,
            h1:after,
            h2:after,
            h3:after,
            h4:after,
            h5:after,
            h6:after,
            .h2:before,
            .h3:before,
            .h4:before,
            .h5:before,
            .h6:before,
            .h2:after,
            .h3:after,
            .h4:after,
            .h5:after {
                width: 45px !important;
                height: 5px !important;
            }

            .sbc_b:before,
            .sbc_b_h:hover:before,
            h1:before,
            .h1:before,
            h2:before,
            .h2:before,
            h3:before,
            .h3:before,
            h4:before,
            .h4:before,
            h5:before,
            .h5:before,
            h6:before,
            .h6:before {
                background: #992a26 !important;
            }

            .stm_headings_line.stm_headings_line_top h1::before,
            .stm_headings_line.stm_headings_line_top .h1::before,
            .stm_headings_line.stm_headings_line_top h2::before,
            .stm_headings_line.stm_headings_line_top .h2::before,
            .stm_headings_line.stm_headings_line_top h3::before,
            .stm_headings_line.stm_headings_line_top .h3::before,
            .stm_headings_line.stm_headings_line_top h4::before,
            .stm_headings_line.stm_headings_line_top .h4::before,
            .stm_headings_line.stm_headings_line_top h5::before,
            .stm_headings_line.stm_headings_line_top .h5::before,
            .stm_headings_line.stm_headings_line_top h6::before,
            .stm_headings_line.stm_headings_line_top .h6::before {
                content: "";
                display: block;
                width: 46px;
                height: 5px;
                margin: 0 0 21px;
            }

            .stm_headings_line.stm_headings_line_top h1::before {
                margin: 0 0 4px;
                background-color: #992a26 !important;
            }

            .sbc,
            .sbc_h:hover,
            .sbc_a::after,
            .sbc_a_h:hover::after,
            .sbc_b::before,
            .sbc_b_h:hover::before,
            h1::before,
            .h1::before,
            h2::before,
            .h2::before,
            h3::before,
            .h3::before,
            h4::before,
            .h4::before,
            h5::before,
            .h5::before,
            h6::before,
            .h6::before,
            h1::after,
            .h1::after,
            h2::after,
            .h2::after,
            h3::after,
            .h3::after,
            h4::after,
            .h4::after,
            h5::after,
            .h5::after,
            h6::after,
            .h6::after,
            .services_price_list_style_1.services_price_list_tabs ul li.active a,
            .stm_history_style_2 .stm_history__title::after,
            .stm_pagination_style_4 ul.page-numbers .page-numbers.current,
            .stm_pagination_style_4 ul.page-numbers .page-numbers:hover,
            .services_price_list_style_1 .services__tab_heading::after,
            .dropcaps_circle::before,
            .stm_tabs_style_3 .vc_tta-tabs .vc_tta-tab.vc_active,
            .stm_pricing-table_style_4 .stm_pricing-table__label,
            .stm_pagination_style_6 .owl-nav .owl-prev:hover,
            .stm_pagination_style_6 .owl-nav .owl-next:hover,
            .stm_pagination_style_7 .owl-dots .owl-dot:hover span,
            .stm_pagination_style_7 .owl-dots .owl-dot.active span,
            .stm_single_donation_style_1 .stm_single_donation__progress-bar span,
            .stm_single_events_style_3 .stm_event_wide_details .stm_single_event_part-label,
            .stm_form_style_6 .stm_input_wrapper_checkbox.active::before,
            .stm_pagination_style_4 .tp-bullet.selected span,
            .stm_gmap_wrapper.style_2 .gmap_addresses .owl-dots-wr .owl-dot.active,
            .stm_sidebar_style_12 .widget_tag_cloud .tagcloud a:hover,
            .stm_layout_store .stm-cart_style_1 .cart__quantity-badge,
            .woocommerce .stm_woo_products .owl-prev:hover,
            .woocommerce .stm_woo_products .owl-next:hover,
            .store_newsletter .mc4wp-form-fields .btn,
            .woocommerce .special_offer_product__meta_box .special_offer_product__countdown .count_meta:first-child .count_meta_info,
            .woocommerce .special_offer_product__meta_box .special_offer_countdown_out,
            .stm_form_style_10 [type="submit"],
            .stm_pagination_style_14 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_16 .page-numbers .page-numbers:not(.current):hover,
            .stm_pagination_style_17 .page-numbers .page-numbers:not(.current):hover,
            .stm_shop_layout_store .cart-collaterals .wc-proceed-to-checkout .checkout-button:hover,
            .stm_shop_layout_store.woocommerce .button:hover,
            .stm_shop_layout_store.woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_shop_layout_store .woocommerce .button:hover,
            .stm_shop_layout_store .woocommerce .checkout #order_review #payment .place-order #place_order:hover,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__products::before,
            .stm_layout_store .stm-cart_style_1 .mini-cart .mini-cart__actions a:hover,
            .stm_shop_layout_store.single-product div.product .woocommerce-tabs ul.tabs li.active a::after,
            .stm-footer .footer-widgets aside.widget.widget_mc4wp_form_widget .btn:hover,
            .stm_posts_list_style_10 .stm_posts_list_single__category,
            .stm_posts_carousel_style_2 .stm_posts_carousel_single__category,
            .stm_posts_carousel_style_3 .stm_posts_carousel_single__category,
            .stm_layout_factory .btn_primary.btn_solid:hover,
            .stm_video_style_10 .stm_playb:hover,
            .stm_projects_carousel .owl-dots .owl-dot.active,
            .stm_iconbox_style_15.stm_iconbox:hover,
            .stm_testimonials_style_17 .image_dots .owl-dot.active,
            .stm_infobox_style_11 .stm_infobox__link a::after,
            .stm_projects_cards_style_5 .stm_projects_cards__filter li.active::after,
            .stm_testimonials_style_18 .image_dots .dots:hover::after,
            .stm_testimonials_style_18 .image_dots .dots.active::after,
            .stm_pricing-table_style_5 .stm_pricing-table__footer .btn,
            .stm_schedule_style_2 .event_lesson_tabs.active a,
            .stm_schedule_style_2 .event_lesson_info>li::before,
            .stm_schedule_style_2 .event_lesson_info_content_wrap .event_lesson_info_content .event_lesson_info_title_desc_wrap .event_lesson_info_full_description ul li::before,
            .stm_tabs_style_6 .vc_tta.vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list .vc_tta-tab.vc_active>a .vc_tta-title-text::before,
            .stm_infobox_style_13 .stm_infobox__button,
            .stm_tabs_style_6 .vc_tta-panel a,
            .stm_pricing-table_style_10 .btn:hover span,
            .stm_pricing-table_style_10:hover .stm_pricing-table__content ul li::before,
            .stm_layout_creativethree .btn_third.btn_solid:hover,
            .stm_layout_creativethree .btn.btn_primary.btn_solid,
            .stm_post_style_26 .stm_loop__grid .stm_posts_list_single__body .read-more i,
            .stm_post_style_26 .stm_loop__list .stm_posts_list_single__body .read-more i,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__addr .__icon,
            .stm_events_layout_6 .stm_single_stm_events .stm_markup__content .stm_single_event__date .__icon,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .stm_single_event__calendar .btn,
            .stm_layout_creativethree .stm_single_stm_events .stm_markup__content .stm_single_event__actions .btn:hover,
            .btn_secondary.btn_solid,
            .btn_secondary.btn_outline:hover,
            .btn_secondary.btn_outline .btn__icon::after,
            .stm_slider_style_3.stm_slider .stm_slide__button a,
            .stm_slider_style_4 .stm_slide__button a {
                background-color: rgb(218, 199, 37) !important;
            }

            p {
                margin: 0 0 10px;
            }

            p {
                line-height: 22px;
                margin: 0 0 15px;
            }

            p {
                margin-bottom: 15px;
                line-height: 22px;
            }

            p {
                font-size: 15px;
                line-height: 21px !important;
            }

            p {
                font-family: "cairo", sans-serif !important;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .column-dx4 :last-child,
            .column-dx4 p:last-child {
                margin-bottom: 0;
            }

            img {
                border: 0;
            }

            img {
                vertical-align: middle;
            }

            img {
                max-width: 100%;
                height: auto;
                transform: translateZ(0);
            }

            .image-ksy img {
                height: auto;
                height: 412px;
                max-width: 68%;
                vertical-align: top;
            }
        }


        /* These were inline style tags. Uses id+class to override almost everything */
        #style-Ksnz9.style-Ksnz9 {
            text-align: right;
            font-size: 24px;
        }

        #style-DRlzk.style-DRlzk {
            text-align: right;
        }

        body {
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            direction: rtl;
            letter-spacing: 0;
        }

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            font-family: "cairo", "Rubik", "Source Sans Pro", "Muli", "Noto Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #ffffff;
        }

        body {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        html {
            direction: rtl;
            text-align: right;
            min-height: 100vh;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            -webkit-font-smoothing: "antialiased";
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: 0;
        }

        .row-ogt {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        *,
        :before,
        :after {
            box-sizing: border-box;
        }

        :selection {
            background: #b68a35;
            color: #FFF;
        }

        .col-2yx,
        .col-oaq {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 576px) {
            .col-2yx {
                flex: 0 0 33.33333%;
                max-width: 33.33333%;
            }
        }

        @media (min-width: 768px) {
            .col-oaq {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .mt-am8 {
            margin-top: 1rem !important;
        }

        .my-eeo {
            margin-top: 1.5rem !important;
        }

        .my-eeo {
            margin-bottom: 1.5rem !important;
        }

        .col-2yx,
        .col-oaq {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .bg-ptb {
            background-color: #fff !important;
        }

        .rou-xnf {
            border-radius: 0.25rem !important;
        }

        .d-log {
            display: flex !important;
        }

        .flex-mb4 {
            flex-wrap: wrap !important;
        }

        .content-85f {
            justify-content: center !important;
        }

        .item-zsg {
            align-items: center !important;
        }

        .h-5rt {
            height: 100% !important;
        }

        .text-if3 {
            text-decoration: none !important;
        }

        .shadow-h9k {
            box-shadow: 0 0 35px rgba(140, 152, 164, 0.15) !important;
        }

        .transition-all-ease-qd6 {
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 250ms !important;
        }

        .transition-hover-36d {
            transform: translateZ(0);
        }

        .overlay-xkz {
            position: relative;
        }

        .shadow-h9k,
        .shadow-3d-7n5 {
            transition-property: box-shadow, transform;
            -webkit-animation: __shadowPageLoadFix;
            animation: __shadowPageLoadFix;
            -webkit-animation-duration: 0.01s;
            animation-duration: 0.01s;
        }

        #overlay-default,
        .overlay-default,
        .overlay-light-hover:after,
        .overlay-xkz:after,
        .overlay-light,
        .overlay-dark {
            transition: all .2s ease;
        }

        .overlay-light-hover:after,
        .overlay-xkz:after {
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        .overlay-light-hover:after,
        .overlay-xkz:after,
        .overlay-light:after,
        .overlay-dark:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 0;
        }

        .opacity-3,
        .overlay-1yx:after {
            opacity: 0.3;
        }

        .shadow-3d-7n5:hover {
            box-shadow: 0 2.5rem 4rem rgba(22, 28, 45, 0.1) !important;
        }

        .transition-hover-36d:hover {
            transform: translateY(-3px);
        }

        .rou-xnf.overlay-xkz:hover {
            border-radius: 0.25rem;
        }

        .overlay-xkz:hover:after,
        .overlay-dark:after {
            background-color: #000000;
        }

        .position-f8s {
            position: absolute !important;
        }

        .w-d98 {
            width: 100% !important;
        }

        .m-kot {
            margin: 1rem !important;
        }

        .text-tfh {
            text-align: center !important;
        }

        .overlay-xkz>* {
            z-index: 0;
            position: relative;
        }

        .z-index-leq {
            z-index: 3 !important;
        }

        @media only screen and (min-width: 992px) {
            .container-8q9:not(:hover) .item-lgy {
                visibility: hidden;
                transition: box-shadow 250ms ease, transform 250ms ease;
            }

            .container-8q9:hover .item-lgy {
                visibility: visible !important;
            }
        }

        figure {
            display: block;
        }

        figure {
            margin: 0 0 1rem;
        }

        .overflow-g44 {
            overflow: hidden !important;
        }

        .m-d29 {
            margin: 0 !important;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a {
            outline: none !important;
        }

        .btn-fca {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.78rem 1rem;
            font-size: 1.0625rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, transform 0.25s ease-in-out;
        }

        .btn-a7p {
            padding: 0.46rem 1rem;
            font-size: 1.0625rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .rounded-8o3 {
            border-radius: 50% !important;
        }

        .shadow-as8 {
            box-shadow: 0 10px 40px 10px rgba(140, 152, 164, 0.175) !important;
        }

        .m-3p5 {
            margin: 0.5rem !important;
        }

        .shadow-as8 {
            transition-property: box-shadow, transform;
            -webkit-animation: __shadowPageLoadFix;
            animation: __shadowPageLoadFix;
            -webkit-animation-duration: 0.01s;
            animation-duration: 0.01s;
        }

        .btn-fca.rounded-8o3 {
            position: relative;
            line-height: 1.6;
            padding: 1.53rem 1.53rem;
            font-size: 1.0625rem;
            text-align: center;
        }

        .btn-fca:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        .btn-fca.btn-a7p.rounded-8o3 {
            padding: 1.22rem 1.22rem;
            font-size: 1.0625rem;
            width: 1.94rem;
            height: 1.94rem;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        .btn-fca:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn-fca+.btn-fca {
            margin-right: .5rem;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .img-5ia {
            max-width: 100%;
            height: auto;
        }

        a>i {
            pointer-events: none;
        }

        .ietmg {
            vertical-align: middle;
            display: inline-block;
        }

        .btn-fca.rounded-8o3>i {
            font-size: 1rem !important;
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            text-align: center;
            margin: 0 !important;
            padding: 0 !important;
            transform: translateY(-50%);
        }

        .ietmg:before {
            font-family: "Flaticon" !important;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            line-height: 1.5;
            text-decoration: inherit;
            text-rendering: optimizeLegibility;
            text-transform: none;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
        }

        .image-77v:before {
            content: "\f18c";
        }

        .link-q4w:before {
            content: "\f15a";
        }


        @keyframes __shadowPageLoadFix {
            0% {}

            100% {
                box-shadow: none;
                box-shadow: none;
            }
        }

    </style>

    <style>
        .board-member-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .board-member-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #eee;
        }

        .board-member-card h2 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #333;
        }

        .board-member-card h3 {
            font-size: 1.1rem;
            color: #666;
        }

        .board-members-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .board-members-grid>div {
            flex: 0 0 calc(50% - 30px);
            max-width: calc(50% - 30px);
        }

        @media (max-width: 768px) {
            .board-members-grid>div {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .board-member-card {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 25px;
            max-width: 500px;
            width: 100%;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .board-member-card>div {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .board-member-card h2 {
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .board-member-card h3 {
            margin: 0;
            font-size: 18px;
            color: #0e6939;
            font-weight: 500;
            opacity: 0.8;
        }

        /* تأثير الحدود المتحركة */
        .board-member-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.95));
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .board-member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        /* خطوط زينة جانبية */
        .decorative-lines {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            z-index: 2;
        }

        .decorative-lines::before,
        .decorative-lines::after {
            content: '';
            position: absolute;
            background: linear-gradient(45deg, #0e6939, #0e6939);
            border-radius: 2px;
        }

        .decorative-lines::before {
            width: 30px;
            height: 3px;
            top: 10px;
            right: 0;
            opacity: 0.6;
        }

        .decorative-lines::after {
            width: 20px;
            height: 3px;
            top: 20px;
            right: 10px;
            opacity: 0.4;
        }

    </style>
</head>

<body>
    <x-guest-header></x-guest-header>
<div id="in-cont">
    <div class="inn-title" style="padding-top: 150px">
        <h2>
            <span><a href="{{ url('/') }}">{{ __('app.home_breadcrumb') }}</a> &raquo;</span>
            {{ __('app.committees_councils_title') }}
        </h2>
    </div>
    <div style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container-i1t">
            <h3 style="text-align: center; margin-bottom: 10px;">{{ __('app.committees_councils_title') }}</h3>

            @forelse($councils as $newsItem)
            <div class="my-kck p-7p2 bg-xf5 shadow-t3k" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                <div class="row-cwp py-hp3">
                    <div class="col-igy col-cvg">
                        <div class="bg-xf5 shadow-primary-sxe position-1lp">
                            <a href="{{ url('members/councils_members_list', ['id' => $newsItem->id]) }}" class="block-osq text-b1x">
                                <figure class="m-38w text-m1o overflow-khm">
                                    <img style="height: 180px; width: 100%;" class="img-odq rou-m3b" src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ app()->getLocale() == 'ar' ? ($newsItem->name_ar ?? __('app.image_alt_fallback')) : ($newsItem->name_en ?? __('app.image_alt_fallback')) }}">
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="col-5vc col-cvg my-mpv">
                        <a href="{{ url('members/councils_members_list', ['id' => $newsItem->id]) }}" class="block-osq text-b1x">
                            <h2 class="qvtmx font-weight-s3h text-7zo">{{ app()->getLocale() == 'ar' ? $newsItem->name_ar : $newsItem->name_en }}</h2>
                        </a>
                        <hr>
                        <div class="my-7z8 fs--oox">
                            <i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($newsItem->created_at)->translatedFormat('Y-m-d') }}
                            <i class="fa fa-clock" style="margin-right: 15px !important;"></i>
                            {{ \Carbon\Carbon::parse($newsItem->created_at)->translatedFormat('h:i A') }}
                        </div>
                        <p class="mt-1o5 fs--6nj mb-yo9 jus-6kh">
                            <span class="text-7zo block-osq">
                                {{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $newsItem->description_ar : $newsItem->description_en, 250) }}
                            </span>
                        </p>

                        <div class="text-jdt">
                            @auth
                            <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h" style="margin-bottom: 0px !important;">
                                {{ __('app.subscribe_to_service') }}
                                <a href="#" onclick="alert('{{ __('app.coming_soon') }}')">{{ __('app.click_here') }}</a>
                            </div>
                            @endauth

                            @guest
                            <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h" style="margin-bottom: 0px !important;">
                                {{ __('app.request_to_join_please') }}
                                <a href="{{ route('login') }}">{{ __('app.login') }}</a> {{ __('app.or') }} <a href="{{ route('members.register') }}">{{ __('app.create_new_account') }}</a>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center w-100">
                <p>{{ __('app.no_councils_available') }}</p>
            </div>
            @endforelse

            @forelse($committees as $newsItem)
            <div class="my-kck p-7p2 bg-xf5 shadow-t3k" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                <div class="row-cwp py-hp3">
                    <div class="col-igy col-cvg">
                        <div class="bg-xf5 shadow-primary-sxe position-1lp">
                            <a href="{{ route('members.committee_members_list', ['id' => $newsItem->id]) }}" class="block-osq text-b1x">
                                <figure class="m-38w text-m1o overflow-khm">
                                    <img style="height: 180px; width: 100%;" class="img-odq rou-m3b" src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ app()->getLocale() == 'ar' ? ($newsItem->name_ar ?? __('app.image_alt_fallback')) : ($newsItem->name_en ?? __('app.image_alt_fallback')) }}">
                                </figure>
                            </a>
                        </div>
                    </div>
                    <div class="col-5vc col-cvg my-mpv">
                        <a class="text-7zo text-b1x" href="{{ route('members.committee_members_list', ['id' => $newsItem->id]) }}">
                            <h2 class="qvtmx font-weight-s3h text-7zo">{{ app()->getLocale() == 'ar' ? $newsItem->name_ar : $newsItem->name_en }}</h2>
                        </a>
                        <hr>
                        <div class="my-7z8 fs--oox">
                            <i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($newsItem->created_at)->translatedFormat('Y-m-d') }}
                            <i class="fa fa-clock" style="margin-right: 15px !important;"></i>
                            {{ \Carbon\Carbon::parse($newsItem->created_at)->translatedFormat('h:i A') }}
                        </div>
                        <p class="mt-1o5 fs--6nj mb-yo9 jus-6kh">
                            <span class="text-7zo block-osq">
                                {{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $newsItem->description_ar : $newsItem->description_en, 250) }}
                            </span>
                        </p>
                        <div class="text-jdt">
                            @auth
                            <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h" style="margin-bottom: 0px !important;">
                                {{ __('app.subscribe_to_service') }}
                                <a href="#" onclick="alert('{{ __('app.coming_soon') }}')">{{ __('app.click_here') }}</a>
                            </div>
                            @endauth

                            @guest
                            <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h" style="margin-bottom: 0px !important;">
                                {{ __('app.request_to_join_please') }}
                                <a href="{{ route('login') }}">{{ __('app.login') }}</a> {{ __('app.or') }} <a href="{{ route('members.register') }}">{{ __('app.create_new_account') }}</a>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center w-100">
                <p>{{ __('app.no_committees_available') }}</p>
            </div>
            @endforelse

        </div>
    </div>
</div>

    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
