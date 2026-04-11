<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Project Form')]
class ProjectFormPage extends Component
{
    use WithFileUploads;

    public ?Project $project = null;
    public string $title = '';
    public string $description = '';
    public ?string $link = null;
    public array $media = [];
    public bool $is_published = true;
    public bool $is_featured = false;
    public ?string $published_at = null;

    public function mount(?Project $project = null): void
    {
        $this->project = $project;
        $this->title = $project?->title ?? '';
        $this->description = $project?->description ?? '';
        $this->link = $project?->link;
        $this->is_published = $project?->is_published ?? true;
        $this->is_featured = $project?->is_featured ?? false;
        $this->published_at = optional($project?->published_at)->format('Y-m-d\TH:i');
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'link' => ['nullable', 'url'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'media' => [$this->project ? 'nullable' : 'required', 'array'],
            'media.*' => ['file', 'mimes:jpg,jpeg,png,gif,mp4', 'max:102400'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $project = $this->project ?? new Project();
        $project->fill([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link' => $validated['link'] ?? null,
            'is_published' => (bool) $validated['is_published'],
            'is_featured' => (bool) $validated['is_featured'],
            'published_at' => $validated['is_published'] ? ($validated['published_at'] ?? now()) : null,
        ]);

        if (!$project->exists) {
            $project->media = '';
            $project->save();
        }

        if (!empty($this->media)) {
            foreach ($project->mediaItems() as $path) {
                Storage::disk('public')->delete($path);
            }

            $newPaths = [];
            foreach ($this->media as $file) {
                $newPaths[] = $file->store('media', 'public');
            }

            $project->media = implode(',', $newPaths);
        }

        $project->save();

        $message = $this->project ? 'Project updated successfully.' : 'Project created successfully.';

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.pages.project-form-page');
    }
}
