<?php

namespace App\View\Components\Layout\Sidebar;

use Illuminate\View\Component;

class ChildOne extends Component
{
    public $links;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($links=[])
    {
       $this->links=$links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.sidebar.child-one',['links'=>$this->links]);
    }
}
