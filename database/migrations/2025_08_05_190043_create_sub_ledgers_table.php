<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'Accounts Receivable', 'Accounts Payable'
            $table->text('description')->nullable();
             // Foreign key to link to the Chart of Accounts controlling account
            $table->foreignId('chart_of_account_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_ledgers');
    }
};
