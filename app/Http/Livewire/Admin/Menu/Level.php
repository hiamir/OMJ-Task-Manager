<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuLevel;
use App\Traits\General;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Level extends Component
{
    use General;

    public string $pageHeader = 'Menu Level';
    public array $menuLevel;

    public $editMenuRecord = null;

    protected $listeners = ['editMenuLevel'];

    public function mount()
    {
        $this->formInfo('create', 'Create', 'Create', 'Create Menu Levels');
        $this->formType = "create";
        $this->resetInput();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
    }

    protected $messages = [
        'menuLevel.name.required' => 'Menu name is required.',
        'menuLevel.name.min' => 'Menu must be at-least 4 letters long.',
        'menuLevel.name.unique' => ':attribute menu already exists!.',
    ];

    protected function rules()
    {
        return [
            'menuLevel.name' => 'required|min:4|unique:menu_levels,name'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'menuLevel.name' => $this->menuLevel['name'],
        ];
    }

    public function resetInput()
    {
        $this->menuLevel = ['name' => ''];
    }

    public function editMenuLevel($row)
    {
        $this->editMenuRecord = MenuLevel::find($row)->first();
        $this->menuLevel['name'] = $this->editMenuRecord->name;
        $this->formInfo('update', 'Update', 'Update ' . $this->menuLevel['name'], 'Update ' . $this->menuLevel['name']);
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }


    public function submit()
    {
        $this->validate();

        switch ($this->formType) {

            case 'create':
                $level = new MenuLevel();
                $level->name = $this->menuLevel['name'];
                $level->save();

                break;

            case 'update':
                $this->editMenuRecord->name = $this->menuLevel['name'];
                $this->editMenuRecord->save();
                break;
        }
        if ($this->formType === 'create' || $this->formType === 'update') {
            $this->emit('refreshDatatable');
            $this->resetForm();
            $this->resetInput();
            $this->dispatchBrowserEvent('FirstModel', ['show' => false]);

            if($this->formType === 'update'){
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->editMenuRecord->name . "'" . ' was updated!']);
            }else{
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $level->name . "'" . ' was added to Menu Level!']);
            }

        }

    }

    public function render()
    {
        return view('livewire.admin.menu.level');
    }
}
