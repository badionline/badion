<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Fileinput extends Component
{
    public $label;
    public $name;
    public $accept;
    public $labelid;
    /**
     * Create a new component instance.
     */
    public function __construct($label,$name, $accept,$labelid)
    {
        $this->label = $label;
        $this->name = $name;
        $this->accept = $accept;
        $this->labelid = $labelid;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fileinput');
    }
}
