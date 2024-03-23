<?php

namespace App\Livewire\Admin;

use App\Models\Annee;
use Livewire\Component;
use App\Models\Document;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DocumentComponent extends Component
{
    use WithPagination;
    use WithoutUrlPagination;
    use LivewireAlert;

    public $perPage = 10;
    public $sortField = 'libelle';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

    //Form Field
    public $rId = null;
    public $isFormOpen = false;
    public $libelle;
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
        $this->libelle= null;
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
           $year = Document::find($this->dId);
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
               $year = Document::find($this->rId);
               if ($year) {
                   $this->libelle = $year->libelle;
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
           'libelle' => 'required',
       ];
       $validatedData = $this->validate($ruleFields);
       try {
           $docQuery = Document::query();
           if (!empty($this->rId)) {
               $doc = $docQuery->find($this->rId);
               if ($doc) {
                   $doc->update($validatedData);
               }
           } else {
               $docQuery->create($validatedData);
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
   #[Title('Types de document')]
    public function render()
    {
        return view('livewire.admin.document-component',[
            'records' => Document::where('libelle','like','%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
