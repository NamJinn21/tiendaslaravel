@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="section-header">
    <h3 class="page__heading">Categorías</h3>
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
                        <a class="btn btn-warning" href="{{ route('categories.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
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
                                        <form class="formEliminar"
                                            action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                            @can('editar-producto')
                                            <a class="btn btn-info"
                                                href="{{ route('categories.edit',$category->id) }}">Editar <i class="fas fa-edit"></i></a>
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