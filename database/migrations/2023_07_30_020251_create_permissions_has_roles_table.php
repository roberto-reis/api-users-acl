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
        Schema::create('permissions_has_roles', function (Blueprint $table) {
            $table->foreignUuid('permission_uid')->constrained('permissions', 'uid')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('role_uid')->constrained('roles', 'uid')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['permission_uid', 'role_uid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_has_roles');
    }
};
