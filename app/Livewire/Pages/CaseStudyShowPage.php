<?php

namespace App\Livewire\Pages;

use App\Models\CaseStudy;
use Livewire\Component;

class CaseStudyShowPage extends Component
{
    public CaseStudy $caseStudy;

    public function mount(CaseStudy $caseStudy): void
    {
        abort_unless($caseStudy->is_published, 404);

        $this->caseStudy = $caseStudy;
    }

    public function render()
    {
        return view('livewire.pages.case-study-show-page')->layout('layouts.portfolio');
    }
}
