<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class select extends Component
{
    public $collection;
    public $name;
    public $class;
    public $value;
    public $label;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, $name, $class, $value, $label)
    {
        $this->collection = $collection;
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
