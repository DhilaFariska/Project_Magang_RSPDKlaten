<header class="header bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <h4 class="mb-0">@yield('title', 'RSPD Klaten Admin Panel')</h4>
    <div class="date-text">
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
</header>