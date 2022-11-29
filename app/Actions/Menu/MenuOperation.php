<?php

namespace App\Actions\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

class MenuOperation
{
    use AsAction;
    use withAttributes;

    /*      FUNCTION TO SAVE DATA        */
    /**
     * @throws ValidationException
     */
    public function save(Menu $menu)
    {
        $this->sanitize($menu);
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

    /*      FUNCTION FOR DELETE DATA        */
    public function delete(Menu $menu)
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

    /*      SANITIZE DATA        */
    protected function sanitize($data) :void{
        $data->name=ucfirst($data->name);
        if($data->route=="null") $data->route=null;
        if($data->parent_id=="null") $data->parent_id=null;
    }

}
