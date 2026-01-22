@extends('layouts.app')

@section('title', 'Detail Feedback')

@section('content')
<style>
    .card {
        background-color: #1a1a1a;
        border: 1px solid #333;
        color: #fff;
    }
    .card-header {
        border-bottom: 1px solid #333;
    }
    .card-body p, .card-body label, .card-body strong, .card-body small {
        color: #fff !important;
    }
    .text-muted {
        color: #999 !important;
    }
    .form-control {
        background-color: #2a2a2a;
        border: 1px solid #444;
        color: #fff;
    }
    .form-control:focus {
        background-color: #2a2a2a;
        border-color: #ffc107;
        color: #fff;
    }
    .form-label {
        color: #fff;
    }
    h2, h4, h5 {
        color: #fff !important;
    }
</style>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary btn-sm mb-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0">Detail Feedback</h2>
        </div>
        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-envelope"></i> Pesan dari Audiens</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $feedback->subjek }}</h4>
                        @if($feedback->kategori)
                        <span class="badge bg-info">{{ $feedback->kategori }}</span>
                        @endif
                        <span class="ms-2">
                            @if($feedback->status === 'baru')
                            <span class="badge bg-warning text-dark">Baru</span>
                            @else
                            <span class="badge bg-primary">Dibaca</span>
                            @endif
                        </span>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold">Pesan:</label>
                        <p style="white-space: pre-line;">{{ $feedback->pesan }}</p>
                    </div>
                    <div class="text-muted">
                        <small><i class="fas fa-clock"></i> Diterima: {{ $feedback->created_at->format('d F Y, H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Informasi Pengirim</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Nama Lengkap:</label>
                        <p>{{ $feedback->nama_lengkap }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Nomor Telepon:</label>
                        <p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $feedback->nomor_telepon) }}" 
                               target="_blank" 
                               class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i> {{ $feedback->nomor_telepon }}
                            </a>
                        </p>
                    </div>
                    @if($feedback->email)
                    <div class="mb-3">
                        <label class="fw-bold">Email:</label>
                        <p>
                            <a href="mailto:{{ $feedback->email }}">{{ $feedback->email }}</a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Status Timeline</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success"></i> 
                            <strong>Diterima</strong><br>
                            <small class="text-muted ms-3">{{ $feedback->created_at->format('d/m/Y H:i') }}</small>
                        </li>
                        @if($feedback->status === 'dibaca')
                        <li class="mb-2">
                            <i class="fas fa-eye text-primary"></i> 
                            <strong>Dibaca</strong><br>
                            <small class="text-muted ms-3">{{ $feedback->updated_at->format('d/m/Y H:i') }}</small>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
