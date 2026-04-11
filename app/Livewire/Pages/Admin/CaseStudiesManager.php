<?php

namespace App\Livewire\Pages\Admin;

use App\Models\CaseStudy;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Case Studies Manager')]
class CaseStudiesManager extends Component
{
    use WithFileUploads;
    use WithPagination;

    public ?int $editingId = null;
    public ?int $project_id = null;
    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $challenge = '';
    public string $solution = '';
    public string $results = '';
    public ?string $project_url = null;
    public string $stack_input = '';
    public int $sort_order = 0;
    public bool $is_published = false;
    public ?string $published_at = null;
    public $cover_image;
    public ?string $current_cover_image = null;
    #[Url(as: 'q')]
    public string $search = '';
    #[Url(as: 'status')]
    public string $status = 'all';

    public function updatedTitle(string $value): void
    {
        if ($this->editingId === null) {
            $this->slug = Str::slug($value);
        }
    }

    public function updating(string $property): void
    {
        if (in_array($property, ['search', 'status'], true)) {
            $this->resetPage();
        }
    }

    protected function rules(): array
    {
        return [
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('case_studies', 'slug')->ignore($this->editingId)],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $coverPath = $this->current_cover_image;
        if ($this->cover_image) {
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }
            $coverPath = $this->cover_image->store('case-studies', 'public');
        }

        $stack = array_values(array_filter(array_map('trim', explode(',', $this->stack_input))));

        $caseStudy = CaseStudy::query()->updateOrCreate(
            ['id' => $this->editingId],
            [
                'project_id' => $validated['project_id'],
                'title' => $validated['title'],
                'slug' => $validated['slug'],
                'excerpt' => $validated['excerpt'],
                'challenge' => $validated['challenge'],
                'solution' => $validated['solution'],
                'results' => $validated['results'],
                'project_url' => $validated['project_url'],
                'sort_order' => $validated['sort_order'],
                'is_published' => $this->is_published,
                'published_at' => $validated['published_at'] ?? null,
                'cover_image' => $coverPath,
                'stack' => $stack ?: null,
            ]
        );

        $this->editingId = $caseStudy->id;
        $this->current_cover_image = $caseStudy->cover_image;
        $this->cover_image = null;
        session()->flash('success', 'Case study saved successfully.');
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $model = CaseStudy::query()->findOrFail($id);

        $this->editingId = $model->id;
        $this->project_id = $model->project_id;
        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->excerpt = (string) $model->excerpt;
        $this->challenge = (string) $model->challenge;
        $this->solution = (string) $model->solution;
        $this->results = (string) $model->results;
        $this->project_url = $model->project_url;
        $this->stack_input = implode(', ', $model->stack ?? []);
        $this->sort_order = $model->sort_order;
        $this->is_published = $model->is_published;
        $this->published_at = optional($model->published_at)->format('Y-m-d\TH:i');
        $this->current_cover_image = $model->cover_image;
    }

    public function delete(int $id): void
    {
        $model = CaseStudy::query()->findOrFail($id);
        if ($model->cover_image) {
            Storage::disk('public')->delete($model->cover_image);
        }
        $model->delete();
        session()->flash('success', 'Case study deleted successfully.');
        $this->resetForm();
    }

    public function togglePublished(int $id): void
    {
        $model = CaseStudy::query()->findOrFail($id);
        $model->is_published = !$model->is_published;
        $model->published_at = $model->is_published ? ($model->published_at ?? now()) : null;
        $model->save();
        session()->flash('success', 'Case study status updated.');
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId',
            'project_id',
            'title',
            'slug',
            'excerpt',
            'challenge',
            'solution',
            'results',
            'project_url',
            'stack_input',
            'sort_order',
            'is_published',
            'published_at',
            'cover_image',
            'current_cover_image',
        ]);

        $this->sort_order = 0;
        $this->is_published = false;
    }

    public function render()
    {
        $caseStudies = CaseStudy::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%');
            })
            ->when($this->status === 'published', fn ($query) => $query->where('is_published', true))
            ->when($this->status === 'draft', fn ($query) => $query->where('is_published', false))
            ->ordered()
            ->paginate(8);

        return view('livewire.pages.admin.case-studies-manager', [
            'caseStudies' => $caseStudies,
            'projects' => Project::query()->orderBy('title')->get(),
        ]);
    }
}
