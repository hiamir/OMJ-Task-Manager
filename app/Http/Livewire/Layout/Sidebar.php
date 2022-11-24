<?php

namespace App\Http\Livewire\Layout;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners=['refreshSidebar'=>'$refresh'];
public array $routes=['hello'];

    public function getRoutes($menu):array
    {
        $array=[];
        array_push($array,$menu->route);
        foreach ($menu->childMenus as $childMenu1){
            array_push($array,$childMenu1->route);
            foreach ($childMenu1->childMenus as $childMenu2){
                array_push($array,$childMenu2->route);
            }
        }
       return $array;
    }

    public function render()
    {
        $sideBar=Menu::with('childMenus')->where('parent_id',null)->orderBy('sort','ASC')->get();
        return view('livewire.layout.sidebar', ['sideBar' => $sideBar]);
    }
}
