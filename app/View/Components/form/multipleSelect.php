<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class multipleSelect extends Component
{
    public $collection;
    public $name;
    public $class;
    public $index;
    public $label;
    public $id;
    public $selectArr;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, $name, $class, $index, $label, $selectArr, $id="")
    {
        $this->collection = $collection;
        $this->name = $name;
        $this->class = $class;
        $this->index = $index;
        $this->label = $label;
        $this->id = $id;
        $this->selectArr = $selectArr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.multiple-select');
    }
}
