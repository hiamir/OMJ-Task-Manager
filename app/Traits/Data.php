<?php

namespace App\Traits;

use App\Models\Guard;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

trait Data
{

    /*      GET URI GUARD        */
    public static function uri_guard($request)
    {
        return explode('/', $request->getRequestUri())[1];
    }

    /*      GET GUARD ARRAY FOR SELECT OPTIONS        */
    public function guards($code=null): array
    {
        if($code === strtolower('admin')) {
            $guards = Guard::where('code', $code)->get();
        }else if($code === strtolower('web')){
            $guards = Guard::where('code', $code)->get();
        }else{
            $guards = Guard::all();
        }
        return $this->get_array_for_select_input($guards);
    }

    /*      GET ARRAY FOR SELECT OPTIONS        */
    public function get_array_for_select_input($record): array
    {
        $array = [];
        foreach ($record as $data) {
            $array[$data->id] = $data->name;
        }
        return $array;
    }

    /*      GET SECOND ARRAY FOR SELECT OPTIONS        */
    public function get_second_array_for_select_input($record): array
    {
        $array = [];
        foreach ($record as $key => $value) {
            foreach ($value->childMenus as $data) {
                $array[$data->id] = $data->name;
            }
        }
        return $array;
    }

    /*      GET ALL ROUTES WITH GUARDS ADMIN AND USERS        */
    public static function all_user_routes(): array
    {
        $routeCollection = Route::getRoutes();
        $routes = [];

        foreach ($routeCollection as $value) {
            if(Auth::guard('admin')->check()){
                if (str_contains($value->getName(), 'admin.') ) {
                    array_push($routes, $value->getName());
                }
            }else{
                if ( str_contains($value->getName(), 'admin.')) {
                    array_push($routes, $value->getName());
                }
            }

        }
        return $routes;
    }

    /*      GET ROUTE ARRAY FOR SELECT OPTIONS        */
    public static function get_routes_array_for_select_input($id = null): array
    {
            $array = [];
            $assignedRoutes = json_decode(Menu::pluck('route'));

            if (isset($id)) $assignedRoutes = array_diff($assignedRoutes, $id);
            foreach (Data::all_user_routes() as $key => $value) {
                $array[$value] = $value;
            }
            return array_diff($array, $assignedRoutes);
    }


}
