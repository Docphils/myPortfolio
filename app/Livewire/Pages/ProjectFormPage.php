<?php

namespace App\Livewire\Pages;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectFormPage extends Component
{
    use WithFileUploads;

    public ?Project $project = null;
    public string $title = '';
    public string $description = '';
    public ?string $link = null;
    public array $media = [];

    public function mount(?Project $project = null): void
    {
        $this->project = $project;
        $this->title = $project?->title ?? '';
        $this->description = $project?->description ?? '';
        $this->link = $project?->link;
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'link' => ['nullable', 'url'],
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

        return redirect()->route('projects.show', $project)->with('success', $message);
    }

    public function render()
    {
        return view('livewire.pages.project-form-page');
    }
}
