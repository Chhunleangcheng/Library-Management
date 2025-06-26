<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Library Management System') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Simple Global Styles -->
    <style>
        /* Khmer Font */
        body, .khmer-regular {
            font-family: 'Noto Sans Khmer', sans-serif;
            font-weight: 400;
        }

        .khmer-medium {
            font-family: 'Noto Sans Khmer', sans-serif;
            font-weight: 500;
        }

        .khmer-semibold {
            font-family: 'Noto Sans Khmer', sans-serif;
            font-weight: 600;
        }

        .khmer-bold {
            font-family: 'Noto Sans Khmer', sans-serif;
            font-weight: 700;
        }

        /* Simple Card */
        .modern-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
        }

        /* Simple Button */
        .modern-btn {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        /* Simple Layout */
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<!-- Navigation -->
@include('layouts.navigation')

<!-- Page Heading -->
@isset($header)
    <header class="bg-white shadow-sm">
        <div class="container-fluid py-4">
            {{ $header }}
        </div>
    </header>
@endisset

<!-- Main Content -->
<main>
    <div class="container-fluid py-4">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                <span class="khmer-regular">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <span class="khmer-regular">{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                <span class="khmer-regular">{{ session('warning') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <span class="khmer-regular">{{ session('info') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        {{ $slot }}
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Simple Time Update Script -->
<script>
    // Simple Global System
    window.LibrarySystem = {
        // Khmer Numbers
        khmerNumbers: {
            '0': '០', '1': '១', '2': '២', '3': '៣', '4': '៤',
            '5': '៥', '6': '៦', '7': '៧', '8': '៨', '9': '៩'
        },

        // Convert to Khmer
        convertToKhmer: function(str) {
            return str.toString().replace(/[0-9]/g, (match) => {
                return this.khmerNumbers[match];
            });
        },

        // Get Current Time
        getCurrentDateTime: function() {
            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hours = String(now.getUTCHours()+7).padStart(2, '0');
            const minutes = String(now.getUTCMinutes()).padStart(2, '0');
            const seconds = String(now.getUTCSeconds()).padStart(2, '0');
            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        },

        // Update Time Display
        updateDateTime: function() {
            const currentTime = this.getCurrentDateTime();
            const khmerTime = this.convertToKhmer(currentTime);

            // Update all time elements
            const timeElements = [
                document.getElementById('status-time'),
                document.getElementById('nav-time'),
                document.getElementById('login-time'),
                document.getElementById('current-time'),
                document.getElementById('header-time')
            ];

            timeElements.forEach(element => {
                if (element) {
                    element.textContent = khmerTime;
                }
            });

            return currentTime;
        },

        // Get Current User
        getCurrentUser: function() {
            return 'Chhunleangcheng';
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Simple Library System Initialized');
        console.log('Current Date and Time (UTC - YYYY-MM-DD HH:MM:SS formatted): 2025-06-20 06:49:21');
        console.log('Current User\'s Login: Chhunleangcheng');

        // Convert existing Khmer numbers
        document.querySelectorAll('.khmer-number').forEach(element => {
            if (element.textContent.match(/\d/)) {
                element.textContent = window.LibrarySystem.convertToKhmer(element.textContent);
            }
        });

        // Initial time update
        window.LibrarySystem.updateDateTime();

        // Update every second
        setInterval(function() {
            window.LibrarySystem.updateDateTime();
        }, 1000);

        // Auto-dismiss alerts
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(alert => {
                if (bootstrap.Alert.getInstance(alert)) {
                    bootstrap.Alert.getInstance(alert).close();
                }
            });
        }, 5000);

        console.log('Simple system ready!');
    });

    // Handle page visibility
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            window.LibrarySystem.updateDateTime();
        }
    });

    // Handle window focus
    window.addEventListener('focus', function() {
        window.LibrarySystem.updateDateTime();
    });
</script>
</body>
</html>
