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
    public array $images = [];
    public array $videos = [];
    public array $existingImages = [];
    public array $existingVideos = [];
    public array $removedMedia = [];
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
        $this->existingImages = $project?->imageMedia() ?? [];
        $this->existingVideos = $project?->videoMedia() ?? [];
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
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,gif', 'max:102400'],
            'videos' => ['nullable', 'array'],
            'videos.*' => ['file', 'mimes:mp4', 'max:102400'],
        ];
    }

    public function removePendingImage(int $index): void
    {
        if (!isset($this->images[$index])) {
            return;
        }

        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function removePendingVideo(int $index): void
    {
        if (!isset($this->videos[$index])) {
            return;
        }

        unset($this->videos[$index]);
        $this->videos = array_values($this->videos);
    }

    public function removeExistingImage(int $index): void
    {
        if (!isset($this->existingImages[$index])) {
            return;
        }

        $path = $this->existingImages[$index];
        unset($this->existingImages[$index]);
        $this->existingImages = array_values($this->existingImages);

        if (!in_array($path, $this->removedMedia, true)) {
            $this->removedMedia[] = $path;
        }
    }

    public function removeExistingVideo(int $index): void
    {
        if (!isset($this->existingVideos[$index])) {
            return;
        }

        $path = $this->existingVideos[$index];
        unset($this->existingVideos[$index]);
        $this->existingVideos = array_values($this->existingVideos);

        if (!in_array($path, $this->removedMedia, true)) {
            $this->removedMedia[] = $path;
        }
    }

    public function save()
    {
        $validated = $this->validate();

        $hasExistingMedia = count($this->existingImages) > 0 || count($this->existingVideos) > 0;
        $hasNewMedia = count($this->images) > 0 || count($this->videos) > 0;

        if (!$this->project && !$hasExistingMedia && !$hasNewMedia) {
            $this->addError('images', 'Please upload at least one image or video.');

            return;
        }

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

        $existingPaths = array_values(array_merge($this->existingImages, $this->existingVideos));
        $newPaths = [];

        foreach ($this->images as $file) {
            $newPaths[] = $file->store('media/images', 'public');
        }

        foreach ($this->videos as $file) {
            $newPaths[] = $file->store('media/videos', 'public');
        }

        $project->media = implode(',', array_merge($existingPaths, $newPaths));

        $project->save();

        if (!empty($this->removedMedia)) {
            foreach ($this->removedMedia as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $message = $this->project ? 'Project updated successfully.' : 'Project created successfully.';

        return redirect()->route('admin.projects.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.pages.project-form-page');
    }
}
