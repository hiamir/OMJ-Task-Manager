<?php

namespace App\Http\Livewire\Layout;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners=['refreshSidebar'=>'$refresh'];


    public function mount()
    {
    }

    public function render()
    {
        $sideBar=Menu::with('childMenus')->where('parent_id',null)->get();
        return view('livewire.layout.sidebar', ['sideBar' => $sideBar]);
    }
}
