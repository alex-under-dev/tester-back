<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers_statistics';
    public $timestamps = true;
    protected $fillable = [
        'test_id',
        'user_id',
        'answer',
        'is_correct',
        'updated_at'
    ];

    protected $guarded = [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function test()
    {
        return $this->belongsTo('App\Models\Test');
    }
}
