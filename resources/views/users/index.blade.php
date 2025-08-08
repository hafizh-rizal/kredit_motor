@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h5><i class="ti-user mr-2"></i> Manajemen User</h5>
                <span>Kelola akun user sesuai peran (admin, marketing, CEO)</span>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-primary mt-2 mt-md-0">
                <i class="ti-plus mr-2"></i> Tambah User
            </a>
        </div>
        <div class="card-body">

            {{-- FORM FILTER & SEARCH --}}
            <form method="GET" action="{{ route('users.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="role" class="form-control">
                            <option value="">-- Semua Role --</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="marketing" {{ request('role') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="ceo" {{ request('role') == 'ceo' ? 'selected' : '' }}>CEO</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-2">
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti-search mr-1"></i> Cari
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-light border">
                            <i class="ti-reload mr-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- TABEL USER --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning edit-button" title="Edit">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                               <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button btn-delete" title="Hapus">
        <i class="ti-trash"></i>
    </button>
</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data user ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<style>
    .action-buttons {
        white-space: nowrap;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        border-radius: 0.2rem;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .edit-button {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .edit-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
    }

    .delete-button {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .delete-button:hover {
        transform: scale(1.1);
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
    }

    .btn i {
        margin-right: 0.3rem;
    }
</style>
@endsection
