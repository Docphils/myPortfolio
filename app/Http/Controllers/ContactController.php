<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 


class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(10);

        return view('contacts.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Contact::findOrFail($id); // Example: Fetch message by ID

        return view('contacts.show', compact('message'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Process the form data (e.g., save to database)
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Optionally, you can send an email here

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
