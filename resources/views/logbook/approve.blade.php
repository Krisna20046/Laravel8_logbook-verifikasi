@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Persetujuan Logbook</h2>
    <p><strong>Tanggal Logbook:</strong> {{ $logbook->created_at->format('d M Y') }}</p>
    <p><strong>Logbook Harian:</strong> {{ $logbook->daily_log }}</p>

    <form action="{{ route('logbook.approve', $logbook->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Approve</button>
        <a href="{{ route('logbook.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
