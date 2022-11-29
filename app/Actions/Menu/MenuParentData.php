<?php

namespace App\Actions\Menu;


use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class MenuParentData
{
    use AsAction;
    use Data;

    public function handle($type, $record, $level): array
    {
        switch ($type) {
            case 'create':
                if ($record->parent_id !== null) $recordSet = Menu::where('id', $record->parent_id)->get();
                return ($record->parent_id !== null) ? Data::get_array_for_select_input(record: $recordSet, isNull: false) : [];

            case 'update':
                return match ($level) {
                    'l2' => Data::get_second_array_for_select_input(record: $this->getRecordByField(['id', 'name'], 'parent_id', null), isNull: true),
                    default =>Data::get_array_for_select_input(record: Menu::select('id', 'name')->where('parent_id', null)->where('id', '!=', $record->id)->get(), isNull: true),
                };
            case 'delete':
            case 'default':
                return [];
        }

        //        return match ($record->exists) {
//            false => ($record->id !== null) ? $this->get_array_for_select_input($record) : [],
//            true => match ($level) {
//                'l2' => $this->get_second_array_for_select_input($this->getRecordByField(['id', 'name'], 'parent_id', null)),
//                default => $this->get_array_for_select_input($this->getRecordByField(['id', 'name'], 'parent_id', null)),
//            }
//        };
    }


    public function getRecordByField($select = [], $field = null, $value = null): Collection
    {
        if ($field !== null && $value !== '') {
            return ((count($select) > 0) ? Menu::select($select)->where($field, $value)->get() : Menu::where($field, $value)->get());
        }
        return Menu::where($field, $value)->get();
    }
}
