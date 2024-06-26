<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Project;
use App\Models\Contact;
use App\Models\User;

class AboutController extends Controller
{
    public function home()
    {
        $projects = Project::latest()->take(3)->get();
        return view('welcome', compact('projects'));
    }
    public function welcome()
    {
        $about = About::first();
        return view('welcome', compact('about'));
    }

    public function dashboard()
    {
        $totalProjects = Project::count();
        $totalMessages = Contact::count();
        $totalUsers = User::count();
        $about = About::first();
        return view('dashboard', compact('about', 'totalProjects', 'totalMessages'));
    }

    public function create()
    {
        return view('abouts.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:10|max:2000',
        ], [
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
            'content.min' => 'The content must be at least 10 characters.',
            'content.max' => 'The content may not be greater than 2000 characters.',
        ]);

        About::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'About Me section created successfully.');
    }

    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:10|max:2000',
        ], [
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
            'content.min' => 'The content must be at least 10 characters.',
            'content.max' => 'The content may not be greater than 2000 characters.',
        ]);

        $about = About::findOrFail($id);
        $about->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'About Me section updated successfully.');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();

        return redirect()->route('dashboard')->with('success', 'About Me section deleted successfully.');
    }
}
