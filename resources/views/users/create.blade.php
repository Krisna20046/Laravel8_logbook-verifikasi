<!-- views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pengguna Baru</h2>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select type="role" name="role" id="role" class="form-control" required>
                <option value="Staff">Staff</option>
                <option value="KepalaBidang">Kepala Bidang</option>
                <option value="KepalaDinas">Kepala Dinas</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
