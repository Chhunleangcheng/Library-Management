<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->index(['returned_at', 'due_date']); // For overdue queries
            $table->index('borrowed_at'); // For recent borrowings
            $table->index('returned_at'); // For active borrowings
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropIndex(['returned_at', 'due_date']);
            $table->dropIndex(['borrowed_at']);
            $table->dropIndex(['returned_at']);
        });
    }
};
