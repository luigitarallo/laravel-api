@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
  <div class='container'>
    <h1>Projects List</h1>
    <a href="{{route('admin.projects.create')}}" class="btn btn-primary">Add New Project</a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Technologies</th>
            <th scope="col">Description</th>
            <th scope="col">Link</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
            <tr>
                <th scope="row">{{$project->id}}</th>
                <td>{{$project->name}}</td>
                <td>{!!$project->getTypeBadge()!!}</td>
                <td>{!!$project->getTechnologyBadges()!!}</td>
                <td>{{$project->description}}</td>
                <td>{{$project->link}}</td>
                <td>
                  <div class="d-flex">
                    {{-- Show Link --}}
                    <a href="{{route('admin.projects.show', $project)}}" class="mx-1">
                      <i class="fa-solid fa-up-right-from-square"></i>
                    </a>
                    {{-- Edit Link --}}
                    <a href="{{ route('admin.projects.edit', $project) }}" class="mx-1">
                      <i class="fa-solid fa-pencil"></i>
                    </a>
                  {{-- Delete Link with modal--}}
                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}" class="mx-1">
                      <i class="fa-solid fa-trash text-danger"></i>  
                    </a>
                    {{-- Modal --}}
                    <div class="modal fade" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Project</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              Are you sure? Do you want to delete the project: "{{$project->name}}"?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retry</button>
                            {{-- Delete Form --}}
                            <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="mx-1">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger">Confirm</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>     
            @empty
            <tr>
                <td colspan="8">
                    <i>No projects found</i>
                </td>
            </tr> 
            @endforelse
        </tbody>
      </table>
      {{-- For pagination --}}
    {{$projects->links('pagination::bootstrap-5')}}
</div>
@endsection