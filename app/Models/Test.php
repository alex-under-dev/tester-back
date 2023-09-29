<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;


    public function rightAnswer()
    {
        return $this->belongsTo('App\Models\Answer', 'right_answer_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'test_id');
    }
}
