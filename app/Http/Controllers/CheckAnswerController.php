<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckingAnswerRequest;
use App\Models\Test;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class CheckAnswerController extends Controller
{
    public function checkingAnswer(CheckingAnswerRequest $request)
    {
        $answer = $request->answer;
        $id = $request->id;
        $userId = Auth::id();

        $rightAnswer = Test::where('id', $userId)
            ->with(['rightAnswer'])
            ->first()
            ->rightAnswer->answer;


        UserAnswer::updateOrCreate(
            [
                'test_id' => $id,
                'user_id' => $userId
            ],
            [
                'is_correct' => $answer === $rightAnswer,
                'updated_at' => now()
            ]
        );
        return  response()->json(['Верно']);
    }
}
