<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TestNotification;

class DemoController extends Controller
{
    public function notify()
    {
        $user = new User();
        $user->first_name = 'John';
        $user->surname = 'Doe';
        $user->email = config('project.user.email');
        $user->notify(new TestNotification());

        return $user;
    }
}
