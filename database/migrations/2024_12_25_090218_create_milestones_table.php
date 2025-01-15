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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('assignedto');
            $table->string('title');
            $table->text('description');
            $table->string("progress")->nullable();
            $table->date("start_date")->nullable();
            $table->date("expected_completion_date")->nullable();
            $table->date("actual_completion_date")->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->decimal('budget');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign("created_by")->references('id')->on('users')->cascadeOnDelete();
            $table->foreign("assignedto")->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
