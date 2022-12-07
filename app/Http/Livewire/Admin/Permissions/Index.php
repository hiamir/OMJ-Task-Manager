<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Actions\Permissions\PermissionFormData;
use App\Actions\Permissions\PermissionGuards;
use App\Actions\Permissions\PermissionModels;
use App\Actions\Permissions\PermissionSubmit;
use App\Actions\Permissions\PermissionValidation;
use App\Traits\Data;
use App\Traits\General;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use General;
    use Data;

    protected $listeners=['show'];

    public string $pageHeader = 'Permissions';
    public array $models,$guards;
    public Permission $permission;



    /*         INITIALIZATION AT START        */
    public function mount()
    {
        $this->permission = new Permission();
    }

    /*         INPUT RULES        */
    public function rules(): array
    {
        return PermissionValidation::make()->rules();
    }

    /*          SHOW MODEL FOR CREATE, UPDATE, DELETE        */
    public function show($data)
    {
        $this->resetForm();

        $this->permission = PermissionFormData::run(type: $data[0], row: $data[1]);
        $this->models= PermissionModels::run($this->permission);
        $this->guards= PermissionGuards::run($this->permission);
        $this->showModal($data[0], ($data[0]==='create') ? 'Permission' :$this->permission->name);
    }

    /*          SUBMIT DATA FOR CREATE, UPDATE, DELETE        */
    public function submit()
    {
        PermissionSubmit::run($this,$this->formType,$this->permission);
    }


    public function render()
    {
        $permissions=Permission::all();
        return view('livewire.admin.permissions.index',['permissions'=>$permissions]);
    }
}
