<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class MenuParent extends Component
{
    use General;
    use Data;

    public string $pageHeader = 'Menu';
    public array $menu;
    public ?int $rowID = null;
    public ?int $menuID = null;

    public $menuRecord = null;

    public array $parentData = [];

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
        'menu.parent_id.integer' => ':attribute must be integer.',
        'menu.parent_id.gt' => ':attribute must be positive integer.',
    ];

    protected function rules()
    {
        return [
            'menu.name' => 'required|min:4|unique:menus,name,' . $this->rowID,
            'menu.parent_id'=>'numeric|gt:0'
        ];
    }

    protected function validationAttributes()
    {
        return [
            'menu.name' => $this->menu['name'],
            'menu.menuID' => $this->menu['menuID'],
        ];
    }

    public function resetInput()
    {
        $this->menu = ['name' => '','menuID'=>null];
    }

    protected function getRecord($row)
    {
        $this->rowID = $row['id'];
        $this->menuRecord = Menu::find($this->rowID)->first();
    }


    public function createMenu($id=null)
    {


        $this->resetForm();
        if($id !== null) $this->menu['menuID']= $id;
        $this->modelInfo('create', 'Menu');
        $this->parentData = $this->get_array_for_select_input(Menu::select('id', 'name')->where('parent_id',null)->where('id',$id)->get());

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

    protected function afterSave($formType)
    {
        $this->emit('refreshDatatable');
        $this->resetForm();
        $this->dispatchBrowserEvent('FirstModel', ['show' => false]);

        switch ($formType) {
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
                ($this->menu['menuID'] !== null) ? $this->menuRecord->parent_id = $this->menu['menuID'] : $this->menuRecord->parent_id=null;
                $this->menuRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'update':
                $this->validate();
                $this->menuRecord->name = $this->menu['name'];
                $this->menuRecord->menus_id = $this->menu['menuID'];
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
        $menus = Menu::with('childMenus')->where('parent_id','=',null)->get();
        return view('livewire.admin.menu.menu-parent',['menus'=>$menus]);
    }
}
