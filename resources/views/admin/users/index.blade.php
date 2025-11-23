@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Manajemen User</h2>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role Saat Ini</th>
                        <th style="width: 200px;">Ubah Role</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                <span class="badge 
                                    {{ $user->role->name === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </td>

                            <td>
                                <form action="{{ route('admin.users.updateRole', $user->id) }}" 
                                      method="POST" class="d-flex gap-2">
                                    @csrf

                                    <select name="role_id" class="form-select form-select-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" 
                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-success btn-sm">
                                        Update
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
