<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Companie;
use App\Models\Component_View;
use App\Models\Section;
use App\Models\SectionComponent;


class SectionCreate extends Component
{
    public $company_id;
    public $name;
    public $selectedComponents = [];
    public $availableComponents = [];
    public $invitationComponents = [];
    public $previewMode = false;
    public $CustomViewId;

    public function mount($CustomViewId = null)
    {
        $this->CustomViewId = $CustomViewId;
        $this->availableComponents = Component_View::pluck('name', 'model_type')->toArray();
        if ($CustomViewId) {
            $this->loadSectionComponents($CustomViewId);
        }
    }

    public function loadSectionComponents($CustomViewId)
    {
        // Realiza una consulta para obtener la invitación relacionada
        $this->customView = Section::with('SectionComponent.Component_View')->find($CustomViewId);
        // Luego, puedes acceder a los componentes de la invitación
        $this->invitationComponents = $this->customView->SectionComponent;
    }

    public function render()
    {
        $this->availableComponents = Component_View::pluck('name', 'model_type')->toArray();
        $companies = Companie::all();
        return view('livewire.section-create', compact('companies'));
    }

    public function addComponent($component)
    {
        if (count($this->selectedComponents) < 5) {
            $this->selectedComponents[] = ['ComponentView' => $component, 'props' => []];
        }
    }

    public function updateComponent($index, $props)
    {
        $this->selectedComponents[$index]['props'] = $props;
    }

    public function togglePreviewMode()
    {
        $this->previewMode = !$this->previewMode;
        $this->emit('togglePreviewMode');
    }

    public function saveAll()
    {

        if ($this->CustomViewId) {
            $this->emit('saveComponents');
        } else {
            $customView = Section::create([
                'user_id' => auth()->id(),
                'company_id' => $this->company_id,
                'name' => $this->name,
            ]);
            foreach ($this->selectedComponents as $index => $componentViewData) {
                $componentName = $componentViewData['ComponentView'];
                $componentRecord = Component_View::where('model_type', $componentName)->first();
                if ($componentRecord) {
                    $componentClassName = $componentRecord->model_type;
                    $order = $index + 1;
                    $CompanyComponent = SectionComponent::create([
                        'section_id' => $customView->id,
                        'component_id' => $componentRecord->id,
                        'order' => $order,
                    ]);
                }
            }
            $this->emit('saveComponents');
        }
    }
    public function removeComponent($index)
    {
        unset($this->selectedComponents[$index]);
    }
}
