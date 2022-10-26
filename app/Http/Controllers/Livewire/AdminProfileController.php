<?php

namespace App\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminProfileController extends Controller
{
    /**
     * Show the Admin profile screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {

        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}




