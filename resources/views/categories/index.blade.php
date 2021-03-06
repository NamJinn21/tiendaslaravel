@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="section-header">
    <h1 class="page__heading">Categorías</h1>
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


                        @can('crear-categoria')
                        <a style="margin:0px 0px 10px 0px" class="btn btn-warning" href="{{ route('categories.create') }}">Nuevo</a>
                        @endcan

                        <table id="categorias" class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="display: none;">ID</th>
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td style="display: none;">{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->id == 4)
                                        <p>Sin acciones</p>
                                        @else
                                        <form class="formEliminar"
                                            action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                            @can('editar-categoria')
                                            <a class="btn btn-info"
                                                href="{{ route('categories.edit',$category->id) }}">Editar <i
                                                    class="fas fa-edit"></i></a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('borrar-categoria')
                                            <button type="submit" class="btn btn-danger">Borrar <i
                                                    class="fas fa-trash-alt "></i></button>
                                            @endcan
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $categories->links() !!}
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

<script>
    $(document).ready(function(){
        $('#categorias').DataTable();
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