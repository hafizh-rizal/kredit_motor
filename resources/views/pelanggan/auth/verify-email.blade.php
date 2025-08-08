@extends('fe.master')

@section('content')
<div class="container py-5">
    <h4>Verifikasi Email</h4>
    <p>Kami telah mengirim link verifikasi ke email kamu.</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
    </form>
</div>
@endsection
