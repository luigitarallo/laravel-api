@extends('layouts.app')

@section('header')
{{-- Buttons to navigate --}}
<a href="{{route('admin.projects.index')}}" class="btn btn-primary">Back to Projects List</a>
<h1 class="my-2">Insert a new Project</h1>
@endsection

@section('content')
{{-- Condition to display form errors in page --}}
<div class="container">
    @if($errors->any())
    <h2>Correct following errors:</h2>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
        @endforeach
    </ul>
    @endif
    {{-- FORM --}}
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-4">
                {{-- Name --}}
                <label for="name" class="form-label mt-2">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="name" name="name"  />
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-4">
                {{-- Type --}}
                <label for="type_id" class="form-label mt-2">Type</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Untyped</option>
                    @foreach($types as $type)
                    <option value="{{$type->id}}" @if(old('Type_id')==$type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-4">
                {{-- Link --}}
                <label for="link" class="form-label mt-2">Link</label>
                <input type="url" class="form-control @error('description') is-invalid @enderror " id="link" name="link" value="{{old('link')}}" />
                @error('link')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-4">
                {{-- Technologies --}}
                <p class="mt-2">Technologies Used</p>
                <div class="form-check @error('technologies') is-invalid @enderror">
                    @foreach($technologies as $technology)
                    <input type="checkbox" 
                        name="technologies[]" 
                        id="technology-{{$technology->id}}" 
                        value="{{$technology->id}}" 
                        class="form-check-control" 
                        @if(in_array($technology->id, old('technologies', [])))checked @endif>
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
            <div class="col-4">
                {{-- Cover Image --}}
                <label for="cover_image" class="form-label mt-2">Cover Image</label>
                <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image')}}" id="cover_image"  />
                @error('cover_image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                {{-- Description --}}
                <label for="description" class="form-label mt-2">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">
                    {{old('description')}}
                </textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>  
            <div class="col-4">
                {{-- Cover Image Preview --}}
                <img src="" class="img-fluid rounded mt-2" id="cover_image_preview" alt="cover image">
            </div>
            
        </div>
        {{-- Save Button --}}
        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
// Get ElementById from img and save in a const
const coverImagePreview = document.getElementById('cover_image_preview');

// Condition if img is missing
if(!coverImagePreview.getAttribute('src')){
    coverImagePreview.src = 'https://placehold.co/600x400?text=No+Image';
}

// Get ElementById from input and save in a const
const inputFileElement = document.getElementById('cover_image');

// Function to put uploaded file to img src
inputFileElement.addEventListener('change', function(){
    const[file] = this.files;
    coverImagePreview.src = URL.createObjectURL(file);
})
</script>
@endsection