@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cobranzas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                <a href="{{ route('transaction.transfer.index') }}">Transacciones</a>
            </li>
            <li class="active">
                <strong>Cobranzas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
			@if (Session::has('message'))
				@if(session('message') == "error")
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Error en envío de cobranza.
				</div>
				@endif
				@if(session('message') == "exito")
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Cobranza enviada correctamente.
				</div>
				@endif
			@endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Cobranzas</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a href="{{ route('transaction.collection.create') }}" type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva cobranza" data-original-title="Nueva cobranza" style="margin-right: 5px; color: white;"> Nueva cobranza </a>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Nro.<br/>Documento</th>
                                <th style="vertical-align:bottom">Propiedad</th>
                                <th style="vertical-align:bottom">Contacto</th>
                                <th style="vertical-align:bottom">Concepto</th>
                                <th style="vertical-align:bottom">Cuenta</th>
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="70"></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($collections as $collection)
							@if($collection->transaction->anulada == 1)
							
							<tr style="color: #bbb">
                                <td data-order="{{ $collection->transaction->fecha_pago }}">{{ date_format(date_create($collection->transaction->fecha_pago),'d/m/Y') }}</td>
                                <td>{{ str_pad($collection->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</td>
                                <td data-order="{{ $collection->property->orden }}">{{ $collection->property->nro }}</td>
                                <td>{{ $collection->contact->nombre }} {{ $collection->contact->apellido }}</td>
                                <td>{{ $collection->transaction->concepto }}</td>
                                <td>{{ $collection->account->nombre }}</td>
                                <td style="text-align: right;">{{ number_format($collection->transaction->importe_credito, 2, ',', '.') }}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <span class="label label-warning">ANULADA</span>
                                </td>
                                <td>{{ $collection->transaction->notas }}</td>
                            </tr>
							
							@else
							
                            <tr>
                                <td data-order="{{ $collection->transaction->fecha_pago }}">{{ date_format(date_create($collection->transaction->fecha_pago),'d/m/Y') }}</td>
                                <td>{{ str_pad($collection->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</td>
                                <td data-order="{{ $collection->property->orden }}">{{ $collection->property->nro }}</td>
                                <td>{{ $collection->contact->nombre }} {{ $collection->contact->apellido }}</td>
                                <td>{{ $collection->transaction->concepto }}</td>
                                <td>{{ $collection->account->nombre }}</td>
                                <td style="text-align: right;">{{ number_format($collection->transaction->importe_credito, 2, ',', '.') }}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('transaction.collection.show',Crypt::encrypt($collection->id) ) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('transaction.collection.edit',Crypt::encrypt($collection->id)) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                   
                               </td>
                                <td>{{ $collection->transaction->notas }}</td>
                            </tr>
							
							@endif
							
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
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
                "order": [[ 0, "desc" ], [ 1, "desc" ]],
                "pageLength": 100,
                "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "Todos"] ],
                "bLengthChange" : false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 4 }, {"orderable": false, "targets": 7 }, {"visible": false, "targets": 8 } ]
            });
        } );
    </script>
@endsection



