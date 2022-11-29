<?php

namespace App\Actions\Menu;


use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class MenuRouteData
{
    use AsAction;
    use Data;

    public function handle($record): array
    {
        ($record->route === null) ? $arr = Data::get_routes_array_for_select_input() : $arr = Data::get_routes_array_for_select_input([$record->route]);
        return (array_merge(["null" => "None"], $arr));
    }

}
