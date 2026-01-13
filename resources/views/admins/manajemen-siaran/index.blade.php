@extends('layouts.app')
@section('title', 'Manajemen Program Siaran - RSPD Klaten Admin Panel')
@section('content')
    <div class="siaran-management p-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2>Manajemen Program Siaran</h2>
                <p class="mb-0">Kelola program siaran radio dan jadwal harian</p>
            </div>
            <div>
                <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#tambahProgramModal">
                    <i class="fas fa-plus me-2"></i>Buat Program
                </button>
                <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                    <i class="fas fa-plus me-2"></i>Buat Jadwal
                </button>
            </div>
        </div>

        <div class="tab-wrapper gap-2 mb-4">
            <button class="tab-btn active" data-tab="program">Daftar Program</button>
            <button class="tab-btn" data-tab="jadwal">Jadwal Harian</button>
        </div>

        <div class="tab-content active" id="programTab">
            <div class="program-header d-flex align-items-center mb-4">
                <i class="far fa-list-alt text-warning me-2"></i>
                <span class="h5 mb-0">Daftar Program Siaran</span>
                <span class="badge bg-dark ms-3">{{ $siarans->count() }} Program</span>
            </div>
            @if ($siarans->count() > 0)
                <div class="program-list" id="programList">
                    @foreach ($siarans as $siaran)
                        <div class="program-card card mb-4" data-category="{{ $siaran->kategori }}"
                            data-search="{{ Str::lower($siaran->nama_program . ' ' . $siaran->deskripsi . ' ' . $siaran->presenter) }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $siaran->nama_program }}</h5>
                                    <div>
                                        <span class="badge bg-primary text-white">{{ $siaran->kategori }}</span>
                                    </div>
                                </div>
                                <p class="card-text">
                                    {{ Str::limit($siaran->deskripsi, 150) }}
                                </p>
                                <div class="program-meta d-flex align-items-center mt-3">
                                    <span class="me-3">
                                        <i class="far fa-clock me-1 text-warning"></i>{{ $siaran->waktu_siaran }}
                                    </span>
                                    <span class="me-3">
                                        <i class="fas fa-user me-1 text-warning"></i>{{ $siaran->presenter }}
                                    </span>
                                </div>
                                <div class="action-buttons mt-3 d-flex gap-2">
                                    <button type="button" class="btn btn-outline-light btn-sm edit-program"
                                        data-id="{{ $siaran->id }}">
                                        <i class="far fa-edit me-1"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-danger text-white btn-sm hapus-program"
                                        data-id="{{ $siaran->id }}" data-nama="{{ $siaran->nama_program }}">
                                        <i class="far fa-trash-alt me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-secondary">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-broadcast-tower" style="font-size: 4rem; color: #6b7280;"></i>
                        </div>
                        <h4 class="text-white mb-3">Belum Ada Program Siaran</h4>
                        <p class="text-white mb-4">
                            Belum ada program siaran yang ditambahkan. Mulai dengan membuat program pertama Anda.
                        </p>
                        <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                            data-bs-target="#tambahProgramModal">
                            <i class="fas fa-plus me-2"></i>Tambah Program Pertama
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <div class="tab-content" id="jadwalTab">
            <div class="jadwal-header d-flex align-items-center mb-4">
                <i class="far fa-calendar-alt text-warning me-2"></i>
                <span class="h5 mb-0">Jadwal Siaran Harian</span>
                <span class="badge bg-dark ms-3">{{ $jadwals->count() }} Jadwal</span>
            </div>
            @if ($jadwals->count() > 0)
                <div class="jadwal-container" id="jadwalList">
                    @foreach ($jadwals as $jadwal)
                        <div class="card mb-3"
                            data-search="{{ Str::lower($jadwal->nama_jadwal . ' ' . $jadwal->presenter) }}">
                            <div class="card-body">
                                <div class="jadwal-item d-flex align-items-center gap-3">
                                    <div class="jadwal-content d-flex align-items-center gap-4">
                                        <div class="jam-box text-center bg-dark py-2 px-3 rounded">
                                            <span class="jam h4 mb-0 text-warning">{{ $jadwal->waktu_format }}</span>
                                        </div>
                                        <div class="info">
                                            <h4 class="mb-1">{{ $jadwal->nama_jadwal }}</h4>
                                            <small class="text-white">
                                                <i class="fas fa-user me-1"></i>{{ $jadwal->presenter }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="jadwal-action-buttons d-flex gap-2">
                                        <button type="button" class="btn btn-outline-light btn-sm edit-jadwal"
                                            data-id="{{ $jadwal->id }}">
                                            <i class="far fa-edit me-1"></i>Edit
                                        </button>
                                        <button type="button" class="btn btn-danger text-white btn-sm hapus-jadwal"
                                            data-id="{{ $jadwal->id }}" data-nama="{{ $jadwal->nama_jadwal }}">
                                            <i class="far fa-trash-alt me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card border-secondary">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="far fa-calendar-alt" style="font-size: 4rem; color: #6b7280;"></i>
                        </div>
                        <h4 class="text-white mb-3">Belum Ada Jadwal</h4>
                        <p class="text-white mb-4">
                            Belum ada jadwal siaran yang ditambahkan. Tambahkan jadwal untuk mengatur siaran harian.
                        </p>
                        <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                            data-bs-target="#tambahJadwalModal">
                            <i class="fas fa-plus me-2"></i>Tambah Jadwal Pertama
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Info Filter Kosong -->
        <!-- Bagian ini dihapus karena filter/search dihapus -->

    </div>

    <!-- Modal Tambah Program -->
    <div class="modal fade" id="tambahProgramModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Program Siaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formTambahProgram">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_program" class="form-label">Nama Program</label>
                            <input type="text" class="form-control bg-dark text-white" id="nama_program"
                                name="nama_program" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select bg-dark text-white" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Musik">Musik</option>
                                    <option value="Talk Show">Talk Show</option>
                                    <option value="Edukasi">Edukasi</option>
                                    <option value="Hiburan">Hiburan</option>
                                    <option value="Religi">Religi</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="presenter" class="form-label">Presenter</label>
                                <input type="text" class="form-control bg-dark text-white" id="presenter"
                                    name="presenter" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_siaran" class="form-label">Waktu Siaran</label>
                            <input type="text" class="form-control bg-dark text-white" id="waktu_siaran"
                                name="waktu_siaran" placeholder="Contoh: 06:00 - 07:00" required>
                            <small class="text-white">Contoh: 06:00 - 07:00</small>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Program</label>
                            <textarea class="form-control bg-dark text-white" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Program -->
    <div class="modal fade" id="editProgramModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Program Siaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formEditProgram">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_program_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_program" class="form-label">Nama Program</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_nama_program"
                                name="nama_program" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_kategori" class="form-label">Kategori</label>
                                <select class="form-select bg-dark text-white" id="edit_kategori" name="kategori"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Musik">Musik</option>
                                    <option value="Talk Show">Talk Show</option>
                                    <option value="Edukasi">Edukasi</option>
                                    <option value="Hiburan">Hiburan</option>
                                    <option value="Religi">Religi</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_presenter" class="form-label">Presenter</label>
                                <input type="text" class="form-control bg-dark text-white" id="edit_presenter"
                                    name="presenter" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_waktu_siaran" class="form-label">Waktu Siaran</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_waktu_siaran"
                                name="waktu_siaran" required>
                            <small class="text-white">Contoh: 06:00 - 07:00</small>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi Program</label>
                            <textarea class="form-control bg-dark text-white" id="edit_deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Jadwal Harian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formTambahJadwal">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_jadwal" class="form-label">Nama Jadwal</label>
                            <input type="text" class="form-control bg-dark text-white" id="nama_jadwal"
                                name="nama_jadwal" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="waktu_jadwal" class="form-label">Waktu Jadwal</label>
                                <input type="time" class="form-control bg-dark text-white" id="waktu_jadwal"
                                    name="waktu_jadwal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="presenter_jadwal" class="form-label">Presenter</label>
                                <input type="text" class="form-control bg-dark text-white" id="presenter_jadwal"
                                    name="presenter" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Jadwal -->
    <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Jadwal Harian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formEditJadwal">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_jadwal_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_jadwal" class="form-label">Nama Jadwal</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_nama_jadwal"
                                name="nama_jadwal" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_waktu_jadwal" class="form-label">Waktu Jadwal</label>
                                <input type="time" class="form-control bg-dark text-white" id="edit_waktu_jadwal"
                                    name="waktu_jadwal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_presenter_jadwal" class="form-label">Presenter</label>
                                <input type="text" class="form-control bg-dark text-white" id="edit_presenter_jadwal"
                                    name="presenter" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-yellow">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Program -->
    <div class="modal fade" id="hapusProgramModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Konfirmasi Hapus Program</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus program "<span id="hapusProgramNama"></span>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmHapusProgram">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Jadwal -->
    <div class="modal fade" id="hapusJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Konfirmasi Hapus Jadwal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jadwal "<span id="hapusJadwalNama"></span>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmHapusJadwal">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/manajemen-siaran.css') }}">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .program-card,
        .jadwal-item {
            transition: all 0.3s ease;
        }

        .program-card.hidden,
        .jadwal-item.hidden {
            display: none !important;
        }

        .jam-box {
            min-width: 80px;
        }

        .tab-wrapper {
            background: #1e293b;
            border-radius: 8px;
            padding: 6px;
            display: flex;
            margin-bottom: 16px;
            border: 1px solid #334155;
        }

        .tab-btn {
            flex: 1;
            background: transparent;
            border: none;
            padding: 10px;
            color: #cbd5e1;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .tab-btn.active {
            background: #f59e0b;
            color: #1e293b;
        }

        .tab-btn:hover:not(.active) {
            background: #334155;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab Navigation
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById(btn.dataset.tab + 'Tab').classList.add('active');
                });
            });

            // Form Tambah Program
            document.getElementById('formTambahProgram').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("{{ route('siaran.store-program') }}", {
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
                        alert('Terjadi kesalahan saat menambahkan program');
                    });
            });

            // Tombol Edit Program
            document.querySelectorAll('.edit-program').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`/admin/siaran/program/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_program_id').value = data.id;
                            document.getElementById('edit_nama_program').value = data.nama_program;
                            document.getElementById('edit_kategori').value = data.kategori;
                            document.getElementById('edit_presenter').value = data.presenter;
                            document.getElementById('edit_waktu_siaran').value = data.waktu_siaran;
                            document.getElementById('edit_deskripsi').value = data.deskripsi;
                            const modal = new bootstrap.Modal(document.getElementById('editProgramModal'));
                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching program details:', error);
                            alert('Gagal memuat data program untuk diedit.');
                        });
                });
            });

            // Form Edit Program
            document.getElementById('formEditProgram').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('edit_program_id').value;
                const formData = new FormData(this);
                formData.append('_method', 'PUT');
                fetch(`/admin/siaran/program/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else if (data.errors) {
                            alert('Terjadi kesalahan: ' + JSON.stringify(data.errors));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengupdate program');
                    });
            });

            // Tombol Hapus Program
            let programToDelete = null;
            document.querySelectorAll('.hapus-program').forEach(button => {
                button.addEventListener('click', function() {
                    programToDelete = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    document.getElementById('hapusProgramNama').textContent = nama;
                    const modal = new bootstrap.Modal(document.getElementById('hapusProgramModal'));
                    modal.show();
                });
            });

            // Konfirmasi Hapus Program
            document.getElementById('confirmHapusProgram').addEventListener('click', function() {
                if (!programToDelete) return;
                fetch(`/admin/siaran/program/${programToDelete}`, {
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus program');
                    });
            });

            // Form Tambah Jadwal
            document.getElementById('formTambahJadwal').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch("{{ route('siaran.store-jadwal') }}", {
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
                        alert('Terjadi kesalahan saat menambahkan jadwal');
                    });
            });

            // Tombol Edit Jadwal
            document.querySelectorAll('.edit-jadwal').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`/admin/siaran/jadwal/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_jadwal_id').value = data.id;
                            document.getElementById('edit_nama_jadwal').value = data.nama_jadwal;
                            document.getElementById('edit_waktu_jadwal').value = data.waktu_jadwal;
                            document.getElementById('edit_presenter_jadwal').value = data.presenter;
                            const modal = new bootstrap.Modal(document.getElementById('editJadwalModal'));
                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching jadwal details:', error);
                            alert('Gagal memuat data jadwal untuk diedit.');
                        });
                });
            });

            // Form Edit Jadwal
            document.getElementById('formEditJadwal').addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('edit_jadwal_id').value;
                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                fetch(`/admin/siaran/jadwal/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else if (data.errors) {
                            alert('Terjadi kesalahan: ' + JSON.stringify(data.errors));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengupdate jadwal');
                    });
            });

            // Tombol Hapus Jadwal
            let jadwalToDelete = null;
            document.querySelectorAll('.hapus-jadwal').forEach(button => {
                button.addEventListener('click', function() {
                    jadwalToDelete = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');
                    document.getElementById('hapusJadwalNama').textContent = nama;
                    const modal = new bootstrap.Modal(document.getElementById('hapusJadwalModal'));
                    modal.show();
                });
            });

            // Konfirmasi Hapus Jadwal
            document.getElementById('confirmHapusJadwal').addEventListener('click', function() {
                if (!jadwalToDelete) return;
                fetch(`/admin/siaran/jadwal/${jadwalToDelete}`, {
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
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus jadwal');
                    });
            });
        });
    </script>
@endpush