<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Menu extends Model
{
    use HasFactory;
//    use HasRecursiveRelationships;
    public function childMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('childMenus');
    }


}
