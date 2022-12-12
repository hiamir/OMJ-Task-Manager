<?php

namespace App\Actions\Permissions;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class PermissionSubmit
{
    use AsAction;
    use Data;


    public function handle($thiss,$formType,$permission): void
    {
        $output = match ($formType) {
            'create', 'update' => PermissionSave::run($permission),
            'delete' => PermissionDelete::run($permission),
            default => [],
        };
        $thiss->dispatchBrowserEvent('FirstModel', ['show' => false]);
        $thiss->emit('refreshSidebar');
        $thiss->afterSave($output, $thiss->formType, $permission->name);
    }
}
