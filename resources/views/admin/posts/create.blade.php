@extends('layouts.app')

@section('content')
<div class="container">
    <header>
        <h1>Crea Post</h1>
    </header>
    <hr>
    @include('includes.admin.posts.form')
</div>
@endsection