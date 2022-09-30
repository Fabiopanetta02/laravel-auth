@if ($post->exists)
<form action="{{ route('admin.posts.update', $post) }}" method="POST">
    @method('PUT')
@else
<form action="{{ route('admin.posts.store') }}" method="POST">  
@endif
    @csrf
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" id="category_id" name="category_id">
                  <option value="">Nessuna categoria</option>
                  @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->label }}</option>
                  @endforeach

                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="8">{{ old('content', $post->content) }}</textarea>
            </div>
        </div>
        <div class="col-11">
            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="url" class="form-control" id="image-field" name="image" value="{{ old('image', $post->image) }}">
            </div>
        </div>
        <div class="col-1">
            <img src="{{ $post->image ?? "https://www.runningin.info/wp-content/uploads/2018/07/no-image.jpg" }}" alt="post image preview" id="preview" class="img-fluid">
        </div>
        @if(count($tags))
            <div class="col-12">
                <h4>Tags</h4>
                @foreach ($tags as $tag)
                    <div class="form-group form-check-inline">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            id="tag-{{ $tag->label }}" 
                            name="tags[]" 
                            value="{{ $tag->id }}"
                            @if(in_array($tag->id, old('tags', $prev_tags ?? []))) checked @endif 
                        >
                        <label class="form-check-label" for="tag-{{ $tag->label }}">{{ $tag->label }}</label>
                    </div>   
                @endforeach
            </div>
        @endif
    </div>
    <hr>
    <footer class="d-flex justify-content-between">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
        </a>

        <button class="btn btn-success" type="submit">
            <i class="fa-solid fa-floppy-disk mr-2"></i> Salva
        </button>
    </footer>
</form>