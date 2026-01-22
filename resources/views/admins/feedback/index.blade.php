@extends('layouts.app')

@section('title', 'Manajemen Feedback Audiens')

@section('content')
<style>
    .card {
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        color: #fff !important;
    }
    .table {
        color: #fff !important;
        background-color: #1a1a1a !important;
    }
    .table thead th {
        color: #ffc107 !important;
        border-bottom: 2px solid #444 !important;
        background-color: #1a1a1a !important;
    }
    .table tbody td {
        border-bottom: 1px solid #333 !important;
        color: #fff !important;
        vertical-align: middle !important;
        background-color: #1a1a1a !important;
    }
    .table tbody td small {
        color: #ccc !important;
    }
    .table tbody td .text-muted {
        color: #999 !important;
    }
    .table-hover tbody tr:hover td {
        background-color: #2a2a2a !important;
        color: #fff !important;
    }
    .table-warning td {
        background-color: #3a3520 !important;
        color: #fff !important;
    }
    h2 {
        color: #fff !important;
    }
    .form-select {
        background-color: #2a2a2a !important;
        border: 1px solid #444 !important;
        color: #fff !important;
    }
    .form-select option {
        background-color: #2a2a2a !important;
        color: #fff !important;
    }
    small {
        color: #ccc !important;
    }
    .badge {
        font-weight: 600;
        padding: 0.35em 0.65em;
    }
    .btn {
        border: 1px solid #444;
    }
    .btn:hover {
        transform: scale(1.05);
        transition: all 0.2s;
    }
</style>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Feedback dari Audiens</h2>
        <div class="d-flex gap-2">
            <select class="form-select" id="filterStatus" style="width: auto;">
                <option value="">Semua Status</option>
                <option value="baru">Baru</option>
                <option value="dibaca">Dibaca</option>
                <option value="ditanggapi">Ditanggapi</option>
            </select>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($feedbacks->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" style="color: #fff !important;">
                    <thead>
                        <tr style="background-color: #1a1a1a;">
                            <th width="5%" style="color: #ffc107 !important;">#</th>
                            <th width="15%" style="color: #ffc107 !important;">Nama</th>
                            <th width="15%" style="color: #ffc107 !important;">Kontak</th>
                            <th width="25%" style="color: #ffc107 !important;">Subjek</th>
                            <th width="15%" style="color: #ffc107 !important;">Kategori</th>
                            <th width="10%" style="color: #ffc107 !important;">Status</th>
                            <th width="10%" style="color: #ffc107 !important;">Tanggal</th>
                            <th width="10%" style="color: #ffc107 !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr class="{{ $feedback->status === 'baru' ? 'table-warning' : '' }}" style="background-color: {{ $feedback->status === 'baru' ? '#3a3520' : '#1a1a1a' }} !important;">
                            <td style="color: #fff !important;">{{ $loop->iteration }}</td>
                            <td style="color: #fff !important;">{{ $feedback->nama_lengkap }}</td>
                            <td style="color: #fff !important;">
                                <small style="color: #ccc !important;">{{ $feedback->nomor_telepon }}</small><br>
                                @if($feedback->email)
                                <small class="text-muted" style="color: #999 !important;">{{ $feedback->email }}</small>
                                @endif
                            </td>
                            <td style="color: #fff !important;">{{ Str::limit($feedback->subjek, 50) }}</td>
                            <td style="color: #fff !important;">
                                @if($feedback->kategori)
                                <span class="badge bg-info">{{ $feedback->kategori }}</span>
                                @else
                                <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td style="color: #fff !important;">
                                @if($feedback->status === 'baru')
                                <span class="badge bg-warning text-dark">Baru</span>
                                @else
                                <span class="badge bg-primary">Dibaca</span>
                                @endif
                            </td>
                            <td style="color: #fff !important;">
                                <small style="color: #ccc !important;">{{ $feedback->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td style="color: #fff !important;">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-primary" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Menampilkan {{ $feedbacks->firstItem() }} - {{ $feedbacks->lastItem() }} dari {{ $feedbacks->total() }} feedback
                </div>
                <div>
                    {{ $feedbacks->links() }}
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h4>Belum Ada Feedback</h4>
                <p class="text-muted">Feedback dari audiens akan muncul di sini</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table-warning {
        background-color: #fff3cd !important;
    }
</style>
@endsection
