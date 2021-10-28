@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="section-header">
    <h3 class="page__heading">Productos</h3>
</div>
@stop

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        @can('crear-producto')
                        <a class="btn btn-warning" href="{{ route('products.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Código</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Descripción</th>
                                <th style="color:#fff;">Categoría</th>
                                <th style="color:#fff;">Cantidad Stock</th>
                                <th style="color:#fff;">Cantidad Inventario</th>
                                <th style="color:#fff;">Fecha de vencimiento</th>
                                <th style="color:#fff;">Cantidad minima de reabastecimiento</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td style="display: none;">{{ $product->id }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->quantity_stock }}</td>
                                    <td>{{ $product->quantity_inventory }}</td>
                                    <td>{{ $product->due_date }}</td>
                                    <td>{{ $product->min_supply_quantity }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                            @can('editar-producto')
                                            <a href="{{ route('products.edit',$product->id) }}"><i
                                                    class="fas fa-edit fa-2x"
                                                    href="{{ route('products.edit',$product->id) }}"></i></a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-producto')
                                            <button type="submit"> <i class="fas fa-trash-alt fa-2x"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $products->links() !!}
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop