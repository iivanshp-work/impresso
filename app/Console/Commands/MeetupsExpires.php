<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meetup;
use App\Models\Users_Notification;
use Carbon\Carbon;

class MeetupsExpires extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meetups_expires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Meetups expires checker';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $meetups = Meetup::where('status', 1)
            ->where('inviting_date', "<", Carbon::now()->subDays(30))
            ->get();
        if ($meetups) {
            foreach ($meetups as $meetup) {
                $meetup->status = 4;//expired
                $meetup->invited_date = Carbon::now();
                $meetup->save();
                if ($meetup->invitingUser) {
                    //send notification to inviting user
                    Users_Notification::saveNotification('meetup_expired', 'expires', $meetup->invitingUser->id, $meetup->id);

                    //save transaction to inviting user
                    $neededCredits = LAConfigs::getByKey('invite_xims_amount');
                    if (!$neededCredits) {
                        $neededCredits = 30;
                    }
                    $amount = $neededCredits;
                    $User_Transaction = new User_Transaction;
                    $User_Transaction->user_id = $meetup->invitingUser->id;
                    $User_Transaction->amount = $amount;
                    $User_Transaction->type = 'meetup_declined';
                    $User_Transaction->notes = 'meetup_expired';
                    $User_Transaction->share_id = $meetup->id;

                    $User_Transaction->by_user_id = $meetup->invitingUser->id;
                    $User_Transaction->old_credits_amount = $meetup->invitingUser->credits_count_value;
                    $User_Transaction->new_credits_amount = floatval($meetup->invitingUser->credits_count_value) + $amount;
                    $User_Transaction->save();

                    //adding balance to inviting user
                    $meetup->invitingUser->credits_count = $meetup->invitingUser->credits_count_value + $amount;
                    $meetup->invitingUser->save();
                }
            }
        }
    }
}
