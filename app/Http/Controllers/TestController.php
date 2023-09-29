<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTestRequest;
use App\Models\Test;

class TestController extends Controller
{
    public function getTest(GetTestRequest $request)
    {
        $id = $request->id;

        $test = Test::select('id', 'title')->with('answers')->find($id);

        return [
            'id' => $test->id,
            'title' => $test->title,
            'answers' => $test->answers()->pluck('answer')->toArray()
        ];
    }

    public function getAllTests()
    {
        $tests = Test::select('id', 'title')->get();
        return response()->json($tests);
    }
}
