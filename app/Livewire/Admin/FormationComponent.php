<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Formation;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormationComponent extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use LivewireAlert;

    public $perPage = 10;
    public $sortField = 'intitule';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

    //Form Field
    public $rId = null;
    public $intitule;
    #[Url] 
    public $search = '';
    //Action
    public $dId = '';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ?
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc'
            : 'asc';
        $this->sortField = $field;
    }

    public function confirmed($id)
    {
        $this->dId = $id;
        try {
            $year = Formation::find($this->dId);
            if ($year) {
                $year->delete();
            }
            $this->alert('success', 'Année supprimée avec succès!!');
            $this->resetPage();
        } catch (\Exception $ex) {
            $this->alert('success', 'Something goes wrong!!');
        }
    }

    #[Layout('components.layouts.app')]
    #[Title('Nos formations')]
    public function render()
    {
        return view('livewire.admin.formation-component',[
            'records' => Formation::where('intitule','like','%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
