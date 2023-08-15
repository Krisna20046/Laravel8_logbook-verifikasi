<!-- views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengguna</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select type="role" name="role" id="role" class="form-control" value="{{ $user->role }}" required>
                <option value="Staff" {{ $user->role === 'Staff' ? 'selected' : '' }}>Staff</option>
                <option value="KepalaBidang" {{ $user->role === 'KepalaBidang' ? 'selected' : '' }}>Kepala Bidang</option>
                <option value="KepalaDinas" {{ $user->role === 'KepalaDinas' ? 'selected' : '' }}>Kepala Dinas</option>
                <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection