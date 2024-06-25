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
        Schema::create('matchups', function (Blueprint $table) {
            $table->id();
            $table->datetime("start");
            $table->integer("team_home_score")->nullable(true);
            $table->integer("team_away_score")->nullable(true);
            $table->foreignId('round_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_home_id')->constrained('team_editions')->onDelete('cascade');
            $table->foreignId('team_away_id')->constrained('team_editions')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchups');
    }
};
