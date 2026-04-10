<?php

namespace App\Livewire\Pages;

use App\Models\About;
use Livewire\Component;

class AboutFormPage extends Component
{
    public ?About $about = null;
    public string $content = '';

    public function mount(?About $about = null): void
    {
        $this->about = $about;
        $this->content = $about?->content ?? '';
    }

    protected function rules(): array
    {
        return [
            'content' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->about) {
            $this->about->update($validated);
            $message = 'About Me section updated successfully.';
        } else {
            $this->about = About::query()->create($validated);
            $message = 'About Me section created successfully.';
        }

        return redirect()->route('dashboard')->with('success', $message);
    }

    public function delete()
    {
        if ($this->about) {
            $this->about->delete();
        }

        return redirect()->route('dashboard')->with('success', 'About Me section deleted successfully.');
    }

    public function render()
    {
        return view('livewire.pages.about-form-page');
    }
}
