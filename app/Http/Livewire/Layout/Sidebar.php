<?php

namespace App\Http\Livewire\Layout;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners=['refreshSidebar'=>'$refresh','sidebarRender'];
public $sideBar;
    public function sidebarRender()
    {
      $this->render();

    }

    public function render()
    {
        $this->sideBar=Menu::with('childMenus')->where('parent_id',null)->orderBy('sort','ASC')->get();
        return view('livewire.layout.sidebar');
    }
}
