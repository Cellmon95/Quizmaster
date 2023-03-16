<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    function createGame(){
        $game = new Game();
        $game->current_question = 0;
        $game->save();
        $questions = Question::all()->take(3);

        $game->questions()->saveMany($questions);

        foreach ($questions as $key => $question) {
            $question->setOrder($key, $game->id);
        }

        return $game;
    }

    function startGame()
    {
        $user = Auth::user();
        $game = null;

        if (isset($user->current_game)) {
            $game = Game::find($user->current_game);
        }
        else{
            $game = $this->createGame();
            $user->current_game = $game->id;
            $user->save();
        }

        if (count($game->questions) > 0) {

            $question = $game->questions[0];
            return view('game', ['question' => $question]);
        }
        else{
            $user->current_game = null;
            $user->save();
            return view('questionResult', ['result' => 'game_over' ]);
        }
    }

    function checkIfAnswerIsCorrect(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'submitedAnswer' => 'required|in:alt1,alt2,alt3,alt4'
        ]);
        $game = Game::find($user->current_game);
        $currentQuestion = $game->questions[0];
        $questionResult = '';

        if ($currentQuestion->correct_answer === $request->input('submitedAnswer')) {
            $questionResult = 'correct';
            $game->archiveQuestion($currentQuestion, $questionResult);
        }
        else{
            $questionResult = 'incorrect';
            $game->archiveQuestion($currentQuestion, $questionResult);
        }

        return view('questionResult', ['result' => $questionResult ]);
    }

    function printRandQuestion(){
        $question = Question::find([1,2,3]);

        return view('game', ['question' => $question]);
    }

    function checkAnswer(){

    }
}
