<div class="container">
    <link rel="stylesheet" type="text/css" href="/assets/css/cropper.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/cropperImage.css">
    @livewireStyles()
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <button id="openComponentMenuButton" class="btn btn-primary">
                <i class="fas fa-bars"></i> Agregar Componente
            </button>
        </div>
        <div class="col-auto">
            <button wire:click="togglePreviewMode">
                @if($previewMode)
                    <i class="fas fa-eye"></i> Modo Vista Previa
                @else
                    <i class="fas fa-eye"></i> Modo Edición
                @endif
            </button>
        </div>
    </div>
    <div class="component-menu" id="componentMenu">
        <ul>
            @foreach($availableComponents as $component => $label)
                <li wire:click="addComponent('{{ $component }}')">{{ $label }}</li>
            @endforeach
        </ul>
    </div>

    @if(count($selectedComponents) >= 5)
        <p>Has alcanzado el máximo de 5 componentes.</p>
    @endif

    <div>
        <form wire:submit.prevent="saveAll">
            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h3>Nueva Sección</h3>
                                <div class="col-12 col-sm-6 mt-3">
                                    <label for="name">Nombre:</label>
                                    <input type="text" wire:model="name" name="name" class="form-control" placeholder="Nombre de la sección">
                                </div>
                                <div class="col-12 col-sm-6 mt-3">
                                    <label for="company_id">Compañia:</label>
                                    <select wire:model="company_id" name="company_id" class="form-control">
                                        <option value="">Selecciona una opción</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($selectedComponents as $index => $componentData)
                @livewire($componentData['ComponentView'], ['props' => $componentData['props']], key($index))
                <button wire:click="removeComponent({{ $index }})" class="btn btn-danger">Reset</button>
            @endforeach
            @if($CustomViewId != null)
                @foreach($invitationComponents as $component)
                @livewire($component->Component_View->model_type, ['info' => $component->Component_View->ComponentViewDataOrder(), 'CustomViewId' => $CustomViewId], key($component->id))
                @endforeach
            @endif
            <button type="submit" class="btn btn-primary mt-4">Guardar</button>
        </form>
    </div>

    <div class="hidden" id="modal">
        <div class="card-content">
            <div class="card-header">
                <p>Recorta tu foto</p>
            </div>
            <div class="card-body">
                <div class="image-container">
                    <img src="" alt="" class="img-cropper" id="cropped-image">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn primary" id="cut">Recortar</button>
                <button class="btn secondary" id="close">Cancelar</button>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/cropper.js"></script>
    <script>
        document.getElementById('openComponentMenuButton').addEventListener('click', function() {
            var componentMenu = document.getElementById('componentMenu');
            componentMenu.style.display = componentMenu.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</div>