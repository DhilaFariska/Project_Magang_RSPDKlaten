@extends('layouts.app')

@section('title', 'Manajemen Berita - RSPD Klaten Admin Panel')

@section('content')
    <div class="news-management p-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2>Manajemen Berita</h2>
                <p class="mb-0">Kelola artikel berita dan pengumuman</p>
            </div>
            <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#tambahBeritaModal">
                <i class="fas fa-plus me-2"></i>Buat Berita
            </button>
        </div>

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-center align-items-center gap-3">
                <div class="input-group grow text-white">
                    <span class="input-group-text bg-dark text-white"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control text-white border-secondary"
                        placeholder="Cari berita berdasarkan judul atau deskripsi..." id="searchInput">
                </div>
                <select class="form-select bg-dark text-white border-secondary" id="categoryFilter">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategories as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="news-list" id="newsList">
            @if ($beritas->count() > 0)
                @foreach ($beritas as $item)
                    <div class="news-card card mb-4" data-category="{{ $item->kategori }}"
                        data-search="{{ Str::lower($item->judul . ' ' . $item->deskripsi) }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">{{ $item->judul }}</h5>
                                <div>
                                    <span class="badge bg-primary text-white">{{ $item->kategori }}</span>
                                </div>
                            </div>

                            @if ($item->gambar)
                                <div class="mb-3">
                                    <img src="{{ asset('images/berita/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                                </div>
                            @endif

                            <p class="card-text">
                                {{ Str::limit($item->deskripsi, 150) }}
                            </p>
                            <div class="news-meta d-flex align-items-center mt-3">
                                <span class="me-3"><i class="far fa-calendar me-1"></i>
                                    {{ $item->tanggal->format('d M Y') }}</span>
                                @if ($item->gambar)
                                    <span class="me-3"><i class="far fa-image me-1"></i> Dengan Gambar</span>
                                @endif
                            </div>
                            <div class="action-buttons mt-3 d-flex gap-2">
                                <button type="button" class="btn btn-outline-light btn-sm lihat-berita"
                                    data-id="{{ $item->id }}">
                                    <i class="far fa-eye me-1"></i>Lihat
                                </button>
                                <button type="button" class="btn btn-outline-light btn-sm edit-berita"
                                    data-id="{{ $item->id }}">
                                    <i class="far fa-edit me-1"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger text-white btn-sm hapus-berita"
                                    data-id="{{ $item->id }}" data-judul="{{ $item->judul }}">
                                    <i class="far fa-trash-alt me-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="card border-secondary">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="far fa-newspaper" style="font-size: 4rem; color: #6b7280;"></i>
                        </div>
                        <h4 class="text-muted mb-3">Belum Ada Berita</h4>
                        <p class="text-muted mb-4">
                            Belum ada berita yang ditambahkan. Mulai dengan membuat berita pertama Anda.
                        </p>
                        <button type="button" class="btn btn-yellow" data-bs-toggle="modal"
                            data-bs-target="#tambahBeritaModal">
                            <i class="fas fa-plus me-2"></i>Tambah Berita Pertama
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <div class="card border-warning d-none" id="noResultsCard">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-search" style="font-size: 3rem; color: #f59e0b;"></i>
                </div>
                <h4 class="text-warning mb-3">Tidak Ditemukan</h4>
                <p class="text-muted mb-3">
                    Tidak ada berita yang sesuai dengan filter pencarian Anda.
                </p>
                <button type="button" class="btn btn-outline-warning me-2" id="resetFilterBtn">
                    <i class="fas fa-times me-1"></i>Reset Filter
                </button>
                <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#tambahBeritaModal">
                    <i class="fas fa-plus me-1"></i>Tambah Berita Baru
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Berita -->
    <div class="modal fade" id="tambahBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Berita Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formTambahBerita" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control bg-dark text-white" id="judul" name="judul"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control bg-dark text-white" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control bg-dark text-white" id="tanggal"
                                    name="tanggal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control bg-dark text-white" id="kategori" name="kategori"
                                    required placeholder="Masukkan kategori (contoh: Infrastruktur, Kesehatan, dll)">
                                <small class="text-muted">Masukkan kategori baru atau pilih dari kategori yang sudah ada</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar (Optional)</label>
                            <input type="file" class="form-control bg-dark text-white" id="gambar" name="gambar"
                                accept="image/*">
                            <small class="text-muted">Format: jpg, png, jpeg, gif. Maks: 2MB</small>
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

    <!-- Modal Edit Berita -->
    <div class="modal fade" id="editBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formEditBerita" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_judul" class="form-label">Judul Berita</label>
                            <input type="text" class="form-control bg-dark text-white" id="edit_judul" name="judul"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control bg-dark text-white" id="edit_deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control bg-dark text-white" id="edit_tanggal"
                                    name="tanggal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control bg-dark text-white" id="edit_kategori" name="kategori"
                                    required placeholder="Masukkan kategori">
                                <small class="text-muted">Masukkan kategori baru atau pilih dari kategori yang sudah ada</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_gambar" class="form-label">Gambar (Optional)</label>
                            <input type="file" class="form-control bg-dark text-white" id="edit_gambar"
                                name="gambar" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            <div id="currentImage" class="mt-2"></div>
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

    <div class="modal fade" id="detailBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Detail Berita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detailContent"></div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus berita "<span id="hapusJudul"></span>"?</p>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmHapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/manajemen-berita.css') }}">
    <style>
        #noResultsCard {
            display: none;
            animation: fadeIn 0.3s ease-in;
        }

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

        .news-card {
            transition: all 0.3s ease;
        }

        .news-card.hidden {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const newsCards = document.querySelectorAll('.news-card');
            const noResultsCard = document.getElementById('noResultsCard');
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            const newsList = document.getElementById('newsList');
            
            document.getElementById('tanggal').valueAsDate = new Date();

            function updateCategoryFilter() {
                const categories = new Set();
                document.querySelectorAll('.news-card').forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (category) {
                        categories.add(category);
                    }
                });
                
                const sortedCategories = Array.from(categories).sort();
                
                categoryFilter.innerHTML = '<option value="">Semua Kategori</option>';
                sortedCategories.forEach(category => {
                    categoryFilter.innerHTML += `<option value="${category}">${category}</option>`;
                });
            }

            function filterNews() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedCategory = categoryFilter.value;
                let visibleCount = 0;

                newsCards.forEach(card => {
                    const searchText = card.getAttribute('data-search') || '';
                    const category = card.getAttribute('data-category');

                    const matchesSearch = searchTerm === '' || searchText.includes(searchTerm);
                    const matchesCategory = !selectedCategory || category === selectedCategory;

                    if (matchesSearch && matchesCategory) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (visibleCount === 0 && (searchTerm !== '' || selectedCategory !== '')) {
                    noResultsCard.classList.remove('d-none');
                    newsList.style.display = 'none';
                } else {
                    noResultsCard.classList.add('d-none');
                    newsList.style.display = 'block';
                }
            }

            searchInput.addEventListener('input', filterNews);
            categoryFilter.addEventListener('change', filterNews);

            if (resetFilterBtn) {
                resetFilterBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    categoryFilter.value = '';
                    filterNews();
                });
            }

            // Form Tambah Berita
            document.getElementById('formTambahBerita').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch("{{ route('berita.store') }}", {
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
                        alert('Terjadi kesalahan saat menambahkan berita');
                    });
            });

            // Edit Berita
            document.querySelectorAll('.edit-berita').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');

                    fetch(`/admin/berita/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit_id').value = data.id;
                            document.getElementById('edit_judul').value = data.judul;
                            document.getElementById('edit_deskripsi').value = data.deskripsi;
                            document.getElementById('edit_tanggal').value = data.tanggal.split('T')[0];
                            document.getElementById('edit_kategori').value = data.kategori;

                            const currentImageDiv = document.getElementById('currentImage');
                            if (data.gambar) {
                                currentImageDiv.innerHTML = `
                                <p class="mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('images/berita') }}/${data.gambar}" 
                                     alt="${data.judul}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 100px;">
                            `;
                            } else {
                                currentImageDiv.innerHTML =
                                    '<p class="text-muted">Tidak ada gambar</p>';
                            }

                            const modal = new bootstrap.Modal(document.getElementById(
                                'editBeritaModal'));
                            modal.show();
                        });
                });
            });

            // Form Edit Berita
            document.getElementById('formEditBerita').addEventListener('submit', function(e) {
                e.preventDefault();

                const id = document.getElementById('edit_id').value;
                const formData = new FormData(this);

                fetch(`/admin/berita/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-HTTP-Method-Override': 'PUT'
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
                        alert('Terjadi kesalahan saat mengupdate berita');
                    });
            });

            // Lihat Berita
            document.querySelectorAll('.lihat-berita').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');

                    fetch(`/admin/berita/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            let imageHtml = '';
                            if (data.gambar) {
                                imageHtml = `
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('images/berita') }}/${data.gambar}" 
                                         alt="${data.judul}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 300px;">
                                </div>
                            `;
                            }

                            document.getElementById('detailContent').innerHTML = `
                            <h4>${data.judul}</h4>
                            <div class="mb-3">
                                <span class="badge bg-primary">${data.kategori}</span>
                                <span class="ms-2 text-muted">
                                    <i class="far fa-calendar"></i> ${new Date(data.tanggal).toLocaleDateString('id-ID', { 
                                        weekday: 'long', 
                                        year: 'numeric', 
                                        month: 'long', 
                                        day: 'numeric' 
                                    })}
                                </span>
                            </div>
                            ${imageHtml}
                            <div class="mb-3">
                                <h6>Deskripsi:</h6>
                                <p style="white-space: pre-wrap;">${data.deskripsi}</p>
                            </div>
                            <div class="text-muted small">
                                <i class="far fa-clock"></i> Diperbarui: ${new Date(data.updated_at).toLocaleString('id-ID')}
                            </div>
                        `;

                            const modal = new bootstrap.Modal(document.getElementById(
                                'detailBeritaModal'));
                            modal.show();
                        });
                });
            });

            let beritaToDelete = null;
            document.querySelectorAll('.hapus-berita').forEach(button => {
                button.addEventListener('click', function() {
                    beritaToDelete = this.getAttribute('data-id');
                    const judul = this.getAttribute('data-judul');
                    document.getElementById('hapusJudul').textContent = judul;

                    const modal = new bootstrap.Modal(document.getElementById('hapusBeritaModal'));
                    modal.show();
                });
            });

            document.getElementById('confirmHapus').addEventListener('click', function() {
                if (!beritaToDelete) return;

                fetch(`/admin/berita/${beritaToDelete}`, {
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
                        alert('Terjadi kesalahan saat menghapus berita');
                    });
            });

            updateCategoryFilter();
        });
    </script>
@endpush