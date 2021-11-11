@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="section-header">
    <h1 class="page__heading">Productos</h1>
</div>
@stop
@section('plugins.Datatables', true)
@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        @can('crear-producto')
                        <a style="margin:0px 0px 10px 0px" class="btn btn-warning" href="{{ route('products.create') }}">Nuevo</a>
                        <a style="margin:0px 0px 10px 10px" class="btn btn-success" href="{{ url('importproducts') }}">Cargue Masivo</a>
                        @endcan

                        <table id="productos" class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Código</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Descripción</th>
                                <th style="display: none;">Id Usuario</th>
                                <th style="color:#fff;">Categoría</th>
                                <th style="color:#fff;">Importancia</th>
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
                                    <td style="display: none;">{{ $product->id_user }}</td>
                                    <td>{{ $product->joincategory }}</td>
                                    <td>{{ $product->importance }}</td>
                                    <td>{{ $product->quantity_stock }}</td>
                                    <td>{{ $product->quantity_inventory }}</td>
                                    <td>{{ $product->due_date }}</td>
                                    <td>{{ $product->min_supply_quantity }}</td>
                                    <td>
                                        <form class="formEliminar"
                                            action="{{ route('products.destroy',$product->id) }}" method="POST">
                                            @can('editar-producto')
                                            <a class="btn btn-info"
                                                href="{{ route('products.edit',$product->id) }}">Editar <i class="fas fa-edit"></i></a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-producto')
                                            <button type="submit" class="btn btn-danger">Borrar <i class="fas fa-trash-alt "></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        
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

<script>
    $(document).ready(function(){
        $('#productos').DataTable();
    });
</script>

<script>
    (function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {        
          event.preventDefault()
          event.stopPropagation()        
          Swal.fire({
                title: '¿Confirma la eliminación del Producto?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El Rol ha sido eliminado exitosamente.','success');
                }
            })                      
      }, false)
    })
})()
</script>
@stop