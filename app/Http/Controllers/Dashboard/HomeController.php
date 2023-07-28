<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Notifications\testNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index(){
        return view('Dashboard.home');
    }
}
