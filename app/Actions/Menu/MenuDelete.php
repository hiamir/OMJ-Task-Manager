<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuDelete
{
    use AsAction;
    use withAttributes;


    public function handle(Menu $menu):array
    {
        try {
            $success = DB::transaction(function () use ($menu) {
                $menu->delete();
                return [true, $menu];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }


}
