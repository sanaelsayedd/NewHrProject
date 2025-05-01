<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->uuid('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('VacationTypeID')->constrained('vacation_types', 'id')->restrictOnDelete();
            $table->date('Start_Date'); 
            $table->date('End_Date');  
            $table->integer('Duration'); 
            $table->dateTime('RequestDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('ApprovalDate')->nullable();            
            $table->string(column: 'Status')->default('Pending'); 
            $table->string('Comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
