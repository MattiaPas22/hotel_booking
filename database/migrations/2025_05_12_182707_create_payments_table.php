<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Relazione con bookings
            $table->decimal('amount', 8, 2);
            $table->string('payment_method')->default('stripe'); // Specifica il metodo (es: Stripe)
            $table->string('payment_status')->default('pending'); // pending / paid / failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
