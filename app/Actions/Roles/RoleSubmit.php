<?php

namespace App\Actions\Roles;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class RoleSubmit
{
    use AsAction;
    use Data;


    public function handle($thiss,$formType,$role): void
    {
        $output = match ($formType) {
            'create', 'update' => RoleSave::run($role),
            'delete' => RoleDelete::run($role),
            default => [],
        };
        $thiss->dispatchBrowserEvent('FirstModel', ['show' => false]);
        $thiss->emit('refreshSidebar');
        $thiss->afterSave($output, $thiss->formType, $role->name);
    }
}
