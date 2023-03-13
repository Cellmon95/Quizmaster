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
            $game = Game::where('id', $user->current_game)->first();
        }
        else{
            $game = $this->createGame();
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
        $questionResult = '';

        if ($currentQuestion->correct_answer === $request->input('submitedAnswer')) {
            $questionResult = 'correct';
            $game->archiveQuestion($currentQuestion, $questionResult);
        }
        else{
            $questionResult = 'incorrect';
            $game->archiveQuestion($currentQuestion, $questionResult);
        }

        if ($game->current_question < count($game->questions)) {
            $game->current_question += 2;
        }
        else{
            $questionResult = 'game_over';
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
