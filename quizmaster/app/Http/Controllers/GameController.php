<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    function createGame(){
        $game = new Game();
        $game->save();
        $game->questions()->saveMany(Question::find([1,2,3]));
    }

    function startGame()
    {
        $user = Auth::user();
        $game = null;

        if ($user->currentGame !== null) {
            $game = Game::where('id', $user->currentGame)->first();
        }
        else{
            $game = new Game();
            $game->current_question = 0;
            $game->save();
            $game->questions()->saveMany(Question::find([1,2,3]));
            $user->current_game = $game->id;
            $user->save();
        }
        $currentQuestion = $game->current_question;
        $question = $game->questions[$currentQuestion];

        return view('game', ['question' => $question]);
    }

    function checkIfAnswerIsCorrect(Request $request)
    {
        $user = Auth::user();
        $game = Game::where('id', $user->current_game)->first();
        $currentQuestionIndex = $game->current_question;
        $currentQuestion = $game->questions[$currentQuestionIndex];

        if ($currentQuestion->correct_answer === $request->input('submitedAnswer')) {
            return 'Hurray!!!';
        }
        else{
            return 'Doh!!!';
        }

        return $request->input('submitedAnswer');

    }

    function printRandQuestion(){
        $question = Question::find([1,2,3]);

        return view('game', ['question' => $question]);
    }

    function checkAnswer(){

    }
}
