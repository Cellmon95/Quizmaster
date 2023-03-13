<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Game extends Model
{
    use HasFactory;

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public function archiveQuestion($question, $result)
    {
        $user = Auth::user();
        DB::table('users_questions_games_answers')
        ->insert(
            [
                'user_id' => $user->id,
                'question_id' => $question->id,
                'game_id' => $this->id,
                'answer_result' => $result
            ]
        );

        DB::table('game_question')
        ->where('question_id',  $question->id)
        ->where('game_id', $this->id)
        ->delete();
    }
}
