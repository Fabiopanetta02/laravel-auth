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
            <th scope="col">Titolo</th>
            <th scope="col">Autore</th>
            <th scope="col">Categoria</th>
            <th scope="col">Tags</th>
            <th scope="col">Creato</th>
            <th scope="col">Modificato</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>
                @if ($post->author)
                    {{ $post->author->name }}
                @else
                    Anonimo
                @endif
            </td>
            <td>
                @if ($post->category)
                    <span class="badge badge-pill badge-{{ $post->category->color ?? 'light' }}">
                        {{ $post->category->label }}
                    </span>
                @else
                    Nessuna
                @endif
            </td>
            <td>
                @forelse ($post->tags as $tag)
                    <span class="badge mx-1" style="background-color: {{ $tag->color }}">{{ $tag->label }}</span>
                @empty
                    Nessun Tag
                @endforelse
            </td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            <td class="d-flex justify-content-center">
                <a class="btn btn-sm btn-light mr-2" href="{{ route('admin.posts.show', $post) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <a class="btn btn-sm btn-warning mr-2" href="{{ route('admin.posts.edit', $post) }}">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <h3 class="text-center">Nessun Post</h3>
            </td>
        </tr>  
        @endforelse 
    </tbody>
</table>
@endsection