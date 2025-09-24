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
        Schema::table('secrets', function (Blueprint $table) {
            $table->longText('link')->nullable()->change();
            $table->longText('username')->nullable()->change();
            $table->longText('password')->nullable()->change();
            $table->longText('additional_information')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('secrets', function (Blueprint $table) {
            $table->string('link')->change();
            $table->string('username')->change();
            $table->string('password')->change();
            $table->longText('additional_information')->change(); // Cette colonne était déjà longText
        });
    }
};
