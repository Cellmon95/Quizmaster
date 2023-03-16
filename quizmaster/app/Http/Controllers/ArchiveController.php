<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $archives = DB::table('users_questions_games_answers')
        ->where('user_id', $user->id)
        ->get();
        $questions = array();
        $questionViews = array();

        foreach ($archives as $archive) {
            $question = Question::all()->find($archive->question_id);
            $questionView = [
                'question' => $question->question,
                'result' => $archive->answer_result
            ];
            array_push($questionViews, $questionView);
        }


        return view('archive', ['questionViews' => $questionViews]);
    }
}
