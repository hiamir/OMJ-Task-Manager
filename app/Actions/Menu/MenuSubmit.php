<?php

namespace App\Actions\Menu;


use App\Traits\Data;
use Lorisleiva\Actions\Concerns\AsAction;

class MenuSubmit
{
    use AsAction;
    use Data;


    public function handle($thiss,$formType,$menu): void
    {
        $output = match ($formType) {
            'create', 'update' => MenuSave::run($menu),
            'delete' => MenuDelete::run($menu),
            default => [],
        };
        $thiss->dispatchBrowserEvent('FirstModel', ['show' => false]);
        $thiss->emit('refreshSidebar');
        $thiss->afterSave($output, $thiss->formType, $menu->name);
    }
}
