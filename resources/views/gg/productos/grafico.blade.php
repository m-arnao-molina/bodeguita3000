@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header">
                Estadísticas de Venta: {{$nombre}}
            </div>
            <div class="card-body">
                @if($suma != 0)
                    @include('layouts.errores')
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script>
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Fecha', 'Cantidad'],
                                @foreach($ventas as $venta)
                                    @php
                                        $fecha=$venta->created_at->format('d-m-Y');
                                    @endphp
                                    ['{{$fecha}}', {{$venta->cantidad}}],
                                @endforeach
                            ]);
                            var options = {
                                title: 'Se han vendido {{$suma}} unidades de {{$nombre}} entre el {{$d}} y el {{$h}}',
                                hAxis: {title: 'Fecha',  titleTextStyle: {color: '#000'}},
                                vAxis: {minValue: 0}
                            };
                            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="chart_div"></div>
                    @else
                        <div class="alert alert-warning centrar-alerta">
                            <strong>¡Advertencia!</strong> No se han vendido productos en el rango de fecha establecido.
                        </div>
                @endif
                <a href="{{ route('gg_prod_estadisticas') }}">Volver</a>
            </div>
        </div>
    </div>
@endsection