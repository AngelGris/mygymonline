<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * User for email
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a mail for a given user
     */
    static function create($user_id, $type)
    {
        // Get unsent emails for the user
        $email = Email::where('user_id', $user_id)->whereNull('sent_at')->first();

        /**
         * If no mails in the queue add new one
         * If there's a mail in the queue only change the type if
         * type in the queue is 2 and type to add is 1
         * in any other case just leave it as it is
         */
        if (count($email) == 0) {
            Email::insert([
                'user_id'       => $user_id,
                'type'          => $type,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        } elseif ($email->type == 2 and $type == 1) {
            $email->type = 1;
            $email->save();
        }
    }

    /**
     * Create email for updated plan
     */
    static function createPlanUpdated($plan_id)
    {
        // Get plan info
        $plan = Plan::find($plan_id);

        // For each user with the plan assigned create a new mail
        foreach ($plan->users as $user) {
            Email::create($user->id, 2);
        }
    }
}
