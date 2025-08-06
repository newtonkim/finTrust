<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChartOfAccounts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

class ChartOfAccountsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_displays_chart_of_accounts_index_page()
    {
        // Create test accounts
        $parentAccount = ChartOfAccounts::factory()->create([
            'gl_code' => '1000',
            'name' => 'Assets',
            'account_type' => 'Asset',
            'parent_account_id' => null,
        ]);

        $childAccount = ChartOfAccounts::factory()->create([
            'gl_code' => '1100',
            'name' => 'Current Assets',
            'account_type' => 'Asset',
            'parent_account_id' => $parentAccount->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get('/chart-of-accounts');

        $response->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('ChartOfAccounts/Index')
                ->has('accounts')
                ->has('accounts.data', 2)
                ->has('allAccounts', 2)
                ->where('accounts.data.0.name', 'Assets')
                ->where('accounts.data.1.name', 'Current Assets')
                ->where('accounts.data.1.parent_account.name', 'Assets')
            );
    }

    /** @test */
    public function it_can_create_a_new_account()
    {
        $accountData = [
            'gl_code' => '2000',
            'name' => 'Liabilities',
            'account_type' => 'Liability',
            'parent_account_id' => null,
            'description' => 'Test liability account',
        ];

        $response = $this->actingAs($this->user)
            ->post('/chart-of-accounts', $accountData);

        $response->assertRedirect('/chart-of-accounts')
            ->assertSessionHas('success', 'Account created successfully.');

        $this->assertDatabaseHas('chart_of_accounts', [
            'gl_code' => '2000',
            'name' => 'Liabilities',
            'account_type' => 'Liability',
        ]);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_account()
    {
        $response = $this->actingAs($this->user)
            ->post('/chart-of-accounts', []);

        $response->assertSessionHasErrors(['gl_code', 'name', 'account_type']);
    }

    /** @test */
    public function it_validates_unique_gl_code()
    {
        ChartOfAccounts::factory()->create(['gl_code' => '1000']);

        $response = $this->actingAs($this->user)
            ->post('/chart-of-accounts', [
                'gl_code' => '1000',
                'name' => 'Test Account',
                'account_type' => 'Asset',
            ]);

        $response->assertSessionHasErrors(['gl_code']);
    }

    /** @test */
    public function it_can_update_an_existing_account()
    {
        $account = ChartOfAccounts::factory()->create([
            'gl_code' => '1000',
            'name' => 'Original Name',
            'account_type' => 'Asset',
        ]);

        $updateData = [
            'gl_code' => '1001',
            'name' => 'Updated Name',
            'account_type' => 'Asset',
            'parent_account_id' => null,
            'description' => 'Updated description',
        ];

        $response = $this->actingAs($this->user)
            ->put("/chart-of-accounts/{$account->id}", $updateData);

        $response->assertRedirect('/chart-of-accounts')
            ->assertSessionHas('success', 'Account updated successfully.');

        $this->assertDatabaseHas('chart_of_accounts', [
            'id' => $account->id,
            'gl_code' => '1001',
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_delete_an_account()
    {
        $account = ChartOfAccounts::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete("/chart-of-accounts/{$account->id}");

        $response->assertRedirect('/chart-of-accounts')
            ->assertSessionHas('success', 'Account deleted successfully.');

        $this->assertDatabaseMissing('chart_of_accounts', [
            'id' => $account->id,
        ]);
    }

    /** @test */
    public function it_shows_parent_account_relationships()
    {
        $parentAccount = ChartOfAccounts::factory()->create([
            'name' => 'Parent Account',
            'parent_account_id' => null,
        ]);

        $childAccount = ChartOfAccounts::factory()->create([
            'name' => 'Child Account',
            'parent_account_id' => $parentAccount->id,
        ]);

        $response = $this->actingAs($this->user)
            ->get('/chart-of-accounts');

        $response->assertInertia(fn (Assert $page) => $page
            ->where('accounts.data.1.parent_account.name', 'Parent Account')
        );
    }

    /** @test */
    public function it_paginates_accounts_correctly()
    {
        // Create 25 accounts to test pagination (20 per page)
        ChartOfAccounts::factory()->count(25)->create();

        $response = $this->actingAs($this->user)
            ->get('/chart-of-accounts');

        $response->assertInertia(fn (Assert $page) => $page
            ->has('accounts.data', 20)
            ->where('accounts.total', 25)
            ->where('accounts.per_page', 20)
        );
    }

    /** @test */
    public function unauthenticated_users_cannot_access_chart_of_accounts()
    {
        $response = $this->get('/chart-of-accounts');
        $response->assertRedirect('/login');
    }
}
