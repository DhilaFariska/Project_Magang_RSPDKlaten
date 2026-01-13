@extends('layouts.app')

@section('title', 'Pengaturan - RSPD Klaten Admin Panel')

@section('content')
    <div class="settings-management p-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2>Pengaturan Admin</h2>
                <p class="mb-0">Kelola profile admin dan tambah admin baru</p>
            </div>
        </div>

        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-user-circle me-2"></i>Profile Saya
                        </h5>

                        <div class="text-center mb-4">
                            <div class="profile-image-wrapper mx-auto mb-3">
                                <img src="{{ $admin->gambar ? asset('images/profiles/' . $admin->gambar) : asset('images/default-img.png') }}"
                                    alt="{{ $admin->nama_lengkap }}" class="profile-image rounded-circle">
                                <div class="profile-overlay">
                                    <button class="btn btn-sm btn-light rounded-circle edit-profile-btn" data-bs-toggle="modal"
                                        data-bs-target="#editProfileModal">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1 text-white">{{ $admin->nama_lengkap }}</h4>
                            <p class=" mb-0"><i class="fas fa-envelope me-2"></i>{{ $admin->email }}</p>
                            @if ($admin->nomor_telepon)
                                <p class="">
                                    <i class="fas fa-phone me-2"></i>{{ $admin->nomor_telepon }}
                                </p>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </button>
                            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#changePasswordModal">
                                <i class="fas fa-key me-2"></i>Ubah Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i>Daftar Admin
                            </h5>
                            <button type="button" class="btn btn-yellow btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addAdminModal">
                                <i class="fas fa-plus me-1"></i>Tambah Admin
                            </button>
                        </div>

                        @if ($admins->count() > 0)
                            <div class="admin-list">
                                @foreach ($admins as $item)
                                    <div class="admin-item d-flex align-items-center mb-3 p-3 rounded gap-3">
                                        <div class="shrink-0">
                                            <img src="{{ $item->gambar ? asset('images/profiles/' . $item->gambar) : asset('images/default-img.png') }}"
                                                alt="{{ $item->nama_lengkap }}" class="rounded-circle"
                                                style="width: 45px; height: 45px; object-fit: cover;">
                                        </div>
                                        <div class="content-item">
                                            <h6 class="mb-0 text-white">{{ $item->nama_lengkap }}</h6>
                                            <small class="text-white">{{ $item->email }}</small>
                                        </div>
                                        <div class="action-item-admin">
                                            <button type="button" class="btn btn-danger text-white btn-sm hapus-admin"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-users" style="font-size: 3rem; color: #6b7280;"></i>
                                </div>
                                <h6 class=" mb-2 text-white">Belum Ada Admin Lain</h6>
                                <p class=" small mb-3">
                                    Tambahkan admin baru untuk mengelola sistem bersama
                                </p>
                                <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                                    data-bs-target="#addAdminModal">
                                    <i class="fas fa-plus me-1"></i>Tambah Admin Pertama
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="fas fa-shield-alt me-2"></i>Keamanan Akun
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Password harus minimal 6 karakter</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Harus mengandung huruf besar dan kecil</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Harus mengandung angka dan simbol</span>
                            </li>
                            <li>
                                <i class="fas fa-history text-info me-2"></i>
                                <span>Terakhir login:
                                    {{ \Carbon\Carbon::parse($admin->last_login_at ?? $admin->updated_at)->diffForHumans() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formEditProfile" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="profile-image-wrapper mx-auto mb-3">
                                <img id="profilePreview"
                                    src="{{ $admin->gambar ? asset('images/profiles/' . $admin->gambar) : asset('images/default-img.png') }}"
                                    alt="Profile Preview" class="profile-image rounded-circle">
                                <div class="profile-overlay">
                                    <label for="profileImage" class="btn btn-sm text-white rounded-circle m-0">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                            </div>
                            <input type="file" class="d-none" id="profileImage" name="gambar" accept="image/*">
                            <small class=" d-block">Klik ikon kamera untuk mengganti foto</small>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_nama_lengkap"
                                name="nama_lengkap" value="{{ $admin->nama_lengkap }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-dark text-white" id="edit_email" name="email"
                                value="{{ $admin->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_nomor_telepon"
                                name="nomor_telepon" value="{{ $admin->nomor_telepon ?? '' }}">
                            <small class="">Contoh: 081234567890</small>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Ubah Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formChangePassword">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-white" id="current_password"
                                    name="current_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-white" id="new_password"
                                    name="new_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="">Minimal 6 karakter, mengandung huruf besar/kecil, angka, dan
                                simbol</small>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-white"
                                    id="new_password_confirmation" name="new_password_confirmation" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Admin Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formAddAdmin" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="profile-image-wrapper mx-auto mb-3">
                                <img id="newAdminPreview" src="{{ asset('images/default-img.png') }}"
                                    alt="New Admin Preview" class="profile-image rounded-circle">
                                <div class="profile-overlay">
                                    <label for="newAdminImage" class="btn btn-sm btn-light m-0">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                            </div>
                            <input type="file" class="d-none" id="newAdminImage" name="gambar" accept="image/*">
                            <small class=" d-block">Foto Profile (Optional)</small>
                        </div>

                        <div class="mb-3">
                            <label for="add_nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control bg-dark text-white" id="add_nama_lengkap"
                                name="nama_lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label for="add_email" class="form-label">Email</label>
                            <input type="email" class="form-control bg-dark text-white" id="add_email" name="email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="add_nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control bg-dark text-white" id="add_nomor_telepon"
                                name="nomor_telepon">
                        </div>

                        <div class="mb-3">
                            <label for="add_password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-white" id="add_password"
                                    name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleAddPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="add_password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-white"
                                    id="add_password_confirmation" name="password_confirmation" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleAddConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="">Minimal 6 karakter, mengandung huruf besar/kecil, angka, dan
                                simbol</small>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Tambah Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Konfirmasi Hapus Admin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus admin "<span id="hapusNama"></span>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmHapusAdmin">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            function setupPasswordToggle(inputId, toggleId) {
                const input = document.getElementById(inputId);
                const toggle = document.getElementById(toggleId);

                if (input && toggle) {
                    toggle.addEventListener('click', function() {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        this.querySelector('i').classList.toggle('fa-eye');
                        this.querySelector('i').classList.toggle('fa-eye-slash');
                    });
                }
            }

            // Setup password toggles
            setupPasswordToggle('current_password', 'toggleCurrentPassword');
            setupPasswordToggle('new_password', 'toggleNewPassword');
            setupPasswordToggle('new_password_confirmation', 'toggleConfirmPassword');
            setupPasswordToggle('add_password', 'toggleAddPassword');
            setupPasswordToggle('add_password_confirmation', 'toggleAddConfirmPassword');

            // Profile image preview for edit
            const profileImageInput = document.getElementById('profileImage');
            const profilePreview = document.getElementById('profilePreview');

            if (profileImageInput) {
                profileImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Profile image preview for new admin
            const newAdminImageInput = document.getElementById('newAdminImage');
            const newAdminPreview = document.getElementById('newAdminPreview');

            if (newAdminImageInput) {
                newAdminImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            newAdminPreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Form Edit Profile
            document.getElementById('formEditProfile').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch("{{ route('settings.update-profile') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengupdate profile');
                    });
            });

            // Form Change Password
            document.getElementById('formChangePassword').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch("{{ route('settings.update-password') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengubah password');
                    });
            });

            // Form Add Admin
            document.getElementById('formAddAdmin').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch("{{ route('settings.store') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan admin');
                    });
            });

            // Tombol Hapus Admin
            let adminToDelete = null;
            document.querySelectorAll('.hapus-admin').forEach(button => {
                button.addEventListener('click', function() {
                    adminToDelete = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    document.getElementById('hapusNama').textContent = nama;

                    const modal = new bootstrap.Modal(document.getElementById('hapusAdminModal'));
                    modal.show();
                });
            });

            // Konfirmasi Hapus Admin
            document.getElementById('confirmHapusAdmin').addEventListener('click', function() {
                if (!adminToDelete) return;

                fetch(`/admin/settings/${adminToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus admin');
                    });
            });
        });
    </script>
@endpush
