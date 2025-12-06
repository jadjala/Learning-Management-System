<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('short_description', 500);
            $table->text('content');
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('title');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};