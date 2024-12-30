<?php

namespace App\Http\Controllers\Web;

class HomeController
{
    public function home(): void
    {
        view('home');
    }
}