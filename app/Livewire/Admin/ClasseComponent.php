<?php

namespace App\Livewire\Admin;

use App\Models\Formation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ClasseComponent extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use LivewireAlert;

    public $perPage = 10;
    public $sortField = 'intitule';
    public $sortDirection = 'asc';
    public $isFormOpen = false;

    protected $queryString = ['sortField', 'sortDirection'];

    //Form Field
    #[Url]
    public $search = '';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ?
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc'
            : 'asc';
        $this->sortField = $field;
    }

    public function openModal($id)
    {
        $this->isFormOpen = true;
    }

    public function closeModal()
    {
        $this->isFormOpen = false;
        $this->id = null;
    }

    #[Layout('components.layouts.app')]
    #[Title('Nos classes')]
    public function render()
    {
        return view('livewire.admin.classe-component',[
            'records' => Formation::where('intitule','like','%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
