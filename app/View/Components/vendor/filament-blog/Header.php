<?php

namespace Firefly\FilamentBlog\Components;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('filament-blog::components.header');
    }
}
