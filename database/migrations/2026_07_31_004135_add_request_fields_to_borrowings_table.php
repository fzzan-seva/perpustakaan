<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->timestamp('requested_at')->nullable()->after('notes');
            $table->timestamp('confirmed_at')->nullable()->after('requested_at');
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete()->after('confirmed_at');
            $table->timestamp('rejected_at')->nullable()->after('confirmed_by');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete()->after('rejected_at');
            $table->string('rejection_reason')->nullable()->after('rejected_by');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropForeign(['confirmed_by']);
            $table->dropForeign(['rejected_by']);
            $table->dropColumn(['requested_at', 'confirmed_at', 'confirmed_by', 'rejected_at', 'rejected_by', 'rejection_reason']);
        });
    }
};
