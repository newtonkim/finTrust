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
        Schema::create('sub_ledger_transactions', function (Blueprint $table) {
            $table->id();
            // Foreign key to link to the parent sub-ledger
            $table->foreignId('sub_ledger_id')->constrained()->onDelete('cascade');
            $table->date('transaction_date');
            $table->string('reference_number')->nullable(); // e.g., Invoice #, Payment ID
            $table->decimal('amount', 15, 2);
            $table->string('type'); // e.g., 'invoice', 'payment', 'purchase', 'sale'
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_ledger_transactions');
    }
};
