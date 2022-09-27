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
            <p>{{ $post->content }}</p>
            <div>
                <strong>Creato il: </strong><time>{{ $post->created_at }}</time>
            </div>
            <div>
                <strong>Modificato il: </strong><time>{{ $post->updated_at }}</time>
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