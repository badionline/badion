<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $img;
    public $title;
    public $value;
    public $url;
    /**
     * Create a new component instance.
     */
    public function __construct($img, $title, $value,$url)
    {
        $this->img = $img;
        $this->title = $title;
        $this->value = $value;
        $this->url=$url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
