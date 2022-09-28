@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista Post</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus mr-2"></i> Nuovo Post
    </a>
</header>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            <td class="d-flex justify-content-start">
                <a class="btn btn-sm btn-light mr-2" href="{{ route('admin.posts.show', $post) }}">
                    <i class="fa-solid fa-eye mr-2"></i> Dettagli
                </a>
                <a class="btn btn-sm btn-warning mr-2" href="{{ route('admin.posts.edit', $post) }}">
                    <i class="fa-solid fa-pencil mr-2"></i> Modifica
                </a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fa-solid fa-trash mr-2"></i>Elimina
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <h3 class="text-center">Nessun Post</h3>
            </td>
        </tr>  
        @endforelse 
    </tbody>
</table>
@endsection