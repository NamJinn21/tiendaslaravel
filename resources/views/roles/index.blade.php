@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
     <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roless</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="div col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            @can('crear-rol')
                                <a class="btn btn-warning" href="{{ route('roles.create')}}">Nuevo</a>
                            @endcan

                            
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef">
                                    <th style="color: #fff;">Rol</th>
                                    <th style="color: #fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @can('editar-rol')
                                                <a class="btn btn-info"
                                                href="{{ route('roles.edit',$role->id)}}">Editar <i class="fas fa-edit"></i></a>
                                                @endcan
                                               
                                                @can('borrar-rol')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="formEliminar" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Borrar <i class="fas fa-trash-alt "></i></button>
                                                </form>
                                                @endcan                                                                                     
                                            </td>                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!!$roles->links()!!}
                            </div>
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
                title: '¿Confirma la eliminación del Rol?',        
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

   

