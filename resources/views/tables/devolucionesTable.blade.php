@extends('layouts.user_type.auth')

@section('title', 'Devoluciones')

@push('styles')
    {{-- Agregamos del cdn de datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    {{-- Referenciamos los estilos de app.css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <div class="d-flex justify-content-between align-items-center mx-4">
                        <h6 class="mb-0">Tabla de devoluciones</h6>
                        <div class="d-flex justify-end">
                            <!-- {{-- Imagen para imprimir --}}
                                {{-- <a href="{{ route('importar-productos') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print" width="30px">
                            </a> --}} -->

                            {{-- Botón para exportar el PDF --}}
                            <a href="{{ route('reporte-devoluciones.pdf') }}" class="btn bg-gradient-primary mt-4 mx-2">
                                <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                            </a>
                            <!-- {{-- Imagen para exportar XML --}}
                                <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                    <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                </a> -->

                            {{-- Boton de agregar productos --}}
                            {{-- <a href="{{ route('mostrar-ventas') }}" class="btn bg-gradient-primary mt-4">Devolución de
                                Venta
                            </a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="productos-table" class="table align-items-center mb-0 text-center">
                            <thead>
                                <tr>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        
                                    </th> --}}
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Producto</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID de la venta</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Motivo</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha de devolución</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Cantidad devuelta</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Editar</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Eliminar</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Detalle</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($devoluciones as $devolucion)
                                    <tr>
                                        {{-- <td>
                                            <!-- Checkbox for each row -->
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input checkbox-item" type="checkbox"
                                                    id="check-{{ $devolucion->id }}">
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('productos') . '/' . $devolucion->producto->imagen_producto }}"
                                                        class="me-3 rounded-3 ms-4" width="100px"
                                                        alt="{{ $devolucion->producto->nombre_producto }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $devolucion->producto->nombre_producto }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $devolucion->venta_id }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($devolucion->motivo_devolucion === 'Sin motivo')
                                                <span
                                                    class="badge badge-sm bg-gradient-info">{{ $devolucion->motivo_devolucion }}</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $devolucion->motivo_devolucion }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $devolucion->fecha_devolucion }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $devolucion->cantidad_devuelta }}
                                            </p>
                                        </td>

                                        <td>
                                            <button type="button" class="btn bg-gradient-info mt-3" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-status-{{ $devolucion->id }}">
                                                <img src="{{ asset('images/icons/icon-edit.svg') }}" alt="edit"
                                                    width="30px">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn bg-gradient-danger mt-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-default-{{ $devolucion->id }}">
                                                <img src="{{ asset('images/icons/icon-delete.svg') }}" alt="delete"
                                                    width="30px">
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No se encontraron devoluciones</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@push('modals')
    @foreach ($devoluciones as $devolucion)
        <!-- The Modal delete -->
        <div class="modal fade" id="modal-default-{{ $devolucion->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-{{ $devolucion->id }}" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default-{{ $devolucion->id }}">¿Estás seguro de eliminar
                            la devolución <span class="modal-edit-name">{{ $devolucion->id }}</span>?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <!-- Form to handle the category deletion -->
                        <form action="{{ route('eliminar-devolucion', $devolucion->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn bg-gradient-danger">Eliminar</button>
                        </form>
                        <button type="button" class="btn bg-gradient-info ml-auto" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit-status-{{ $devolucion->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-edit-status-{{ $devolucion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">Editar motivo</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('actualizar-motivo-devolucion', $devolucion->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="input-group mb-3">
                                        <div class="form-group">
                                            <h6 for="motivo_devolucion">Ingresa el motivo de la devolución</h6>
                                            <input type="text" placeholder=" Motivo de la devolución"
                                                class="form-control" id="motivo_devolucion" name="motivo_devolucion"
                                                value="{{ old('motivo_devolucion') }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Bien!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-success.svg') }}" alt="icono de exito" class="mb-2"
                        width="70%">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">¡Cuidado!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-warning.svg') }}" alt="icono de warning" class="mb-2"
                        width="70%">
                    {{ session('warning') }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">¡Algo salió mal!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-evenly align-content-center flex-wrap">
                    <img src="{{ asset('images/icons/icon-error.svg') }}" alt="icono de error" class="mb-2"
                        width="70%">
                    {{ session('error') }}
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
                $('#warningModal').modal('show');
                setTimeout(function() {
                    $('#warningModal').modal('hide');
                }, 6000);
            @elseif (session('error'))
                $('#errorModal').modal('show');
                setTimeout(function() {
                    $('#errorModal').modal('hide');
                }, 6000);
            @endif
        });
    </script>

    {{-- Este script permite modificar los textos de el datatable --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTable with drawCallback and language options
            $('#productos-table').DataTable({
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
@endpush
