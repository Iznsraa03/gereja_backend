<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            // ponytail: track who submitted the church
            $table->foreignId('submitted_by')->nullable()->after('verified_by')
                ->constrained('users')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->dropForeignIdFor(App\Models\User::class, 'submitted_by');
            $table->dropColumn('submitted_by');
        });
    }
};
