<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SPK Keringanan UKT')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        html {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background: linear-gradient(135deg, var(--warm-gray) 0%, #f3f2f0 100%) !important;
            overflow-x: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, var(--warm-gray) 0%, #f3f2f0 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        /* Hilangkan semua pseudo-element yang bisa membuat garis */
        html::before,
        html::after,
        body::before,
        body::after {
            display: none !important;
            content: none !important;
        }

        /* Override semua kemungkinan garis */
        * {
            border-bottom-color: transparent !important;
            border-bottom-width: 0 !important;
            border-bottom-style: none !important;
        }


        main {
            flex: 1;
        }

        /* Enhanced Navbar styling */
        .navbar {
            background: black;
            box-shadow: 0 8px 32px rgba(161, 98, 7, 0.3);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            height: var(--header-height);
            position: relative;
            overflow: visible;
            z-index: 1000;
        }


        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            /* background: linear-gradient(45deg, #ffffff, #fbbf24, #ffffff); */
            background: white;
            background-size: 200% 200%;
            animation: shimmer 3s ease-in-out infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        @keyframes shimmer {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.5));
        }

        .navbar-brand::before {
            content: '🏆';
            position: absolute;
            left: -2.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(-50%);
            }

            40% {
                transform: translateY(-60%);
            }

            60% {
                transform: translateY(-55%);
            }
        }

        /* Enhanced Navigation Links */
        .navbar-nav {
            position: relative;
            z-index: 1001;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1.25rem !important;
            border-radius: 10px;
            margin: 0 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }




        /* Responsive adjustments for header */
        @media (max-width: 991.98px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-brand::before {
                left: -2rem;
                font-size: 1.2rem;
            }

            .navbar-collapse {
                background: rgba(26, 54, 93, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.1);
                z-index: 1002;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .navbar-brand::before {
                display: none;
            }
        }

        /* Override semua kemungkinan elemen yang bisa buat garis */
        div,
        span,
        section,
        article,
        main,
        header,
        footer,
        nav,
        ul,
        li,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            border-bottom: none !important;
            box-shadow: none !important;
        }

        /* Pastikan viewport tidak ada garis */
        @media screen {

            html,
            body {
                border: none !important;
                box-shadow: none !important;
                outline: none !important;
            }
        }

        /* Hilangkan semua border dan outline yang mungkin muncul */
        *,
        *::before,
        *::after {
            border-bottom: none !important;
            outline-bottom: none !important;
        }

        /* PERBAIKAN RADIKAL: Hilangkan SEMUA garis di bagian bawah viewport */
        html {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            background: linear-gradient(135deg, var(--warm-gray) 0%, #f3f2f0 100%) !important;
            overflow-x: hidden !important;
        }

        body {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        /* Hilangkan semua pseudo-element yang bisa membuat garis */
        html::before,
        html::after,
        body::before,
        body::after {
            display: none !important;
            content: none !important;
        }

        /* Hilangkan garis dari viewport dan window */
        :root {
            border: none !important;
            box-shadow: none !important;
        }

        /* Pastikan viewport tidak ada garis */
        @media screen {

            html,
            body {
                border: none !important;
                box-shadow: none !important;
                outline: none !important;
            }
        }


        /* Hilangkan garis dari viewport dan window */
        html {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Hilangkan border dari semua div, section, dan container */
        div,
        section,
        article,
        main,
        header,
        footer,
        nav {
            border-bottom: none !important;
            border: none !important;
        }

        /* Khusus untuk elemen yang mungkin memiliki border default */
        .container,
        .container-fluid,
        .row,
        .col-*,
        [class*="col-"] {
            border: none !important;
            border-bottom: none !important;
            outline: none !important;
        }

        /* Hilangkan semua box-shadow yang mungkin terlihat seperti garis */
        * {
            box-shadow: none !important;
        }

        /* Override untuk elemen yang memang butuh shadow (kecuali bottom) */
        .card,
        .modal,
        .dropdown-menu,
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
        }

        /* Pastikan tidak ada pseudo-element yang membuat garis di bottom */
        html::after,
        body::after,
        main::after,
        footer::after {
            display: none !important;
        }

        /* TAMBAHAN KHUSUS: Hilangkan garis emas/coklat yang muncul di viewport */
        * {
            border-bottom-color: transparent !important;
            border-bottom-width: 0 !important;
            border-bottom-style: none !important;
        }

        /* Override semua kemungkinan elemen yang bisa buat garis */
        div,
        span,
        section,
        article,
        main,
        header,
        footer,
        nav,
        ul,
        li,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            border-bottom: none !important;
            box-shadow: none !important;
        }


        /* Button enhancements */
        .btn-dark {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #000;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
        }

        .form-control {
            border: 1px solid #ced4da;
            /* border default */
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:hover {
            border-color: #6c757d;
            /* abu-abu saat hover */
        }

        .form-control:focus {
            border-color: #212529;
            /* hitam saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(33, 37, 41, 0.25);
            /* shadow halus hitam */
        }

        /* Print styles */
        @media print {

            .sidebar,
            .navbar,
            .btn,
            .modal {
                display: none !important;
            }

            .main-content {
                margin: 0;
                padding: 0;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .table {
                font-size: 12px;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #92400e, #a16207);
        }
    </style>

    @yield('styles')

    {{-- <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                SPK Penilaian UKT
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Content for guest users -->
            <main class="col-12 py-4">
                @yield('content')
            </main>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @yield('scripts')
</body>

</html>
