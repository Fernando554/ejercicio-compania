<div>
    @if($preview)
    <section class="container py-5">
        <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <h2>
                    {{ $title }}
                </h2>
            <div class="mt-4 w-100">
                    <h4 class="fw-bold">
                        {{ $subtitle }}
                    </h4>
                <div class="row mt-4 justify-content-center">
                    <div class="col-5 col-md-3 col-lg-2">
                            <img src="{{asset($image)}}" alt="Imagen" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                    </div>
                    <div class="col-5 col-md-3 col-lg-2 ms-lg-5">
                            <img src="{{ $image2 }}" alt="" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                    </div>
                </div>
            </div>
            <div class="mt-5 fs-4">
                    {{ $text }}
            </div>
            <div class="mt-4 fs-1">
                    {{ $finalMessage }}
            </div>
        </div>
    </section>
    @else
    <section class="container py-5">
        <div class="d-flex flex-column justify-content-center align-items-center text-center">
            @if($isEditing)
                <h2>
                    <input type="text" class="form-control" wire:model="title">
                </h2>
            @else
                <h2>
                    {{ $title }}
                </h2>
            @endif
            <div class="mt-4 w-100">
                @if($isEditing)
                    <h4 class="fw-bold">
                        <input type="text" class="form-control fw-bold text-center" wire:model="subtitle">
                    </h4>
                @else
                    <h4 class="fw-bold">
                        {{ $subtitle }}
                    </h4>
                @endif
                <div class="row mt-4 justify-content-center">
                    <div class="col-5 col-md-3 col-lg-2">
                        @if($isEditing)
                            @if($image)
                                <img src="{{ is_string($image) ? $image : $image->temporaryUrl() }}" alt="" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                            @endif
                            <input type="file" class="form-control" wire:model="image" placeholder="subir imagen">
                        @else
                            <img src="{{asset($image)}}" alt="Imagen" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                        @endif
                    </div>
                    <div class="col-5 col-md-3 col-lg-2 ms-lg-5">
                        @if($isEditing)
                            @if($image2)
                                <img src="{{ is_string($image2) ? $image2 : $image2->temporaryUrl() }}" alt="" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                            @endif
                            <input type="file" class="form-control" wire:model="image2" placeholder="subir imagen">
                        @else
                            <img src="{{ $image2 }}" alt="" class="img-fluid object-fit-cover shadow w-100 rounded-pill" style="height: 300px;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-5 fs-4">
                @if($isEditing)
                    <input type="text" class="form-control mt-5 fs-4 text-center" wire:model="text">
                @else
                    {{ $text }}
                @endif
            </div>
            <div class="mt-4 fs-1">
                @if($isEditing)
                    <input type="text" class="form-control mt-4 fs-1 text-center" wire:model="finalMessage">
                @else
                    {{ $finalMessage }}
                @endif
            </div>
        </div>
    </section> 
    @endif
</div>
