<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class textarea extends Component
{
    public $name;
    public $class;
    public $value;
    public $label;
    public $attribute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class, $name ="test", $value, $label ="", $attribute="")
    {
        $this->name = $name;
        $this->class = $class;
        $this->value = $value;
        $this->label = $label;
        $this->attribute = $attribute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
