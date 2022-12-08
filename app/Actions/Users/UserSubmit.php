<?php

namespace App\Actions\Users;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class UserSubmit
{
    use AsAction;
    use Data;


    public function handle($thiss,$formType,$permission): void
    {
        $output = match ($formType) {
            'create', 'update' => UserSave::run($permission),
            'delete' => UserDelete::run($permission),
            default => [],
        };
        $thiss->dispatchBrowserEvent('FirstModel', ['show' => false]);
        $thiss->emit('refreshSidebar');
        $thiss->afterSave($output, $thiss->formType, $permission->name);
    }
}
