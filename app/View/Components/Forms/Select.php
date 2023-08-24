<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * @param string $id
     * @param string $name
     * @param string|null $label
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $label = null,
    ){}


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
