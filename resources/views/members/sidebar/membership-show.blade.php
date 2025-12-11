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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        div:where(.swal2-container).swal2-center>.swal2-popup {
            font-size: 15px;
        }

        #newMembershipContent {
            display: none;
            /* مخفي افتراضيًا */
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            /* لون الخلفية حسب التصميم */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* لإضافة تأثير بصري */
        }

        #newMembershipContent.active {
            display: block !important;
            /* للتأكد من الإظهار */
        }

        #renewalModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* خلفية معتمة */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #renewalModal.active {
            display: flex !important;
            /* لإظهار الـ modal */
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        @media all {
            body {
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

            .container-5vw {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        .vc_-onj {
            padding-top: 80px !important;
            padding-bottom: 80px !important;
        }

        @media all {
            .container-aon {
                position: relative;
                z-index: 10;
            }

            :before,
            :after {
                box-sizing: border-box;
            }

            .container-5vw:before,
            .container-5vw:after {
                display: table;
                content: " ";
            }

            .container-5vw:after {
                clear: both;
            }

            .row-dq5 {
                margin-left: -15px;
                margin-right: -15px;
            }

            .row-dq5 {
                position: relative;
            }

            .row-dq5.row-r5g {
                box-sizing: border-box;
                display: flex;
                flex-wrap: wrap;
            }

            .row-dq5.column-hf7 {
                margin-left: -32.5px;
                margin-right: -32.5px;
            }

            .row-dq5:after,
            .row-dq5:before {
                content: " ";
                display: table;
            }

            .row-dq5.row-r5g:after,
            .row-dq5.row-r5g:before {
                display: none;
            }

            .row-dq5:after {
                clear: both;
            }

            .container-sho {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

        @media (min-width: 768px) {
            .container-sho {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .container-sho {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container-sho {
                width: 1170px;
            }
        }

        @media all {
            .container-sho {
                max-width: 100%;
            }

            .container-sho:before,
            .container-sho:after {
                display: table;
                content: " ";
            }

            .container-sho:after {
                clear: both;
            }

            .row-d6o {
                margin-right: -15px;
                margin-left: -15px;
            }

            .row-dq5>.container-sho>.row-d6o {
                padding: 0;
            }

            .row-r5g>.container-sho>.row-d6o {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }

            .row-d6o:before,
            .row-d6o:after {
                display: table;
                content: " ";
            }

            .row-r5g .row-d6o::before,
            .row-r5g .row-d6o::after {
                display: none;
            }

            .row-r5g>.container-sho>.row-d6o::before,
            .row-r5g>.container-sho>.row-d6o::after,
            .row-r5g>.container-5vw>.row-d6o::before,
            .row-r5g>.container-5vw>.row-d6o::after {
                display: none;
            }

            .row-d6o:after {
                clear: both;
            }

            .container-gnx {
                width: 100%;
            }

            .col-46s {
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                box-sizing: border-box;
            }
        }

        @media (min-width: 768px) {
            .col-46s {
                float: left;
            }

            .col-46s {
                width: 100%;
            }
        }

        @media all {
            .container-gnx {
                padding-left: 0;
                padding-right: 0;
            }

            .row-r5g>.container-sho>.row-d6o>.container-gnx {
                display: -ms-flexbox;
                display: flex;
            }

            .row-g2e>.container-sho>.row-d6o>.container-gnx {
                -ms-flex-align: stretch;
                align-items: stretch;
            }

            .container-gnx>.column-jzp {
                box-sizing: border-box;
                padding-left: 15px;
                padding-right: 15px;
                width: 100%;
            }

            .row-r5g>.container-sho>.row-d6o>.container-gnx>.column-jzp {
                -ms-flex-positive: 1;
                flex-grow: 1;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                z-index: 1;
            }

            .content-375>.container-sho>.row-d6o>.container-gnx>.column-jzp {
                -ms-flex-pack: center;
                justify-content: center;
            }

            .column-jzp:after,
            .column-jzp:before {
                content: " ";
                display: table;
            }

            .column-jzp:after {
                clear: both;
            }

            .content-y8i {
                margin-bottom: 35px;
            }

            .header-ac9 {
                margin-bottom: 20px;
            }
        }

        .vc_-cx1 {
            padding-bottom: 10px !important;
        }

        @media all {


            .stm_headings_line.stm_headings_line_top .h5::before,
            .stm_headings_line.stm_headings_line_top h2::before {
                content: "";
                display: none !important;
            }

            .form-6cc {
                font-family: inherit;
            }

            .form-6cc * {
                box-sizing: border-box;
            }

            .error-bor {
                display: none;
                margin-top: 15px;
            }

            fieldset {
                border: 1px solid #c0c0c0;
                margin: 0 2px;
                padding: 0.35em 0.625em 0.75em;
            }

            fieldset {
                min-width: 0;
                padding: 0;
                margin: 0;
                border: 0;
            }

            legend {
                border: 0;
                padding: 0;
            }

            legend {
                display: block;
                width: 100%;
                padding: 0;
                margin-bottom: 20px;
                font-size: 21px;
                line-height: inherit;
                color: #333333;
                border: 0;
                border-bottom: 1px solid #e5e5e5;
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
        }

        @media (min-width: 768px) {
            .form-7fx .container-8ka {
                display: flex;
                gap: 15px;
                width: 100%;
            }
        }

        @media all {
            .form-7fx .container-8ka {
                margin-bottom: 21px !important;
            }

            .container-8ka.container-gx5.column-p79 {
                margin-bottom: 20px;
            }

            .content-mar {
                margin-top: 10px !important;
            }

            .form-6cc .ff-el-qhz {
                margin-bottom: 20px;
            }

            .form-6cc .ff-el-qhz {
                padding: 0px 30px;
            }

            .form-6cc .ff-el-qhz {
                padding: 0px 0;
                padding-left: 32px;
            }

            .form-6cc .clearfix::after,
            .form-6cc .clearfix::before,
            .form-6cc .ff-el-qhz::after,
            .form-6cc .ff-el-qhz::before,
            .form-6cc .ff-el-repeat .content-mar::after,
            .form-6cc .ff-el-repeat .content-mar::before,
            .form-6cc .ff-step-body::after,
            .form-6cc .ff-step-body::before {
                content: " ";
                display: table;
            }

            .form-6cc .clearfix::after,
            .form-6cc .ff-el-qhz::after,
            .form-6cc .ff-el-repeat .content-mar::after,
            .form-6cc .ff-step-body::after {
                clear: both;
            }

            .form-6cc .text-g1j {
                text-align: right;
            }
        }

        @media (min-width: 768px) {
            .form-7fx .ff-t-r5r {
                display: flex;
                flex-direction: column;
                vertical-align: inherit;
                width: 100%;
            }

            .form-7fx .ff-t-r5r:first-of-type {
                padding-right: 0;
            }

            .form-7fx .ff-t-r5r:last-of-type {
                flex-grow: 1;
                padding-left: 0;
            }
        }

        @media all {
            .form-6cc .ff-el-7d7 {
                border: none;
                border-collapse: collapse;
                display: table;
                width: 100%;
            }

            button {
                color: inherit;
                font: inherit;
                margin: 0;
            }

            button {
                overflow: visible;
            }

            button {
                text-transform: none;
            }

            button {
                -webkit-appearance: button;
                cursor: pointer;
            }

            button {
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }

            button[type="submit"] {
                transition: all 0.25s ease !important;
            }

            .form-6cc .btn-lmc {
                border: 1px solid transparent;
                border-radius: 4px;
                cursor: pointer;
                display: inline-block;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.5;
                padding: 6px 12px;
                position: relative;
                text-align: center;
                transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
                vertical-align: middle;
                white-space: nowrap;
            }

            button[type="submit"]:not(.btn) {
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

            button[type="submit"]:not(.btn) {
                background-color: #dac725;
            }
        }

        form.form-mke .btn-mo3 {
            background-color: #1a7efb;
            color: #ffffff;
        }

        @media all {
            .form-6cc .btn-lmc:hover {
                opacity: .8;
                outline: 0;
                text-decoration: none;
            }

            button[type="submit"]:not(.btn):hover {
                background-color: #333333;
                color: #fff;
            }

            label {
                display: inline-block;
                max-width: 100%;
                margin-bottom: 5px;
                font-weight: 700;
            }

            .form-6cc label {
                font-weight: 400;
            }

            .form-6cc .ff-el-7d7 label.label-frw {
                display: table-row;
            }

            .form-6cc .form-ras label.label-iqv {
                cursor: pointer;
                margin-bottom: 7px;
            }

            .form-6cc .form-ras:last-child label.label-iqv {
                margin-bottom: 0;
            }

            .form-6cc .input-ond {
                display: inline-block;
                margin-bottom: 5px;
                position: relative;
            }
        }

        @media (min-width: 481px) {
            .form-6cc .form-drm .input-ond {
                float: right;
                margin-bottom: 0;
                padding: 10px 0 0 15px;
                width: 180px;
            }
        }

        @media all {
            .form-6cc .form-drm .input-ond {
                float: right;
                margin-bottom: 0;
                padding: 17px 0 0 15px;
                width: 198px;
                margin-top: 11px !important;
            }
        }

        @media (min-width: 481px) {
            .form-6cc .ff-el-qhz.form-drm .input-ond {
                text-align: right;
            }

            .form-6cc .form-drm .content-mar {
                margin-right: 180px;
            }
        }

        @media all {
            span {
                font-family: "cairo", sans-serif !important;
                line-height: normal;
                color: #000;
                letter-spacing: -0.1px;
            }

            .form-6cc .ff-el-7d7 label.label-frw>span {
                padding-top: 8px !important;
                width: 20px;
            }

            .form-6cc .ff-el-7d7 label.label-frw>span {
                display: table-cell;
            }

            .form-6cc .form-ras label.label-iqv>span::after,
            .form-6cc .form-ras label.label-iqv>span::before {
                content: none;
            }

            .form-6cc .ff_-rtr {
                margin: 0;
                padding: 0 0 0 5px;
            }

            .form-6cc .ff-el-7d7 label.label-frw>div {
                display: table-cell;
            }

            .form-6cc .input-ond label {
                display: inline-block;
                font-weight: 600;
                line-height: inherit;
                margin-bottom: 0;
            }

            .form-6cc .input-ond label {
                font-weight: 600 !important;
            }

            .form-6cc .input-ond.ff-el-is-8a6.asterisk-9yx label::after {
                color: #f56c6c;
                content: " *";
                margin-right: 3px;
            }

            .select-rnr {
                cursor: pointer;
                position: relative;
                background: #fff;
                border: 1px solid #e6e6e6;
                box-sizing: border-box;
                min-width: 205px;
            }

            .select-rnr {
                z-index: 500 !important;
            }

            .select-rnr:after {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 15px;
                font-size: 7px;
                font-weight: 300;
            }

            .select-rnr:after {
                content: "";
                right: 15px;
                width: 0;
                height: 0;
                border-style: solid;
                border-width: 6px 4.5px 0 4.5px;
                border-color: #a6a9aa transparent transparent transparent;
                top: 50%;
                transform: translateY(-50%);
            }

            .select-rnr:after {
                right: unset;
                left: 15px;
            }

            .xccgm {
                position: relative;
                display: inline-block;
            }

            .form-6cc .xccgm {
                width: 100%;
            }

            .form-control-27x {
                overflow: hidden;
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

            .form-6cc .form-control-27x {
                background-clip: padding-box;
                background-image: none;
                border: 1px solid #ced4da;
                border-radius: .25rem;
                color: #495057;
                display: block;
                font-size: 16px;
                line-height: 1.5;
                margin-bottom: 0;
                max-width: 100%;
                padding: 6px 12px;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                width: 100%;
            }

            .form-6cc .form-control-27x {
                margin-top: 8px;
                border: 1px solid #dadbdd;
                border-radius: 4px !important;
                color: #606266;
                background: #fafafa;
            }

            input[type="text"] {
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

            input[type="text"] {
                transition: all 0.25s ease !important;
            }

            input[type="text"] {
                padding: 0px 20px;
                line-height: 35px !important;
                margin-top: 13px;
            }

            .form-6cc .ff_-pjz {
                margin-bottom: 0;
            }

            input[type="checkbox"] {
                box-sizing: border-box;
                padding: 0;
            }

            input[type="checkbox"] {
                margin: 4px 0 0;
                margin-top: 1px \9;
                line-height: normal;
            }

            input[type="checkbox"] {
                outline: none !important;
            }

            input[type="checkbox"] {
                margin-right: 5px;
            }

            .form-6cc input[type="checkbox"] {
                display: inline-block;
                margin: 0;
            }

            .form-6cc input[type="checkbox"] {
                -webkit-appearance: checkbox;
            }

            .form-6cc .label-iqv .input-nk3 {
                position: relative;
                top: -3px;
                vertical-align: middle;
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

            .form-6cc .ff_-rtr p {
                margin: 0;
                padding: 0;
            }

            .column-3li :last-child,
            .column-3li p:last-child {
                margin-bottom: 0;
            }

            select {
                color: inherit;
                font: inherit;
                margin: 0;
            }

            select {
                text-transform: none;
            }

            select {
                font-family: inherit;
                font-size: inherit;
                line-height: inherit;
            }

            select {
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

            select {
                padding: 0px 20px;
                line-height: 35px !important;
                margin-top: 13px;
            }

            .select-rnr select {
                opacity: 0;
                position: relative;
                z-index: 100;
                display: none;
            }

            .select-rnr select {
                cursor: pointer;
                display: none !important;
            }

            select.form-control-27x:not([size]):not([multiple]) {
                height: 38px;
            }

            .select-rnr .select-njk {
                width: 100%;
                padding-right: 25px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: block;
                padding: 10px 10px 10px 10px;
                margin-top: 0 !important;
            }

            ul {
                box-sizing: border-box;
            }

            ul {
                margin-top: 0;
                margin-bottom: 10px;
            }

            .dropdown-n2d {
                transition: all 0.3s ease;
                box-shadow: 2px 2px 5px 0 rgba(0, 0, 0, 0.1);
                opacity: 0;
                visibility: hidden;
                position: absolute;
                list-style: none;
                padding: 0;
                top: 100%;
                left: 0;
                right: 0;
                min-height: 150px;
                max-height: 250px;
                overflow-y: scroll;
                border: 1px solid #eee;
                background-color: #fff;
            }

            .column-3li ul {
                list-style: none;
                padding-left: 0;
            }

            .xccgm * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .container-4dm {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                padding: 1px;
            }

            .dropdown-v1e .container-4dm {
                left: auto;
                right: 0;
            }

            .dropdown-v1e .container-4dm:hover {
                cursor: pointer;
            }

            input[type="tel"] {
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

            input[type="tel"] {
                padding: 0px 20px;
                line-height: 35px !important;
                margin-top: 13px;
            }

            .xccgm input,
            .xccgm input[type="tel"] {
                position: relative;
                z-index: 0;
                margin-top: 0 !important;
                margin-bottom: 0 !important;
                padding-left: 36px;
                margin-left: 0;
            }

            .dropdown-v1e input,
            .dropdown-v1e input[type="tel"] {
                padding-left: 6px;
                padding-right: 52px;
                margin-right: 0;
            }

            .form-6cc .btn-xwt.btn-5mm {
                background: #6f757e;
                color: #fff;
                cursor: pointer;
                display: inline-block;
                padding: 10px 20px;
            }

            .form-6cc .btn-xwt.btn-5mm {
                margin-top: 8px !important;
            }

            input[type="file"] {
                display: block;
            }

            .form-6cc .ff-screen-reader-i5l {
                clip: rect(0, 0, 0, 0) !important;
                word-wrap: normal !important;
                border: 0 !important;
                height: 1px !important;
                margin: 0 !important;
                overflow: hidden !important;
                padding: 0 !important;
                position: absolute !important;
                width: 1px !important;
            }

            .select-rnr select option {
                display: none;
                position: absolute;
                left: 10000000%;
            }

            .column-3li ul li {
                position: relative;
                margin-bottom: 11px;
                padding-left: 18px;
            }

            .dropdown-n2d li::before {
                display: none !important;
            }

            .column-3li ul li::before {
                content: "";
                font-size: 18px;
                position: absolute;
                top: 10px;
                left: 0;
                width: 4px;
                height: 4px;
                transform: rotate(45deg);
            }

            .column-3li ul li::before {
                content: "";
                font-size: 18px;
                position: absolute;
                top: 6px;
                left: unset;
                width: 7px;
                height: 7px;
                transform: rotate(45deg);
                right: 0;
            }

            .select-7re {
                z-index: 1;
                position: relative;
                display: flex;
                align-items: center;
                height: 100%;
                padding: 0 8px 0 6px;
            }

            .form-6cc .select-7re {
                background: rgba(0, 0, 0, .1);
            }

            .dropdown-v1e .container-4dm:hover .select-7re {
                background-color: rgba(0, 0, 0, .05);
            }

            .iti-jos {
                display: none;
            }

            .list-jrs {
                position: absolute;
                z-index: 2;
                list-style: none;
                text-align: right;
                padding: 0;
                margin: 0 -1px 0 0;
                box-shadow: -1px 1px 4px rgba(0, 0, 0, .2);
                background-color: #fff;
                border: 1px solid #ccc;
                white-space: nowrap;
                max-height: 200px;
                overflow-y: scroll;
                -webkit-overflow-scrolling: touch;
            }

            input[type="radio"] {
                box-sizing: border-box;
                padding: 0;
            }

            input[type="radio"] {
                margin: 4px 0 0;
                margin-top: 1px \9;
                line-height: normal;
            }

            input[type="radio"] {
                outline: none !important;
            }

            input[type="radio"] {
                margin-right: 5px;
            }

            .form-6cc input[type="radio"] {
                display: inline-block;
                margin: 0;
            }

            .form-6cc input[type="radio"] {
                -webkit-appearance: radio;
            }

            .dropdown-n2d li span {
                transition: all 0.15s ease;
                padding: 10px 15px;
                display: block;
                font-size: 14px;
            }

            .dropdown-n2d li span:hover {
                background-color: #eee;
            }

            .row-vo9 {
                margin-right: 6px;
                width: 0;
                height: 0;
                border-right: 3px solid transparent;
                border-left: 3px solid transparent;
                border-top: 4px solid #555;
            }

            .iti-3ki {
                padding: 5px 10px;
                outline: 0;
            }

            .box-5wj {
                display: inline-block;
                width: 20px;
            }

            .box-5wj {
                vertical-align: middle;
            }

            .box-5wj {
                margin-left: 6px;
            }

            .iti__country-tz6 {
                vertical-align: middle;
            }

            .iti__country-tz6 {
                margin-left: 6px;
            }

            .iti__dial-9ig {
                color: #999;
            }

            .iti__dial-9ig {
                vertical-align: middle;
            }

        }


        #style-HrvSv.style-HrvSv {
            text-align: right;
        }

        #style-D8eJc.style-D8eJc {
            border: none !important;
            margin: 0 !important;
            padding: 0 !important;
            background-color: transparent !important;

            box-shadow: none !important;
            outline: none !important;
        }

        #style-Pszom.style-Pszom {
            margin: 0 !important;
            padding: 0 !important;
            height: 0 !important;
            text-indent: -999999px;
            width: 0 !important;
        }

        #style-Djnqr.style-Djnqr {
            flex-basis: 50%;
        }

        #style-6eOgw.style-6eOgw {
            flex-basis: 50%;
        }

        #style-RizyE.style-RizyE {
            font-size: 12px;
            margin-top: 15px;
        }

        #style-eGJft.style-eGJft {
            font-size: 12px;
            margin-top: 15px;
        }

        #style-c1RkX.style-c1RkX {
            font-size: 12px;
            margin-top: 15px;
        }

        #style-zUUYm.style-zUUYm {
            font-size: 12px;
            margin-top: 15px;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 500;
            color: #555;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .radio-label:hover {
            color: #b28b46;
        }

        .radio-label input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
            max-height: 80vh;
            overflow-y: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .close {
            color: #aaa;
            float: left;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover,
        .close:focus {
            color: #b28b46;
        }

        .modal-title {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 22px;
            border-bottom: 2px solid #b28b46;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #b28b46;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .country-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .country-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s ease;
        }

        .country-section:hover {
            border-color: #b28b46;
        }

        .country-title {
            text-align: center;
            color: #b28b46;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #b68a35;
            color: white !important;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .required {
            color: #e74c3c;
        }

        @media (max-width: 768px) {
            .radio-group {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .country-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                margin: 10% auto;
                padding: 20px;
            }
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        .professional-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .professional-table th {
            background-color: #000000;
            color: white;
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        .professional-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .professional-table input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: right;
            font-size: 14px;
        }

        .professional-table input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .add-row-btn {
            background-color: #28a745 !important;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .add-row-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .actions-cell {
            width: 80px;
        }

        @media (max-width: 768px) {
            .professional-table {
                font-size: 12px;
            }

            .professional-table input {
                padding: 6px;
                font-size: 12px;
            }
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        .professional-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .professional-table th {
            background-color: #000000;
            color: white;
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        .professional-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .professional-table input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: right;
            font-size: 14px;
        }

        .professional-table input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .add-row-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .add-row-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .actions-cell {
            width: 80px;
        }

        @media (max-width: 768px) {
            .professional-table {
                font-size: 12px;
            }

            .professional-table input {
                padding: 6px;
                font-size: 12px;
            }
        }

        .experience-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .experience-table th {
            background-color: #000000;
            color: white;
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        .experience-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .experience-table input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: right;
            font-size: 14px;
        }

        .experience-table input:focus {
            outline: none;
            border-color: #17a2b8;
            box-shadow: 0 0 5px rgba(23, 162, 184, 0.3);
        }

        .add-row-btn,
        .add-exp-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .actions-cell {
            width: 80px;
        }

        @media (max-width: 768px) {
            .experience-table {
                font-size: 12px;
            }

            .experience-table input {
                padding: 6px;
                font-size: 12px;
            }
        }

        #phone-home:after {
            content: "";
        }
    </style>

</head>

<body>
    <div id="renewalModal" class="">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="modal-title" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                {{ __('app.membership_renewal_form_title') }}
            </h3>
            <form id="renewalForm" method="POST" action="{{ route('members.renewal') }}"
                dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                @csrf
                <div class="country-grid">
                    <div class="country-section">
                        <div class="form-group">
                            <label for="membership_id_kw">
                                {{ __('app.membership_id') }} <span class="required">{{
                                    __('app.required_field_indicator') }}</span>
                            </label>
                            <input type="text" id="membership_id_kw" name="membership_id_kw"
                                placeholder="{{ __('app.enter_membership_id') }}">
                        </div>
                        <div class="form-group">
                            <label for="national_id_kw">
                                {{ __('app.national_id') }} <span class="required">{{ __('app.required_field_indicator')
                                    }}</span>
                            </label>
                            <input type="text" id="national_id_kw" name="national_id_kw"
                                placeholder="{{ __('app.enter_national_id') }}">
                        </div>
                        <div class="form-group">
                            <label for="email_kw">
                                {{ __('app.email') }} <span class="required">{{ __('app.required_field_indicator')
                                    }}</span>
                            </label>
                            <input type="email" id="email_kw" name="email_kw"
                                placeholder="{{ __('app.email_placeholder') }}">
                        </div>
                        <!-- reCAPTCHA -->
                        <div class="mb-os5" style="margin-bottom: 15px; margin-top: 15px;">
                            <div class="g-recaptcha" data-sitekey="6Le8MSgsAAAAACpmYLs_Rzga_iIewZ-qCDPAN0MD">
                            </div>
                            <div class="error-message" id="recaptcha-error"
                                style="display: none; color: #dc3545; font-size: 0.875rem; margin-top: 5px;">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-btn"
                    style="color: white !important; background-color: #b68a35 !important;">
                    {{ __('app.confirm_renewal') }}
                </button>
            </form>
        </div>
    </div>
    <x-guest-header></x-guest-header>

    <div id="in-cont" style="padding-top: 150px">
        <div class="container-5vw container-aon vc_-onj">
            <div class="row-dq5 column-hf7 row-g2e content-375 row-r5g">
                <div class="container-sho">
                    <div class="row-d6o">
                        <div class="container-gnx col-46s">
                            <div class="column-jzp">
                                <div>
                                    <div class="column-3li content-y8i vc_-cx1 header-ac9">
                                        <div>
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif

                                            <h2 id="style-HrvSv" class="style-HrvSv">{{
                                                __('app.membership_renewal_form_title') }}</h2>

                                            <div class="radio-group"
                                                dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                                                <label class="radio-label" for="new1">
                                                    <span>{{ __('app.new') }}</span>
                                                    <input id="new1" name="membership_type" type="radio" value="new">
                                                </label>
                                                <label class="radio-label" for="renewal">
                                                    <span>{{ __('app.renewal') }}</span>
                                                    <input id="renewal" name="membership_type" type="radio"
                                                        value="renewal">
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div id="newMembershipContent" class="column-3li content-y8i" style="display: none;">
                                    <div>
                                        <div class="form-6cc">
                                            <form class="form-7fx form-mke"
                                                action="{{ route('members.application.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="container-8ka container-gx5 column-p79">
                                                    <div class="ff-t-r5r style-Djnqr" id="style-Djnqr">
                                                        <div>
                                                            <div class="container-8ka">
                                                                <div class="ff-t-r5r">
                                                                    <div class="ff-el-qhz">
                                                                        <div
                                                                            class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                            <label for="ff_3_full_name">{{
                                                                                __('app.full_name') }}</label>
                                                                        </div>
                                                                        <div class="content-mar">
                                                                            <input type="text" name="full_name" required
                                                                                id="ff_3_full_name"
                                                                                class="form-control-27x"
                                                                                placeholder="{{ __('app.full_name_placeholder') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ff-t-r5r">
                                                                    <div class="ff-el-qhz">
                                                                        <div
                                                                            class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                            <label for="ff_3_nationality">{{
                                                                                __('app.nationality') }}</label>
                                                                        </div>
                                                                        <select name="nationality" id="ff_3_nationality"
                                                                            class="form-control-27x" required>

                                                                            <option value="">{{ __('app.select') }}
                                                                            </option>
                                                                            <option value="أفغانستان">{{
                                                                                __('app.afghanistan') }}</option>
                                                                            <option value="ألبانيا">{{ __('app.albania')
                                                                                }}</option>
                                                                            <option value="الجزائر">{{ __('app.algeria')
                                                                                }}</option>
                                                                            <option value="أندورا">{{ __('app.andorra')
                                                                                }}</option>
                                                                            <option value="أنغولا">{{ __('app.angola')
                                                                                }}</option>
                                                                            <option value="أنتيغوا وباربودا">{{
                                                                                __('app.antigua_and_barbuda') }}
                                                                            </option>
                                                                            <option value="الأرجنتين">{{
                                                                                __('app.argentina') }}</option>
                                                                            <option value="أرمينيا">{{ __('app.armenia')
                                                                                }}</option>
                                                                            <option value="أستراليا">{{
                                                                                __('app.australia') }}</option>
                                                                            <option value="النمسا">{{ __('app.austria')
                                                                                }}</option>
                                                                            <option value="أذربيجان">{{
                                                                                __('app.azerbaijan') }}</option>
                                                                            <option value="البهاما">{{ __('app.bahamas')
                                                                                }}</option>
                                                                            <option value="البحرين">{{ __('app.bahrain')
                                                                                }}</option>
                                                                            <option value="بنغلاديش">{{
                                                                                __('app.bangladesh') }}</option>
                                                                            <option value="بربادوس">{{
                                                                                __('app.barbados') }}</option>
                                                                            <option value="بيلاروسيا">{{
                                                                                __('app.belarus') }}</option>
                                                                            <option value="بلجيكا">{{ __('app.belgium')
                                                                                }}</option>
                                                                            <option value="بليز">{{ __('app.belize') }}
                                                                            </option>
                                                                            <option value="بنين">{{ __('app.benin') }}
                                                                            </option>
                                                                            <option value="بوتان">{{ __('app.bhutan') }}
                                                                            </option>
                                                                            <option value="بوليفيا">{{ __('app.bolivia')
                                                                                }}</option>
                                                                            <option value="البوسنة والهرسك">{{
                                                                                __('app.bosnia_and_herzegovina') }}
                                                                            </option>
                                                                            <option value="بوتسوانا">{{
                                                                                __('app.botswana') }}</option>
                                                                            <option value="البرازيل">{{ __('app.brazil')
                                                                                }}</option>
                                                                            <option value="بروناي">{{ __('app.brunei')
                                                                                }}</option>
                                                                            <option value="بلغاريا">{{
                                                                                __('app.bulgaria') }}</option>
                                                                            <option value="بوركينا فاسو">{{
                                                                                __('app.burkina_faso') }}</option>
                                                                            <option value="بوروندي">{{ __('app.burundi')
                                                                                }}</option>
                                                                            <option value="كمبوديا">{{
                                                                                __('app.cambodia') }}</option>
                                                                            <option value="الكاميرون">{{
                                                                                __('app.cameroon') }}</option>
                                                                            <option value="كندا">{{ __('app.canada') }}
                                                                            </option>
                                                                            <option value="الرأس الأخضر">{{
                                                                                __('app.cape_verde') }}</option>
                                                                            <option value="جمهورية أفريقيا الوسطى">{{
                                                                                __('app.central_african_republic') }}
                                                                            </option>
                                                                            <option value="تشاد">{{ __('app.chad') }}
                                                                            </option>
                                                                            <option value="تشيلي">{{ __('app.chile') }}
                                                                            </option>
                                                                            <option value="الصين">{{ __('app.china') }}
                                                                            </option>
                                                                            <option value="كولومبيا">{{
                                                                                __('app.colombia') }}</option>
                                                                            <option value="جزر القمر">{{
                                                                                __('app.comoros') }}</option>
                                                                            <option value="الكونغو">{{ __('app.congo')
                                                                                }}</option>
                                                                            <option value="جمهورية الكونغو الديمقراطية">
                                                                                {{
                                                                                __('app.democratic_republic_of_congo')
                                                                                }}</option>
                                                                            <option value="كوستاريكا">{{
                                                                                __('app.costa_rica') }}</option>
                                                                            <option value="ساحل العاج">{{
                                                                                __('app.cote_d_ivoire') }}</option>
                                                                            <option value="كرواتيا">{{ __('app.croatia')
                                                                                }}</option>
                                                                            <option value="كوبا">{{ __('app.cuba') }}
                                                                            </option>
                                                                            <option value="قبرص">{{ __('app.cyprus') }}
                                                                            </option>
                                                                            <option value="التشيك">{{
                                                                                __('app.czech_republic') }}</option>
                                                                            <option value="الدنمارك">{{
                                                                                __('app.denmark') }}</option>
                                                                            <option value="جيبوتي">{{ __('app.djibouti')
                                                                                }}</option>
                                                                            <option value="دومينيكا">{{
                                                                                __('app.dominica') }}</option>
                                                                            <option value="جمهورية الدومينيك">{{
                                                                                __('app.dominican_republic') }}</option>
                                                                            <option value="الإكوادور">{{
                                                                                __('app.ecuador') }}</option>
                                                                            <option value="مصر">{{ __('app.egypt') }}
                                                                            </option>
                                                                            <option value="السلفادور">{{
                                                                                __('app.el_salvador') }}</option>
                                                                            <option value="غينيا الاستوائية">{{
                                                                                __('app.equatorial_guinea') }}</option>
                                                                            <option value="إريتريا">{{ __('app.eritrea')
                                                                                }}</option>
                                                                            <option value="إستونيا">{{ __('app.estonia')
                                                                                }}</option>
                                                                            <option value="إسواتيني">{{
                                                                                __('app.eswatini') }}</option>
                                                                            <option value="إثيوبيا">{{
                                                                                __('app.ethiopia') }}</option>
                                                                            <option value="فيجي">{{ __('app.fiji') }}
                                                                            </option>
                                                                            <option value="فنلندا">{{ __('app.finland')
                                                                                }}</option>
                                                                            <option value="فرنسا">{{ __('app.france') }}
                                                                            </option>
                                                                            <option value="الغابون">{{ __('app.gabon')
                                                                                }}</option>
                                                                            <option value="غامبيا">{{ __('app.gambia')
                                                                                }}</option>
                                                                            <option value="جورجيا">{{ __('app.georgia')
                                                                                }}</option>
                                                                            <option value="ألمانيا">{{ __('app.germany')
                                                                                }}</option>
                                                                            <option value="غانا">{{ __('app.ghana') }}
                                                                            </option>
                                                                            <option value="اليونان">{{ __('app.greece')
                                                                                }}</option>
                                                                            <option value="غرينادا">{{ __('app.grenada')
                                                                                }}</option>
                                                                            <option value="غواتيمالا">{{
                                                                                __('app.guatemala') }}</option>
                                                                            <option value="غينيا">{{ __('app.guinea') }}
                                                                            </option>
                                                                            <option value="غينيا بيساو">{{
                                                                                __('app.guinea_bissau') }}</option>
                                                                            <option value="غويانا">{{ __('app.guyana')
                                                                                }}</option>
                                                                            <option value="هايتي">{{ __('app.haiti') }}
                                                                            </option>
                                                                            <option value="هندوراس">{{
                                                                                __('app.honduras') }}</option>
                                                                            <option value="المجر">{{ __('app.hungary')
                                                                                }}</option>
                                                                            <option value="آيسلندا">{{ __('app.iceland')
                                                                                }}</option>
                                                                            <option value="الهند">{{ __('app.india') }}
                                                                            </option>
                                                                            <option value="إندونيسيا">{{
                                                                                __('app.indonesia') }}</option>
                                                                            <option value="إيران">{{ __('app.iran') }}
                                                                            </option>
                                                                            <option value="العراق">{{ __('app.iraq') }}
                                                                            </option>
                                                                            <option value="أيرلندا">{{ __('app.ireland')
                                                                                }}</option>
                                                                            <option value="إسرائيل">{{ __('app.israel')
                                                                                }}</option>
                                                                            <option value="إيطاليا">{{ __('app.italy')
                                                                                }}</option>
                                                                            <option value="جامايكا">{{ __('app.jamaica')
                                                                                }}</option>
                                                                            <option value="اليابان">{{ __('app.japan')
                                                                                }}</option>
                                                                            <option value="الأردن">{{ __('app.jordan')
                                                                                }}</option>
                                                                            <option value="كازاخستان">{{
                                                                                __('app.kazakhstan') }}</option>
                                                                            <option value="كينيا">{{ __('app.kenya') }}
                                                                            </option>
                                                                            <option value="كيريباتي">{{
                                                                                __('app.kiribati') }}</option>
                                                                            <option value="كوريا الشمالية">{{
                                                                                __('app.north_korea') }}</option>
                                                                            <option value="كوريا الجنوبية">{{
                                                                                __('app.south_korea') }}</option>
                                                                            <option value="الكويت">{{ __('app.kuwait')
                                                                                }}</option>
                                                                            <option value="قيرغيزستان">{{
                                                                                __('app.kyrgyzstan') }}</option>
                                                                            <option value="لاوس">{{ __('app.laos') }}
                                                                            </option>
                                                                            <option value="لاتفيا">{{ __('app.latvia')
                                                                                }}</option>
                                                                            <option value="لبنان">{{ __('app.lebanon')
                                                                                }}</option>
                                                                            <option value="ليسوتو">{{ __('app.lesotho')
                                                                                }}</option>
                                                                            <option value="ليبيريا">{{ __('app.liberia')
                                                                                }}</option>
                                                                            <option value="ليبيا">{{ __('app.libya') }}
                                                                            </option>
                                                                            <option value="ليختنشتاين">{{
                                                                                __('app.liechtenstein') }}</option>
                                                                            <option value="ليتوانيا">{{
                                                                                __('app.lithuania') }}</option>
                                                                            <option value="لوكسمبورغ">{{
                                                                                __('app.luxembourg') }}</option>
                                                                            <option value="مدغشقر">{{
                                                                                __('app.madagascar') }}</option>
                                                                            <option value="ملاوي">{{ __('app.malawi') }}
                                                                            </option>
                                                                            <option value="ماليزيا">{{
                                                                                __('app.malaysia') }}</option>
                                                                            <option value="المالديف">{{
                                                                                __('app.maldives') }}</option>
                                                                            <option value="مالي">{{ __('app.mali') }}
                                                                            </option>
                                                                            <option value="مالطا">{{ __('app.malta') }}
                                                                            </option>
                                                                            <option value="جزر مارشال">{{
                                                                                __('app.marshall_islands') }}</option>
                                                                            <option value="موريتانيا">{{
                                                                                __('app.mauritania') }}</option>
                                                                            <option value="موريشيوس">{{
                                                                                __('app.mauritius') }}</option>
                                                                            <option value="المكسيك">{{ __('app.mexico')
                                                                                }}</option>
                                                                            <option value="ميكرونيسيا">{{
                                                                                __('app.micronesia') }}</option>
                                                                            <option value="مولدوفا">{{ __('app.moldova')
                                                                                }}</option>
                                                                            <option value="موناكو">{{ __('app.monaco')
                                                                                }}</option>
                                                                            <option value="منغوليا">{{
                                                                                __('app.mongolia') }}</option>
                                                                            <option value="الجبل الأسود">{{
                                                                                __('app.montenegro') }}</option>
                                                                            <option value="المغرب">{{ __('app.morocco')
                                                                                }}</option>
                                                                            <option value="موزمبيق">{{
                                                                                __('app.mozambique') }}</option>
                                                                            <option value="ميانمار">{{ __('app.myanmar')
                                                                                }}</option>
                                                                            <option value="ناميبيا">{{ __('app.namibia')
                                                                                }}</option>
                                                                            <option value="ناورو">{{ __('app.nauru') }}
                                                                            </option>
                                                                            <option value="نيبال">{{ __('app.nepal') }}
                                                                            </option>
                                                                            <option value="هولندا">{{
                                                                                __('app.netherlands') }}</option>
                                                                            <option value="نيوزيلندا">{{
                                                                                __('app.new_zealand') }}</option>
                                                                            <option value="نيكاراغوا">{{
                                                                                __('app.nicaragua') }}</option>
                                                                            <option value="النيجر">{{ __('app.niger') }}
                                                                            </option>
                                                                            <option value="نيجيريا">{{ __('app.nigeria')
                                                                                }}</option>
                                                                            <option value="مقدونيا الشمالية">{{
                                                                                __('app.north_macedonia') }}</option>
                                                                            <option value="النرويج">{{ __('app.norway')
                                                                                }}</option>
                                                                            <option value="عُمان">{{ __('app.oman') }}
                                                                            </option>
                                                                            <option value="باكستان">{{
                                                                                __('app.pakistan') }}</option>
                                                                            <option value="بالاو">{{ __('app.palau') }}
                                                                            </option>
                                                                            <option value="فلسطين">{{
                                                                                __('app.palestine') }}</option>
                                                                            <option value="بنما">{{ __('app.panama') }}
                                                                            </option>
                                                                            <option value="بابوا غينيا الجديدة">{{
                                                                                __('app.papua_new_guinea') }}</option>
                                                                            <option value="باراغواي">{{
                                                                                __('app.paraguay') }}</option>
                                                                            <option value="بيرو">{{ __('app.peru') }}
                                                                            </option>
                                                                            <option value="الفلبين">{{
                                                                                __('app.philippines') }}</option>
                                                                            <option value="بولندا">{{ __('app.poland')
                                                                                }}</option>
                                                                            <option value="البرتغال">{{
                                                                                __('app.portugal') }}</option>
                                                                            <option value="قطر">{{ __('app.qatar') }}
                                                                            </option>
                                                                            <option value="رومانيا">{{ __('app.romania')
                                                                                }}</option>
                                                                            <option value="روسيا">{{ __('app.russia') }}
                                                                            </option>
                                                                            <option value="رواندا">{{ __('app.rwanda')
                                                                                }}</option>
                                                                            <option value="سانت كيتس ونيفيس">{{
                                                                                __('app.saint_kitts_and_nevis') }}
                                                                            </option>
                                                                            <option value="سانت لوسيا">{{
                                                                                __('app.saint_lucia') }}</option>
                                                                            <option value="سانت فنسنت والغرينادين">{{
                                                                                __('app.saint_vincent_and_the_grenadines')
                                                                                }}</option>
                                                                            <option value="ساموا">{{ __('app.samoa') }}
                                                                            </option>
                                                                            <option value="سان مارينو">{{
                                                                                __('app.san_marino') }}</option>
                                                                            <option value="ساو تومي وبرينسيبي">{{
                                                                                __('app.sao_tome_and_principe') }}
                                                                            </option>
                                                                            <option value="السعودية">{{
                                                                                __('app.saudi_arabia') }}</option>
                                                                            <option value="السنغال">{{ __('app.senegal')
                                                                                }}</option>
                                                                            <option value="صربيا">{{ __('app.serbia') }}
                                                                            </option>
                                                                            <option value="سيشل">{{ __('app.seychelles')
                                                                                }}</option>
                                                                            <option value="سيراليون">{{
                                                                                __('app.sierra_leone') }}</option>
                                                                            <option value="سنغافورة">{{
                                                                                __('app.singapore') }}</option>
                                                                            <option value="سلوفاكيا">{{
                                                                                __('app.slovakia') }}</option>
                                                                            <option value="سلوفينيا">{{
                                                                                __('app.slovenia') }}</option>
                                                                            <option value="جزر سليمان">{{
                                                                                __('app.solomon_islands') }}</option>
                                                                            <option value="الصومال">{{ __('app.somalia')
                                                                                }}</option>
                                                                            <option value="جنوب أفريقيا">{{
                                                                                __('app.south_africa') }}</option>
                                                                            <option value="جنوب السودان">{{
                                                                                __('app.south_sudan') }}</option>
                                                                            <option value="إسبانيا">{{ __('app.spain')
                                                                                }}</option>
                                                                            <option value="سريلانكا">{{
                                                                                __('app.sri_lanka') }}</option>
                                                                            <option value="السودان">{{ __('app.sudan')
                                                                                }}</option>
                                                                            <option value="سورينام">{{
                                                                                __('app.suriname') }}</option>
                                                                            <option value="السويد">{{ __('app.sweden')
                                                                                }}</option>
                                                                            <option value="سويسرا">{{
                                                                                __('app.switzerland') }}</option>
                                                                            <option value="سوريا">{{ __('app.syria') }}
                                                                            </option>
                                                                            <option value="تايوان">{{ __('app.taiwan')
                                                                                }}</option>
                                                                            <option value="طاجيكستان">{{
                                                                                __('app.tajikistan') }}</option>
                                                                            <option value="تنزانيا">{{
                                                                                __('app.tanzania') }}</option>
                                                                            <option value="تايلاند">{{
                                                                                __('app.thailand') }}</option>
                                                                            <option value="تيمور الشرقية">{{
                                                                                __('app.timor_leste') }}</option>
                                                                            <option value="توغو">{{ __('app.togo') }}
                                                                            </option>
                                                                            <option value="تونغا">{{ __('app.tonga') }}
                                                                            </option>
                                                                            <option value="ترينيداد وتوباغو">{{
                                                                                __('app.trinidad_and_tobago') }}
                                                                            </option>
                                                                            <option value="تونس">{{ __('app.tunisia') }}
                                                                            </option>
                                                                            <option value="تركيا">{{ __('app.turkey') }}
                                                                            </option>
                                                                            <option value="تركمانستان">{{
                                                                                __('app.turkmenistan') }}</option>
                                                                            <option value="توفالو">{{ __('app.tuvalu')
                                                                                }}</option>
                                                                            <option value="أوغندا">{{ __('app.uganda')
                                                                                }}</option>
                                                                            <option value="أوكرانيا">{{
                                                                                __('app.ukraine') }}</option>
                                                                            <option value="الإمارات العربية المتحدة">{{
                                                                                __('app.united_arab_emirates') }}
                                                                            </option>
                                                                            <option value="المملكة المتحدة">{{
                                                                                __('app.united_kingdom') }}</option>
                                                                            <option value="الولايات المتحدة الأمريكية">
                                                                                {{ __('app.united_states') }}</option>
                                                                            <option value="أوروغواي">{{
                                                                                __('app.uruguay') }}</option>
                                                                            <option value="أوزبكستان">{{
                                                                                __('app.uzbekistan') }}</option>
                                                                            <option value="فانواتو">{{ __('app.vanuatu')
                                                                                }}</option>
                                                                            <option value="الفاتيكان">{{
                                                                                __('app.vatican_city') }}</option>
                                                                            <option value="فنزويلا">{{
                                                                                __('app.venezuela') }}</option>
                                                                            <option value="فيتنام">{{ __('app.vietnam')
                                                                                }}</option>
                                                                            <option value="اليمن">{{ __('app.yemen') }}
                                                                            </option>
                                                                            <option value="زامبيا">{{ __('app.zambia')
                                                                                }}</option>
                                                                            <option value="زيمبابوي">{{
                                                                                __('app.zimbabwe') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_date_of_birth">{{
                                                                    __('app.date_of_birth') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="date" required name="date_of_birth"
                                                                    id="ff_3_date_of_birth" class="form-control-27x">

                                                            </div>
                                                        </div>
                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_gender">{{ __('app.gender') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select required name="gender" id="ff_3_gender"
                                                                    class="form-control-27x">

                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="male">{{ __('app.male') }}</option>
                                                                    <option value="female">{{ __('app.female') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_emirate">{{ __('app.emirate')
                                                                    }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select name="emirate" id="ff_3_emirate"
                                                                    class="form-control-27x">
                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="أبو ظبي">{{ __('app.abu_dhabi') }}
                                                                    </option>
                                                                    <option value="دبي">{{ __('app.dubai') }}</option>
                                                                    <option value="الشارقة">{{ __('app.sharjah') }}
                                                                    </option>
                                                                    <option value="عجمان">{{ __('app.ajman') }}</option>
                                                                    <option value="الفجيرة">{{ __('app.fujairah') }}
                                                                    </option>
                                                                    <option value="راس الخيمة">{{
                                                                        __('app.ras_al_khaimah') }}</option>
                                                                    <option value="أم القيوين">{{ __('app.um_al_quwain')
                                                                        }}</option>
                                                                    <option value="العين">{{ __('app.al_ain') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_marital_status">{{
                                                                    __('app.marital_status') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select name="marital_status" id="ff_3_marital_status"
                                                                    class="form-control-27x">
                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="single">{{ __('app.single') }}
                                                                    </option>
                                                                    <option value="married">{{ __('app.married') }}
                                                                    </option>
                                                                    <option value="divorced">{{ __('app.divorced') }}
                                                                    </option>
                                                                    <option value="widowed">{{ __('app.widowed') }}
                                                                    </option>
                                                                    <option value="separated">{{ __('app.separated') }}
                                                                    </option>
                                                                    <option value="engaged">{{ __('app.engaged') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_national_id">{{ __('app.national_id')
                                                                    }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="text" name="national_id"
                                                                    id="ff_3_national_id" class="form-control-27x"
                                                                    placeholder="{{ __('app.national_id_placeholder') }}">
                                                            </div>
                                                        </div>
                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_educational_qualification">{{
                                                                    __('app.educational_qualification') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select name="educational_qualification"
                                                                    id="ff_3_educational_qualification"
                                                                    class="form-control-27x">
                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="دكتوراه">{{ __('app.doctorate') }}
                                                                    </option>
                                                                    <option value="ماجيستير">{{ __('app.masters') }}
                                                                    </option>
                                                                    <option value="بكالوريوس">{{ __('app.bachelors') }}
                                                                    </option>
                                                                    <option value="دبلوم">{{ __('app.diploma') }}
                                                                    </option>
                                                                    <option value="ثانوي">{{ __('app.secondary') }}
                                                                    </option>
                                                                    <option value="اعدادي">{{ __('app.preparatory') }}
                                                                    </option>
                                                                    <option value="ابتدائي">{{ __('app.primary') }}
                                                                    </option>
                                                                    <option value="غير ذلك">{{ __('app.other') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="ff-t-r5r style-6eOgw" id="style-6eOgw">
                                                        <h3 id="style-HrvSv" class="style-HrvSv"
                                                            style="margin-top: 30px;">{{
                                                            __('app.registration_requirements') }}</h3>

                                                        <div class="ff-el-qhz form-drm">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_passport_photo">{{
                                                                    __('app.passport_photo') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <label class="ff_-pjz">
                                                                    <span class="btn-xwt btn-5mm">{{
                                                                        __('app.choose_file') }}</span>
                                                                    <input type="file" name="passport_photo"
                                                                        id="ff_3_passport_photo" required
                                                                        class="form-control-27x ff-screen-reader-i5l">
                                                                </label>
                                                                <div class="style-RizyE" id="style-RizyE"></div>
                                                                <img id="preview_passport_photo" src="#"
                                                                    alt="{{ __('app.passport_photo_preview') }}"
                                                                    style="display: none; max-width: 200px; margin-top: 10px;">
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz form-drm">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_national_id_photo">{{
                                                                    __('app.national_id_photo') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <label class="ff_-pjz">
                                                                    <span class="btn-xwt btn-5mm">{{
                                                                        __('app.choose_file') }}</span>
                                                                    <input type="file" name="national_id_photo"
                                                                        id="ff_3_national_id_photo" required
                                                                        class="form-control-27x ff-screen-reader-i5l">

                                                                </label>
                                                                <div class="style-c1RkX" id="style-c1RkX"></div>
                                                                <img id="preview_national_id_photo" src="#"
                                                                    alt="{{ __('app.national_id_photo_preview') }}"
                                                                    style="display: none; max-width: 200px; margin-top: 10px;">
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz form-drm">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_personal_photo">{{
                                                                    __('app.personal_photo') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <label class="ff_-pjz">
                                                                    <span class="btn-xwt btn-5mm">{{
                                                                        __('app.choose_file') }}</span>
                                                                    <input type="file" name="personal_photo"
                                                                        id="ff_3_personal_photo" required
                                                                        class="form-control-27x ff-screen-reader-i5l">

                                                                </label>
                                                                <div class="style-eGJft" id="style-eGJft"></div>
                                                                <img id="preview_personal_photo" src="#"
                                                                    alt="{{ __('app.personal_photo_preview') }}"
                                                                    style="display: none; max-width: 200px; margin-top: 10px;">
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz form-drm">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_educational_qualification_photo">{{
                                                                    __('app.educational_qualification_photo') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <label class="ff_-pjz">
                                                                    <span class="btn-xwt btn-5mm">{{
                                                                        __('app.choose_file') }}</span>
                                                                    <input type="file"
                                                                        name="educational_qualification_photo" required
                                                                        id="ff_3_educational_qualification_photo"
                                                                        class="form-control-27x ff-screen-reader-i5l">
                                                                </label>
                                                                <div class="style-zUUYm" id="style-zUUYm"></div>
                                                                <img id="preview_educational_qualification_photo"
                                                                    src="#"
                                                                    alt="{{ __('app.educational_qualification_photo_preview') }}"
                                                                    style="display: none; max-width: 200px; margin-top: 10px;">
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz form-drm">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_retirement_card_photo">{{
                                                                    __('app.retirement_card_photo') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <label class="ff_-pjz">
                                                                    <span class="btn-xwt btn-5mm">{{
                                                                        __('app.choose_file') }}</span>
                                                                    <input type="file" name="retirement_card_photo"
                                                                        required id="ff_3_retirement_card_photo"
                                                                        class="form-control-27x ff-screen-reader-i5l">
                                                                </label>
                                                                <div class="style-zUUYm" id="style-zUUYm"></div>
                                                                <img id="preview_retirement_card_photo" src="#"
                                                                    alt="{{ __('app.retirement_card_photo_preview') }}"
                                                                    style="display: none; max-width: 200px; margin-top: 10px;">
                                                            </div>
                                                        </div>

                                                        <div class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_gender">{{ __('app.pension') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select required name="pension" id="ff_3_gender"
                                                                    class="form-control-27x">
                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="pensions_and_social">{{
                                                                        __('app.pensions_and_social') }}</option>
                                                                    <option value="sharjah_social">{{
                                                                        __('app.sharjah_social') }}</option>
                                                                    <option value="dubai_social">{{
                                                                        __('app.dubai_social') }}</option>
                                                                    <option value="pensions__social">{{
                                                                        __('app.pensions__social') }}</option>
                                                                    <option value="ministry_of_defense">{{
                                                                        __('app.ministry_of_defense') }}</option>
                                                                    <option value="ministry_of_interior">{{
                                                                        __('app.ministry_of_interior') }}</option>
                                                                    <option value="police_dubai">{{
                                                                        __('app.police_dubai') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>


                                                <div>
                                                    <h3 id="style-HrvSv" class="style-HrvSv" style="margin-top: 30px;">
                                                        {{ __('app.contact_details') }}</h3>
                                                    <div style="display: flex; align-items: center; gap: 20px;">
                                                        <div style="width: 50%;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_mobile_phone">{{ __('app.mobile_phone')
                                                                    }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="text" name="mobile_phone"
                                                                    id="ff_3_mobile_phone" class="form-control-27x"
                                                                    placeholder="{{ __('app.mobile_phone_placeholder') }}">
                                                            </div>
                                                        </div>
                                                        <div style="width: 50%; margin-bottom: 20px;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label id="phone-home" for="ff_3_home_phone">{{
                                                                    __('app.home_phone') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="text" name="home_phone"
                                                                    id="ff_3_home_phone" class="form-control-27x"
                                                                    placeholder="{{ __('app.home_phone_placeholder') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="display: flex; align-items: center; gap: 20px;">
                                                        <div style="width: 50%;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_email">{{ __('app.email') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="email" name="email" id="ff_3_email"
                                                                    class="form-control-27x"
                                                                    placeholder="{{ __('app.email_placeholder') }}">
                                                            </div>
                                                        </div>
                                                        <div style="width: 50%; margin-bottom: 20px;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label id="phone-home" for="ff_3_po_box">{{
                                                                    __('app.po_box') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="text" name="po_box" id="ff_3_po_box"
                                                                    class="form-control-27x"
                                                                    placeholder="{{ __('app.po_box_placeholder') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 id="style-HrvSv" class="style-HrvSv" style="margin-top: 30px;">
                                                        {{ __('app.retirement_details') }}</h3>
                                                    <div style="display: flex; align-items: center; gap: 20px;">
                                                        <div style="width: 50%;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_retirement_date">{{
                                                                    __('app.retirement_date') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <input type="date" name="retirement_date"
                                                                    id="ff_3_retirement_date" class="form-control-27x">
                                                            </div>
                                                        </div>
                                                        <div style="width: 50%; margin-bottom: 20px;" class="ff-el-qhz">
                                                            <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                                <label for="ff_3_contract_type">{{
                                                                    __('app.contract_type') }}</label>
                                                            </div>
                                                            <div class="content-mar">
                                                                <select name="contract_type" id="ff_3_contract_type"
                                                                    class="form-control-27x">
                                                                    <option value="">{{ __('app.select') }}</option>
                                                                    <option value="نظامي">{{ __('app.regular') }}
                                                                    </option>
                                                                    <option value="مبكر">{{ __('app.early') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ff-el-qhz" id="early_reason_container"
                                                        style="display: none;">
                                                        <div class="input-ond ff-el-is-8a6 asterisk-9yx">
                                                            <label for="early_reason">{{ __('app.early_reason')
                                                                }}</label>
                                                        </div>
                                                        <div class="content-mar">
                                                            <input type="text" name="early_reason" id="early_reason"
                                                                class="form-control-27x"
                                                                placeholder="{{ __('app.early_reason_placeholder') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 id="style-HrvSv" class="style-HrvSv" style="margin-top: 30px;">{{
                                                    __('app.previous_professional_details') }}</h3>
                                                <div class="table-container">
                                                    <table class="professional-table" id="professionalTable">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('app.year') }}</th>
                                                                <th>{{ __('app.job_title') }}</th>
                                                                <th>{{ __('app.employer') }}</th>
                                                                <th>{{ __('app.years_of_experience') }}</th>
                                                                <th class="actions-cell">{{ __('app.actions') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="professionalTableBody">
                                                            <tr>
                                                                <td><input type="text" required
                                                                        name="professional_experience[0][year]"
                                                                        placeholder="{{ __('app.example_year_range') }}">
                                                                </td>
                                                                <td><input type="text" required
                                                                        name="professional_experience[0][job_title]"
                                                                        placeholder="{{ __('app.example_job_title') }}">
                                                                </td>
                                                                <td><input type="text" required
                                                                        name="professional_experience[0][employer]"
                                                                        placeholder="{{ __('app.example_employer') }}">
                                                                </td>
                                                                <td><input type="text" required
                                                                        name="professional_experience[0][years_of_experience]"
                                                                        placeholder="{{ __('app.example_years_exp') }}">
                                                                </td>
                                                                <td class="actions-cell">
                                                                    <button type="button" class="delete-btn"
                                                                        onclick="deleteProfessionalRow(this)">{{
                                                                        __('app.delete') }}</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="button" class="add-row-btn"
                                                    onclick="addNewProfessionalRow()">{{ __('app.add_professional_data')
                                                    }}</button>
                                                <div class="container">
                                                    <h3 id="style-HrvSv2" class="style-HrvSv" style="margin-top: 30px;">
                                                        {{ __('app.previous_experiences') }}</h3>
                                                    <div class="table-container">
                                                        <table class="experience-table" id="experienceTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('app.year') }}</th>
                                                                    <th>{{ __('app.job_title') }}</th>
                                                                    <th>{{ __('app.employer') }}</th>
                                                                    <th>{{ __('app.years_of_experience') }}</th>
                                                                    <th class="actions-cell">{{ __('app.actions') }}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="experienceTableBody">
                                                                <tr>
                                                                    <td><input type="text" required
                                                                            name="previous_experience[0][year]"
                                                                            placeholder="{{ __('app.example_year_range') }}">
                                                                    </td>
                                                                    <td><input type="text" required
                                                                            name="previous_experience[0][job_title]"
                                                                            placeholder="{{ __('app.example_project_manager') }}">
                                                                    </td>
                                                                    <td><input type="text" required
                                                                            name="previous_experience[0][employer]"
                                                                            placeholder="{{ __('app.example_construction_company') }}">
                                                                    </td>
                                                                    <td><input type="text" required
                                                                            name="previous_experience[0][years_of_experience]"
                                                                            placeholder="{{ __('app.example_years_exp') }}">
                                                                    </td>
                                                                    <td class="actions-cell">
                                                                        <button type="button" class="delete-btn"
                                                                            onclick="deleteExperienceRow(this)">{{
                                                                            __('app.delete') }}</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="add-exp-btn"
                                                        onclick="addNewExperienceRow()">{{ __('app.add_experience')
                                                        }}</button>
                                                </div>

                                                <!-- reCAPTCHA -->
                                                <div class="mb-os5" style="margin-bottom: 15px; margin-top: 15px;">
                                                    <div class="g-recaptcha"
                                                        data-sitekey="6Le8MSgsAAAAACpmYLs_Rzga_iIewZ-qCDPAN0MD">
                                                    </div>
                                                    <div class="error-message" id="recaptcha-error"
                                                        style="display: none; color: #dc3545; font-size: 0.875rem; margin-top: 5px;">
                                                    </div>
                                                </div>
                                                <div class="ff-el-qhz content-mar">
                                                    <div class="form-ras ff-el-7d7">
                                                        <label class="label-iqv label-frw"
                                                            for="terms-n-condition_726ef60f0da1bb731535cda34122e01f">
                                                            <span><input type="checkbox" name="terms-n-condition"
                                                                    class="input-nk3" id="ter-6zo" value="on"></span>
                                                            <div class="ff_-rtr">
                                                                <p>{{ __('app.agree_terms_and_privacy') }}</p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="ff-el-qhz text-g1j">
                                                    <button type="submit" class="btn-5mm btn-mo3 btn-lmc"
                                                        style="background-color: #b28b46 !important; color: white !important;">{{
                                                        __('app.submit_application') }}</button>
                                                </div>
                                            </form>


                                            <script>
                                                let professionalRowCount = 1;
                                                let experienceRowCount = 1;

                                                function addNewProfessionalRow() {
                                                    const tbody = document.getElementById('professionalTableBody');
                                                    const newRow = document.createElement('tr');
                                                    newRow.innerHTML = `
            <td><input type="text" name="professional_experience[${professionalRowCount}][year]" placeholder="مثال: 2020-2023"></td>
            <td><input type="text" name="professional_experience[${professionalRowCount}][job_title]" placeholder="مثال: مطور ويب"></td>
            <td><input type="text" name="professional_experience[${professionalRowCount}][employer]" placeholder="مثال: شركة التقنية"></td>
            <td><input type="text" name="professional_experience[${professionalRowCount}][years_of_experience]" placeholder="مثال: 3 سنوات"></td>
            <td class="actions-cell">
                <button type="button" class="delete-btn" onclick="deleteProfessionalRow(this)">حذف</button>
            </td>
        `;
                                                    tbody.appendChild(newRow);
                                                    professionalRowCount++;
                                                }

                                                function addNewExperienceRow() {
                                                    const tbody = document.getElementById('experienceTableBody');
                                                    const newRow = document.createElement('tr');
                                                    newRow.innerHTML = `
            <td><input type="text" name="previous_experience[${experienceRowCount}][year]" placeholder="مثال: 2018-2021"></td>
            <td><input type="text" name="previous_experience[${experienceRowCount}][job_title]" placeholder="مثال: مدير مشاريع"></td>
            <td><input type="text" name="previous_experience[${experienceRowCount}][employer]" placeholder="مثال: شركة الإنشاءات"></td>
            <td><input type="text" name="previous_experience[${experienceRowCount}][years_of_experience]" placeholder="مثال: 3 سنوات"></td>
            <td class="actions-cell">
                <button type="button" class="delete-btn" onclick="deleteExperienceRow(this)">حذف</button>
            </td>
        `;
                                                    tbody.appendChild(newRow);
                                                    experienceRowCount++;
                                                }

                                                function deleteProfessionalRow(button) {
                                                    button.closest('tr').remove();
                                                }

                                                function deleteExperienceRow(button) {
                                                    button.closest('tr').remove();
                                                }

                                                // Show/hide early reason field based on contract type
                                                document.getElementById('ff_3_contract_type').addEventListener('change', function() {
                                                    const earlyReasonContainer = document.getElementById('early_reason_container');
                                                    if (this.value === 'مبكر') {
                                                        earlyReasonContainer.style.display = 'block';
                                                    } else {
                                                        earlyReasonContainer.style.display = 'none';
                                                    }
                                                });

                                            </script>
                                            <div class="error-bor"></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer-section></x-footer-section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // كود معاينة الصور
    function setupImagePreview(inputId, previewId) {
        const inputElement = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);

        if (inputElement && previewElement) {
            inputElement.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewElement.src = '#';
                    previewElement.style.display = 'none';
                }
            });
        }
    }

    setupImagePreview('ff_3_passport_photo', 'preview_passport_photo');
    setupImagePreview('ff_3_national_id_photo', 'preview_national_id_photo');
    setupImagePreview('ff_3_personal_photo', 'preview_personal_photo');
    setupImagePreview('ff_3_educational_qualification_photo', 'preview_educational_qualification_photo');
    setupImagePreview('ff_3_retirement_card_photo', 'preview_retirement_card_photo');

    // كود الـ contractTypeSelect
    const contractTypeSelect = document.getElementById('contract_type');
    const earlyReasonContainer = document.getElementById('early_reason_container');
    if (contractTypeSelect && earlyReasonContainer) {
        contractTypeSelect.addEventListener('change', function() {
            if (this.value == 'مبكر') {
                earlyReasonContainer.style.display = 'block';
            } else {
                earlyReasonContainer.style.display = 'none';
            }
        });
    }

    // كود جداول البيانات المهنية والخبراء
    let professionalRowCount = 1;
    let experienceRowCount = 1;
        
    window.addNewProfessionalRow = function() {
        professionalRowCount++;
        const tableBody = document.getElementById('professionalTableBody');
        if (!tableBody) return;
        
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="professional_years[]" placeholder="مثال: 2020-2023"></td>
            <td><input type="text" name="professional_job_title[]" placeholder="مثال: مطور ويب"></td>
            <td><input type="text" name="professional_company[]" placeholder="مثال: شركة التقنية"></td>
            <td><input type="text" name="professional_experience[]" placeholder="مثال: 3 سنوات"></td>
            <td class="actions-cell">
                <button type="button" class="delete-btn" onclick="deleteProfessionalRow(this)">حذف</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        newRow.querySelector('input').focus();
    }

    window.deleteProfessionalRow = function(button) {
        const tableBody = document.getElementById('professionalTableBody');
        if (!tableBody) return;
        
        if (tableBody.children.length > 1) {
            button.closest('tr').remove();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'تنبيه',
                text: 'يجب الاحتفاظ بصف واحد على الأقل',
                confirmButtonText: 'حسناً'
            });
        }
    }

    window.addNewExperienceRow = function() {
        experienceRowCount++;
        const tableBody = document.getElementById('experienceTableBody');
        if (!tableBody) return;
        
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="experience_year[]" placeholder="مثال: 2018-2021"></td>
            <td><input type="text" name="experience_job_title[]" placeholder="مثال: مدير مشاريع"></td>
            <td><input type="text" name="experience_company[]" placeholder="مثال: شركة الإنشاءات"></td>
            <td><input type="text" name="experience_years[]" placeholder="مثال: 3 سنوات"></td>
            <td class="actions-cell">
                <button type="button" class="delete-btn" onclick="deleteExperienceRow(this)">حذف</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        newRow.querySelector('input').focus();
    }

    window.deleteExperienceRow = function(button) {
        const tableBody = document.getElementById('experienceTableBody');
        if (!tableBody) return;
        
        if (tableBody.children.length > 1) {
            button.closest('tr').remove();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'تنبيه',
                text: 'يجب الاحتفاظ بخبرة واحدة على الأقل',
                confirmButtonText: 'حسناً'
            });
        }
    }

    // اختصارات الكيبورد
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' && event.ctrlKey) {
            const activeElement = document.activeElement;
            if (activeElement && activeElement.tagName === 'INPUT') {
                const table = activeElement.closest('table');
                if (table && table.id === 'professionalTable') {
                    addNewProfessionalRow();
                } else if (table && table.id === 'experienceTable') {
                    addNewExperienceRow();
                }
            }
            event.preventDefault();
        }
    });

    // كود المودال والتجديد
    const renewalModal = document.getElementById('renewalModal');
    const renewalRadio = document.getElementById('renewal');
    const newRadio = document.getElementById('new1');
    const closeBtn = document.querySelector('.close');
    const renewalForm = document.getElementById('renewalForm');
    const newMembershipContent = document.getElementById('newMembershipContent');

    // إخفاء المحتوى افتراضيًا
    if (renewalModal) renewalModal.classList.remove('active');
    if (newMembershipContent) newMembershipContent.classList.remove('active');

    // عند اختيار "جديد"
    if (newRadio) {
        newRadio.addEventListener('change', function() {
            if (this.checked) {
                if (newMembershipContent) newMembershipContent.classList.add('active');
                if (renewalModal) renewalModal.classList.remove('active');
                document.body.style.overflow = 'auto';
                if (renewalForm) renewalForm.reset();
                if (newMembershipContent) {
                    newMembershipContent.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    }

    // عند اختيار "تجديد"
    if (renewalRadio) {
        renewalRadio.addEventListener('change', function() {
            if (this.checked) {
                if (renewalModal) renewalModal.classList.add('active');
                if (newMembershipContent) newMembershipContent.classList.remove('active');
                document.body.style.overflow = 'hidden';
            }
        });
    }

    // إغلاق الـ modal عند الضغط على زر الإغلاق
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            if (renewalModal) renewalModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            resetFormAndRadios();
        });
    }

    // إغلاق الـ modal عند الضغط خارج النافذة
    if (renewalModal) {
        window.addEventListener('click', function(event) {
            if (event.target === renewalModal) {
                renewalModal.classList.remove('active');
                document.body.style.overflow = 'auto';
                resetFormAndRadios();
            }
        });
    }

    // إعادة ضبط النموذج والـ radio buttons
    function resetFormAndRadios() {
        document.querySelectorAll('input[name="membership_type"]').forEach(radio => {
            radio.checked = false;
        });
        if (renewalForm) renewalForm.reset();
        if (newMembershipContent) newMembershipContent.classList.remove('active');
    }

    // معالج إرسال نموذج التجديد
    if (renewalForm) {
        renewalForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // عرض تحميل
            Swal.fire({
                title: 'جاري الإرسال...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(this);

            try {
                const csrfToken = document.querySelector('input[name="_token"]');
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }

                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken.value,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'رائع!',
                        text: result.message || 'تم تقديم طلب التجديد بنجاح!',
                        confirmButtonText: 'حسناً'
                    });

                    if (renewalModal) renewalModal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                    resetFormAndRadios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ!',
                        text: result.error || 'حدث خطأ أثناء تقديم الطلب. الرجاء المحاولة مرة أخرى.',
                        confirmButtonText: 'حسناً'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'خطأ في الاتصال!',
                    text: 'حدث خطأ أثناء إرسال النموذج. الرجاء التحقق من اتصالك بالإنترنت والمحاولة مرة أخرى.',
                    confirmButtonText: 'حسناً'
                });
            }
        });
    }

    // تلوين الحقول عند الإدخال
    const renewalInputs = renewalForm ? renewalForm.querySelectorAll('input[type="text"], input[type="email"]') : [];
    renewalInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.style.borderColor = this.value.trim() ? '#28a745' : '#e1e5e9';
        });
    });

    const newMembershipInputs = newMembershipContent ? newMembershipContent.querySelectorAll('input[type="text"], input[type="email"]') : [];
    newMembershipInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.style.borderColor = this.value.trim() ? '#28a745' : '#e1e5e9';
        });
    });
});
    </script>
    </div>
</body>

</html>