<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mind_maps', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_fr');
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();
            $table->string('group');        // maternelle | primaire | college | lycee
            $table->string('level');        // CP | CE1 | CE2 | CM1 | CM2 | 6ème …
            $table->string('topic_en')->nullable();
            $table->string('topic_fr')->nullable();
            $table->string('preview_image')->nullable(); // storage path
            $table->string('file_path')->nullable();     // storage path to PDF
            $table->boolean('is_published')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mind_maps');
    }
};
