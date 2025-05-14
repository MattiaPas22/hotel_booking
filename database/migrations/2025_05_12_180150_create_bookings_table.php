<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // CHIAVE ESTERNA VERSO LA TABELLA USERS
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // CHIAVE ESTERNA VERSO LA TABELLA ROOMS
            $table->foreignId('room_id')
                  ->constrained()
                  ->onDelete('cascade');

            // GESTIONE DELLE DATE DI CHECK-IN E CHECK-OUT
            $table->date('check_in_date');
            $table->date('check_out_date');

            // PREZZO TOTALE DELLA PRENOTAZIONE
            $table->decimal('total_price', 8, 2);

            // STATO DELLA PRENOTAZIONE
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');

            // DATA CREAZIONE E AGGIORNAMENTO DELLA PRENOTAZIONE
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
