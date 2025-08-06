<?php

namespace Database\Factories;

use App\Models\ChartOfAccounts;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChartOfAccountsFactory extends Factory
{
    protected $model = ChartOfAccounts::class;

    public function definition(): array
    {
        return [
            'gl_code' => $this->faker->unique()->numerify('####'),
            'name' => $this->faker->words(2, true),
            'account_type' => $this->faker->randomElement(['Asset', 'Liability', 'Equity', 'Revenue', 'Expense']),
            'parent_account_id' => null,
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }

    public function asset(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'Asset',
        ]);
    }

    public function liability(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'Liability',
        ]);
    }

    public function equity(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'Equity',
        ]);
    }

    public function revenue(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'Revenue',
        ]);
    }

    public function expense(): static
    {
        return $this->state(fn (array $attributes) => [
            'account_type' => 'Expense',
        ]);
    }

    public function withParent(ChartOfAccounts $parent): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_account_id' => $parent->id,
        ]);
    }
}
