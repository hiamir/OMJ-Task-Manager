<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $pageHeader='Dashboard';
    public function render()
    {
        return view('livewire.admin.dashboard',['pageHeader'=>$this->pageHeader]);
    }
}
