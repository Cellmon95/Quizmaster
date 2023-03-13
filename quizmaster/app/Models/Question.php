<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;


    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    public function getOrder(){
        return DB::table('game_question')
        ->where('question_id', $this->id)
        ->where('game_id', $this->gameId)
        ->value('order');
    }

    public function setOrder($order, $gameId)
    {
        DB::table('game_question')
        ->where('question_id', $this->id)
        ->where('game_id', $gameId)
        ->update(['order' => $order]);
        //echo $gameId;
    }
}
