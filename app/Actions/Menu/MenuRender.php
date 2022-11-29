<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use App\Traits\Data;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuRender
{
    use AsAction;

    public function handle(): Collection
    {
        return Menu::with('childMenus')->where('parent_id', '=', null)->orderBy('sort', 'ASC')->get();
    }
}
