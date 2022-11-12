<?php

namespace App\Http\Livewire\Admin\Menu;

use App\Models\MenuLevel;
use Livewire\Component;

class Level extends Component
{
    public string $pageHeader='Menu Level';
    public array $menuLevel;

    public function mount(){
        $this->resetInput();
    }

    public function resetForm(){
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

    public function resetInput(){
        $this->menuLevel=['name'=>''];
    }



    public function submit(){
        $this->validate();
       $level=new MenuLevel();
       $level->name=$this->menuLevel['name'];
       $level->save();
       $this->resetForm();
        $this->resetInput();
       $this->dispatchBrowserEvent('FirstModel',['show'=>false]);
       $this->dispatchBrowserEvent('Toast',['show'=>true,'type'=>'success','message'=>"'".$level->name."'".' was added to Menu Level!']);
    }

    public function render()
    {
        return view('livewire.admin.menu.level');
    }
}
