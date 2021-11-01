@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<section class="section">
    <div class="container-fluid">
        <a style="margin:10px 0" class="btn btn-primary" href="{{ route('markAsRead') }}">Marcar todas como leídas</a>
        <div class="header">
            <h1>Sin leer.</h1>
        </div> 
        <div class="row">   
            @foreach ( $noleidas as $noread)
            
                <div class="col-lg-6 col-12">
                    <form action="{{ route('markRead') }}" method="POST">
                        @csrf
                        <input value="{{$noread->id}}"style="display: none;" type="text" id="id" name="id">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$noread->data['name']}}</h3>

                            <p>{{$noread->data['due_date']}}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        
                        <a href="{{url('products')}}" class="small-box-footer"><button type="submit" class="btn btn-warnign">Marcar como leída <i class="fas fa-arrow-circle-right"></i></button></a>
                    </div>
                    </form>
                </div>
              
            @endforeach
        </div>
        <div class='dropdown-divider'></div>
        <div class="header">
            <h1>Leídas.</h1>
        </div>
        <div class="row">
            @foreach ($leidas as $read)
            <div class="col-lg-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$read->data['name']}}</h3>

                        <p>{{$read->data['due_date']}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <a class="small-box-footer">Leída </a>
                </div>
            </div>                
            @endforeach
        </div>
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop