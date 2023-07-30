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
        Schema::create('roles_has_users', function (Blueprint $table) {
            $table->foreignUuid('role_uid')->constrained('roles', 'uid')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('user_uid')->constrained('users', 'uid')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['role_uid', 'user_uid']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_has_users');
    }
};
