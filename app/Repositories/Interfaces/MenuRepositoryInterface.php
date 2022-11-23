<?php

namespace App\Repositories\Interfaces;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

interface MenuRepositoryInterface
{
    public function resetInputs(): array;

    public function getRecord($type, $row): Menu;

    public function getRecordByField($select = [], $field = null, $value = null): Collection;

    public function formData($type, $row, $record): array;

    public function getParentData($type, $record, $level): array;

    public function getRoutes($type, $record): array;

    public function assignData($record, $formInputs): Menu;

    public function saveData($record,$formInputs):array;

    public function deleteData($record): array;

}
