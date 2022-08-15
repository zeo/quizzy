<?php

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuizSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('quiz_session_answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(QuizSession::class, 'session_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Answer::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamp('should_answer_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_session_answers');
    }
};
