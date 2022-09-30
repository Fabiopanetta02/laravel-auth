@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista Post</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i>
        </a>
    </header>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">E-mail</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">Età</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Telefono</th>
                <th scope="col">N. Posts</th>
                <th scope="col" class="text-center">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <th scope="col">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->details->getFullName() }}</td>
                <td>{{ $user->details->getAge() }}</td>
                <td>{{ $user->details->address }}</td>
                <td>{{ $user->details->phone }}</td>
                <td>{{ count($user->posts) }}</td>
                <td></td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <h3 class="text-center">Nessun Utente</h3>
                </td>
            </tr> 
            @endforelse
        </tbody>
    </table>
@endsection