<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use App\Traits\Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuGuards
{
    use AsAction;

    public function handle(Menu $menu): array
    {
        if (auth()->guard('admin')->check()) {
            $guards = Data::guards('admin');
            if (count($guards) === 1) $menu['guards_id'] = array_key_first($guards);
        } else {
            $guards = Data::guards('web');
            if (count($guards) === 1) $menu['guards_id'] = array_key_first($guards);
        }
        return $guards;
    }


}
