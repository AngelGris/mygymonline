<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Day;

class ExercisesController extends Controller
{
    /**
     * remove exercise from day
     */
    function delete(Request $request) {
        // Validators
        $v = Validator::make($request->all(), [
            'day_id'        => 'required|integer',
            'exercise_id'   => 'required|integer'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $day = Day::find($request->input('day_id'));
        $day->exercises()->detach($request->input('exercise_id'));

        return response()->json([], 200);
    }

    /**
     * Add exercises to day
     */
    function save(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'day_id'    => 'required|integer',
            'exercises' => 'required|array'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $day = Day::find($request->input('day_id'));
        $day->exercises()->attach($request->input('exercises'));

        return response()->json([], 200);
    }
}
