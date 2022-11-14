<?php

namespace App\Traits;

trait General
{
    public string $formType = 'create';
    public string $buttonName = 'Create';
    public string $submitName = 'Create';
    public string $modalHeader = 'Create';

    public function modelInfo($formType, $name, $submitName='', $modalHeader='')
    {
        switch ($formType) {
            case 'create':
                $this->formType = $formType;
                ($submitName==='') ? $this->submitName = "let`s Create" :  $this->submitName = $submitName;
                ($modalHeader==='') ? $this->modalHeader = "New ".$name :  $this->modalHeader = $modalHeader;
                break;
            case 'update':
                $this->formType = $formType;
                ($submitName==='') ? $this->submitName = "Yes, Update" :  $this->submitName = $submitName;
                ($modalHeader==='') ? $this->modalHeader = "Update ".$name :  $this->modalHeader = $modalHeader;
                break;
            case 'delete':
                $this->formType = $formType;
                ($submitName==='') ? $this->submitName = "Yes, Delete" :  $this->submitName = $submitName;
                ($modalHeader==='') ? $this->modalHeader = "Delete ".$name :  $this->modalHeader = $modalHeader;
                break;
        }
    }
}
