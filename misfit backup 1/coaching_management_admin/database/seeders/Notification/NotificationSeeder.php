<?php

namespace Database\Seeders\Notification;

use App\Models\UserManagement\Notification;
use App\Models\UserManagement\NotificationUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::truncate();
        NotificationUser::truncate();

        $notification = new Notification();
        $notification->title = "A new student is added";
        $notification->description = "A new student is added to the class 9 regular batch";
        $notification->date = Carbon::now()->subDays(1);
        $notification->save();

        $notification_user = new NotificationUser();
        $notification_user->notification_id = $notification->id;
        $notification_user->user_id = 3;
        $notification_user->save();

        $notification = new Notification();
        $notification->title = "A student course payment fullfiled";
        $notification->description = "A student payment added for this month";
        $notification->date = Carbon::now()->subDays(2);
        $notification->save();

        $notification_user = new NotificationUser();
        $notification_user->notification_id = $notification->id;
        $notification_user->user_id = 4;
        $notification_user->save();

        $notification = new Notification();
        $notification->title = "A student course payment fullfiled";
        $notification->description = "A student payment added for this month";
        $notification->date = Carbon::now()->subDays(3);
        $notification->save();

        $notification_user = new NotificationUser();
        $notification_user->notification_id = $notification->id;
        $notification_user->user_id = 4;
        $notification_user->save();

        $notification = new Notification();
        $notification->title = "A new batch is started";
        $notification->description = "A new batch is started";
        $notification->date = Carbon::now()->subDays(4);
        $notification->save();

        $notification_user = new NotificationUser();
        $notification_user->notification_id = $notification->id;
        $notification_user->user_id = 5;
        $notification_user->save();
    }
}
