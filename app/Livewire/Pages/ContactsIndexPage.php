<?php

namespace App\Livewire\Pages;

use App\Models\Contact;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Contacts')]
class ContactsIndexPage extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';
    #[Url(as: 'from')]
    public ?string $dateFrom = null;
    #[Url(as: 'to')]
    public ?string $dateTo = null;

    public function updating(string $property): void
    {
        if (in_array($property, ['search', 'dateFrom', 'dateTo'], true)) {
            $this->resetPage();
        }
    }

    public function deleteMessage(int $contactId): void
    {
        Contact::query()->findOrFail($contactId)->delete();
        session()->flash('success', 'Message deleted successfully.');
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'dateFrom', 'dateTo']);
        $this->resetPage();
    }

    public function render()
    {
        $messages = Contact::query()
            ->when($this->search !== '', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('message', 'like', '%'.$this->search.'%');
            })
            ->when($this->dateFrom, fn ($query) => $query->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($query) => $query->whereDate('created_at', '<=', $this->dateTo))
            ->latest()
            ->paginate(10);

        return view('livewire.pages.contacts-index-page', [
            'messages' => $messages,
        ]);
    }
}
