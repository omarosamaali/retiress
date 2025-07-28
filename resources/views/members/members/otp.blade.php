<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>من نحن</title>
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

        body:not(.layout-admin) section {
            background: rgb(241, 241, 241) !important;
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

        .py-rzt {
            padding-top: 3rem !important;
        }

        .py-rzt {
            padding-bottom: 3rem !important;
        }

        @media only screen and (min-width: 768px) {
            body:not(.layout-admin) section {
                padding: 100px 0;
            }
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

        .container-w8y {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-w8y {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container-w8y {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container-w8y {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container-w8y {
                max-width: 1200px;
            }
        }

        .container-w8y {
            position: relative;
        }

        .row-x6c {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-83z {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .col-83z {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .offset-md-f6v {
                margin-left: 25%;
            }
        }

        .col-83z {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .offset-md-f6v {
                margin-left: 0;
                margin-right: 25%;
            }
        }

        .accordion-5w4 {
            overflow-anchor: none;
        }

        .col-k19:not(.sho-ph8) {
            display: none;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h1 {
            font-size: 2.65625rem;
        }

        h1,
        .xygoj {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .xygoj {
            font-size: 1.85938rem;
        }

        .mb-pfh {
            margin-bottom: 0.25rem !important;
        }

        .font-weight-dom {
            font-weight: 700 !important;
        }

        .text-o8q {
            color: #b28b46 !important;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        p {
            color: #1f1f1f;
        }

        .b-r8w {
            border: 0 !important;
        }

        .rou-kih {
            border-radius: 0.25rem !important;
        }

        .p-72h {
            padding: 1rem !important;
        }

        .shadow-eoy {
            box-shadow: 0 0 25px rgba(140, 152, 164, 0.1) !important;
        }

        .shadow-eoy {
            transition-property: box-shadow, transform;
            -webkit-animation: __shadowPageLoadFix;
            animation: __shadowPageLoadFix;
            -webkit-animation-duration: 0.01s;
            animation-duration: 0.01s;
        }

        .mb-os5 {
            margin-bottom: 1rem !important;
        }

        .label-dav {
            position: relative;
        }

        .input-3ob {
            position: relative;
        }

        .text-a3b {
            text-align: left !important;
        }

        button {
            border-radius: 0;
        }

        button {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button {
            overflow: visible;
        }

        button {
            text-transform: none;
        }

        button {
            outline: none !important;
        }

        button,
        [type="submit"] {
            -webkit-appearance: button;
        }

        .btn-qhr {
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

        .btn-primary-t6n {
            color: #ffffff;
            background: #b28b46;
            border-color: #9C7A3D;
        }

        .block-426 {
            display: block;
            width: 100%;
        }

        button:not(:disabled),
        [type="submit"]:not(:disabled) {
            cursor: pointer;
        }

        .btn-qhr:not(:disabled):not(.disabled) {
            cursor: pointer;
        }

        input {
            text-align: right;
        }

        .btn-8b1.btn-primary-t6n:not(:hover):not([aria-expanded="true"]):not(.act-gsg) {
            color: #ffffff;
            background: #BC9B61;
            border-color: #9C7A3D;
        }

        .btn-qhr:hover {
            color: #212529;
            text-decoration: none;
        }

        .btn-primary-t6n:hover {
            color: #ffffff;
            background: #BC9B61;
            border-color: #9C7A3D;
        }

        .btn-primary-t6n:not(.btn-noshadow):hover {
            box-shadow: 0 4px 11px rgba(55, 125, 255, 0.35);
        }

        .text-oy9 {
            text-align: center !important;
        }

        .mt--m56 {
            margin-top: 30px !important;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        h2 {
            font-size: 2.125rem;
        }

        h2,
        .lgoot {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .lgoot {
            font-size: 1.32812rem;
        }

        .mb-4qd {
            margin-bottom: 1.5rem !important;
        }

        .text-j88 {
            text-align: right !important;
        }

        .bg-odn {
            background-color: #f8f9fa !important;
        }

        .position-roy {
            position: relative !important;
        }

        .pt-t94 {
            padding-top: 1rem !important;
        }

        .cle-c4k:after {
            display: block;
            clear: both;
            content: "";
        }

        .btn-primary-t6n:not(.btn-noshadow):hover,
        .btn-primary-t6n:not(.btn-noshadow):not(.btn-8b1):active {
            box-shadow: 0 4px 11px rgba(55, 125, 255, 0.35);
        }

        input {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        input {
            overflow: visible;
        }

        input {
            outline: none !important;
        }

        .form-control-k7o {
            display: block;
            width: 100%;
            height: calc(1.5em + 1.56rem + 2px);
            padding: 0.78rem 1rem;
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #dde4ea;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .fsbsy {
            direction: ltr !important;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .label-dav>.form-control-k7o+label {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.88rem 1rem;
            margin-bottom: 0;
            color: #95a4af;
            pointer-events: none;
            cursor: text;
            transition: all 0.2s ease-in-out;
        }

        .input-fja {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-fja {
            direction: ltr;
        }

        a {
            color: #b28b46;
            text-decoration: none;
            background-color: transparent;
        }

        a {
            outline: none !important;
        }

        .fs--n1f {
            font-size: 12px !important;
        }

        a:hover {
            color: unset;
            text-decoration: underline;
        }

        .block-kof {
            display: block !important;
        }

        .success-xd5 {
            color: #6dbb30 !important;
        }

        .text-kkc {
            text-decoration: none !important;
        }

        a.success-xd5:hover {
            color: #4a7e20 !important;
        }

        .input-mae {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .input-mpr {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.88rem 1rem;
            margin-bottom: 0;
            color: #95a4af;
            pointer-events: none;
            cursor: text;
            padding-top: 3px;
            padding-bottom: 0;
            font-size: 12px;
            transition: all 0.2s ease-in-out;
        }

        .checkbox-e9k {
            position: relative;
            cursor: pointer;
            line-height: 1.3;
            padding-right: 30px;
            padding-left: 15px;
        }

        .text-nwd {
            color: #7e8299 !important;
        }

        .input-f96 {
            display: flex;
        }

        .input-f96 {
            margin-right: -1px;
        }

        .input-fja>.form-control-k7o {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
        }

        .input-fja>.form-control-k7o:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-fja>.form-control-k7o:not(:first-child) {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-mae * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .input-mae .container-r7c {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            padding: 1px;
        }

        .input-mae.dropdown-x3r .container-r7c {
            right: auto;
            left: 0;
        }

        .input-mae.dropdown-x3r .container-r7c:hover {
            cursor: pointer;
        }

        .input-mae input,
        .input-mae input[type="tel"] {
            position: relative;
            z-index: 0;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-right: 36px;
            margin-right: 0;
        }

        .input-mae.dropdown-x3r input,
        .input-mae.dropdown-x3r input[type="tel"] {
            padding-right: 6px;
            padding-left: 52px;
            margin-left: 0;
        }

        .input-mae input {
            position: relative;
            z-index: 0;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-right: 36px;
            margin-right: 0;
        }

        .input-mae.dropdown-x3r input {
            padding-right: 6px;
            padding-left: 52px;
            margin-left: 0;
        }

        input[type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
        }

        .checkbox-e9k>input[type="checkbox"] {
            display: none;
        }

        .checkbox-e9k>i {
            position: absolute;
            display: inline-block;
            border-radius: 3px;
            transition: 0.3s;
            right: 0;
            margin-left: 10px;
            width: 20px;
            height: 20px;
            background: #fff;
            border: 2px solid rgba(0, 0, 0, 0.35);
            cursor: pointer;
        }

        .checkbox-e9k>input[type="checkbox"]:checked+i {
            background: #b28b46;
            border: none;
        }

        .checkbox-e9k>input[type="checkbox"]:checked+i {
            border: none;
            background: #121212;
        }

        .checkbox-e9k.checkbox-77x>input[type="checkbox"]:checked+i {
            background: #b28b46;
        }

        a.checkbox-e9k.act-gsg>i::after,
        .checkbox-e9k>input[type="checkbox"]:checked+i::after {
            position: absolute;
            content: "";
            top: 5px;
            width: 12px;
            height: 6px;
            border: 2px solid #fff;
            border-top-style: none;
            border-right-style: none;
            transform: rotate(-45deg);
            right: 4px;
        }

        .input-fo3 {
            display: flex;
            align-items: center;
            padding: 0.78rem 1rem;
            margin-bottom: 0;
            font-size: 1.0625rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #dde4ea;
            border-radius: 0.25rem;
        }

        .input-fja>.input-f96>.input-fo3 {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-mae .select-fkn {
            z-index: 1;
            position: relative;
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 6px 0 8px;
        }

        .input-mae.dropdown-x3r .container-r7c:hover .select-fkn {
            background-color: rgba(0, 0, 0, 0.05);
        }

        ul {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .hid-rag {
            display: none;
        }

        .input-mae .hid-rag {
            display: none;
        }

        .input-mae .list-x4e {
            position: relative;
            z-index: 2;
            list-style: none;
            text-align: left;
            direction: ltr;
            padding: 0;
            margin: 0 0 0 -1px;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            background-color: white;
            border: 1px solid #CCC;
            white-space: nowrap;
            max-height: 200px;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
        }

        .fa-evk {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .fa-pp5:before {
            content: "\f06e";
        }

        .iti-f5r {
            width: 20px;
        }

        .iti-f5r {
            height: 15px;
            box-shadow: 0px 0px 1px 0px #888;
            background-image: url("https://www.easd.ae/site/ar/build/img/flags.png");
            background-repeat: no-repeat;
            background-color: #DBDBDB;
            background-position: 20px 0;
        }

        .iti-f5r.cocwe {
            height: 11px;
            background-position: -5263px 0px;
        }

        .input-mae .select-fkn .row-c96 {
            margin-left: 6px;
            width: 0;
            height: 0;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
            border-top: 4px solid #555;
        }

        .input-mae .list-x4e .cou-qst {
            padding: 5px 10px;
        }

        .input-mae .list-x4e .div-6rv {
            padding-bottom: 5px;
            margin-bottom: 5px;
            border-bottom: 1px solid #CCC;
        }

        .input-mae .list-x4e .box-s7y {
            display: inline-block;
            width: 20px;
        }

        .input-mae .list-x4e .box-s7y {
            vertical-align: middle;
        }

        .input-mae .list-x4e .box-s7y {
            margin-right: 6px;
        }

        .input-mae .list-x4e .dial-myl {
            vertical-align: middle;
        }

        .input-mae .list-x4e .cou-qst .dial-myl {
            color: #999;
        }

        .input-mae .list-x4e .country-6tr {
            vertical-align: middle;
        }

        .input-mae .list-x4e .country-6tr {
            margin-right: 6px;
        }

        .iti-f5r.trokh {
            height: 10px;
            background-position: -1775px 0px;
        }

        .iti-f5r.dcyjk {
            height: 14px;
            background-position: -66px 0px;
        }

        .iti-f5r.qptog {
            height: 15px;
            background-position: -132px 0px;
        }

        .iti-f5r.obqwi {
            height: 14px;
            background-position: -1401px 0px;
        }

        .iti-f5r.ofimo {
            height: 10px;
            background-position: -242px 0px;
        }

        .iti-f5r.jsdbx {
            height: 14px;
            background-position: -22px 0px;
        }

        .iti-f5r.mifeo {
            height: 14px;
            background-position: -176px 0px;
        }

        .iti-f5r.wfqpe {
            height: 10px;
            background-position: -110px 0px;
        }

        .iti-f5r.hosxf {
            height: 14px;
            background-position: -88px 0px;
        }

        .iti-f5r.imcoy {
            height: 13px;
            background-position: -220px 0px;
        }

        .iti-f5r.tbqbv {
            height: 10px;
            background-position: -154px 0px;
        }

        .iti-f5r.kisxl {
            height: 14px;
            background-position: -308px 0px;
        }

        .iti-f5r.kqqwb {
            height: 10px;
            background-position: -286px 0px;
        }

        .iti-f5r.ysahb {
            height: 14px;
            background-position: -264px 0px;
        }

        .iti-f5r.rxqln {
            height: 10px;
            background-position: -352px 0px;
        }

        .iti-f5r.mrrov {
            height: 10px;
            background-position: -702px 0px;
        }

        .iti-f5r.mmlmg {
            height: 12px;
            background-position: -504px 0px;
        }

        .iti-f5r.kpvov {
            height: 12px;
            background-position: -418px 0px;
        }

        .iti-f5r.tekrh {
            height: 14px;
            background-position: -396px 0px;
        }

        .iti-f5r.bxbno {
            height: 10px;
            background-position: -790px 0px;
        }

        .iti-f5r.jmjng {
            width: 18px;
        }

        .iti-f5r.jmjng {
            height: 15px;
            background-position: -440px 0px;
        }

        .iti-f5r.rghwx {
            height: 14px;
            background-position: -812px 0px;
        }

        .iti-f5r.ypvdo {
            height: 14px;
            background-position: -548px 0px;
        }

        .iti-f5r.damhp {
            height: 10px;
            background-position: -592px 0px;
        }

        .iti-f5r.pthtq {
            height: 14px;
            background-position: -724px 0px;
        }

        .iti-f5r.oxcgb {
            height: 14px;
            background-position: -636px 0px;
        }

        .iti-f5r.omqol {
            height: 10px;
            background-position: -374px 0px;
        }

        .iti-f5r.bocoa {
            height: 14px;
            background-position: -768px 0px;
        }

        .iti-f5r.dmpfb {
            height: 14px;
            background-position: -680px 0px;
        }

        .iti-f5r.sleqj {
            height: 10px;
            background-position: -2435px 0px;
        }

        .iti-f5r.rcqje {
            height: 10px;
            background-position: -5390px 0px;
        }

        .iti-f5r.lylfj {
            height: 10px;
            background-position: -614px 0px;
        }

        .iti-f5r.hocck {
            height: 12px;
            background-position: -482px 0px;
        }

        .iti-f5r.wasem {
            height: 14px;
            background-position: -460px 0px;
        }

        .iti-f5r.jnofc {
            height: 12px;
            background-position: -526px 0px;
        }

        .iti-f5r.gonll {
            height: 13px;
            background-position: -2677px 0px;
        }

        .iti-f5r.exnpa {
            height: 14px;
            background-position: -1027px 0px;
        }

        .iti-f5r.rtmrm {
            height: 10px;
            background-position: -834px 0px;
        }

        .iti-f5r.aodic {
            height: 12px;
            background-position: -1159px 0px;
        }

        .iti-f5r.abloy {
            height: 10px;
            background-position: -2831px 0px;
        }

        .iti-f5r.scfqa {
            height: 14px;
            background-position: -900px 0px;
        }

        .iti-f5r.aodmo {
            height: 14px;
            background-position: -4845px 0px;
        }

        .iti-f5r.rsbcd {
            height: 14px;
            background-position: -1005px 0px;
        }

        .iti-f5r.osevn {
            height: 14px;
            background-position: -1049px 0px;
        }

        .iti-f5r.agafo {
            height: 10px;
            background-position: -1203px 0px;
        }

        .iti-f5r.cbtch {
            height: 10px;
            background-position: -856px 0px;
        }

        .iti-f5r.wtvtt {
            height: 14px;
            background-position: -1071px 0px;
        }

        .iti-f5r.wqabq {
            height: 12px;
            background-position: -2721px 0px;
        }

        .iti-f5r.crodf {
            height: 15px;
            background-position: -878px 0px;
        }

        .iti-f5r.oyxle {
            height: 14px;
            background-position: -922px 0px;
        }

        .iti-f5r.nhqcs {
            height: 10px;
            background-position: -983px 0px;
        }

        .iti-f5r.mbony {
            height: 12px;
            background-position: -1115px 0px;
        }

        .iti-f5r.nmpfg {
            height: 14px;
            background-position: -961px 0px;
        }

        .btacg {
            display: block;
            height: 1px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .iti-f5r.btacg {
            height: 10px;
            background-position: -2237px 0px;
        }

        .iti-f5r.volpc {
            height: 10px;
            background-position: -1137px 0px;
        }

        .iti-f5r.qmjcr {
            height: 14px;
            background-position: -1225px 0px;
        }

        .iti-f5r.ooocg {
            height: 14px;
            background-position: -1247px 0px;
        }

        .iti-f5r.xwfjo {
            height: 15px;
            background-position: -1335px 0px;
        }

        .iti-f5r.xsynh {
            height: 14px;
            background-position: -1313px 0px;
        }

        .iti-f5r.rmpsw {
            height: 10px;
            background-position: -1357px 0px;
        }

        .iti-f5r.qoxxq {
            height: 14px;
            background-position: -1379px 0px;
        }

        .iti-f5r.ietao {
            height: 14px;
            background-position: -1445px 0px;
        }

        .iti-f5r.gbkik {
            height: 14px;
            background-position: -1489px 0px;
        }

        .iti-f5r.omthc {
            height: 12px;
            background-position: -4713px 0px;
        }

        .iti-f5r.pcior {
            height: 14px;
            background-position: -2017px 0px;
        }

        .iti-f5r.xyboe {
            height: 10px;
            background-position: -1533px 0px;
        }

        .iti-f5r.qwviv {
            height: 13px;
            background-position: -1467px 0px;
        }

        .iti-f5r.shdvf {
            height: 10px;
            background-position: -1577px 0px;
        }

        .iti-f5r.gpwsw {
            height: 10px;
            background-position: -1665px 0px;
        }

        .iti-f5r.cvxoh {
            height: 15px;
            background-position: -1709px 0px;
        }

        .iti-f5r.ylord {
            height: 10px;
            background-position: -1643px 0px;
        }

        .wyatp {
            vertical-align: middle;
            display: inline-block;
        }

        .iti-f5r.wyatp {
            height: 12px;
            background-position: -1621px 0px;
        }

        .wyatp:before {
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

        .iti-f5r.tnrml {
            height: 14px;
            background-position: -1731px 0px;
        }

        .iti-f5r.ioohp {
            height: 14px;
            background-position: -1841px 0px;
        }

        .iti-f5r.lorrb {
            height: 14px;
            background-position: -3943px 0px;
        }

        .iti-f5r.dtyko {
            height: 15px;
            background-position: -1753px 0px;
        }

        .iti-f5r.kptro {
            height: 14px;
            background-position: -1951px 0px;
        }

        .iti-f5r.xsxkv {
            height: 14px;
            background-position: -1819px 0px;
        }

        .iti-f5r.ikfck {
            height: 12px;
            background-position: -1269px 0px;
        }

        .iti-f5r.ieqpq {
            height: 14px;
            background-position: -1885px 0px;
        }

        .iti-f5r.cmivo {
            height: 10px;
            background-position: -1907px 0px;
        }

        .iti-f5r.nwdve {
            height: 14px;
            background-position: -2039px 0px;
        }

        .iti-f5r.gddgt {
            height: 14px;
            background-position: -1929px 0px;
        }

        .iti-f5r.lwyna {
            height: 12px;
            background-position: -1797px 0px;
        }

        .iti-f5r.kaofm {
            height: 14px;
            background-position: -1995px 0px;
        }

        .iti-f5r.snvco {
            height: 11px;
            background-position: -2105px 0px;
        }

        .iti-f5r.jsoxo {
            height: 13px;
            background-position: -2083px 0px;
        }

        .iti-f5r.okotr {
            height: 14px;
            background-position: -1863px 0px;
        }

        .iti-f5r.lboao {
            height: 14px;
            background-position: -1973px 0px;
        }

        .iti-f5r.achlo {
            height: 10px;
            background-position: -2127px 0px;
        }

        .iti-f5r.horeh {
            height: 12px;
            background-position: -2149px 0px;
        }

        .iti-f5r.aovdk {
            height: 12px;
            background-position: -2259px 0px;
        }

        .iti-f5r.gdphs {
            height: 10px;
            background-position: -2215px 0px;
        }

        .iti-f5r.flvfg {
            height: 14px;
            background-position: -2171px 0px;
        }

        .iti-f5r.njjte {
            height: 10px;
            background-position: -2281px 0px;
        }

        .iti-f5r.bshop {
            height: 15px;
            background-position: -2501px 0px;
        }

        .iti-f5r.vsliq {
            height: 14px;
            background-position: -2413px 0px;
        }

        .iti-f5r.xygop {
            height: 14px;
            background-position: -2325px 0px;
        }

        .iti-f5r.gjtdi {
            height: 12px;
            background-position: -2479px 0px;
        }

        .iti-f5r.qqacy {
            height: 14px;
            background-position: -2457px 0px;
        }

        .iti-f5r.rbaeq {
            height: 10px;
            background-position: -2347px 0px;
        }

        .iti-f5r.tnpkh {
            height: 10px;
            background-position: -2391px 0px;
        }

        .iti-f5r.qitck {
            height: 15px;
            background-position: -2369px 0px;
        }

        .iti-f5r.jvday {
            height: 14px;
            background-position: -2523px 0px;
        }

        .iti-f5r.crkpb {
            height: 10px;
            background-position: -2567px 0px;
        }

        .iti-f5r.gmcci {
            height: 14px;
            background-position: -2611px 0px;
        }

        .iti-f5r.ibkvc {
            height: 12px;
            background-position: -2545px 0px;
        }

        .iti-f5r.osovs {
            height: 10px;
            background-position: -2589px 0px;
        }

        .iti-f5r.jwynk {
            height: 10px;
            background-position: -2853px 0px;
        }

        .iti-f5r.kamjc {
            height: 14px;
            background-position: -2633px 0px;
        }

        .iti-f5r.vdlwn {
            height: 10px;
            background-position: -2699px 0px;
        }

        .iti-f5r.wyhkl {
            height: 10px;
            background-position: -2809px 0px;
        }

        .iti-f5r.owwtr {
            height: 12px;
            background-position: -2655px 0px;
        }

        .iti-f5r.xliye {
            height: 14px;
            background-position: -2875px 0px;
        }

        .iti-f5r.gqpig {
            height: 10px;
            background-position: -3073px 0px;
        }

        .iti-f5r.opokg {
            height: 14px;
            background-position: -2897px 0px;
        }

        .iti-f5r.hkxsi {
            height: 14px;
            background-position: -3007px 0px;
        }

        .iti-f5r.ycfnd {
            height: 11px;
            background-position: -2985px 0px;
        }

        .iti-f5r.fcayc {
            height: 10px;
            background-position: -3095px 0px;
        }

        .iti-f5r.phcqr {
            height: 12px;
            background-position: -2941px 0px;
        }

        .iti-f5r.oeolx {
            height: 12px;
            background-position: -3029px 0px;
        }

        .iti-f5r.mhgok {
            height: 12px;
            background-position: -3051px 0px;
        }

        .iti-f5r.dehnq {
            height: 14px;
            background-position: -3358px 0px;
        }

        .iti-f5r.vtgoa {
            height: 10px;
            background-position: -3270px 0px;
        }

        .iti-f5r.pwjfa {
            height: 14px;
            background-position: -3226px 0px;
        }

        .iti-f5r.qwqvr {
            height: 14px;
            background-position: -3534px 0px;
        }

        .iti-f5r.jhcyc {
            height: 10px;
            background-position: -3578px 0px;
        }

        .iti-f5r.ghocd {
            height: 14px;
            background-position: -3512px 0px;
        }

        .iti-f5r.qmngw {
            height: 14px;
            background-position: -3292px 0px;
        }

        .iti-f5r.elokw {
            height: 14px;
            background-position: -3468px 0px;
        }

        .iti-f5r.ieoox {
            height: 11px;
            background-position: -3248px 0px;
        }

        .iti-f5r.ytqej {
            height: 14px;
            background-position: -3402px 0px;
        }

        .iti-f5r.ecipe {
            height: 14px;
            background-position: -3424px 0px;
        }

        .iti-f5r.rcoog {
            height: 14px;
            background-position: -3490px 0px;
        }

        .iti-f5r.ccbxt {
            height: 14px;
            background-position: -5566px 0px;
        }

        .iti-f5r.nbxde {
            height: 12px;
            background-position: -3556px 0px;
        }

        .iti-f5r.jcqyh {
            height: 11px;
            background-position: -1687px 0px;
        }

        .iti-f5r.fkolj {
            height: 10px;
            background-position: -3160px 0px;
        }

        .iti-f5r.exhvs {
            width: 19px;
        }

        .iti-f5r.exhvs {
            height: 15px;
            background-position: -3139px 0px;
        }

        .iti-f5r.kbxvl {
            height: 10px;
            background-position: -3336px 0px;
        }

        .iti-f5r.kerhk {
            height: 10px;
            background-position: -3182px 0px;
        }

        .iti-f5r.voofh {
            height: 10px;
            background-position: -3446px 0px;
        }

        .iti-f5r.ngyas {
            height: 14px;
            background-position: -3117px 0px;
        }

        .iti-f5r.xqhlr {
            height: 14px;
            background-position: -3600px 0px;
        }

        .iti-f5r.nraln {
            height: 14px;
            background-position: -3314px 0px;
        }

        .iti-f5r.qbdvf {
            height: 14px;
            background-position: -3622px 0px;
        }

        .iti-f5r.wynps {
            height: 10px;
            background-position: -3811px 0px;
        }

        .iti-f5r.pvwpt {
            width: 13px;
        }

        .iti-f5r.pvwpt {
            height: 15px;
            background-position: -3796px 0px;
        }

        .iti-f5r.pvwpt {
            background-color: transparent;
        }

        .iti-f5r.gwooo {
            height: 14px;
            background-position: -3752px 0px;
        }

        .iti-f5r.akyht {
            height: 10px;
            background-position: -3644px 0px;
        }

        .iti-f5r.ncfsy {
            height: 10px;
            background-position: -3855px 0px;
        }

        .iti-f5r.djyen {
            height: 12px;
            background-position: -3730px 0px;
        }

        .iti-f5r.mlcpy {
            width: 18px;
        }

        .iti-f5r.mlcpy {
            height: 15px;
            background-position: -3666px 0px;
        }

        .iti-f5r.svfnq {
            height: 10px;
            background-position: -3708px 0px;
        }

        .iti-f5r.rbtik {
            height: 10px;
            background-position: -3833px 0px;
        }

        .iti-f5r.mptov {
            height: 10px;
            background-position: -3686px 0px;
        }

        .iti-f5r.igrhg {
            height: 10px;
            background-position: -2765px 0px;
        }

        .iti-f5r.yxdha {
            height: 10px;
            background-position: -3380px 0px;
        }

        .iti-f5r.koisc {
            height: 15px;
            background-position: -3774px 0px;
        }

        .iti-f5r.vicic {
            height: 10px;
            background-position: -3877px 0px;
        }

        .iti-f5r.twqyd {
            height: 14px;
            background-position: -4009px 0px;
        }

        .iti-f5r.kbomp {
            height: 13px;
            background-position: -4163px 0px;
        }

        .iti-f5r.csasp {
            height: 10px;
            background-position: -4119px 0px;
        }

        .iti-f5r.cehgt {
            height: 14px;
            background-position: -3899px 0px;
        }

        .iti-f5r.pdaqx {
            height: 15px;
            background-position: -3965px 0px;
        }

        .iti-f5r.wwona {
            height: 11px;
            background-position: -4185px 0px;
        }

        .iti-f5r.fogln {
            height: 14px;
            background-position: -3921px 0px;
        }

        .iti-f5r.awamh {
            height: 10px;
            background-position: -3987px 0px;
        }

        .iti-f5r.qwysi {
            height: 13px;
            background-position: -4031px 0px;
        }

        .iti-f5r.cbnsx {
            height: 14px;
            background-position: -4141px 0px;
        }

        .iti-f5r.qndjj {
            height: 14px;
            background-position: -4097px 0px;
        }

        .iti-f5r.hpfas {
            height: 8px;
            background-position: -4207px 0px;
        }

        .iti-f5r.lhfsn {
            height: 14px;
            background-position: -4229px 0px;
        }

        .iti-f5r.memmy {
            height: 14px;
            background-position: -4251px 0px;
        }

        .iti-f5r.rsljn {
            height: 14px;
            background-position: -4295px 0px;
        }

        .iti-f5r.topcy {
            height: 14px;
            background-position: -4317px 0px;
        }

        .iti-f5r.skoow {
            height: 10px;
            background-position: -4471px 0px;
        }

        .iti-f5r.ycqed {
            height: 14px;
            background-position: -2743px 0px;
        }

        .iti-f5r.fweii {
            height: 10px;
            background-position: -2919px 0px;
        }

        .iti-f5r.awctp {
            height: 14px;
            background-position: -4053px 0px;
        }

        .iti-f5r.sgijo {
            height: 14px;
            background-position: -5346px 0px;
        }

        .iti-f5r.qssrx {
            height: 10px;
            background-position: -5500px 0px;
        }

        .iti-f5r.pykoi {
            height: 15px;
            background-position: -4581px 0px;
        }

        .iti-f5r.gygmi {
            height: 10px;
            background-position: -4691px 0px;
        }

        .iti-f5r.liolx {
            height: 14px;
            background-position: -4339px 0px;
        }

        .iti-f5r.wespp {
            height: 14px;
            background-position: -4603px 0px;
        }

        .iti-f5r.dgfee {
            height: 14px;
            background-position: -4273px 0px;
        }

        .text-o8q {
            text-align: center;
            color: #333;
        }

        .xygoj {
            font-size: 24px;
        }

        .mb-pfh {
            margin-bottom: 20px;
        }

        .font-weight-dom {
            font-weight: bold;
        }

        .b-r8w {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .p-72h {
            padding: 30px;
        }

        .rou-kih {
            border-radius: 10px;
        }

        .shadow-eoy {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
            margin: 20px auto;
        }

        .verification-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .verification-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease;
        }

        .verification-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .verification-input:valid {
            border-color: #b68a35;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #9C7A3D;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }


        .iti-f5r.lmewg {
            height: 10px;
            background-position: -4383px 0px;
        }

        .iti-f5r.scfyy {
            height: 14px;
            background-position: -4559px 0px;
        }

        .iti-f5r.oioop {
            height: 14px;
            background-position: -4449px 0px;
        }

        .iti-f5r.owoeb {
            height: 14px;
            background-position: -4537px 0px;
        }

        .iti-f5r.fyyce {
            height: 10px;
            background-position: -4493px 0px;
        }

        .iti-f5r.kbdxp {
            height: 10px;
            background-position: -4361px 0px;
        }

        .iti-f5r.favbx {
            height: 14px;
            background-position: -4625px 0px;
        }

        .iti-f5r.xyfyp {
            height: 14px;
            background-position: -5588px 0px;
        }

        .iti-f5r.njowq {
            height: 14px;
            background-position: -2787px 0px;
        }

        .iti-f5r.fcdib {
            height: 14px;
            background-position: -1555px 0px;
        }

        .iti-f5r.rkfcv {
            height: 10px;
            background-position: -2963px 0px;
        }

        .iti-f5r.leekj {
            height: 10px;
            background-position: -4405px 0px;
        }

        .iti-f5r.dogse {
            height: 14px;
            background-position: -4647px 0px;
        }

        .iti-f5r.xcsfk {
            height: 15px;
            background-position: -4515px 0px;
        }

        .iti-f5r.wfofd {
            height: 14px;
            background-position: -4779px 0px;
        }

        .iti-f5r.ijnca {
            height: 13px;
            background-position: -4427px 0px;
        }

        .iti-f5r.cjhxw {
            width: 15px;
        }

        .iti-f5r.cjhxw {
            height: 15px;
            background-position: -944px 0px;
        }

        .iti-f5r.hjtkk {
            height: 14px;
            background-position: -4757px 0px;
        }

        .iti-f5r.hiofw {
            height: 14px;
            background-position: -5131px 0px;
        }

        .iti-f5r.olqoe {
            height: 10px;
            background-position: -4933px 0px;
        }

        .iti-f5r.cfiky {
            height: 14px;
            background-position: -5153px 0px;
        }

        .iti-f5r.bxeld {
            height: 14px;
            background-position: -4911px 0px;
        }

        .iti-f5r.rjcop {
            height: 13px;
            background-position: -4889px 0px;
        }

        .iti-f5r.omdje {
            height: 10px;
            background-position: -4955px 0px;
        }

        .iti-f5r.jcqes {
            height: 10px;
            background-position: -5043px 0px;
        }

        .iti-f5r.rwlep {
            height: 12px;
            background-position: -5087px 0px;
        }

        .iti-f5r.sobyt {
            height: 14px;
            background-position: -5021px 0px;
        }

        .iti-f5r.bqnol {
            height: 14px;
            background-position: -5065px 0px;
        }

        .iti-f5r.ofwky {
            height: 14px;
            background-position: -4999px 0px;
        }

        .iti-f5r.qtoco {
            height: 10px;
            background-position: -4823px 0px;
        }

        .iti-f5r.wmpob {
            height: 10px;
            background-position: -5109px 0px;
        }

        .iti-f5r.hyplx {
            height: 14px;
            background-position: -5412px 0px;
        }

        .iti-f5r.ntgfm {
            height: 14px;
            background-position: -5197px 0px;
        }

        .iti-f5r.tqiwh {
            height: 14px;
            background-position: -5175px 0px;
        }

        .iti-f5r.whook {
            height: 10px;
            background-position: -44px 0px;
        }

        .iti-f5r.spqfg {
            height: 14px;
            background-position: -5285px 0px;
        }

        .iti-f5r.foaqn {
            height: 10px;
            background-position: -5307px 0px;
        }

        .iti-f5r.ojphd {
            height: 12px;
            background-position: -5456px 0px;
        }

        .iti-f5r.hmycx {
            width: 15px;
        }

        .iti-f5r.hmycx {
            height: 15px;
            background-position: -5329px 0px;
        }

        .iti-f5r.llhbo {
            height: 14px;
            background-position: -5368px 0px;
        }

        .iti-f5r.bobjq {
            height: 14px;
            background-position: -5434px 0px;
        }

        .iti-f5r.icfnx {
            height: 14px;
            background-position: -5478px 0px;
        }

        .iti-f5r.dgnfe {
            height: 10px;
            background-position: -1511px 0px;
        }

        .iti-f5r.vjpsx {
            height: 14px;
            background-position: -5544px 0px;
        }

        .iti-f5r.hcixd {
            height: 14px;
            background-position: -5610px 0px;
        }

        .iti-f5r.ivmnc {
            height: 10px;
            background-position: -5632px 0px;
        }


        @keyframes __shadowPageLoadFix {
            0% {}

            100% {
                box-shadow: none;
                box-shadow: none;
            }

        }

    </style>

</head>

<body>
    <x-guest-header></x-guest-header>
    <div id="in-cont">
<section class="py-rzt" style="padding-top: 150px;">
    <div class="container-w8y">
        <div class="col-83z offset-md-f6v">
            <form class="col-k19 sho-ph8" id="otpForm" method="POST" action="{{ route('members.verify_otp') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('password_reset_email') }}">

                <h1 class="text-o8q xygoj mb-pfh font-weight-dom" style="margin-bottom: 20px;"> إدخال رمز اعادة تعيين كلمة المرور </h1>
                <div class="p-72h rou-kih shadow-eoy">
                    <div class="verification-container">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                        <input type="text" class="verification-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    </div>
                    <button type="button" class="submit-btn" id="submitBtn" disabled>تأكيد الرمز</button>
                </div>
                <div class="text-oy9 mt--m56 text-a3b font-weight-dom">
                    <a href="{{ route('members.login') }}" class="block-kof success-xd5 text-a3b text-kkc">
                        سجل دخول ؟
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const inputs = document.querySelectorAll('.verification-input');
    const submitBtn = document.getElementById('submitBtn');
    const otpForm = document.getElementById('otpForm'); // احصل على الفورم عن طريق ID

    inputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            checkAllFilled();
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');
            for (let i = 0; i < Math.min(pastedData.length, inputs.length - index); i++) {
                inputs[index + i].value = pastedData[i];
            }
            const nextIndex = Math.min(index + pastedData.length, inputs.length - 1);
            inputs[nextIndex].focus();
            checkAllFilled();
        });
    });

    function checkAllFilled() {
        const allFilled = Array.from(inputs).every(input => input.value.length === 1);
        submitBtn.disabled = !allFilled;
    }

    submitBtn.addEventListener('click', function() {
        // جمع الأرقام من كل الحقول
        const otpValue = Array.from(inputs).map(input => input.value).join('');

        // ابحث عن الحقل المخفي لو موجود، أو أنشئه لو مش موجود
        let hiddenOtpInput = document.querySelector('input[name="otp"][type="hidden"]');
        if (!hiddenOtpInput) {
            hiddenOtpInput = document.createElement('input');
            hiddenOtpInput.type = 'hidden';
            hiddenOtpInput.name = 'otp'; // اسم الحقل المطلوب في الكنترولر
            otpForm.appendChild(hiddenOtpInput);
        }
        hiddenOtpInput.value = otpValue; // حط القيمة المجمعة في الحقل المخفي

        otpForm.submit(); // اعمل submit للفورم عن طريق الـ JavaScript
    });

    // إضافة معالجة للأخطاء لو فيه validation errors راجعة من Laravel
    // ده بيخلي رسائل الأخطاء تظهر للمستخدم لو الـ OTP غلط
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
        const errorMessage = "{{ $errors->first('otp') }}";
        if (errorMessage) {
            alert(errorMessage); // أو اعرضها في مكان مخصص في الـ HTML
        }
        @endif
    });

</script>


        <x-footer-section></x-footer-section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
        <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
        <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
        <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
        <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
