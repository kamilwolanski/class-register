<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_classroom_id')
                ->constrained()  // Domyślnie wskazuje na 'teacher_classroom.id'
                ->onDelete('cascade');  // Usuwa rekordy powiązane, gdy nauczyciel zostanie usunięty.

            $table->integer('day_of_week');  // Dzień tygodnia: 0 (Poniedziałek), ..., 6 (Niedziela)
            $table->integer('hour');  // Godzina lekcji jako liczba, np. 1 = 8:00, 2 = 9:00, itp.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
}
