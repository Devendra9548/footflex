<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class footer extends Component
{
    /**
     * Create a new component instance.
     */
    public $facebook='';
    public $linkedin='';
    public $instagram='';
    public $twitter='';
    public $youtube='';
    public $mail='';
    public function __construct($facebook,$linkedin,$instagram,$twitter,$youtube,$mail)
    {
       $this->facebook=$facebook;
       $this->linkedin=$linkedin;
       $this->instagram=$instagram;
       $this->twitter=$twitter;
       $this->youtube=$youtube;
       $this->mail=$mail;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
