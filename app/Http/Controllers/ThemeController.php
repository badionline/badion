<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function theme(Request $request)
    {
        $session = session()->all();
        if (session()->get('theme') == 'dark') {
            $session = $request->session()->put('theme', 'light');
        } else {
            $session = $request->session()->put('theme', 'dark');
        }
        return redirect()->back()->with($session);
    }
}
