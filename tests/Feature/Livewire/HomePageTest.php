<?php

namespace Tests\Feature\Livewire;

use App\Mail\ContactMessageReceived;
use App\Livewire\Pages\HomePage;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_starter_modal_opens_and_applies_message(): void
    {
        Livewire::test(HomePage::class)
            ->call('openProjectStarter')
            ->assertSet('showProjectStarter', true)
            ->set('projectType', 'Business Platform')
            ->set('budgetRange', '$1,500 - $5,000')
            ->set('timeline', '2 - 4 Weeks')
            ->set('goals', 'Build a conversion-ready product website with admin dashboard.')
            ->call('applyProjectStarter')
            ->assertSet('showProjectStarter', false)
            ->assertSet('message', "Project Type: Business Platform\nBudget Range: \$1,500 - \$5,000\nTimeline: 2 - 4 Weeks\nGoals:\nBuild a conversion-ready product website with admin dashboard.");
    }

    public function test_admin_cms_routes_require_authentication(): void
    {
        $this->get(route('admin.case-studies.index'))->assertRedirect(route('login'));
        $this->get(route('admin.testimonials.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_admin_cms_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.case-studies.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('admin.testimonials.index'))
            ->assertOk();
    }

    public function test_contact_submission_sends_email_notification(): void
    {
        Mail::fake();

        Livewire::test(HomePage::class)
            ->set('name', 'Philip Doe')
            ->set('email', 'philip@example.com')
            ->set('message', 'Hello, I need a new website and admin panel for my startup.')
            ->call('submitContact')
            ->assertHasNoErrors();

        $contact = Contact::query()->first();
        $this->assertNotNull($contact);

        Mail::assertSent(ContactMessageReceived::class, function (ContactMessageReceived $mail) use ($contact) {
            return $mail->contact->is($contact);
        });
    }
}
