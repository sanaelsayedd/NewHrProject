<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->uuid('employee_id'); // Assuming users.id is a UUID
            $table->foreign('employee_id')->references('id')->on('users')->restrictOnDelete();
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('Status')->default('Pending');
            $table->foreignId('Permission_Type_id')->constrained('permission_types', 'id')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
