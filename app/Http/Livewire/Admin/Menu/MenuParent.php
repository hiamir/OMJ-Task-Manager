<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class MenuParent extends Component
{
    use General;
    use Data;

    public string $pageHeader = 'Menu';
    public array $menu, $guards, $routes;
    public ?int $rowID = null;
    public ?int $menuID = null;
    public $menus;
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
        'menu.menuID.integer' => ':attribute must be integer.',
        'menu.menuID.gt' => ':attribute must be positive integer.',
        'menu.guard.required' => 'Guard is required.',
        'menu.guard.integer' => ':attribute must be integer.',
        'menu.guard.gt' => ':attribute must be positive integer.',
        'menuItem.route.unique' => ':attribute already exists.',
        'menuItem.route.regex' => ':attribute must lower case. Allowed ' . ' only',
        'menu.sort.integer' => ':attribute must be integer.',
        'menu.sort.gt' => ':attribute must be positive integer.',
    ];

    #[ArrayShape(['menu.name' => "string", 'menu.menuID' => "string", 'menu.guard' => "string", 'menu.route' => "string", 'menu.sort' => "string"])] protected function rules(): array
    {
        return [
            'menu.name' => 'required|min:4|unique:menus,name,' . $this->rowID,
            'menu.menuID' => 'numeric|gt:0|nullable',
            'menu.guard' => 'required|numeric|gt:0',
            'menu.route' => 'required|min:4|regex:/^[a-z,\.-]+$/|unique:menus,route,' . $this->rowID,
            'menu.sort' => 'required|numeric|gt:0'
        ];
    }

    #[ArrayShape(['menu.name' => "mixed", 'menu.menuID' => "mixed"])] protected function validationAttributes(): array
    {
        return [
            'menu.name' => $this->menu['name'],
            'menu.menuID' => $this->menu['menuID'],
        ];
    }

    public function resetInput()
    {
        $this->menu = ['name' => '', 'menuID' => null, 'guard' => null, 'route' => null, 'sort' => ''];
    }

    protected function getRecord($row)
    {
        $this->rowID = $row['id'];
        $this->menuRecord = Menu::where('id', $this->rowID)->first();
    }


    public function createMenu($id = null)
    {
        $this->resetForm();
        if ($id !== null) $this->menu['menuID'] = $id;
        $this->routes = Data::get_routes_array_for_select_input();
        $this->modelInfo('create', 'Menu');
        $this->parentData = $this->get_array_for_select_input(Menu::select('id', 'name')->where('id', $id)->get());

        $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }


    public function editMenu($row, $level = null)
    {
        $this->resetForm();
        $this->getRecord($row);
        $this->routes = Data::get_routes_array_for_select_input([$this->menuRecord->route]);


        $this->modelInfo('update', $this->menuRecord->name);
        $this->parentData = match ($level) {
            'l1' => $this->get_array_for_select_input(Menu::select('id', 'name')->where('parent_id', null)->get()),
            'l2' => $this->get_second_array_for_select_input(Menu::select('id', 'name')->where('parent_id', null)->get()),
            default => [],
        };
        $this->menu['name'] = $this->menuRecord->name;
        $this->menu['menuID'] = $this->menuRecord->parent_id;
        $this->menu['route'] = $this->menuRecord->route;
        $this->menu['sort'] = $this->menuRecord->sort;
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
                ($this->menu['menuID'] !== null) ? $this->menuRecord->parent_id = strval($this->menu['menuID']) : $this->menuRecord->parent_id = null;
                $this->menuRecord->route = $this->menu['route'];
                $this->menuRecord->guards_id = $this->menu['guard'];
                $this->menuRecord->sort = $this->menu['sort'];

                $this->menuRecord->save();
                $this->afterSave($this->formType);
                break;

            case 'update':
                $this->validate();
                $this->menuRecord->name = $this->menu['name'];
                $this->menuRecord->parent_id = $this->menu['menuID'];
                $this->menuRecord->guards_id = $this->menu['guard'];
                $this->menuRecord->route = $this->menu['route'];
                $this->menuRecord->sort = $this->menu['sort'];
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
        if (auth()->guard('admin')->check()) {
            $this->guards = $this->guards('admin');
            if (count($this->guards) === 1) $this->menu['guard'] = array_key_first($this->guards);
        } else {
            $this->guards = $this->guards('web');
            if (count($this->guards) === 1) $this->menu['guard'] = array_key_first($this->guards);
        }


        $this->menus = Menu::with('childMenus')->where('parent_id', '=', null)->get();
        return view('livewire.admin.menu.menu-parent', ['menus' => $this->menus]);
    }
}
