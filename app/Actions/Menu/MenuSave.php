<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuSave
{
    use AsAction;
    use withAttributes;


    /**
     * @throws ValidationException
     */
    public function handle(Menu $menu):array
    {
      $menu= MenuSanitizeData::run($menu);
        $data = $this->set('menu', $menu)->fill($menu->toArray());

        Validator::make(
            $data->attributes,
            MenuValidation::make()->rules($this->menu->id),
            MenuValidation::make()->messages(),
        )->validate();
        try {
            $success = DB::transaction(function () use ($menu) {

                $menu->save();
                return [true, $menu];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }



}
