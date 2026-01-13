<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RSPD Klaten Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('styles')
    <style>
        .swal2-popup {
            background: #1a1a1a !important;
            border: 1px solid #333 !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }
        
        .swal2-title {
            color: #fff !important;
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        .swal2-html-container {
            color: #ccc !important;
            font-size: 1rem !important;
            line-height: 1.5 !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        }
        
        .swal2-confirm {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 500 !important;
            padding: 10px 24px !important;
            font-size: 0.95rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.25) !important;
        }
        
        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 8px rgba(13, 110, 253, 0.3) !important;
        }
        
        .swal2-cancel {
            background: linear-gradient(135deg, #6c757d 0%, #5c636a 100%) !important;
            border: none !important;
            border-radius: 6px !important;
            font-weight: 500 !important;
            padding: 10px 24px !important;
            font-size: 0.95rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px rgba(108, 117, 125, 0.25) !important;
        }
        
        .swal2-cancel:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 8px rgba(108, 117, 125, 0.3) !important;
        }
        
        .swal2-icon {
            border-color: transparent !important;
            transform: scale(1.1) !important;
        }
        
        .swal2-success-line-tip,
        .swal2-success-line-long {
            background-color: #198754 !important;
            height: 3px !important;
        }
        
        .swal2-success-ring {
            border-color: rgba(25, 135, 84, 0.3) !important;
        }
        
        .swal2-error [class^=swal2-x-mark-line] {
            background-color: #dc3545 !important;
            height: 3px !important;
        }
        
        .swal2-warning {
            border-color: #ffc107 !important;
            color: #ffc107 !important;
        }
        
        .swal2-info {
            border-color: #0dcaf0 !important;
            color: #0dcaf0 !important;
        }
        
        .swal2-question {
            border-color: #6c757d !important;
            color: #6c757d !important;
        }
        
        .swal2-input,
        .swal2-file,
        .swal2-textarea,
        .swal2-select,
        .swal2-radio,
        .swal2-checkbox {
            background-color: #2d2d2d !important;
            border: 1px solid #444 !important;
            color: #fff !important;
            border-radius: 5px !important;
        }
        
        .swal2-input:focus,
        .swal2-file:focus,
        .swal2-textarea:focus {
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
        }
        
        .swal2-validation-message {
            background: rgba(220, 53, 69, 0.1) !important;
            color: #f8d7da !important;
            border: 1px solid rgba(220, 53, 69, 0.3) !important;
        }
        
        .swal2-footer {
            border-top: 1px solid #333 !important;
            color: #888 !important;
        }
        
        .swal2-close {
            color: #999 !important;
            transition: color 0.3s ease !important;
        }
        
        .swal2-close:hover {
            color: #fff !important;
        }
        
        .swal2-toast {
            background: #1a1a1a !important;
            border: 1px solid #333 !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5) !important;
        }
        
        .swal2-toast .swal2-title {
            color: #fff !important;
            font-size: 1rem !important;
        }
        
        .swal2-toast .swal2-html-container {
            color: #ccc !important;
            font-size: 0.875rem !important;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        @include('partials.sidebar')
        <div class="main-content grow">
            @include('partials.header')
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>