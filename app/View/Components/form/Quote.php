<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Quote extends Component
{
    public $prop;
    /**
     * Create a new component instance.
     */
    public function __construct($prop)
    {
        $this->prop= $prop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.quote');
    }
}
