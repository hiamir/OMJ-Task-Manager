<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Actions\Menu\MenuFormData;
use App\Actions\Menu\MenuGuards;
use App\Actions\Menu\MenuParentData;
use App\Actions\Menu\MenuRouteData;
use App\Actions\Menu\MenuSubmit;
use App\Actions\Menu\MenuValidation;
use App\Actions\Roles\RoleFormData;
use App\Actions\Roles\RoleGuards;
use App\Actions\Roles\RoleSubmit;
use App\Actions\Roles\RoleValidation;
use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use General;
    use Data;

    protected $listeners=['show'];

    public string $pageHeader = 'Roles';
    public array $guards;
    public Role $role;






    /*         INITIALIZATION AT START        */
    public function mount()
    {
        $this->role = new Role();
    }

    /*         INPUT RULES        */
    public function rules(): array
    {
        return RoleValidation::make()->rules();
    }

    /*          SHOW MODEL FOR CREATE, UPDATE, DELETE        */
    public function show($data)
    {
        $this->resetForm();

        $this->role = RoleFormData::run(type: $data[0], row: $data[1]);
        $this->guards= RoleGuards::run($this->role);
        $this->showModal($data[0], ($data[0]==='create') ? 'Role' :$this->role->name);
    }

    /*          SUBMIT DATA FOR CREATE, UPDATE, DELETE        */
    public function submit()
    {
        RoleSubmit::run($this,$this->formType,$this->role);
    }


    public function render()
    {
        $roles=Role::all();
        return view('livewire.admin.roles.index',['roles'=>$roles]);
    }
}
