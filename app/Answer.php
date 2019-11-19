<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'id','user_id','question_id','content'
    ];
    public function questions(){
        return $this->belongsToMany(Question::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
