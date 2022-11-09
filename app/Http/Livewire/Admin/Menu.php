<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Menu extends Component
{
    public string $pageHeader='Menu';
    public function render()
    {
        return view('livewire.admin.menu',['pageHeader'=>$this->pageHeader]);
    }
}
