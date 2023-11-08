<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('id', 'name', 'type_id', 'description', 'link', 'slug')
            ->with('technologies:id,name,color', 'type:id,name,color')
            ->paginate(12);
        return response()->json($projects);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::select('id', 'name', 'type_id', 'description', 'link', 'slug')
            ->where('id', $id)
            ->with('technologies:id,name,color', 'type:id,name,color')
            ->first();
        return response()->json($project);
    }

    public function projectsByType($type_id)
    {
        $type = Type::select('id', 'name', 'color')
            ->where('id', $type_id)
            ->first();

        $projects = Project::select('id', 'name', 'type_id', 'description', 'link', 'slug')
            ->where('type_id', $type_id)
            ->with('technologies:id,name,color', 'type:id,name,color')
            ->orderByDesc('id')
            ->get();
        return response()->json([
            'type' => $type,
            'projects' => $projects
        ]);
    }
}
