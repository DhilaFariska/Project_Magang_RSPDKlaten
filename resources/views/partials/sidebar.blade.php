<aside class="sidebar d-flex flex-column">
    <div class="logo-section">
        <h5>RSPD Klaten</h5>
        <small>Admin Panel</small>
    </div>

    <nav class="menu-section flex-wrap">
        <ul class="nav flex-column gap-1 px-3">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('berita.index') }}"
                    class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                    <i class="far fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('siaran.index') }}"
                    class="nav-link {{ request()->routeIs('siaran.*') ? 'active' : '' }}">
                    <i class="fas fa-broadcast-tower"></i>
                    <span>Program Siaran</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('feedback.index') }}"
                    class="nav-link {{ request()->routeIs('feedback.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Feedback Audiens</span>
                    @php
                        $newFeedbackCount = \App\Models\Feedback::where('status', 'baru')->count();
                    @endphp
                    @if($newFeedbackCount > 0)
                        <span class="badge bg-danger ms-2">{{ $newFeedbackCount }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('settings.index') }}"
                    class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="d-flex flex-column">
        <div class="user-card mt-5">
            @auth('admin')
                @php
                    $admin = auth('admin')->user();
                    $avatarInitial = strtoupper(substr($admin->nama_lengkap, 0, 1));
                    $avatarImage = $admin->gambar
                        ? asset('images/profiles/' . $admin->gambar)
                        : asset('images/default-img.png');
                @endphp

                <div class="avatar position-relative">
                    @if ($admin->gambar)
                        <img src="{{ $avatarImage }}" alt="{{ $admin->nama_lengkap }}" class="rounded-circle w-100 h-100">
                    @else
                        <span>{{ $avatarInitial }}</span>
                    @endif
                </div>
                <div class="info">
                    <div class="name">{{ $admin->nama_lengkap }}</div>
                    <div class="email">{{ $admin->email }}</div>
                </div>
            @else
                <div class="avatar">A</div>
                <div class="info">
                    <div class="name">Admin User</div>
                    <div class="email">admin@rspd.klaten.go.id</div>
                </div>
            @endauth
        </div>

        <div class="logout mb-3">
            <button type="submit"
                class="btn btn-link gap-3 text-decoration-none p-0 d-flex justify-content-start align-items-center w-100"
                onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>LOGOUT</span>
            </button>
        </div>
    </div>
</aside>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin logout dari sistem?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('logout-form')) {
            const logoutForm = document.createElement('form');
            logoutForm.id = 'logout-form';
            logoutForm.method = 'POST';
            logoutForm.action = '{{ route('logout') }}';
            logoutForm.style.display = 'none';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            logoutForm.appendChild(csrfToken);
            document.body.appendChild(logoutForm);
        }
    });
</script>
