<?php

namespace App\Actions\Permissions;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class PermissionSubmit
{
    use AsAction;
    use Data;


    public function handle($thiss,$formType,$role): void
    {
        $output = match ($formType) {
            'create', 'update' => PermissionSave::run($role),
            'delete' => PermissionDelete::run($role),
            default => [],
        };
        $thiss->dispatchBrowserEvent('FirstModel', ['show' => false]);
        $thiss->emit('refreshSidebar');
        $thiss->afterSave($output, $thiss->formType, $role->name);
    }
}
