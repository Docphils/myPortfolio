<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(9);
        
        // Filter projects with images
        $projectImages = $projects->filter(function ($project) {
            $imageMedia = array_filter(explode(',', $project->media), function ($media) {
                return Str::endsWith($media, ['.jpg', '.jpeg', '.png', '.gif']);
            });
            return count($imageMedia) > 0;
        });

        // Filter projects with videos
        $projectVideos = $projects->filter(function ($project) {
            $videoMedia = array_filter(explode(',', $project->media), function ($media) {
                return Str::endsWith($media, ['.mp4']);
            });
            return count($videoMedia) > 0;
        });

        return view('projects.index', compact('projects','projectImages', 'projectVideos'));
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

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:1000',
            'media.*' => 'required|file|mimes:jpg,jpeg,png,gif,mp4|max:100240', // Max 10MB per file
            'link' => 'nullable|url',
        ]);

        // Save the project details to get the project ID
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'media' => '', // Initialize the media column; you can update this later
            'link' => $validated['link'],
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

    public function update(Request $request, Project $project)
    {
        // Validate inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:1000',
            'media.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4|max:100240',
            'link' => 'nullable|url',
        ]);

        // Update main fields
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->link = $validated['link'] ?? $project->link;

        // Check if new media is uploaded
        if ($request->hasFile('media')) {

            // 1. Delete existing media files
            if (!empty($project->media)) {
                $existingMedia = array_filter(explode(',', $project->media));

                foreach ($existingMedia as $mediaPath) {
                    Storage::disk('public')->delete($mediaPath);
                }
            }

            // 2. Store new media files & build the media string
            $mediaPaths = [];

            foreach ($request->file('media') as $file) {
                $path = $file->store('media', 'public');
                $mediaPaths[] = $path;
            }

            // Save the new comma-separated list
            $project->media = implode(',', $mediaPaths) . ',';

        }

        // Save changes
        $project->save();

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Project updated successfully');
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
