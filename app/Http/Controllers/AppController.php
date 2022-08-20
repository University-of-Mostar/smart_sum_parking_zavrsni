<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    function health()
    {
        return response('OK', 200);
    }
}
