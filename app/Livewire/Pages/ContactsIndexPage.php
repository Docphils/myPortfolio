<?php

namespace App\Livewire\Pages;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsIndexPage extends Component
{
    use WithPagination;

    public function deleteMessage(int $contactId): void
    {
        Contact::query()->findOrFail($contactId)->delete();
        session()->flash('success', 'Message deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.contacts-index-page', [
            'messages' => Contact::query()->latest()->paginate(10),
        ]);
    }
}
