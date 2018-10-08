<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function messages(){
        return view('admin.notifications.messages');
    }

    public function annoucements(){
        return view('admin.notifications.annoucement');
    }
}
