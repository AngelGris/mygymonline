<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exercise;
use App\Plan;

class PlansController extends Controller
{
    /**
     * Plans main page
     */
    function index()
    {
        $plans = Plan::orderBy('name')->paginate(20);
        $exercises = Exercise::orderBy('name')->get();
        return view('plans.index', [
            'exercises' => $exercises,
            'plans'     => $plans
        ]);
    }

    /**
     * Delete plan
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
        Plan::destroy($request->input('id'));

        return response()->json([], 200);
    }

    /**
     * save new plan
     */
    function save(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'name'  => 'required'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $plan = Plan::create([
            'name'  => $request->input('name')
        ]);

        return response()->json($plan, 201);
    }

    /**
     * Update plan information
     */
    function update(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'id'    => 'required|integer',
            'name'  => 'required'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $plan = Plan::find($request->input('id'));
        $plan->name   = $request->input('name');
        $plan->save();

        return response()->json($plan, 200);
    }
}
