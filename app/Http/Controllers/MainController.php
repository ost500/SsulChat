<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $channels = Channel::get();

        return view('main', compact('channels'));
    }
}
