<?php

namespace App\Livewire\Pages;

use App\Models\About;
use App\Models\Contact;
use App\Models\Project;
use Livewire\Component;

class HomePage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }

    public function submitContact(): void
    {
        $validated = $this->validate();

        Contact::create($validated);

        $this->reset(['name', 'email', 'message']);
        session()->flash('success', 'Message sent successfully!');
    }

    public function render()
    {
        $about = About::query()->first();
        $projects = Project::query()
            ->latest()
            ->take(9)
            ->get()
            ->filter(static fn (Project $project): bool => count($project->imageMedia()) > 0);

        return view('livewire.pages.home-page', [
            'about' => $about,
            'projects' => $projects,
        ])->layout('layouts.portfolio');
    }
}
