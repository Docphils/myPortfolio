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

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:10|max:1000',
        'media.*' => 'required|file|mimes:jpg,jpeg,png,gif,mp4|max:10240', // Max 10MB per file
    ]);

    $mediaPaths = [];

    if ($request->hasFile('media')) {
        // Delete old media files
        if ($project->media) {
        $oldMediaPaths = json_decode($project->media, true);
        foreach ($oldMediaPaths as $oldMediaPath) {
            Storage::disk('public')->delete($oldMediaPath);
        }
        }

        foreach ($request->file('media') as $file) {
        $mediaPath = $file->store('media', 'public');
        $mediaPaths[] = $mediaPath;
        }
    } else {
        // Keep existing media if no new files uploaded
        $mediaPaths = json_decode($project->media, true);
    }

    $validated['media'] = json_encode($mediaPaths);

    $project->update($validated);

    return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }


    public function destroy(Project $project)
    {
        // Delete media file
        if ($project->media) {
            Storage::disk('public')->delete($project->media);
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
