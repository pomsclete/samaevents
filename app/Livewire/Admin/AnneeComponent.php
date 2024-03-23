<?php

namespace App\Livewire\Admin;

use App\Models\Annee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;



class AnneeComponent extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use LivewireAlert;

    public $perPage = 10;
    public $sortField = 'annee_scolaire';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

    //Form Field
    public $rId = null;
    public $isFormOpen = false;
    public $annee_scolaire;
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
        $this->annee_scolaire= null;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isFormOpen = false;
        $this->editModalOpen = false;
        $this->resetData();
    }

   /*public function deleteId($id){
       $this->dId = $id;
       $this->alert('warning', 'Confirmer pour supprimer', [
        'showConfirmButton' => true,
        'confirmButtonText' => 'Confirmer',
        'showCancelButton' => true,
        'cancelButtonText' => 'Annuler',
        'onConfirmed' => 'confirmed',  
        'allowOutsideClick' => false,
        'timer' => null
    ]);
   }*/

   public function confirmed($id)
    {
        $this->dId = $id;
        try {
            $year = Annee::find($this->dId);
            if ($year) {
                $year->delete();
            }
            $this->alert('success', 'Année supprimée avec succès!!');
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
                $year = Annee::find($this->rId);
                if ($year) {
                    $this->annee_scolaire = $year->annee_scolaire;
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
            'annee_scolaire' => 'required',
        ];
        $validatedData = $this->validate($ruleFields);
        try {
            $anneeQuery = Annee::query();
            if (!empty($this->rId)) {
                $year = $anneeQuery->find($this->rId);
                if ($year) {
                    $year->update($validatedData);
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
    #[Title('Année scolaire')]
    public function render()
    {
        return view('livewire.admin.annee-component', [
            'records' => Annee::where('annee_scolaire','like','%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
