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
        Schema::table('users', function (Blueprint $table) {
    $table->foreignId('agency_id')->nullable()->constrained()->cascadeOnDelete();
    $table->boolean('is_agency_admin')->default(false);
     $table->boolean('is_super_admin')->default(false);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['agency_id']); 
        $table->dropColumn(['agency_id', 'is_agency_admin','is_super_admin']); 
    });
    }
};
