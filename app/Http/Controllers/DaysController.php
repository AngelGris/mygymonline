<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Day;
use App\Email;

class DaysController extends Controller
{
    /**
     * Retrieve days for a given Plan
     */
    function load(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'plan_id'    => 'required|integer'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $days = Day::where('plan_id', $request->input('plan_id'))->orderBy('name')->get();

        return response()->json($days, 200);
    }

    /**
     * Delete day
     */
    function delete(Request $request) {
        // Validators
        $v = Validator::make($request->all(), [
            'id'    => 'required|integer'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $day = Day::find($request->input('id'));

        // Queue mail
        Email::createPlanUpdated($day->plan->id);

        $day->delete();

        return response()->json([], 200);
    }

    /**
     * Save new day
     */
    function save(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'plan_id'   => 'required|integer',
            'name'      => 'required'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $day = Day::create([
            'name'      => $request->input('name'),
            'plan_id'   => $request->input('plan_id')
        ]);

        // Queue mail
        Email::createPlanUpdated($day->plan->id);

        return response()->json($day, 201);
    }
}
