<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('')
    <style>
        .swal2-popup {
            background: #1a1a1a !important;
            border: 1px solid #333 !important;
            border-radius: 10px !important;
        }
        
        .swal2-title {
            color: #fff !important;
            font-size: 1.5rem !important;
            font-weight: 600 !important;
        }
        
        .swal2-html-container {
            color: #ccc !important;
            font-size: 1rem !important;
        }
        
        .swal2-confirm {
            background-color: #0d6efd !important;
            border: none !important;
            border-radius: 5px !important;
            font-weight: 500 !important;
            padding: 10px 24px !important;
        }
        
        .swal2-confirm:hover {
            background-color: #0b5ed7 !important;
        }
        
        .swal2-cancel {
            background-color: #6c757d !important;
            border: none !important;
            border-radius: 5px !important;
            font-weight: 500 !important;
            padding: 10px 24px !important;
        }
        
        .swal2-cancel:hover {
            background-color: #5c636a !important;
        }
        
        .swal2-icon {
            border-color: transparent !important;
        }
        
        .swal2-success-line-tip,
        .swal2-success-line-long {
            background-color: #198754 !important;
        }
        
        .swal2-success-ring {
            border-color: rgba(25, 135, 84, 0.3) !important;
        }
        
        .swal2-error-line {
            background-color: #dc3545 !important;
        }
        
        .swal2-warning {
            border-color: #ffc107 !important;
            color: #ffc107 !important;
        }
        
        .swal2-info {
            border-color: #0dcaf0 !important;
            color: #0dcaf0 !important;
        }
        
        .swal2-progress-steps .swal2-progress-step {
            background: #0d6efd !important;
            color: #fff !important;
        }
        
        .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
            background: #0d6efd !important;
        }
        
        .swal2-progress-steps .swal2-progress-step-line {
            background: #333 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid auth-container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
</body>
</html>