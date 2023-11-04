@extends('layouts.app')

@section('header')
{{-- * Navigate Buttons --}}
<a href="{{route('admin.projects.index')}}" class="btn btn-primary">Back to projects list</a>
<a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning">Edit Project</a>
<h1 class="my-2">Project Name: {{$project->name}}</h1>
@endsection

@section('content')
<div class="container">
    <div class="row my-4">
        {{-- Row with technologies and type --}}
        <h3 class="col-6"><strong>Technologies: </strong>{!!$project->getTechnologyBadges()!!}</h3>
        <h3 class="col-6"><strong>Type: </strong>{!!$project->getTypeBadge()!!}</h3>
    </div>
    <div class="row">
        {{-- Row with link, slug, creatend, update, description--}}
        <p class="col-4">
            <strong>Link:</strong> {{$project->link}}<br>
            <strong>Slug:</strong> {{$project->slug}}<br>
            <strong>Created at:</strong> {{$project->created_at}}<br>
            <strong>Updated at:</strong> {{$project->updated_at}}
        </p>
        {{-- Description --}}
        <p class="col-4">
            <strong>Description:</strong> {{$project->description}}
        </p>
        {{-- CoverImg --}}
        <div class="col-4">
            @if($project->cover_image)
            <img src="{{asset('/storage/' . $project->cover_image)}}" class="img-fluid rounded" alt="cover image">
            @endif
        </div>
    </div>
    
</div>
@endsection