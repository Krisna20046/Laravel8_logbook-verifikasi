@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Logbook Harian</h2>
    <form action="{{ route('logbook.update', $logbook->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="daily_log">Logbook Harian:</label>
            <textarea class="form-control" name="daily_log" id="daily_log" rows="6"
                required>{{ $logbook->daily_log }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" class="form-control"></input>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('logbook.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection