<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('contract_title');
            $table->date('renewal_due_date');
            $table->string('status')->default('upcoming');
            $table->decimal('renewal_amount', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('reminder_30_sent')->default(false);
            $table->boolean('reminder_90_sent')->default(false);
            $table->boolean('reminder_150_sent')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('renewals');
    }
};
