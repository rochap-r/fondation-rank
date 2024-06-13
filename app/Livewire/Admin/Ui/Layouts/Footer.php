<?php

namespace App\Livewire\Admin\Ui\Layouts;

use Livewire\Component;

class Footer extends Component
{
    public $config;
    protected $listeners=[
        'updateFooter'=>'$refresh'
    ];
    public function render()
    {
        return view('livewire.admin.ui.layouts.footer');
    }
}
