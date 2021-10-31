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
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="chart-container" style="height: 25vw">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="chart-container" style="height: 25vw">
                        <canvas id="BarChart"></canvas>
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
<!-- Map card -->
<div class="card bg-gradient-primary">
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Visitors
        </h3>
        <!-- card tools -->
        <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                <i class="far fa-calendar-alt"></i>
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <div class="card-body">
        <div id="world-map" style="height: 250px; width: 100%;"></div>
    </div>
    <!-- /.card-body-->
    <div class="card-footer bg-transparent">
        <div class="row">
            <div class="col-4 text-center">
                <div id="sparkline-1"></div>
                <div class="text-white">Visitors</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
                <div id="sparkline-2"></div>
                <div class="text-white">Online</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
                <div id="sparkline-3"></div>
                <div class="text-white">Sales</div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.card -->
@stop

@section('plugins.Chartjs', true)



@section('css')

@stop

@section('js')

<script>
    //data donut chart
    const data = {
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

    //config donut chart
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