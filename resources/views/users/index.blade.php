<!-- views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengguna</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
