<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{

    public $prop;
    public $title;
    public $order;
    public $priceRequest;
    public $listNotice;
    public $countNotice;

    /**
     * Create a new component instance.
     */
    public function __construct($prop, $title, $order = null, $priceRequest = null, $listNotice = null, $countNotice = null)
    {
        $this->prop = $prop;
        $this->title = $title;

        // Kiểm tra nếu $order không null thì gán giá trị cho $this->order
        if ($order !== null) {
            $this->order = $order;
        }
        if ($priceRequest !== null) {
            $this->priceRequest = $priceRequest;
        }
        if ($listNotice !== null) {
            $this->listNotice = $listNotice;
        }
        if ($countNotice !== null) {
            $this->countNotice = $countNotice;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.User.header');
    }
}
