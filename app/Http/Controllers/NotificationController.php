<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::orderBy("id" , "desc")->get();

        return $notifications;
    }
    public function getNotificationNotopen($user_id){
        $notificationNotOpen = Notification::where("id_user" , $user_id)->where("isOpen" , 0)->count();

        return $notificationNotOpen;
    }

}
