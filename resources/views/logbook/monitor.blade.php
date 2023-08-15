@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Monitor Logbook Harian</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Logbook</th>
                <th>Logbook Harian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logbook as $key => $log)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->created_at->format('d M Y') }}</td>
                <td>{{ $log->daily_log }}</td>
                <td>{{ $log->status }}</td>
                <td>
                    @if ($log->status === 'Pending')
                    <form action="{{ route('logbook.approve', $log->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <form action="{{ route('logbook.reject', $log->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
