<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display the MIRANSH LLC landing page.
     */
    public function index()
    {
        return view('home', [
            'license' => '13-ユ-319558',
        ]);
    }
}
