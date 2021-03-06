@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Plan de mantenimiento</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Equipamiento
            </li>
            <li class="active">
                <strong>Plan de mantenimiento</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
			@if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Plan de mantenimiento</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <div class="btn-group">
							<a href="{{ route('equipment.maintenanceplan.create') }}" class="btn btn-sm btn-default">Nuevo</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha estimada</th>
                                <th style="vertical-align:bottom">Equipo/ Maquinaria</th>
                                <th style="vertical-align:bottom">Referencia</th>
                                <th style="vertical-align:bottom" width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($maintenanceplans as $maintenanceplan)
                            <tr>
                                <td data-order="{{ $maintenanceplan->fecha_estimada }}" style="vertical-align: middle;">{{ date_format(date_create($maintenanceplan->fecha_estimada),'d/m/Y') }} 
									@if(diffdays($maintenanceplan->fecha_estimada) >= 0)
									  ({{diffdays($maintenanceplan->fecha_estimada)}})
									@else
									(<span style="color: red;">{{diffdays($maintenanceplan->fecha_estimada)}}</span>)
									@endif
								</td>
                                <td style="vertical-align: middle;">{{$maintenanceplan->equipment->equipo}}</td>
                                <td style="vertical-align: middle;">{{$maintenanceplan->referencia}}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group" style="padding-right: 10px;">
                                        <a style="width: 80px; text-align: left;" href="{{route('equipment.maintenancerecord.maintenanceplan.create',Crypt::encrypt($maintenanceplan->id) )}}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Registrar mantenimiento">
                                            <i class="fa fa-wrench"></i> Registrar 
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('equipment.maintenanceplan.show', Crypt::encrypt($maintenanceplan->id) ) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro de plan de mantenimiento">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('equipment.maintenanceplan.edit', Crypt::encrypt($maintenanceplan->id) ) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro de plan de mantenimiento">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
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
    <script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "No se encontraron Comunicados.",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "order": [[ 0, "asc" ]],
                "paging":   false,
                "info":     false
            });
        } );
    </script>
@endsection