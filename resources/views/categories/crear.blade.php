@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="section-header">
    <h3 class="page__heading">Crear Producto</h3>
</div>
@stop

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-6 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="code">Código</label>
                                        <input type="text" name="code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="quantity_Stock">Cantidad Stock</label>
                                        <input type="text" name="quantity_Stock" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="quantity_inventory">Cantidad Inventario</label>
                                        <input type="text" name="quantity_inventory" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="due_date">Fecha Vencimiento</label>
                                        <input type="date" name="due_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="category">Categoria</label>
                                        <input type="text" name="category" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="min_supply_quantity">Cantidad Minima Reabastecimiento</label>
                                        <input type="text" name="min_supply_quantity" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-floating">
                                        <label for="description">Descripción</label>
                                        <textarea class="form-control" name="description"
                                            style="height: 100px"></textarea>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                        </form>

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