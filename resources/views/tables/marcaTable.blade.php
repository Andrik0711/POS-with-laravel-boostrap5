@extends('layouts.user_type.auth')

@section('title', 'Marcas')

@push('styles')
    {{-- Agregamos del cdn de datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    {{-- Referenciamos los estilos de app.css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Tabla de marcas</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    {{-- <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-printer.svg') }}" alt="print"
                                            width="30px">
                                    </a> --}}

                                    {{-- Botón para exportar el PDF --}}
                                    <a href="{{ route('exportar-marcas.pdf') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>


                                    {{-- Boton de importar XML --}}
                                    <label for="xml-file-input-marcas" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="import" width="30px">
                                    </label>
                                    <form id="import-form-marcas" action="{{ route('import-xml-marcas') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="xml_file" accept=".xml" id="xml-file-input-marcas"
                                            style="display: none;">
                                    </form>

                                    {{-- Boton de agregar productos --}}
                                    <a href="{{ route('registrar-marca-form') }}" class="btn bg-gradient-primary mt-4"><img
                                            src="{{ asset('images/icons/icon-add.svg') }}" alt="add"
                                            width="30px">Agregar marca</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="marcas-table" class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                
                                            </th> --}}
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Imagen</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Nombre</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                Descripción</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Editar</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($marcas as $marca)
                                            <tr>
                                                {{-- <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input checkbox-item" type="checkbox"
                                                            id="check-{{ $marca->id }}">
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <img src="{{ asset('marcas') . '/' . $marca->imagen_marca }}"
                                                        alt="{{ $marca->nombre_marca }}" width="60px"
                                                        class="border-radius-lg">
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $marca->nombre_marca }}</span>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $marca->descripcion_marca }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-info mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-edit-{{ $marca->id }}">
                                                        <img src="{{ asset('images/icons/icon-edit.svg') }}" alt="edit"
                                                            width="30px">
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn bg-gradient-danger mt-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-default-{{ $marca->id }}">
                                                        <img src="{{ asset('images/icons/icon-delete.svg') }}"
                                                            alt="delete" width="30px">
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No se encontraron marcas</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('modals')
    @foreach ($marcas as $marca)
        <!-- The Modal delete -->
        <div class="modal fade" id="modal-default-{{ $marca->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $marca->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $marca->id }}">¿Estás seguro de eliminar la
                            marca <span class="modal-edit-name">{{ $marca->nombre_marca }}</span>?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-marca', $marca->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn bg-gradient-danger">Eliminar</button>
                        </form>
                        <button type="button" class="btn bg-gradient-info ml-auto" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal para editar --}}
        <div class="modal fade" id="modal-edit-{{ $marca->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-edit-{{ $marca->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-edit-{{ $marca->id }}">¿Seguro qué quieres editar
                            la marca <span class="modal-edit-name">{{ $marca->nombre_marca }}</span>?
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('editar-marca-update', $marca->id) }}">
                            <button type="button" class="btn bg-gradient-info">SI</button>
                        </a>
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal para mostrar mensaje --}}
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- Condicionamos el tipo de mensaje --}}
                    @if (session('success'))
                        <h5 class="modal-title" id="successModalLabel">¡Bien!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @elseif (session('warning'))
                        <h5 class="modal-title" id="successModalLabel">¡Cuidado!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @elseif (session('error'))
                        <h5 class="modal-title" id="successModalLabel">¡Algo salio mal!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    @endif
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    @if (session('success'))
                        <img src="{{ asset('images/icons/icon-success.svg') }}" alt="icono de exito" class="mb-2"
                            width="70%">
                        {{ session('success') }}
                    @elseif (session('warning'))
                        <img src="{{ asset('images/icons/icon-warning.svg') }}" alt="icono de warning" class="mb-2"
                            width="70%">
                        {{ session('warning') }}
                    @elseif (session('error'))
                        <img src="{{ asset('images/icons/icon-error.svg') }}" alt="icono de error" class="mb-2"
                            width="70%">
                        {{ session('error') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endpush


@push('scripts')
    {{-- Agregamos del cdn de datatable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    {{-- Modales --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @elseif (session('warning'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @elseif (session('error'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 6000);
            @endif
        });
    </script>


    {{-- Este script permite modificar los textos de el datatable --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTable with drawCallback and language options
            $('#marcas-table').DataTable({
                "drawCallback": function(settings) {
                    // Find the "Previous" and "Next" button elements and change their content
                    $('.dataTables_wrapper .pagination .page-item.previous .page-link').html('&lt;');
                    $('.dataTables_wrapper .pagination .page-item.next .page-link').html('&gt;');

                    // Find the "Search" label and replace it with "Buscar" text but keep the input
                    $('.dataTables_wrapper .dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith('Buscar');

                    // Find the "Show [entries] entries" label and modify its text
                    $('.dataTables_wrapper .dataTables_length label').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith(function() {
                        return this.textContent.replace('Show', 'Mostrar').replace('entries',
                            'registros');
                    });

                    // Find "Showing [start] to [end] of [entries] entries" text and modify its text
                    $('.dataTables_wrapper .dataTables_info').contents().filter(function() {
                        return this.nodeType === 3;
                    }).replaceWith(function() {
                        return this.textContent.replace('Showing', 'Mostrando').replace('to',
                                'de').replace('of',
                                'de')
                            .replace('entries', 'registros');
                    });
                },
                "language": {
                    "infoFiltered": "" // Remove the "(filtered from x total entries)" text
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Abre el navegador de archivos al hacer clic en el botón
            $('#xml-file-input-marcas').on('change', function() {
                $('#import-form-marcas').submit();
            });
        });
    </script>
@endpush
