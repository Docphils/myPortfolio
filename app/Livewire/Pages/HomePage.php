<?php

namespace App\Livewire\Pages;

use App\Mail\ContactMessageReceived;
use App\Models\About;
use App\Models\CaseStudy;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Throwable;

class HomePage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';
    public bool $showProjectStarter = false;
    public ?int $selectedCaseStudyId = null;
    public string $projectType = '';
    public string $budgetRange = '';
    public string $timeline = '';
    public string $goals = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    protected function starterRules(): array
    {
        return [
            'projectType' => ['required', 'string', 'max:100'],
            'budgetRange' => ['required', 'string', 'max:100'],
            'timeline' => ['required', 'string', 'max:100'],
            'goals' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    protected function starterSubmitRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'projectType' => ['required', 'string', 'max:100'],
            'budgetRange' => ['required', 'string', 'max:100'],
            'timeline' => ['required', 'string', 'max:100'],
            'goals' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function openProjectStarter(): void
    {
        $this->showProjectStarter = true;
    }

    public function closeProjectStarter(): void
    {
        $this->showProjectStarter = false;
    }

    public function applyProjectStarter(): void
    {
        $this->validate($this->starterRules());

        $this->message = "Project Type: {$this->projectType}\n"
            ."Budget Range: {$this->budgetRange}\n"
            ."Timeline: {$this->timeline}\n"
            ."Goals:\n{$this->goals}";

        $this->showProjectStarter = false;
        $this->dispatch('scroll-to', target: 'contact');
    }

    public function openCaseStudies(): void
    {
        $latestCaseStudy = CaseStudy::query()
            ->published()
            ->ordered()
            ->first();

        if (!$latestCaseStudy) {
            session()->flash('error', 'No case studies are published yet.');
            return;
        }

        $this->redirectRoute('case-studies.show', ['caseStudy' => $latestCaseStudy->slug], navigate: true);
    }

    public function selectCaseStudy(int $caseStudyId): void
    {
        $this->selectedCaseStudyId = $caseStudyId;
    }

    public function submitContact(): void
    {
        $throttleKey = 'homepage-contact:'.Str::lower($this->email).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            session()->flash('error', 'Too many attempts. Please wait a minute and try again.');
            return;
        }

        $validated = $this->validate();
        RateLimiter::hit($throttleKey, 60);

        $this->storeContactAndNotify($validated);

        $this->reset(['name', 'email', 'message']);
        session()->flash('success', 'Message sent successfully!');
    }

    public function submitProjectStarter(): void
    {
        $throttleKey = 'homepage-starter:'.Str::lower($this->email).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            session()->flash('error', 'Too many attempts. Please wait a minute and try again.');
            return;
        }

        $validated = $this->validate($this->starterSubmitRules());
        RateLimiter::hit($throttleKey, 60);

        $this->storeContactAndNotify([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => "Project Type: {$validated['projectType']}\n"
                ."Budget Range: {$validated['budgetRange']}\n"
                ."Timeline: {$validated['timeline']}\n"
                ."Goals:\n{$validated['goals']}",
        ]);

        $this->reset([
            'name',
            'email',
            'message',
            'projectType',
            'budgetRange',
            'timeline',
            'goals',
        ]);
        $this->showProjectStarter = false;
        session()->flash('success', 'Project request sent successfully!');
    }

    protected function storeContactAndNotify(array $payload): void
    {
        $contact = Contact::create($payload);

        try {
            Mail::to(config('mail.contact_recipients'))->send(new ContactMessageReceived($contact));
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    public function render()
    {
        $about = Cache::remember('homepage:about:v1', now()->addMinutes(30), static fn () => About::query()->first());

        $projects = Cache::remember('homepage:projects:v1', now()->addMinutes(10), static function () {
            return Project::query()
                ->published()
                ->featured()
                ->latest('published_at')
                ->latest('id')
                ->take(9)
                ->get()
                ->filter(static fn (Project $project): bool => count($project->imageMedia()) > 0)
                ->values();
        });

        $caseStudies = Cache::remember('homepage:case-studies:v1', now()->addMinutes(10), static function () {
            return CaseStudy::query()
                ->published()
                ->ordered()
                ->take(6)
                ->get();
        });

        $testimonials = Cache::remember('homepage:testimonials:v1', now()->addMinutes(10), static function () {
            return Testimonial::query()
                ->published()
                ->featured()
                ->ordered()
                ->take(10)
                ->get();
        });

        if ($this->selectedCaseStudyId === null && $caseStudies->isNotEmpty()) {
            $this->selectedCaseStudyId = $caseStudies->first()->id;
        }

        $selectedCaseStudy = $caseStudies->firstWhere('id', $this->selectedCaseStudyId) ?? $caseStudies->first();

        $totalProjects = Project::query()->published()->count();
        $totalMessages = Contact::query()->count();
        $yearsExperience = max(1, Carbon::now()->year - 2020);

        return view('livewire.pages.home-page', [
            'about' => $about,
            'projects' => $projects,
            'caseStudies' => $caseStudies,
            'selectedCaseStudy' => $selectedCaseStudy,
            'testimonials' => $testimonials,
            'totalProjects' => $totalProjects,
            'totalMessages' => $totalMessages,
            'yearsExperience' => $yearsExperience,
        ])->layout('layouts.portfolio');
    }
}
