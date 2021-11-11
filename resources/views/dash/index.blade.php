@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$products->count();}}</h3>

                        <p>Productos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-shopping-basket"></i>
                    </div>
                    <a href="{{url('products')}}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$categories->count()-1;}}</h3>

                        <p>Categorías</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fas fa-list"></i>
                    </div>
                    <a href="{{url('categories')}}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$user->count();}}</h3>

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <a href="{{url('usuarios')}}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$productosxvencer->count();}}</h3>

                        <p>Productos a menos de 30 días de vencer</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-white" style="height: 25vw; padding: 40px 15px;">
                    <div class="info-box">
                        @php
                            if($products->count() > 0){
                                $porcentmuyimportantes = ($products->where('importance','Muy Importante')->count() / $products->count())*100;
                            }else{
                                $porcentmuyimportantes = 0;
                            }
                            
                        @endphp
                        @if ($porcentmuyimportantes < 15 || $porcentmuyimportantes > 25)
                            <span class="info-box-icon bg-warning"><i class="far fa-arrow-alt-circle-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text" style="color: tomato;">Productos Muy Importantes - No corresponde al porcentaje establecido</span>
                                <span class="info-box-number">{{$products->where('importance','Muy Importante')->count();}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: {{$porcentmuyimportantes}}%;"></div>
                                </div>
                                <span class="progress-description" style="color: tomato;">
                                    {{round($porcentmuyimportantes,2)}}% del inventario.
                                </span>
                            </div>
                        @else
                            <span class="info-box-icon bg-success"><i class="far fa-arrow-alt-circle-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Productos Muy Importantes</span>
                                <span class="info-box-number">{{$products->where('importance','Muy Importante')->count();}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: {{$porcentmuyimportantes}}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{$porcentmuyimportantes}}% del inventario.
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="info-box">
                        @php
                            if($products->count() > 0){
                                $porcentmedioimportantes = ($products->where('importance','Medianamente Importante')->count() / $products->count())*100;
                            }else{
                                $porcentmedioimportantes = 0;
                            }
                            
                        @endphp
                        @if ($porcentmedioimportantes < 25 || $porcentmedioimportantes > 30)
                        <span class="info-box-icon bg-warning"><i class="far fa-arrow-alt-circle-right"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: tomato;">Productos Medianamente Importantes - No corresponde al porcentaje establecido</span>
                            <span class="info-box-number">{{$products->where('importance','Medianamente Importante')->count();}}</span>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: {{$porcentmedioimportantes}}%"></div>
                            </div>
                            <span class="progress-description" style="color: tomato;">
                                {{round($porcentmedioimportantes,2)}}% del inventario.
                            </span>
                        </div>
                        @else
                            <span class="info-box-icon bg-success"><i class="far fa-arrow-alt-circle-right"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Productos Medianamente Importantes</span>
                                <span class="info-box-number">{{$products->where('importance','Medianamente Importante')->count();}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: {{$porcentmedioimportantes}}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{$porcentmedioimportantes}}% del inventario.
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="info-box">
                        @php
                            if($products->count() > 0){
                                $porcentpocoimportantes = ($products->where('importance','Poco Importante')->count() / $products->count())*100;
                            }else{
                                $porcentpocoimportantes = 0;
                            }
                            
                        @endphp
                        @if ($porcentpocoimportantes < 45 || $porcentpocoimportantes > 55)
                            <span class="info-box-icon bg-warning"><i class="far fa-arrow-alt-circle-down"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text" style="color: tomato;">Productos Poco Importantes - No corresponde al porcentaje establecido</span>
                                <span class="info-box-number">{{$products->where('importance','Poco Importante')->count();}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: {{$porcentpocoimportantes}}%;"></div>
                                </div>
                                <span class="progress-description" style="color: tomato;">
                                    {{round($porcentpocoimportantes,2)}}% del inventario.
                                </span>
                            </div>
                        @else
                            <span class="info-box-icon bg-success"><i class="far fa-arrow-alt-circle-down"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Productos Poco Importantes</span>
                                <span class="info-box-number">{{$products->where('importance','Poco Importante')->count();}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: {{$porcentpocoimportantes}}%"></div>
                                </div>
                                <span class="progress-description">
                                    {{$porcentpocoimportantes}}% del inventario.
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <!-- small box -->
                <div class="small-box bg-white" style="height: 25vw">
                    <span class="d-flex justify-content-center"><h3>Productos x Categorías</h3></span>
                    <div class="chart-container"  style="height: 21vw">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor auctor eros, id laoreet enim mollis quis.
    Quisque pellentesque neque dolor, in tristique elit consequat a. Phasellus vitae ultricies augue. Pellentesque
    libero justo, posuere facilisis accumsan nec, faucibus et justo. Praesent suscipit odio pretium imperdiet iaculis.
    Morbi tempus leo ut congue volutpat. Aliquam mollis fermentum sagittis. Aenean semper velit a urna porta bibendum.
    Nunc porta imperdiet metus, sed luctus urna sodales sit amet. Aliquam volutpat sem ipsum, nec sollicitudin nunc
    interdum at. Vestibulum dignissim diam at imperdiet tempor.

    Duis suscipit est non diam molestie porta. Fusce placerat vitae lacus vel aliquet. Duis dapibus urna vel leo luctus,
    quis pulvinar eros scelerisque. Nullam tristique ligula in lectus interdum, a lacinia nulla imperdiet. Sed convallis
    magna quis ornare condimentum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
    mus. Aenean imperdiet blandit nisi, vel eleifend velit lobortis in. Suspendisse metus ante, sagittis sed lorem
    volutpat, porttitor consectetur leo. Vestibulum purus nisl, scelerisque vel maximus in, porttitor ut erat. Mauris
    elit nulla, suscipit nec posuere quis, cursus sit amet purus. Suspendisse eget lorem congue, vehicula neque nec,
    condimentum sem. Cras a neque nisi. Sed nec ipsum vehicula lorem placerat rhoncus.

    Nam eget justo quam. Cras at est vel arcu egestas varius et id justo. Quisque commodo nisl risus, non tristique enim
    faucibus nec. Morbi faucibus faucibus est nec posuere. Aenean posuere est quis quam rutrum sagittis. Donec sit amet
    velit vitae nisi pulvinar condimentum. Mauris tincidunt feugiat elit, in viverra eros porttitor ut. Class aptent
    taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ornare velit nec nulla
    ornare molestie. Etiam aliquet, sem ac elementum suscipit, leo velit pulvinar sem, vitae vehicula nisi urna ac enim.
</p>
@stop

@section('plugins.Chartjs', true)



@section('css')

@stop

@section('js')

<script>
    //pull de colores background
    const background = ['rgb(220, 53, 69)',
                    'rgb(23, 162, 184)',
                    'rgb(255, 193, 7)',
                    'rgb(40, 167, 69)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)'];
    //valores donut
    var xValues =  [
            @foreach ($produxcatego as $proxcat2)
                ["{{ $proxcat2->name }}"],
            @endforeach
            ];
    var yValues =  [
            @foreach ($produxcatego as $proxcat)
                ["{{ $proxcat->countproxcate }}"],
            @endforeach
            ];
    //data donut chart
    const data = {
        labels: xValues,
            datasets: [{
                label: '# of Votes',
                data: yValues,
                backgroundColor: background,
                hoverOffset: 4,
                borderWidth: 1,
            }],
    };
    //config donut chart
    const config = {
        type: 'doughnut',
        data,
        options:{
            responsive:true,
            maintainAspectRatio: false
        }
    };
    //renderizando donut chart
    const myChart = new Chart(document.getElementById('myChart'), config);

    //config bar chart
    const config2 = {
        type: 'bar',
        data,
        options: {
            responsive:true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    //renderizando bar chart
    const BarChart = new Chart(document.getElementById('BarChart'), config2);
    
</script>


<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgb(220, 53, 69)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)'
                ],
              
                borderWidth: 1,
            }],
        },
    });
</script>
@stop