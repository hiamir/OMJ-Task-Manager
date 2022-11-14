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
    public ?int $rowID = null;

    public $menuLevelRecord = null;

    protected $listeners = ['createMenuLevel', 'editMenuLevel', 'deleteMenuLevel'];


    public function mount()
    {
//        $this->modelInfo('create', 'Create', 'Create', 'Create Menu Levels');
//        $this->formType = "create";
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetInput();
    }

    protected $messages = [
        'menuLevel.name.required' => 'Menu name is required.',
        'menuLevel.name.min' => 'Menu must be at-least 4 letters long.',
        'menuLevel.name.unique' => ':attribute menu already exists!.',
    ];

    protected function rules()
    {
        return [
            'menuLevel.name' => 'required|min:4|unique:menu_levels,name,' . $this->rowID
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

    protected function getRecord($row)
    {
        $this->rowID = $row['id'];
        $this->menuLevelRecord = MenuLevel::find($row)->first();
    }


    public function createMenuLevel()
    {
        $this->resetForm();
        $this->modelInfo('create', 'Menu Level');
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    public function editMenuLevel($row)
    {
        $this->getRecord($row);
        $this->modelInfo('update', $this->menuLevelRecord->name);
        $this->menuLevel['name'] = $this->menuLevelRecord->name;
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    public function deleteMenuLevel($row)
    {
        $this->getRecord($row);
        $this->modelInfo('delete', $this->menuLevelRecord->name);
        $this->menuLevel['name'] = $this->menuLevelRecord->name;
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    protected function afterSave($formType){
        $this->emit('refreshDatatable');
        $this->resetForm();
        $this->dispatchBrowserEvent('FirstModel', ['show' => false]);

        switch($formType){
            case 'create':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuLevelRecord->name . "'" . ' was added to Menu Level!']);
                break;

            case 'update':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuLevelRecord->name . "'" . ' was updated!']);
                break;

            case 'delete':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuLevelRecord->name . "'" . ' was deleted!']);
                break;
        }
    }


    public function submit()
    {


        switch ($this->formType) {

            case 'create':
                $this->validate();
                $this->menuLevelRecord = new MenuLevel();
                $this->menuLevelRecord->name = $this->menuLevel['name'];
                $this->menuLevelRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'update':
                $this->validate();
                $this->menuLevelRecord->name = $this->menuLevel['name'];
                $this->menuLevelRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'delete':
                $this->menuLevelRecord->delete();
                $this->afterSave($this->formType);
                break;
        }


    }

    public function render()
    {
        return view('livewire.admin.menu.level');
    }
}
