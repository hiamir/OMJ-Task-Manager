<?php

namespace App\Actions\Menu;


use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class MenuFormData
{
    use AsAction;
    use Data;

    public function handle($type,$row=null): Menu
    {
        if($type==='create'){
            if($row !== null){
                $menu=Menu::find($row['id']);
                $newMenu=new Menu();
                $newMenu->parent_id=$menu->id;
                return $newMenu;
            }else{
                return new Menu();
            }
        }
        return ( ($type==='update' || $type==='delete') && $row !== null) ? Menu::find($row['id']) : new Menu();
    }

}
