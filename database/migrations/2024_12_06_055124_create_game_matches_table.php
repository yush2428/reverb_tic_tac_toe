<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MatchEnums;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('opponent_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->string('match_id')->unique();
            $table->integer('user_score')->nullable();
            $table->integer('opponent_score')->nullable();
            $table->string('match_status')->default(MatchEnums::PENDING)->comment('Game Result: [pending, won, lost, draw]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_matches');
    }
};
