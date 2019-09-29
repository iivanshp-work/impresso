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
                    Users_Notification::saveNotification('meetup_expired', 'expires', $meetup->invitingUser->id, $meetup->id);
                }
            }
        }
    }
}
