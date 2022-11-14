<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Traits\General;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class MenuParent extends Component
{
    use General;

    public string $pageHeader = 'Menu';
    public array $menu;
    public ?int $rowID = null;

    public $menuRecord = null;

    protected $listeners = ['createMenu', 'editMenu', 'deleteMenu'];


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
        'menu.name.required' => 'Menu name is required.',
        'menu.name.min' => 'Menu must be at-least 4 letters long.',
        'menu.name.unique' => ':attribute menu already exists!.',
    ];

    protected function rules()
    {
        return [
            'menu.name' => 'required|min:4|unique:menus,name,' . $this->rowID
        ];
    }

    protected function validationAttributes()
    {
        return [
            'menu.name' => $this->menu['name'],
        ];
    }

    public function resetInput()
    {
        $this->menu = ['name' => ''];
    }

    protected function getRecord($row)
    {
        $this->rowID = $row['id'];
        $this->menuRecord = Menu::find($row)->first();
    }


    public function createMenu()
    {
        $this->resetForm();
        $this->modelInfo('create', 'Menu');
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    public function editMenu($row)
    {
        $this->getRecord($row);
        $this->modelInfo('update', $this->menuRecord->name);
        $this->menu['name'] = $this->menuRecord->name;
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    public function deleteMenu($row)
    {
        $this->getRecord($row);
        $this->modelInfo('delete', $this->menuRecord->name);
        $this->menu['name'] = $this->menuRecord->name;
        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    protected function afterSave($formType){
        $this->emit('refreshDatatable');
        $this->resetForm();
        $this->dispatchBrowserEvent('FirstModel', ['show' => false]);

        switch($formType){
            case 'create':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuRecord->name . "'" . ' was added to Menu Level!']);
                break;

            case 'update':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuRecord->name . "'" . ' was updated!']);
                break;

            case 'delete':
                $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $this->menuRecord->name . "'" . ' was deleted!']);
                break;
        }
    }


    public function submit()
    {


        switch ($this->formType) {

            case 'create':
                $this->validate();
                $this->menuRecord = new Menu();
                $this->menuRecord->name = $this->menu['name'];
                $this->menuRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'update':
                $this->validate();
                $this->menuRecord->name = $this->menu['name'];
                $this->menuRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'delete':
                $this->menuRecord->delete();
                $this->afterSave($this->formType);
                break;
        }


    }

    public function render()
    {
        return view('livewire.admin.menu.menu-parent');
    }
}
