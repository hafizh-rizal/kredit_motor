@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->

        <!-- Main Content Area -->
        <div class="col-md-9 col-12"> 
            <div class="card">
                <div class="card-header">
                    <h5>Edit Asuransi</h5>
                </div>
                <div class="card-body">
                    <!-- Form Edit Asuransi -->
                    <form action="{{ route('asuransi.update', $asuransi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_perusahaan_asuransi">Nama Perusahaan Asuransi</label>
                            <input type="text" class="form-control" id="nama_perusahaan_asuransi" name="nama_perusahaan_asuransi" required value="{{ old('nama_perusahaan_asuransi', $asuransi->nama_perusahaan_asuransi) }}">
                        </div>

                        <div class="form-group">
                            <label for="nama_asuransi">Nama Asuransi</label>
                            <input type="text" class="form-control" id="nama_asuransi" name="nama_asuransi" required value="{{ old('nama_asuransi', $asuransi->nama_asuransi) }}">
                        </div>

                        <div class="form-group">
                            <label for="margin_asuransi">Margin Asuransi (%)</label>
                            <input type="number" class="form-control" id="margin_asuransi" name="margin_asuransi" required value="{{ old('margin_asuransi', $asuransi->margin_asuransi) }}">
                        </div>

                        <div class="form-group">
                            <label for="no_rekening">No Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required value="{{ old('no_rekening', $asuransi->no_rekening) }}">
                        </div>

                        <div class="form-group">
                            <label for="url_logo">URL Logo (Optional)</label>
                            <input type="url" class="form-control" id="url_logo" name="url_logo" value="{{ old('url_logo', $asuransi->url_logo) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('asuransi.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
