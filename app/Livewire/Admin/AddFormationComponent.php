<?php

namespace App\Livewire\Admin;

use App\Models\Formation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AddFormationComponent extends Component
{
    use LivewireAlert;
    public $intitule,$duree,$description,$raison,$condition;

    public $id;
    public $isedit = false;

    public function mount(){
        if (!empty($this->id)) {
            $req = Formation::where('id',$this->id)->first();
            if ($req){
                $this->intitule = $req->intitule;
                $this->duree = $req->duree;
                $this->description = $req->description;
                $this->raison = $req->raison;
                $this->condition = $req->condition;
            } else{
                abort('404');
            }

        }
    }

    public function store()
    {
        $ruleFields = [
            'intitule' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'duree' => 'required',
            'raison' => 'required'
        ];

        $validatedData = $this->validate($ruleFields);
        try {
            $formationQuery = Formation::query();
            if (!empty($this->id)) {
                $formation = $formationQuery->find($this->id);
                if ($formation) {
                    $formation->update($validatedData);
                }
            } else {
                $formationQuery->create($validatedData);
            }
            $this->alert('success', 'Enregistrement éffectué avec succés');
            $this->redirect('/admin/formations');
        } catch (\Exception $ex) {
            dd($ex);
            $this->alert('warning', $ex);
        }
    }

    #[Layout('components.layouts.app')]
    #[Title('Ajouter une formation')]
    public function render()
    {
        return view('livewire.admin.add-formation-component');
    }
}
