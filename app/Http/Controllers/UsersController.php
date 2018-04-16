<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Email;
use App\Plan;
use App\User;

class UsersController extends Controller
{
    /**
     * Users main page
     */
    function index()
    {
        $users = User::orderBy('first_name')->orderBy('last_name')->paginate(20);
        $plans = Plan::orderBy('name')->get();
        return view('users.index', [
            'users' => $users,
            'plans' => $plans
        ]);
    }

    /**
     * Delete user
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
        User::destroy($request->input('id'));

        return response()->json([], 200);
    }

    /**
     * Plans for the user
     */
    function listPlans(Request $request)
    {
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
        $user = User::find($request->input('id'));

        return response()->json($user->plans, 200);
    }

    /**
     * save new user
     */
    function save(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'first-name'    => 'required',
            'last-name'     => 'required',
            'email'         => 'required|email|unique:users',
            'birthdate'     => 'required|date_format:d/m/Y',
            'height'        => 'required|integer',
            'weigth'        => 'required|numeric'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $user = User::create([
            'first_name'    => $request->input('first-name'),
            'last_name'     => $request->input('last-name'),
            'email'         => $request->input('email'),
            'birthdate'     => Carbon::createFromFormat('d/m/Y', $request->input('birthdate')),
            'height'        => $request->input('height'),
            'weigth'        => $request->input('weigth')
        ]);

        return response()->json($user, 201);
    }

    /**
     * Save plans for user
     */
    function savePlans(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'user_id'   => 'required|integer',
            'plans'     => 'array'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $user = User::find($request->input('user_id'));
        $user->plans()->sync($request->input('plans'));
        Email::create($user->id, 1);

        return response()->json([], 200);
    }

    /**
     * Update user information
     */
    function update(Request $request)
    {
        // Validators
        $v = Validator::make($request->all(), [
            'id'            => 'required|integer',
            'first-name'    => 'required',
            'last-name'     => 'required',
            'email'         => 'required|email|unique:users,email,' . $request->input('id'),
            'birthdate'     => 'required|date_format:d/m/Y',
            'height'        => 'required|integer',
            'weigth'        => 'required|numeric'
        ]);

        // Validations fails
        if ($v->fails())
        {
            return response()->json($v->errors(), 400);
        }

        // Data is valid
        $user = User::find($request->input('id'));
        $user->first_name   = $request->input('first-name');
        $user->last_name    = $request->input('last-name');
        $user->email        = $request->input('email');
        $user->birthdate    = Carbon::createFromFormat('d/m/Y', $request->input('birthdate'));
        $user->height       = $request->input('height');
        $user->weigth       = $request->input('weigth');
        $user->save();

        return response()->json($user, 200);
    }
}
