<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{

    public $prop;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($prop, $title)
    {
        $this->prop = $prop;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.User.header');
    }
}
