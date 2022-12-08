<?php

namespace App\Http\Livewire\Admin\Users;

use App\Actions\Users\UserFormData;
use App\Actions\Users\UserGuards;
use App\Actions\Users\UserModels;
use App\Actions\Users\Usersubmit;
use App\Actions\Users\UserValidation;
use App\Models\User;
use App\Traits\Data;
use App\Traits\General;
use Livewire\Component;

class Index extends Component
{
    use General;
    use Data;

    protected $listeners = ['show'];

    public string $pageHeader = 'Users';
    public bool $disabled = true;
    public array $models, $guards;
    public User $User;

    /*         UPDATING FIELD MAKE NAME FROM GUARD AND MODEL        */
    public function updated($variable, $value)
    {
        $this->disabled = UserValidation::make()->updated($this->user, $variable, $value);
        $this->validateOnly('User.name');
    }


    /*         INITIALIZATION AT START        */
    public function mount()
    {
        $this->user = new User();
    }

    /*         INPUT RULES        */
    protected function rules(): array
    {
        return UserValidation::make()->rules();
    }


    /*          SHOW MODEL FOR CREATE, UPDATE, DELETE        */
    public function show($data)
    {
        $this->resetForm();

        $this->user = ($data[0] === 'create') ? UserFormData::run(type: $data[0]) : UserFormData::run(type: $data[0], row: $data[1]);
        $this->showModal($data[0], ($data[0] === 'create') ? 'User' : $this->user->name);
    }

    /*          SUBMIT DATA FOR CREATE, UPDATE, DELETE        */
    public function submit()
    {
        Usersubmit::run($this, $this->formType, $this->user);
    }


    public function render()
    {
        $users = User::all();
        return view('livewire.admin.Users.index', ['users' => $users]);
    }
}
