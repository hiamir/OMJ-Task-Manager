<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;

class Header extends Component
{
    public $header;
    public function render()
    {
        return view('livewire.layout.header');
    }
}
