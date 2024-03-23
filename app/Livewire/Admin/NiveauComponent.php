<?php

namespace App\Livewire\Admin;

use App\Models\Niveau;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;

class NiveauComponent extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use LivewireAlert;


    public $perPage = 10;
    public $sortField = 'designation';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

    //Form Field
    public $rId = null;
    public $isFormOpen = false;
    public $designation;
    #[Url] 
    public $search = '';
    //Action
    public $dId = '';
    public $editModalOpen = false;
   
    public function openModal()
    {
        $this->isFormOpen = true;
        $this->editModalOpen = false;
        $this->resetData();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ?
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc'
            : 'asc';
        $this->sortField = $field;
    }

    // For Delete Feature Start

    public function resetData(){
        $this->rId = null;
        $this->designation= null;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isFormOpen = false;
        $this->editModalOpen = false;
        $this->resetData();
    }


   public function confirmed($id)
    {
        $this->dId = $id;
        try {
            $year = Niveau::find($this->dId);
            if ($year) {
                $year->delete();
            }
            $this->alert('success', 'Niveau supprimée avec succès!!');
            $this->resetPage();
        } catch (\Exception $ex) {
            $this->alert('success', 'Something goes wrong!!');
        }
    }

    // Create and Update Feature Start
    public function edit($id = null)
    {
        try {
            $this->rId = $id;
            if (!empty($this->rId)) {
                $niv = Niveau::find($this->rId);
                if ($niv) {
                    $this->designation = $niv->designation;
                }
            }
            $this->isFormOpen = true;
            $this->editModalOpen = true;
            $this->resetPage();

        } catch (\Exception $ex) {
            $this->alert('warning', 'Something goes wrong!!');
        }
    }



    public function store()
    {
        $ruleFields = [
            'designation' => 'required',
        ];
        $validatedData = $this->validate($ruleFields);
        try {
            $anneeQuery = Niveau::query();
            if (!empty($this->rId)) {
                $niv = $anneeQuery->find($this->rId);
                if ($niv) {
                    $niv->update($validatedData);
                }
            } else {
                $anneeQuery->create($validatedData);
            }
            $this->closeModal();
            $this->resetPage();
            $this->alert('success', 'Enregistrement éffectué avec succés');
        } catch (\Exception $ex) {
            $this->alert('warning', 'Something goes wrong!!');
        }
    }

    public function closeFormModal()
    {
        $this->isFormOpen = false;
        $this->reset();
    }

    #[Layout('components.layouts.app')]
    #[Title("Niveaux d'étude")]
    public function render()
    {
        return view('livewire.admin.niveau-component',[
            'records' => Niveau::where('designation','like','%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
