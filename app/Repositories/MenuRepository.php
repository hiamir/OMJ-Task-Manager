<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Traits\Data;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MenuRepository implements MenuRepositoryInterface
{
    use Data;

    /*     RESET FORM FIELDS     */
    public function resetInputs(): array
    {
        return ['name' => null, 'svg' => null, 'parent_id' => null, 'guard' => null, 'route' => null, 'sort' => null];
    }

    /*     GET RECORD     */
    public function getRecord($type, $row = null): Menu
    {
        if ($type !== 'create' && $row !== null) {
            return Menu::where('id', $row['id'])->first();
        } else {
            return new Menu();
        }
    }

    /*     GET RECORD BY FIELD    */
    public function getRecordByField($select = [], $field = null, $value = null): Collection
    {
        if ($field !== null && $value !== '') {
            return ((count($select) > 0) ? Menu::select($select)->where($field, $value)->get() : Menu::where($field, $value)->get());
        }
        return Menu::where($field, $value)->get();
    }

    /*     GET FORM DATA ARRAY     */
    public function formData($type, $row, $record): array
    {
        $menu = [];
        $menu['name'] = $record->name;
        $menu['svg'] = $record->svg;
        $menu['guards_id'] = $record->guards_id;
        if ($type === 'create' && $row === null) {
            $menu['parent_id'] = null;
        } elseif ($type === 'create' && $row !== null) {
            $menu['parent_id'] = $row['id'];
        } else {
            $menu['parent_id'] = $record->parent_id;
        }
        $menu['route'] = $record->route;
        $menu['sort'] = $record->sort;
        return $menu;
    }

    /*     GET PARENT DATA ARRAY       */
    public function getParentData($type, $record, $level): array
    {
        switch ($type) {
            case 'create':
                return ($record->id !== null) ? $this->get_array_for_select_input($record) : [];

            case 'update':
                return match ($level) {
                    'l1' => $this->get_array_for_select_input($this->getRecordByField(['id', 'name'], 'parent_id', null)),
                    'l2' => $this->get_second_array_for_select_input($this->getRecordByField(['id', 'name'], 'parent_id', null)),
                    default => $this->get_array_for_select_input($this->getRecordByField(['id', 'name'], 'parent_id', null)),
                };

            case 'delete':
            case 'default':
                return [];
        }
    }

    /*     GET ROUTE DATA ARRAY       */
    public function getRoutes($type, $record): array
    {

//        switch ($type) {
//            case 'create':
//                $arr = Data::get_routes_array_for_select_input();
//                return (array_merge(["" => "None"], $arr));
//            case 'update':
//                $arr = Data::get_routes_array_for_select_input([$record->route]);
//                return (array_merge(["" => "None"], $arr));
//            default:
//                return [];
//
//        }
        $arr = Data::get_routes_array_for_select_input([$record->route]);
        $arr = (array_merge(["none" => "None"], $arr));
        return match ($type) {
            'create' => Data::get_routes_array_for_select_input(),
            'update' => $arr,
            default => [],
        };

    }

    /*     ASSIGN DATA FOR SUBMIT       */
    public function assignData($record, $formInputs): Menu
    {
        $record->name = ucfirst($formInputs['name']);
        $record->svg = strtolower($formInputs['svg']);
        $record->parent_id = $formInputs['parent_id'];
        $record->route = ($formInputs['route'] === 'none') ? null : $formInputs['route'];
        $record->guards_id = $formInputs['guard'];
        $record->sort = $formInputs['sort'];
        return $record;
    }

    /*     SAVE DATA FOR SUBMIT       */
    public function saveData($record, $formInputs): array
    {
        try {
            $success = DB::transaction(function () use ($record, $formInputs) {
                $this->assignData($record, $formInputs)->save();
                return [true, $record];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }

    /*     DELETE DATA FOR SUBMIT       */
    public function deleteData($record): array
    {
        try {
            $success = DB::transaction(function () use ($record) {
                $record->delete();
                return [true, $record];
            });
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->getMessage()];
        }
        return $success;
    }
}
