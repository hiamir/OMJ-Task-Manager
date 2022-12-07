<?php

namespace App\Traits;

use App\Models\Guard;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

trait Data
{
    /*      GET MODELS        */
    public static function getAvailableModels(): array
    {

        $models = [];
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($modelFiles as $modelFile) {
            $models[] = $modelFile->getFilenameWithoutExtension();
        }
        return $models;
    }


    /*      GET URI GUARD        */
    public static function uri_guard($request)
    {
        return explode('/', $request->getRequestUri())[1];
    }

    /*      GET GUARD ARRAY FOR SELECT OPTIONS        */
    public static function guards($code = null): array
    {
        if ($code === strtolower('admin')) {
            $guards = Guard::where('code', $code)->get();
        } else if ($code === strtolower('web')) {
            $guards = Guard::where('code', $code)->get();
        } else {
            $guards = Guard::all();
        }
        return Data::get_array_for_select_input(record: $guards, isNull: false);
    }


    /*      GET ARRAY FOR SELECT OPTIONS        */
    public static function get_array_for_select_input($record, $isNull): array
    {
        $array = [];
        if ($isNull) $array = array_merge(array("null" => 'None'), $array);

        foreach ($record as $data) {
            $array[$data->id] = $data->name.' (Parent)';
        }
        return $array;
    }

    /*      GET ALL PARENTS FOR SELECT OPTIONS        */
    public function get_all_parent_array_for_select_input($record,$exclude=null): array
    {
        $array = [];
        foreach ($record as $data) {
            $array[$data->id] = $data->name.' (Parent)';
            foreach ($data->childMenus as $childData) {
                if($childData->id !== $exclude) {
                    $array[$childData->id] = $childData->name . ' (Child)';
                }
            }
        }

        return $array;
    }

    /*      GET SECOND ARRAY FOR SELECT OPTIONS        */
    public static function get_second_array_for_select_input($record, $isNull): array
    {
        $array = [];
        if ($isNull) $array = array_merge(array("null" => 'None'), $array);
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
            if (Auth::guard('admin')->check()) {
                if (str_contains($value->getName(), 'admin.')) {
                    array_push($routes, $value->getName());
                }
            } else {
                if (str_contains($value->getName(), 'admin.')) {
                    array_push($routes, $value->getName());
                }
            }
        }
        return $routes;
    }

    /*         RESET FORM        */
    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
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

    /*      CLOSE FIRST MODEL      */
    public function closeFirstModal()
    {
        $this->dispatchBrowserEvent('FirstModel', ['show' => false]);
    }

    /*      ALTER ARRAY KEYS        */
    public static function AlterArrayKeys($name, $array): array
    {
        $newAttributes = [];
        foreach ($array as $key => $value) {
            $newAttributes[$name . '.' . $key] = $value;
        }
        return $newAttributes;
    }

    /*      ACTION AFTER SAVING THE RECORD        */
    public function afterSave($output, $formType, $recordName)
    {
        $this->emit('refreshDatatable');
        $this->resetForm();
        $this->closeFirstModal();

        if ($output[0]) {
            switch ($formType) {
                case 'create':
                    $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $recordName . "'" . ' was added!']);
                    break;

                case 'update':
                    $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $recordName . "'" . ' was updated!']);
                    break;

                case 'delete':
                    $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'success', 'message' => "'" . $recordName . "'" . ' was deleted!']);
                    break;
            }
        } else {
            $this->dispatchBrowserEvent('Toast', ['show' => true, 'type' => 'error', 'message' => 'Error: ' . $output[1]]);
        }

    }

    /*      GET ALL PUBLIC PROPERTIES DEFINED BY SUBCLASS        */
    public function getPublicProperties(): array
    {
        $publicProperties = array_filter((new \ReflectionObject($this))->getProperties(), function ($property) {
            return $property->isPublic() && !$property->isStatic();
        });

        $data = [];

        foreach ($publicProperties as $property) {
            if ($property->getDeclaringClass()->getName() !== self::class) {
                $data[$property->getName()] = $this->getInitializedPropertyValue($property);
            }
        }

        return $data;
    }
}
