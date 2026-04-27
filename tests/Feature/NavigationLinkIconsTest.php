<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationLinkIconsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_navigation_links_include_icons(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertOk()
            ->assertDontSee('Browse Categories')
            ->assertDontSee('Search Items')
            ->assertSee('M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', false)
            ->assertSee('M8 7V3m8 4V3m-9 8h10', false)
            ->assertSee('M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2', false);
    }

    public function test_homepage_shows_profile_dropdown_for_authenticated_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertOk()
            ->assertSee('Manage Account')
            ->assertSee('group inline-flex items-center rounded-full px-1 py-1 ring-1 ring-transparent transition hover:ring-slate-200 dark:hover:ring-slate-700', false)
            ->assertSee('M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938', false);
    }

    public function test_shared_navigation_menu_links_include_icons(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('my-listings'))
            ->assertOk()
            ->assertSee('M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', false)
            ->assertSee('M8 7V3m8 4V3m-9 8h10', false)
            ->assertSee('M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2', false);
    }
}
