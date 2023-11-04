@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('header')
{{-- * Navigate Buttons --}}
<a href="{{route('admin.projects.index')}}" class="btn btn-primary">Back to Project List</a>
<a href="{{route('admin.projects.show', $project)}}" class="btn btn-success">Back to Project Details</a>
<h1 class="my-2">Edit Project</h1>
@endsection

@section('content')
<div class="container">
    {{-- Condition to display form errors in page --}}
    @if($errors->any())
    <h2>Correct following errors:</h2>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
        @endforeach
    </ul>
    @endif
    {{-- FORM --}}
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row gy-3">
        <div class="col-4">
            {{-- Name --}}
            <label for="name" class="form-label" >Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name') ?? $project->name}}" id="name" name="name" />
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-4">
            {{-- Link --}}
            <label for="link" class="form-label">Link</label>
            <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{old('link') ?? $project->link}}" />
            @error('link')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-4">
            {{-- Type --}}
            <label for="type_id" class="form-label">Type</label>
            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                <option value="">Untyped</option>
                @foreach($types as $type)
                    <option value="{{$type->id}}" @if(old('type_id', $project->type_id ) == $type->id) selected @endif>{{$type->name}}</option>
                @endforeach
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-2">
             {{-- Technologies --}}
            <div>
                <p>Technologies Used</p>
                <div class="form-check @error('technologies') is-invalid @enderror">
                    @foreach($technologies as $technology)
                        <input type="checkbox" 
                        name="technologies[]" 
                        id="technology-{{$technology->id}}" 
                        value="{{$technology->id}}" 
                        class="form-check-control" 
                        @if(in_array($technology->id, old('technologies', $technology_ids)))checked @endif>
                        <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
                        <br>
                    @endforeach
                </div>
                @error('technologies')
                <div class="invalid-feedback">
                        {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-4">
            {{-- Description --}}
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                name="description"
                >{{old('description') ?? $project->description}}
            </textarea>
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            {{-- Cover Image --}}
            <label for="cover_image" class="form-label mt-2">Cover Image</label>
            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image')}}" id="cover_image" />
            @error('cover_image')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 
        <div class="col-6 text-end">
            {{-- Preview Cover Image --}}
            <img src="{{asset('/storage/' . $project->cover_image)}}" class="img-fluid rounded" id="cover_image_preview">
            @if($project->cover_image)
            <span class="badge text-bg-danger del-img-btn" id="del-img-btn">
                <i class="fa-solid fa-trash"></i> Delete Image
            </span>
            @endif
        </div>
        </div>
        {{-- Submit button --}}
        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>

@if($project->cover_image)
<form id="delete-img-form" method="POST" action="{{route('admin.projects.delete-img', $project)}}">
    @method('DELETE')
    @csrf
</form>
@endif

@endsection

@section('scripts')
<script type="text/javascript">
// Get ElementById and save in const
const inputFileElement = document.getElementById('cover_image');

// Get ElementById and save in const (for preview)
const coverImagePreview = document.getElementById('cover_image_preview');

// Condition for showing img placeholder
if(!coverImagePreview.getAttribute('src')|| coverImagePreview.getAttribute('src') == "http://localhost:8000/storage"){
    coverImagePreview.src = 'https://placehold.co/600x400?text=No+Image';
}

// Event listener when insert a file to upload
inputFileElement.addEventListener('change', function(){
    const[file] = this.files;
    coverImagePreview.src = URL.createObjectURL(file);
})
</script>

{{-- Script active when project cover_image exists --}}
@if($project->cover_image)
<script>
    const deleteImgBtn = document.getElementById('del-img-btn');
    const deleteImgForm= document.getElementById('delete-img-form');
    deleteImgBtn.addEventListener('click', function()
    {
        deleteImgForm.submit();
    });
</script>
@endif
@endsection