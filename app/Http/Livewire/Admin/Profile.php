<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Http\Request;
use Livewire\Component;

class Profile extends Component
{
    public $pageHeader='Profile';



    public function render(Request $request)
    {
        return view('livewire.admin.profile',[
            'pageHeader'=>$this->pageHeader,
            'request' => $request,
            'user' => $request->user()
        ]);
    }
}
