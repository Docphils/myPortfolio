<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Testimonial;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Testimonials Manager')]
class TestimonialsManager extends Component
{
    use WithPagination;

    public ?int $editingId = null;
    public string $quote = '';
    public string $author_name = '';
    public string $author_role = '';
    public string $company = '';
    public ?int $rating = null;
    public int $sort_order = 0;
    public bool $is_featured = true;
    public bool $is_published = false;
    public ?string $published_at = null;
    #[Url(as: 'q')]
    public string $search = '';
    #[Url(as: 'status')]
    public string $status = 'all';

    protected function rules(): array
    {
        return [
            'quote' => ['required', 'string', 'min:10', 'max:3000'],
            'author_name' => ['required', 'string', 'max:255'],
            'author_role' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function updating(string $property): void
    {
        if (in_array($property, ['search', 'status'], true)) {
            $this->resetPage();
        }
    }

    public function save(): void
    {
        $validated = $this->validate();

        Testimonial::query()->updateOrCreate(
            ['id' => $this->editingId],
            [
                'quote' => $validated['quote'],
                'author_name' => $validated['author_name'],
                'author_role' => $validated['author_role'] ?: null,
                'company' => $validated['company'] ?: null,
                'rating' => $validated['rating'],
                'sort_order' => $validated['sort_order'],
                'is_featured' => $this->is_featured,
                'is_published' => $this->is_published,
                'published_at' => $validated['published_at'] ?? null,
            ]
        );

        session()->flash('success', 'Testimonial saved successfully.');
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $item = Testimonial::query()->findOrFail($id);

        $this->editingId = $item->id;
        $this->quote = $item->quote;
        $this->author_name = $item->author_name;
        $this->author_role = (string) $item->author_role;
        $this->company = (string) $item->company;
        $this->rating = $item->rating;
        $this->sort_order = $item->sort_order;
        $this->is_featured = $item->is_featured;
        $this->is_published = $item->is_published;
        $this->published_at = optional($item->published_at)->format('Y-m-d\TH:i');
    }

    public function delete(int $id): void
    {
        Testimonial::query()->findOrFail($id)->delete();
        session()->flash('success', 'Testimonial deleted successfully.');
        $this->resetForm();
    }

    public function togglePublished(int $id): void
    {
        $item = Testimonial::query()->findOrFail($id);
        $item->is_published = !$item->is_published;
        $item->published_at = $item->is_published ? ($item->published_at ?? now()) : null;
        $item->save();

        session()->flash('success', 'Testimonial publication status updated.');
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId',
            'quote',
            'author_name',
            'author_role',
            'company',
            'rating',
            'sort_order',
            'is_featured',
            'is_published',
            'published_at',
        ]);

        $this->sort_order = 0;
        $this->is_featured = true;
        $this->is_published = false;
    }

    public function render()
    {
        $testimonials = Testimonial::query()
            ->when($this->search !== '', function ($query) {
                $query->where('author_name', 'like', '%'.$this->search.'%')
                    ->orWhere('company', 'like', '%'.$this->search.'%')
                    ->orWhere('quote', 'like', '%'.$this->search.'%');
            })
            ->when($this->status === 'published', fn ($query) => $query->where('is_published', true))
            ->when($this->status === 'draft', fn ($query) => $query->where('is_published', false))
            ->ordered()
            ->paginate(10);

        return view('livewire.pages.admin.testimonials-manager', [
            'testimonials' => $testimonials,
        ]);
    }
}
