<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status', ['pending', 'borrowed', 'returned', 'overdue', 'rejected'])
                ->default('pending')
                ->nullable(false)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->enum('status', ['borrowed', 'returned', 'overdue'])
                ->default('borrowed')
                ->nullable(false)
                ->change();
        });
    }
};
