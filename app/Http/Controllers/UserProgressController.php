<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserProgressController extends Controller
{
    public function clearProgress()
    {
        try {
            Auth::user()->clearProgress();
            return response(['message' => 'Статистика удалена успешно']);
        } catch (Exception) {
            return response(['message' => 'Не удалось удалить статистику', 500]);
        }
    }

    public function getStatistics()
    {
        $userWithStatistics = User::with([
            'userAnswer', 'userAnswer.test'
        ])->where('id', Auth::id())
            ->first();

        $statistics = $userWithStatistics->userAnswer->toArray();

        $allTestCount = Test::count();
        $correctCount = Arr::where($statistics, function ($statisticAttempt) {
            return $statisticAttempt['is_correct'];
        });
        $incorrectCount = Arr::where($statistics, function ($statisticAttempt) {
            return !$statisticAttempt['is_correct'];
        });

        $rightAnswers = collect($statistics)->map(function ($statistic) {
            return $statistic['test']['title'];
        })->toArray();

        $incorrectAnswers = collect($statistics)->filter(function ($statistic) {
            return !$statistic['is_correct'];
        })->map(function ($statistic) {
            return $statistic['test']['title'];
        })->toArray();

        return [
            'allTestCount' => $allTestCount,
            'passedTestCount' => count($correctCount) + count($incorrectCount),
            'rightAnswers' => $rightAnswers,
            'incorrectAnswers' => $incorrectAnswers,
            'countRigthAnswers' => count($correctCount),
            'countIncorrectAnswers' => count($incorrectCount),

        ];
    }
}
