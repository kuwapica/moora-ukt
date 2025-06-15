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
        :root {
            --primary: #a16207;
            --secondary: #ca8a04;
            --orange: #ff7e3e;
            --light-primary: #fef3c7;
            --light-secondary: #fffbeb;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --accent: #059669;
            --soft-bg: #fefefe;
            --text-dark: #1c1917;
            --text-light: #78716c;
            --emerald: #10b981;
            --amber: #f59e0b;
            --brown-light: #fef7ed;
            --brown-medium: #fed7aa;
            --red-soft: #ef4444;
            --warm-gray: #f5f5f4;
            --header-height: 80px;
        }

        /* PERBAIKAN RADIKAL: Hilangkan SEMUA garis di bagian bawah viewport */
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

        /* Khusus untuk container Bootstrap */
        .container-fluid::after,
        .row::after,
        .col-md-9::after,
        .col-lg-10::after {
            display: none !important;
            content: none !important;
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
            background: white;
            background-size: 200% 200%;
            /* animation: shimmer 3s ease-in-out infinite; */
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
            border-radius: 25px;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        /* SIMPLIFIED DROPDOWN */
        .user-dropdown {
            position: relative;
            display: inline-block;
            z-index: 1001;
        }

        .user-dropdown-toggle {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .user-dropdown-toggle:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .user-dropdown-toggle::before {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        .user-dropdown-toggle::after {
            content: '▼';
            margin-left: 0.5rem;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .user-dropdown.show .user-dropdown-toggle::after {
            transform: rotate(180deg);
        }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: white;
            min-width: 200px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.3s ease;
            z-index: 10000;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .user-dropdown.show .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .user-dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1.5rem;
            color: var(--text-dark);
            font-weight: 500;
            border: none;
            background: none;
            text-align: left;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .user-dropdown-item:hover {
            color: black;
            transform: translateX(5px);
        }

        /* Mobile hamburger enhancement */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover,
        .navbar-toggler:focus {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
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

            .user-dropdown-menu {
                position: static !important;
                transform: none !important;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
                border: 1px solid rgba(255, 255, 255, 0.2) !important;
                background: rgba(255, 255, 255, 0.95) !important;
                margin-top: 0.5rem !important;
                border-radius: 10px !important;
                opacity: 1 !important;
                visibility: visible !important;
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

        /* Button styling */
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #92400e;
            border-color: #92400e;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .bg-primary {
            background: var(--gradient) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* Sidebar styling */
        .sidebar {
            min-height: calc(100vh - var(--header-height));
            background: white;
            box-shadow: 2px 0 15px rgba(161, 98, 7, 0.15);
            border-right: 1px solid rgba(161, 98, 7, 0.1);
        }

        .sidebar .nav-link {
            color: black;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 10px;
            padding: 12px 15px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            color: white;
            background: black;
            transform: translateX(3px);
            box-shadow: 0 2px 4px rgba(161, 98, 7, 0.1);
        }

        .sidebar .nav-link.active {
            color: white;
            background: black;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.25);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main content area */
        .main-content {
            background: var(--warm-gray);
            min-height: calc(100vh - var(--header-height));
        }

        /* Footer - GARIS BAWAH DIHILANGKAN */
        footer {
            padding: 1rem 0;
            background: transparent;
            color: var(--text-light);
            border: none !important;
            box-shadow: none !important;
        }

        /* Hilangkan semua garis yang mungkin ada di bagian bawah */
        html,
        body {
            border-bottom: none !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        /* Hilangkan border dari container dan elemen lainnya */
        .container-fluid,
        .container,
        main,
        .row {
            border-bottom: none !important;
            box-shadow: none !important;
        }

        /* Pastikan tidak ada pseudo-element yang membuat garis */
        *::after,
        *::before {
            border-bottom: none !important;
        }

        /* Khusus untuk menghilangkan garis di viewport bottom */
        body::after {
            display: none !important;
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

        /* Khusus untuk halaman login - hilangkan semua garis */
        .login-page,
        .auth-page,
        .guest-page {
            border: none !important;
            box-shadow: none !important;
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

        /* Enhanced Page Header - CONSISTENT STYLE */
        .page-header {
            color: black;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .page-header-content {
            position: relative;
            z-index: 2;
        }

        .page-title {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .page-subtitle {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Enhanced table */
        .enhanced-table {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .enhanced-table thead th {
            background: var(--brown-light);
            font-weight: 600;
            color: var(--text-dark);
            padding: 1rem 1.25rem;
            border: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }

        .enhanced-table thead th i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .enhanced-table tbody td {
            padding: 1rem 1.25rem;
            border-color: #f1f5f9;
            vertical-align: middle;
            transition: all 0.2s ease;
        }

        .enhanced-table tbody tr {
            transition: all 0.2s ease;
        }

        .enhanced-table tbody tr:hover {
            background: linear-gradient(135deg, #fefbf6 0%, #fef7ed 100%);
            transform: scale(1.01);
        }


        /* Khusus untuk menghilangkan garis di bagian bawah halaman */
        .container-fluid::after,
        .row::after,
        .col-md-9::after,
        .col-lg-10::after {
            display: none !important;
            content: none !important;
        }

        /* Card dashboard styling */
        .card-dashboard {
            border-left: 4px solid var(--primary);
            transition: all 0.2s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(161, 98, 7, 0.15);
        }

        .card-dashboard.card-primary {
            border-left-color: var(--primary);
        }

        .card-dashboard.card-success {
            border-left-color: var(--emerald);
        }

        .card-dashboard.card-warning {
            border-left-color: var(--amber);
        }

        .card-dashboard.card-danger {
            border-left-color: #ef4444;
        }

        /* Enhanced content card */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: slideInUp 0.6s ease-out;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }

        .content-card-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 2px;
            background: var(--gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .content-card:hover .content-card-header::before {
            transform: scaleX(1);
        }

        .content-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .content-card-body {
            padding: 2rem;
        }

        /* Alert styling */
        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
            border-radius: 8px;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
            border-radius: 8px;
        }

        .alert-info {
            background-color: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
            border-radius: 8px;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-color: #fed7aa;
            color: #92400e;
            border-radius: 8px;
        }

        /* Table styling */
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: var(--brown-light);
        }

        .table thead th {
            border-bottom: none;
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Button enhancements */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(161, 98, 7, 0.2);
        }

        /* Form styling */
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(161, 98, 7, 0.15);
        }

        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border: none;
            background: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        /* Pagination styling */
        .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .page-link {
            color: var(--primary);
            border-radius: 6px;
            margin: 0 2px;
        }

        .page-link:hover {
            color: var(--secondary);
            background-color: var(--brown-light);
        }

        /* Card styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(161, 98, 7, 0.1);
        }

        .card-header {
            background: var(--brown-light);
            border-bottom: 2px solid var(--primary);
            font-weight: 600;
        }

        /* Badge styling */
        .badge {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 15px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar .nav-link {
                margin: 1px 5px;
                padding: 10px 12px;
            }

            .sidebar .nav-link:hover {
                transform: none;
            }
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
                    @guest
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
                    @else
                        <li class="nav-item">
                            <div class="user-dropdown" id="userDropdown">
                                <button class="user-dropdown-toggle" type="button" onclick="toggleUserDropdown()">
                                    {{ auth()->user()->name }}
                                </button>
                                <div class="user-dropdown-menu">
                                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="user-dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 d-md-block sidebar p-0">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <!-- Admin Sidebar -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('kriteria.*') ? 'active' : '' }}"
                                    href="{{ route('kriteria.index') }}">
                                    <i class="fas fa-list-ul"></i> Kriteria
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('subkriteria.*') ? 'active' : '' }}"
                                    href="{{ route('subkriteria.index') }}">
                                    <i class="fas fa-list-alt"></i> Sub Kriteria
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('alternatif.*') ? 'active' : '' }}"
                                    href="{{ route('alternatif.index') }}">
                                    <i class="fas fa-users"></i> Alternatif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}"
                                    href="{{ route('penilaian.index') }}">
                                    <i class="fas fa-clipboard-check"></i> Penilaian
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('perhitungan.*') ? 'active' : '' }}"
                                    href="{{ route('perhitungan.index') }}">
                                    <i class="fas fa-calculator"></i> Perhitungan
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
                                        href="{{ route('user.index') }}">
                                        <i class="fas fa-user-cog"></i> Manajemen User
                                    </a>
                                </li> --}}
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            @else
                <!-- Content for guest users -->
                <main class="col-12 py-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} SPK Penilaian UKT | MOORA Method</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <!-- SIMPLE DROPDOWN JAVASCRIPT -->
    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const isClickInside = dropdown.contains(event.target);

            if (!isClickInside) {
                dropdown.classList.remove('show');
            }
        });

        // Prevent dropdown from closing when clicking inside
        document.getElementById('userDropdown').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>

    @yield('scripts')
</body>

</html>
