<?php

namespace App\Livewire\Pages;

use App\Models\Contact;
use Livewire\Component;

class ContactShowPage extends Component
{
    public Contact $contact;

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
    }

    public function delete()
    {
        $this->contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Message deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.contact-show-page');
    }
}
