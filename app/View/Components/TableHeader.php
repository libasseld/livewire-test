<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $direction;
    public string $name;
    public string $field;

    public function __construct($direction,$name,$field)
    {
        $this->direction = $direction;
        $this->name = $name;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-header',[
            'visible' => $this->field == $this->name
        ]);
    }
}
