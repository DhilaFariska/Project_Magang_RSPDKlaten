@extends('layouts.app')

@section('title', 'Dashboard - RSPD Klaten Admin Panel')

@section('content')
    <div class="dashboard p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard</h2>
            <div class="text-white">
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card card bg-dark text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2">Total Admin</h6>
                            <h3 class="mb-1">{{ $totalAdmin }}</h3>
                            <small class="text-success">Pengguna sistem</small>
                        </div>
                        <i class="fas fa-users-cog fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card card bg-dark text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2">Total Berita</h6>
                            <h3 class="mb-1">{{ $totalBerita }}</h3>
                            <small class="text-success">{{ $kategoriBerita['total'] ?? 0 }} kategori aktif</small>
                        </div>
                        <i class="fas fa-newspaper fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card card bg-dark text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2">Program Siaran</h6>
                            <h3 class="mb-1">{{ $totalSiaran }}</h3>
                            <small class="text-white">{{ $siaranHariIni->count() }} program hari ini</small>
                        </div>
                        <i class="fas fa-broadcast-tower fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card card bg-dark text-white h-100">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-2">Total Jadwal</h6>
                            <h3 class="mb-1">{{ $totalJadwal }}</h3>
                            <small class="text-success">{{ $jadwalHariIni->count() }} jadwal hari ini</small>
                        </div>
                        <i class="fas fa-calendar-alt fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Statistik -->
        <div class="row g-4 mb-4">
            <!-- Grafik Kategori Berita -->
            <div class="col-lg-4">
                <div class="card bg-dark text-white">
                    <div class="card-header border-secondary d-flex align-items-center">
                        <i class="fas fa-chart-pie me-2"></i>
                        <h5 class="mb-0">Distribusi Kategori Berita</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="kategoriBeritaChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Grafik Program Siaran -->
            <div class="col-lg-4">
                <div class="card bg-dark text-white">
                    <div class="card-header border-secondary d-flex align-items-center">
                        <i class="fas fa-broadcast-tower me-2"></i>
                        <h5 class="mb-0">Distribusi Program Siaran</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="siaranChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Grafik Jadwal Harian -->
            <div class="col-lg-4">
                <div class="card bg-dark text-white">
                    <div class="card-header border-secondary d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <h5 class="mb-0">Distribusi Jadwal Harian</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="jadwalChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Detail -->
        <div class="row g-4">
            <!-- Berita Terbaru -->
            <div class="col-lg-6">
                <div class="card bg-dark text-white">
                    <div class="card-header border-secondary d-flex align-items-center">
                        <i class="fas fa-newspaper me-2"></i>
                        <h5 class="mb-0">Berita Terbaru</h5>
                        <a href="{{ route('berita.index') }}" class="ms-auto btn btn-sm btn-outline-light">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 60%">Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($beritaTerbaru as $berita)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-alt text-primary me-2"></i>
                                                    <div class="text-truncate" style="max-width: 200px;" 
                                                         title="{{ $berita->judul }}">
                                                        {{ $berita->judul }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $berita->kategori }}</span>
                                            </td>
                                            <td class="text-white">
                                                {{ $berita->tanggal->translatedFormat('d M Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">
                                                <i class="fas fa-newspaper fa-2x mb-3 text-white"></i>
                                                <p class="text-white mb-0">Belum ada berita</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Hari Ini -->
            <div class="col-lg-6">
                <div class="card bg-dark text-white">
                    <div class="card-header border-secondary d-flex align-items-center">
                        <i class="fas fa-calendar-day me-2"></i>
                        <h5 class="mb-0">Jadwal Hari Ini</h5>
                        <span class="ms-auto badge bg-warning text-dark">
                            {{ $jadwalHariIni->count() }} Jadwal
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Waktu</th>
                                        <th>Nama Jadwal</th>
                                        <th>Presenter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jadwalHariIni as $jadwal)
                                        <tr>
                                            <td class="text-warning">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $jadwal->waktu_format }}
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 150px;">
                                                    {{ $jadwal->nama_jadwal }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user me-2 text-white"></i>
                                                    <span class="text-truncate" style="max-width: 100px;">
                                                        {{ $jadwal->presenter }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">
                                                <i class="fas fa-clock fa-2x mb-3 text-white"></i>
                                                <p class="text-white mb-0">Belum ada jadwal hari ini</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ Session::get('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if(Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: true
                });
            @endif

            @if(Session::has('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: '{{ Session::get('info') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: `
                        <ul class="text-start">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                    showConfirmButton: true
                });
            @endif
            
            const kategoriData = @json($kategoriBerita);
            const siaranData = @json($siaranPerKategori);
            const jadwalData = @json($jadwalHarian);

            const kategoriCtx = document.getElementById('kategoriBeritaChart').getContext('2d');
            const kategoriChart = new Chart(kategoriCtx, {
                type: 'doughnut',
                data: {
                    labels: kategoriData.labels,
                    datasets: [{
                        data: kategoriData.data,
                        backgroundColor: kategoriData.colors,
                        borderColor: 'rgba(0, 0, 0, 0.3)',
                        borderWidth: 1,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#94a3b8',
                                padding: 15,
                                font: {
                                    size: 11
                                },
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((context.parsed / total) * 100);
                                    label += context.parsed + ' berita (' + percentage + '%)';
                                    return label;
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });

            const siaranCtx = document.getElementById('siaranChart').getContext('2d');
            const siaranChart = new Chart(siaranCtx, {
                type: 'bar',
                data: {
                    labels: siaranData.labels,
                    datasets: [{
                        label: 'Jumlah Program',
                        data: siaranData.data,
                        backgroundColor: siaranData.colors,
                        borderColor: siaranData.colors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1,
                        borderRadius: 5,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#94a3b8',
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                maxRotation: 45
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            const jadwalCtx = document.getElementById('jadwalChart').getContext('2d');
            const jadwalChart = new Chart(jadwalCtx, {
                type: 'line',
                data: {
                    labels: jadwalData.labels,
                    datasets: [{
                        label: 'Jumlah Jadwal',
                        data: jadwalData.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: 'rgba(54, 162, 235, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: '#94a3b8'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#94a3b8',
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#94a3b8',
                                maxTicksLimit: 8
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            const statCards = document.querySelectorAll('.stat-card');
            
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.3)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(255, 255, 255, 0.05)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
@endpush