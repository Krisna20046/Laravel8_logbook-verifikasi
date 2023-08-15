@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Logbook Harian</h2>
    <a href="{{ route('logbook.create') }}" class="btn btn-primary mb-2">Buat Logbook Baru</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Logbook Harian</th>
                <th>Gambar</th>
                <th>Aksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logbook as $key => $logbook)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $logbook->created_at->format('d M Y') }}</td>
                <td>{{ $logbook->daily_log }}</td>
                <td><img src="{{ asset( $logbook->image) }}" alt="Logbook Image" width="200"></td>
                <td>
                    @if ($logbook->status === 'Pending' || $logbook->status === 'Rejected')
                    <a href="{{ route('logbook.edit', $logbook->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('logbook.destroy', $logbook->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus logbook ini?')">Hapus</button>
                    </form>
                    @endif
                </td>
                <td>{{ $logbook->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
