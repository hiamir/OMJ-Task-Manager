<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\Traits\Data;
use App\Traits\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class MenuParent extends Component
{
    use General;
    use Data;

    public string $pageHeader = 'Menu';
    public array $menu, $guards, $routes, $parentData;
    public ?int $rowID = null, $menuID = null;
    public $menus, $menuRecord = null;

    /*         INITIALIZATION AT START        */
    public function mount()
    {
    }

    /*         RESET FORM        */
    public function resetForm()
    {
        $this->menu= $this->Repository(name: 'resetInputs');
        $this->resetErrorBag();
        $this->resetValidation();

    }

    /*         VALIDATION MESSAGES        */
    protected array $messages = [
        'menu.name.required' => 'Menu name is required.',
        'menu.name.min' => 'Menu must be at-least 4 letters long.',
        'menu.name.unique' => ':attribute menu already exists!.',
        'menu.menuID.integer' => ':attribute must be integer.',
        'menu.menuID.gt' => ':attribute must be positive integer.',
        'menu.guard.required' => 'Guard is required.',
        'menu.guard.integer' => ':attribute must be integer.',
        'menu.guard.gt' => ':attribute must be positive integer.',
        'menu.route.required' => 'Select a route for this menu.',
        'menuItem.route.unique' => ':attribute already exists.',
        'menuItem.route.regex' => ':attribute must lower case. Allowed ' . ' only',
        'menu.sort.required' => 'Give te order for this menu',
        'menu.sort.integer' => ':attribute must be integer.',
        'menu.sort.gt' => ':attribute must be positive integer.',
    ];

    /*         VALIDATION RULES        */
    protected function rules(): array
    {
        return [
            'menu.name' => 'required|min:4|unique:menus,name,' . $this->rowID,
            'menu.menuID' => 'numeric|gt:0|nullable',
            'menu.guard' => 'required|numeric|gt:0',
            'menu.route' => 'required|min:4|regex:/^[a-z,\.-]+$/|unique:menus,route,' . $this->rowID,
            'menu.sort' => 'required|numeric|gt:0'
        ];
    }

    /*         VALIDATION ATTRIBUTES        */
    protected function validationAttributes(): array
    {
        return [
            'menu.name' => $this->menu['name'],
            'menu.menuID' => $this->menu['menuID'],
        ];
    }

//    /*          RESET INPUT        */
//    protected function resetInput()
//    {
//        $this->menu = ['name' => '', 'menuID' => null, 'guard' => null, 'route' => null, 'sort' => ''];
//    }


    /*          REPOSITORY DATA        */
    protected function Repository($name, $type = null, $row = null, $record = null, $formInput = null, $level = null): Menu|array
    {
        $menuRepository = new MenuRepository();
        switch ($name) {
            case 'resetInputs':
                return $menuRepository->resetInputs();
            case 'getRecord':
                if ($type !== 'create' && $row !== null) $this->rowID = $row['id'];
                return $menuRepository->getRecord($type, $row);

            case 'formData':
                return $menuRepository->formData($type, $row, $record);

            case 'getRoutes':
                return $menuRepository->getRoutes($type, $record);

            case 'getParentData':
                return $menuRepository->getParentData($type, $record, $level);

            case 'saveData':
                return $menuRepository->saveData($record, $formInput);

            case 'deleteData':
                return $menuRepository->deleteData($record);
        }
    }

    /*          ASSIGN DATA TO SHOW       */
    protected function showData($type, $row, $level): void
    {
        $this->menuRecord = $this->Repository(name: 'getRecord', type: $type, row: $row);
        ($type === 'create') ? $this->modelInfo($type, 'Menu') : $this->modelInfo($type, $this->menuRecord->name);
        $this->menu = $this->Repository(name: 'formData', type: $type, row: $row, record: $this->menuRecord);
        $this->routes = $this->Repository(name: 'getRoutes', type: $type, record: $this->menuRecord);
        $this->parentData = $this->Repository(name: 'getParentData', type: $type, record: $this->menuRecord, level: $level);
    }


    /*          SHOW MODEL FOR CREATE, UPDATE, DELETE        */
    public function show($type, $row = null, $level = null)
    {
        $this->resetForm();
        $this->showData($type, $row, $level);
        if ($type === "create" || $type === 'update' || $type === 'delete') $this->dispatchBrowserEvent('FirstModel', ['show' => true]);
    }

    /*          SUBMIT DATA FOR CREATE, UPDATE, DELETE        */
    public function submit()
    {
        $success = [];
        switch ($this->formType) {
            case 'create':
            case 'update':
                $this->validate();
                $success = $this->Repository(name: 'saveData', record: $this->menuRecord, formInput: $this->menu);
                break;
            case 'delete':
                $success = $this->Repository(name: 'deleteData', record: $this->menuRecord);
                break;
        }
        $this->emit('refreshSidebar');
        ($success[0] === true) ? $this->afterSave($success, $this->formType, $this->menuRecord->name) : $this->afterSave($success, $this->formType, $success[1]);
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
