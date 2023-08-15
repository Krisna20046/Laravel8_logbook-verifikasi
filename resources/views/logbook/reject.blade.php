@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Penolakan Logbook</h2>
    <p><strong>Tanggal Logbook:</strong> {{ $logbook->created_at->format('d M Y') }}</p>
    <p><strong>Logbook Harian:</strong> {{ $logbook->daily_log }}</p>

    <form action="{{ route('logbook.reject', $logbook->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Reject</button>
        <a href="{{ route('logbook.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
