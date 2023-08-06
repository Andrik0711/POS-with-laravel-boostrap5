@extends('layouts.user_type.auth')

@section('title', 'Ticket')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-2">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h6 class="mb-0">Detalle de venta</h6>

                                <div class="d-flex justify-end">
                                    {{-- Imagen para imprimir --}}
                                    {{-- <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-import.svg') }}" alt="print"
                                            width="30px">
                                    </a> --}}

                                    {{-- Imagen para exportar pdf --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-pdf.svg') }}" alt="pdf" width="30px">
                                    </a>

                                    {{-- Imagen para exportar XML --}}
                                    <a href="#" class="btn bg-gradient-primary mt-4 mx-2">
                                        <img src="{{ asset('images/icons/icon-xml.svg') }}" alt="xml" width="30px">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container mx-4">
                                <div class="row ">
                                    <div class="col">
                                        <h6 class="mb-1">Información del cliente</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Nombre:</span>
                                            <span class="text-secondary text-xs font-weight-bold ">
                                                {{ $venta_realizada->cliente->nombre_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Dirección:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->direccion_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Teléfono:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->telefono_cliente }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Correo:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->cliente->email_cliente }}</span>
                                        </p>
                                    </div>

                                    <div class="col"> </div>

                                    <div class="col">
                                        <h6 class="mb-1">Información de la venta</h6>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Código:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->id }}</span>
                                        </p>

                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Estado:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->venta_status }}</span>
                                        </p>
                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Productos:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $venta_realizada->venta_unidades_vendidas }}</span>
                                        </p>

                                        <p class="text-sm my-0">
                                            <span class="font-weight-bolder">Resta:</span>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                $ {{ $venta_realizada->venta_subtotal }}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive p-0">
                                <table id="productos-table" class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{--
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="check-all">
                                                </div> --}}
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Producto </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Unidades</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Precio unitario</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Subtotal</th>

                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                IVA</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($venta_realizada->productos as $producto)
                                            <tr>
                                                <td>
                                                    <!-- Checkbox for each row -->
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input checkbox-item" type="checkbox"
                                                            id="check-{{ $venta_realizada->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('productos') . '/' . $producto->imagen_producto }}"
                                                                class="me-3 rounded-3" width="100px"
                                                                alt="{{ $producto->nombre_producto }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $producto->nombre_producto }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $producto->pivot->cantidad_vendida }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ $producto->pivot->precio_unitario }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        $ {{ $producto->pivot->subtotal }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No se encontraron ventas</td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="4" class="text-end">
                                                <p class="text-sm font-weight-bold mb-0">Total:</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    $ {{ $venta_realizada->venta_total }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Alerta de éxito --}}
                    @if (session('mensaje'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> {{ session('mensaje') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection