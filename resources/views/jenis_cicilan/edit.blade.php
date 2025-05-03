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
            <h5>Edit Jenis Cicilan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_cicilan.update', $jenisCicilan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="lama_cicilan">Lama Cicilan (bulan)</label>
                    <input type="number" name="lama_cicilan" class="form-control @error('lama_cicilan') is-invalid @enderror" value="{{ old('lama_cicilan', $jenisCicilan->lama_cicilan) }}" required>
                    @error('lama_cicilan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="margin_kredit">Margin Kredit (%)</label>
                    <input type="number" name="margin_kredit" step="0.01" class="form-control @error('margin_kredit') is-invalid @enderror" value="{{ old('margin_kredit', $jenisCicilan->margin_kredit) }}" required>
                    @error('margin_kredit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('jenis_cicilan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
