@extends('layouts.admin')

@section('admin-content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Cobranza correspondiente a: {{nombremes($mes_actual)}} <small>(Comparativo mes anterior)</small></h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="barChart" height="60"></canvas>
						<input  id ="cobranzas-mes-actual" type="hidden" value="{{$cobranzas_mes_actual}}"> 
						<input  id ="cobranzas-mes-anterior" type="hidden" value="{{$cobranza_mes_anterior}}">
						<input  id ="nombre-mes-actual" type="hidden" value="{{nombremes($mes_actual)}}"> 
						<input  id ="nombre-mes-anterior" type="hidden" value="{{nombremes($mes_anterior)}}"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Gastos: {{nombremes($mes_actual)}}</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="250"></canvas>
								<input  id ="nombres-gastos-torta" type="hidden" value="{{$gastos_torta_nombre}}"> 
								<input  id ="importes-gastos-torta" type="hidden" value="{{$gastos_torta_importe}}">
								<input  id ="colores-gastos-torta" type="hidden" value="{{$gastos_torta_color}}"> 
	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ingresos: {{nombremes($mes_actual)}} </h5>
                        </div>
                        <div class="ibox-content">
                            <p><br></p>
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{ number_format($importe_pagado_actual,2,',','.') }}</h2>
                                    <small>Total cobranzas mes actual</small>
									@if($importe_pagado_total != 0)
                                    <div class="stat-percent">{{ number_format($importe_pagado_actual/$importe_pagado_total*100,2,',','.') }}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$importe_pagado_actual/$importe_pagado_total*100}}%;" class="progress-bar"></div>
                                    </div>
									@else
									<div class="stat-percent">0 %</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 0%;" class="progress-bar"></div>
                                    </div>
									@endif
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{ number_format($importe_pagado_anterior,2,',','.') }}</h2>
                                    <small>Total cobranzas mes anterior</small>
									@if($importe_pagado_total_anterior != 0)
                                    <div class="stat-percent">
										{{ number_format($importe_pagado_anterior/$importe_pagado_total_anterior*100,2,',','.')}}%
									</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{ number_format($importe_pagado_anterior/$importe_pagado_total_anterior*100,0)}}%;" class="progress-bar progress-bar-2"></div>
                                    </div>
									@else
									<div class="stat-percent">
										0%
									</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 0%;" class="progress-bar progress-bar-2"></div>
                                    </div>
									@endif
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{number_format ($importe_pagado_promedio,2,',','.')}}</h2>
                                    <small>Promedio cobranzas mensuales</small>
									@if($importe_pagado_promedio_total != 0)
                                    <div class="stat-percent">{{number_format ( ($importe_pagado_promedio/$importe_pagado_promedio_total*100),2,',','.')}}%</div>
									
                                    <div class="progress progress-mini">
                                        <div style="width: {{number_format ( ($importe_pagado_promedio/$importe_pagado_promedio_total*100),0)}}%;" class="progress-bar progress-bar-2"></div>
                                    </div>
									@else
									<div class="stat-percent">0%</div>
                                    
                                    <div class="progress progress-mini">
                                        <div style="width: 0%;" class="progress-bar progress-bar-2"></div>
                                    </div>
									@endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Últimas transacciones</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom">Fecha</th>
                                            <th style="vertical-align:bottom">Nro. Documento</th>
                                            <th style="vertical-align:bottom">Tipo</th>
                                            <th style="vertical-align:bottom">Beneficiario</th>
                                            <th style="vertical-align:bottom">Concepto</th>
                                            <th style="vertical-align:bottom" class="text-right">Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										@for ($i = 0; $i < count($transacciones); $i++)
                                        <tr>
                                            <td>{{$transacciones[$i][0]}}</td>
                                            <td>{{$transacciones[$i][1]}}</td>
                                            <td>{{$transacciones[$i][2]}}</td>
                                            <td>{{$transacciones[$i][3]}}</td>
                                            <td>{{$transacciones[$i][4]}}</td>
                                            <td class="text-right">{{$transacciones[$i][5]}}</td>
                                        </tr>
										@endfor
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('transaction.transfer.index') }}" class="btn btn-default btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas las transacciones</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Solicitudes recibidas</h5>
                    <div class="ibox-tools">
                        <!--
                        <span class="label label-success pull-right">2 Mensajes nuevos</span>
                        -->
                       </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <div class="feed-activity-list">
							@foreach($tasks as $task)
                            <div class="feed-element">
                                <p class="pull-left">
                                    <img alt="Sol." src="img/system/solicitudes1.png" class="img-circle">
                                </p>
                                <div class="media-body ">
                                    <small class="pull-right">{{ date_format(date_create($task->fecha),'d/m/Y') }}</small>
                                    <strong>{{$task->titulo_tarea}}</strong><br>
                                    @if($task->tipo_tarea == 'mis_tareas')
									MIS TAREAS

								@elseif($task->tipo_tarea =='solicitudes_recibidas')
									SOLICITUDES RECIBIDAS

								@elseif($task->tipo_tarea =='reserva_instalaciones')
									RESERVA DE INSTALACION

								@elseif($task->tipo_tarea =='reclamos')
									RECLAMOS

								@elseif($task->tipo_tarea =='sugerencias')
									SUGERENCIAS

								@elseif($task->tipo_tarea =='notificacion_mudanza')
									NOTIFICACION DE MUDANZA

								@elseif($task->tipo_tarea =='notificacion_trabajos')
									NOTIFICACION DE TRABAJO

								@endif
                                    <small class="text-muted"></small>
                                    <div class="actions">
                                        <a href="{{ route('taskrequest.task.show', Crypt::encrypt($task->id)) }}" class="btn btn-xs btn-white">Ver solicitud</a>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('taskrequest.task.index')}}" class="btn btn-success btn-block m-t"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Ver todas</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/Chart.min.js') }}"></script>
<script>
$(function () {

    // Cobranzas
	//cobranzas-mes-actual
	nombre_mes_actual = $('#nombre-mes-actual').val();
	nombre_mes_anterior = $('#nombre-mes-anterior').val();
	mes_cobranza_actual = $('#cobranzas-mes-actual').val();
	mes_cobranza_actual = JSON.parse(mes_cobranza_actual);
	mes_cobranza_anterior = $('#cobranzas-mes-anterior').val();
	mes_cobranza_anterior = JSON.parse(mes_cobranza_anterior);
	//console.log(mes_cobranza_anterior);
    var barData = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
        datasets: [
            {
                label: nombre_mes_anterior,
                backgroundColor: 'rgba(144, 191 , 225, 0.6)',
                borderColor: 'rgba(144, 191 , 225, 0)',
                data: mes_cobranza_anterior
            },
            {
                label: nombre_mes_actual,
                backgroundColor: 'rgba(224, 111, 39, 0.6)',
                borderColor: "rgba(224, 111, 39, 0)",
                data: mes_cobranza_actual
            }
        ]
    };

    var barOptions = {
        responsive: true,
        legend: {
            display: true,
            position: 'bottom'
        },
        tooltips: {
            backgroundColor: 'rgba(0,0,0,0.5)'
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };

    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});


    // Gastos mensuales 
	nombres_gastos_torta = JSON.parse($('#nombres-gastos-torta').val());
	importes_gastos_torta = JSON.parse($('#importes-gastos-torta').val());
	colores_gastos_torta = JSON.parse($('#colores-gastos-torta').val());
	console.log(nombres_gastos_torta);
    var doughnutData = {
        labels: nombres_gastos_torta,
        datasets: [{
            data: importes_gastos_torta,
            //backgroundColor: ["#B8BBC2","#8C8E92","#3C507E","#D8DAE1","#DADCE1"]
            //backgroundColor: ["#ACDBFE","#B1B16F","#6691B1","#FEC7C6","#CACB75"]
            //backgroundColor: ["#3287C8","#C88C32","#134E7B","#59B7FF","#7B4D06"]
            //backgroundColor: ["#ACDBFE","#FEDDAC","#6691B1","#C6E7FF","#B18C55"]
            //backgroundColor: ["#ACDBFE","#ACDBFE","#81A4BE","#566D7E","#2A363F"]
            backgroundColor: colores_gastos_torta

        }]
    } ;


    var doughnutOptions = {
        responsive: true,
        legend: {
            display: false,
            position: 'bottom'
        },
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

});

</script>
@endsection

