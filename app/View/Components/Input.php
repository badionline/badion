<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $name;
    public $placeholder;
    public $dataemail;

    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($label,$type, $name, $placeholder,$value="",$dataemail="")
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value=$value;
        $this->dataemail=$dataemail;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
