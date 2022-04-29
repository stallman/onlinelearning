<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $sDisplayKey;
    public $sValueKey;
    public $arData;
    public $bIsRequired;
    public $sEmptyMessage;
    public $sNameField;
    public $sName;
    public $obData;
    public $bIsMultiple;

    /**
     * Select constructor.
     * @param $sName
     * @param $sNameField
     * @param $obData
     * @param $arData
     * @param $sDisplayKey
     * @param string $sValueKey
     * @param bool $isRequired
     * @param string $sEmptyMessage
     */
    public function __construct($sName, $sNameField, $obData, $arData, $sDisplayKey, $sValueKey = 'id',
                                $bIsRequired = false, $sEmptyMessage = '', $bIsMultiple = false)
    {
        $this->sDisplayKey = $sDisplayKey;
        $this->sValueKey = $sValueKey;
        $this->arData = $arData;
        $this->bIsRequired = $bIsRequired;
        $this->sEmptyMessage = $sEmptyMessage;
        $this->sNameField = $sNameField;
        $this->sName = $sName;
        $this->obData = $obData;
        $this->bIsMultiple = $bIsMultiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
