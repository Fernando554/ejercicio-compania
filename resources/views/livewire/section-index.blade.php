<div>
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto m-0">Lista de Compañias</h3>
        <div class="col-auto">
            <a href="{{ route('CustomView.create') }}" class="btn btn-primary">
                <i data-feather="plus-square"></i>
                Nueva Compañia
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="products" class="w-100 table table-striped">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <div class="form-group">
                                    <label for="paginate">Mostrar:</label>
                                    <select wire:model="paginate" class="form-control">
                                        <option selected>10</option>
                                        <option selected>25</option>
                                        <option selected>50</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>No. Seccion</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->User->name }}</td>
                                    <td>{{ $section->User->email }}</td>
                                    <td>
                                        <a href="{{ route('CustomView.show', $section) }}" class="btn btn-sm btn-success">Ver</a>
                                        <a href="{{ route('CustomView.create', $section) }}" class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $sections->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

