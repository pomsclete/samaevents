<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardComponent extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Tableau de bord')]
    public function render()
    {
        return view('livewire.admin.dashboard-component');
    }
}
