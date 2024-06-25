<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:1000',
            'media.*' => 'required|file|mimes:jpg,jpeg,png,gif,mp4|max:10240', // Max 10MB per file
        ]);

        // Save the project details to get the project ID
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'media' => '', // Initialize the media column; you can update this later
        ]);

        // Process and store each uploaded file
        foreach ($request->file('media') as $file) {
            // Store the file in storage/app/public directory
            $path = $file->store('media', 'public');

            // Append the path to the 'media' column 
            $project->media .= $path . ','; 
        }

        // Save the updated 'media' column
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }
   
    public function destroy(Project $project)
    {
        // Delete media file if it exists
        if ($project->media) {
            Storage::disk('public')->delete($project->media);
        }

        // Delete the project record
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }

}
