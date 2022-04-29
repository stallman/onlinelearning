<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $obData;

    public $sNameField;
    public $sName;
    public $isRequired;
    public $sEmptyMessage;
    public $mDefaultValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sNameField, $sName, $mDefaultValue = null, $isRequired = false, $sEmptyMessage = '', $obData = null)
    {
        $this->obData = $obData;
        $this->sNameField = $sNameField;
        $this->isRequired = $isRequired;
        $this->sEmptyMessage = $sEmptyMessage;
        $this->sName = $sName;
        $this->mDefaultValue = $mDefaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.text-area');
    }
}
