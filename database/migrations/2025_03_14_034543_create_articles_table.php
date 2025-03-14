<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('articles', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->string('thumbnail')->nullable();
        $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
