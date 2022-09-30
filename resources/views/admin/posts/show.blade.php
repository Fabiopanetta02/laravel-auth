@extends('layouts.app')

@section('content')
<div class="container">
    <header>
        <h1>{{ $post->title }}</h1>
    </header>
    <main>
        <div class="clearfix">
            @if ($post->image)
                <img class="float-left mr-2 img-fluid" src="{{ $post->image }}" alt="{{ $post->slug }}">  
            @endif
            <div class="mb-2">
                <strong>Categoria: </strong>
                @if ($post->category)
                    {{ $post->category->label }}
                @else
                    Nessuna Categoria
                @endif
            </div>
            <div class="mb-2">
                <strong>Tags: </strong>
                    @forelse ($post->tags as $tag)
                        <span class="badge mx-1" style="background-color: {{ $tag->color }}">{{ $tag->label }}</span>
                    @empty
                        Nessun Tag
                    @endforelse
            </div>
            <p>{{ $post->content }}</p>
            <div>
                <strong>Creato il: </strong><time>{{ $post->created_at }}</time>
            </div>
            <div>
                <strong>Modificato il: </strong><time>{{ $post->updated_at }}</time>
            </div>
            <div>
                <strong>Autore: </strong>
                @if ($post->author)
                    {{ $post->author->name }}
                @else
                    Anonimo
                @endif
            </div>
        </div>
    </main>
    <hr>
    <footer class="d-flex align-items-center justify-content-between">
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
            </a>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <a class="btn btn btn-warning mr-2" href="{{ route('admin.posts.edit', $post) }}">
                <i class="fa-solid fa-pencil mr-2"></i> Modifica
            </a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-trash mr-2"></i>Elimina
                </button>
            </form>
        </div>
    </footer>

@endsection