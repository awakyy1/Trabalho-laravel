<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submission_versions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unsignedInteger('version');          // 1, 2, 3…
            $table->text('changelog')->nullable();

            $table->timestamps();

            $table->unique(['submission_id', 'version']); // garante 1-a-1
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submission_versions');
    }
};
