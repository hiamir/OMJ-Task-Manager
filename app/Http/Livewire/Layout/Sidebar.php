<?php

namespace App\Http\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sidebar extends Component
{
    public string $dashboardRoute = '';
    public array $sideBar = [
        'dashboard' => ['name' => 'Dashboard', 'href' => ''],
        'users' => ['name' => 'Users', 'href' => ''],

    ];

    public array $sideBarChildOne = [
        'dashboard' => [
            ['name' => 'Dash-1', 'href' => 'admin.dashboard'],
            ['name' => 'Dash-2', 'href' => 'admin.dashboard']
        ],
        'users' => [
            ['name' => 'Data', 'href' => 'admin.dashboard']
        ],
    ];

    public array $sideBarChildTwo = [
        'users' => [
            ['name' => 'Data 1', 'href' => 'admin.dashboard'],
            ['name' => 'Data 2', 'href' => 'admin.dashboard'],
            ['name' => 'Data 3', 'href' => 'admin.dashboard'],
        ]
    ];

    public function mount()
    {
        if (Auth::guard('admin')->check() && explode('.', Route::currentRouteName())[0] === 'admin') {
            $this->sideBar['dashboard']['href'] = route('admin.dashboard');
        } else {
            $this->sideBar['dashboard']['href'] = route('dashboard');
        }
//        (array_key_exists(lcfirst($parent['name']),$sideBarChildTwo[lcfirst($parent['name'])]) ? count($sideBarChildTwo[lcfirst($parent['name'])]) : 0)

    }

    public function render()
    {
        return view('livewire.layout.sidebar', ['sideBar' => $this->sideBar]);
    }
}
