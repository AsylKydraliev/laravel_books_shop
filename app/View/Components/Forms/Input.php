<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * @param string $type
     * @param string $name
     * @param string|null $id
     * @param string|null $value
     * @param string|null $placeholder
     * @param string|null $label
     * @param string|null $class
     * @param string|null $form
     */
    public function __construct(
        public string $type,
        public string $name,
        public ?string $id = null,
        public ?string $value = null,
        public ?string $placeholder = null,
        public ?string $label = null,
        public ?string $class = 'form-control',
        public ?string $form = '',
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
