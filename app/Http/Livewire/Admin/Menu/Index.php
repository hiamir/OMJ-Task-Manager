<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Actions\Menu\MenuParentData;
use App\Actions\Menu\MenuGuards;
use App\Actions\Menu\MenuRouteData;
use App\Actions\Menu\MenuSubmit;
use App\Actions\Menu\MenuFormData;
use App\Actions\Menu\MenuValidation;
use App\Models\Menu;
use App\Traits\Data;
use App\Traits\General;
use Livewire\Component;

class Index extends Component
{
    use General;
    use Data;

    public string $pageHeader = 'Menu';
    public array $guards, $routes, $parentData;
    public Menu $menu;


    /*         INITIALIZATION AT START        */
    public function mount()
    {
        $this->menu = new Menu();
    }

    /*         INPUT RULES        */
    public function rules(): array
    {
        return MenuValidation::make()->rules();
    }

    /*          SHOW MODEL FOR CREATE, UPDATE, DELETE        */
    public function show($type, $row = null, $level = null)
    {
        $this->resetForm();
        $this->menu = MenuFormData::run(type: $type, row: $row);
        $this->guards= MenuGuards::run($this->menu);
        $this->routes = MenuRouteData::run(record: $this->menu);
        $this->parentData = MenuParentData::run(type: $type, record: $this->menu, level: $level);
        $this->showModal($type, $this->menu->name);
    }

    /*          SUBMIT DATA FOR CREATE, UPDATE, DELETE        */
    public function submit()
    {
        MenuSubmit::run($this,$this->formType,$this->menu);
    }

    public function render()
    {
        $menus = Menu::with('childMenus')->where('parent_id', '=', null)->orderBy('sort', 'ASC')->get();
        return view('livewire.admin.menu.index', ['menus' => $menus]);
    }
}
