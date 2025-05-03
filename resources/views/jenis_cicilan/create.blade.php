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
        <div class="card-header">
            <h5>Form Tambah Jenis Cicilan</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jenis_cicilan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="lama_cicilan">Lama Cicilan (bulan)</label>
                    <input type="number" name="lama_cicilan" id="lama_cicilan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="margin_kredit">Margin Kredit (%)</label>
                    <input type="number" step="0.01" name="margin_kredit" id="margin_kredit" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('jenis_cicilan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
