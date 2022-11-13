<?php

namespace App\Traits;

trait General
{
    public string $formType = 'create';
    public string $buttonName = 'Create';
    public string $modalHeader = 'Create';

    public function formInfo($formType, $buttonName, $submitName, $modalHeader)
    {
        switch ($formType) {
            case 'create':
            case 'update':
                $this->formType = $formType;
                $this->buttonName = $buttonName;
                $this->submitName = $submitName;
                $this->modalHeader = $modalHeader;
                break;
        }
    }
}
