<?php

namespace App\View\Components;

use App\Models\PageVisit;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogEntity extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $page, public string $date)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.log-entity');
    }
}
